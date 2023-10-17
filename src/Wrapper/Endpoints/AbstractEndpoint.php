<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Endpoints;

    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\ClientException;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\PdfParameters;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\PreviewParameters;
    use smallinvoice\api2\Wrapper\Exception\ApplicationOfflineException;
    use smallinvoice\api2\Wrapper\Exception\Feature\FeatureHardLimitException;
    use smallinvoice\api2\Wrapper\Exception\Feature\FeatureLimitException;
    use smallinvoice\api2\Wrapper\Exception\Feature\FeatureSoftLimitException;
    use smallinvoice\api2\Wrapper\Exception\Feature\FeatureTotalLimitException;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\OAuth2\Client\Provider\Provider;
    use Psr\Http\Message\RequestInterface;
    use smallinvoice\api2\Wrapper\Response\Response;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;
    use smallinvoice\api2\Wrapper\Exception\BadRequestException;
    use smallinvoice\api2\Wrapper\Exception\RateLimitException;
    use Laminas\Diactoros\Stream;
    use League\OAuth2\Client\Token\AccessToken;
    use Psr\Http\Message\ResponseInterface;
    use smallinvoice\api2\Wrapper\Exception\AuthException;
    use smallinvoice\api2\Wrapper\Exception\MethodNotAllowedException;
    use smallinvoice\api2\Wrapper\Exception\NotFoundException;
    use smallinvoice\api2\Wrapper\Exception\NoFeatureException;
    use smallinvoice\api2\Wrapper\Exception\NoPermissionsException;
    use smallinvoice\api2\Wrapper\Exception\ServerException;
    use smallinvoice\api2\Wrapper\Exception\ValidationFailedException;
    use smallinvoice\api2\Wrapper\Exception\EntityTooLargeException;

    /**
     * Class AbstractEndpoint
     * @package smallinvoice\api2\Wrapper\Endpoints
     */
    abstract class AbstractEndpoint
    {

        const METHOD_GET = 'GET';
        const METHOD_POST = 'POST';
        const METHOD_PUT = 'PUT';
        const METHOD_DELETE = 'DELETE';
        const METHOD_PATCH = 'PATCH';

        /**
         * Service provider (authorization server).
         * @var Provider
         */
        protected $provider;

        /**
         * @var Client;
         */
        protected $httpClient;

        /**
         * Base API URL
         * @var string
         */
        protected $baseUrl;

        /**
         * Request refresh token
         * @var string
         */
        protected $refreshToken;

        /**
         * Request access token
         * @var AccessToken
         */
        protected $accessToken;

        /**
         * Request scopes
         * @var array
         */
        protected $scopes = [];

        /**
         * Request language
         * @var string
         */
        protected $language;

        /**
         * AbstractEndpoint constructor.
         * @param Provider $provider
         * @param string|null $refreshToken
         * @throws \Exception
         */
        public function __construct(Provider $provider, string $refreshToken = null)
        {
            $this->provider = $provider;
            $this->baseUrl = $this->provider->getBaseUrl();
            $this->checkBaseUrl();
            $this->httpClient = $this->provider->getHttpClient();

            if ($refreshToken !== null) {
                $this->setRefreshToken($refreshToken);
            }
        }

        /**
         * Sets request refresh token.
         * @param string $refreshToken
         */
        public function setRefreshToken(string $refreshToken)
        {
            $this->refreshToken = $refreshToken;
            $this->accessToken = null;
        }

        /**
         * Sets request access token.
         * @param AccessToken $accessToken
         */
        public function setAccessToken(AccessToken $accessToken)
        {
            $this->accessToken = $accessToken;
        }

        /**
         * Sets request scopes.
         * @param array $scopes
         */
        public function setScopes(array $scopes)
        {
            $this->scopes = $scopes;
        }

        /**
         * Sets request language. Necessary for endpoints that return translatable content.
         * @param string $language
         */
        public function setLanguage(string $language)
        {
            $this->language = $language;
        }

        /**
         * Gets service provider (authorization server).
         * @return Provider
         */
        public function getProvider(): Provider
        {
            return $this->provider;
        }

        /**
         * Gets request access token.
         * @return AccessToken
         */
        public function getAccessToken(): AccessToken
        {
            if (!isset($this->accessToken) || $this->accessToken->hasExpired()) {
                if ($this->refreshToken) {
                    $this->accessToken = $this->provider->getAccessToken('refresh_token', [
                        'refresh_token' => $this->refreshToken,
                        'scope'         => implode(' ', $this->scopes)
                    ]);
                } else {
                    $this->accessToken = $this->provider->getAccessToken('client_credentials',
                        ['scope' => implode(' ', $this->scopes)]);
                }
            }

            return $this->accessToken;
        }

        /**
         * Checks base URL
         * @throws \Exception
         */
        protected function checkBaseUrl()
        {
            if (!preg_match('/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}' . '((:[0-9]{1,5})?\\/.*)?$/i',
                $this->baseUrl)
            ) {
                throw new LSException('Logic exception: invalid baseUrl set.');
            }
        }

        /**
         * Makes an API call.
         * @param string $method
         * @param string $url
         * @param array $data
         * @return Response
         * @throws LSException
         */
        protected function callApi(string $method, string $url, array $data = []): Response
        {
            try {
                $request = $this->getRequest($method, $url);
                $options = $this->prepareRequestOptions($data);

                return Response::createFromResponse($this->httpClient->send($request, $options));
            } catch (ClientException $e) {
                throw $this->getProperExceptionForResponse($e->getResponse(), $e->getRequest());
            } catch (\GuzzleHttp\Exception\ServerException $e) {
                throw $this->getProperExceptionForResponse($e->getResponse(), $e->getRequest());
            }
        }

        /**
         * Prepares and returns request object.
         * @param string $method
         * @param string $url
         * @return RequestInterface
         */
        protected function getRequest(string $method, string $url): RequestInterface
        {
            $request = $this->provider->getAuthenticatedRequest($method, $url, $this->getAccessToken());

            if (isset($this->language)) {
                $request = $request->withHeader('Accept-Language', $this->language);
            }

            return $request;
        }

        /**
         * Prepares request options.
         * @param array $data
         * @return array
         */
        protected function prepareRequestOptions(array $data = []): array
        {
            if (isset($data['file']) && $data['file'] !== null && !empty($data['file'])) {
                $options = $this->prepareRequestFileOptions($data);
            } else {
                $options = $this->prepareRequestStandardOptions($data);
            }

            return $options;
        }

        /**
         * Prepares request options for standard request.
         * @param array $data
         * @return array
         */
        protected function prepareRequestStandardOptions(array $data): array
        {
            $options = [];
            if ($data !== null) {
                $stream = new Stream('php://temp', 'r+');
                $stream->write(\GuzzleHttp\json_encode($data, JSON_PRESERVE_ZERO_FRACTION));

                $options['body'] = $stream;
                $options['headers'] = ['Content-Type' => 'application/json'];
            }

            return $options;
        }


        /**
         * Prepares request options for sending/uploading files.
         * @param array $data
         * @return array
         */
        protected function prepareRequestFileOptions(array $data): array
        {
            $fileExists = file_exists($data['file']['filePath']);

            $options = [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => $fileExists ? fopen($data['file']['filePath'], 'r') : '',
                        'filename' => $fileExists ? $data['file']['originalName'] : '',
                        'headers'  => [
                            'Content-Type' => $fileExists ? (new \finfo(FILEINFO_MIME))->file($data['file']['filePath']) : ''
                        ]
                    ]
                ]
            ];
            //add additional data if needed
            if ($data['data'] !== null) {
                $options['multipart'][] = [
                    'name'     => 'data',
                    'contents' => \GuzzleHttp\json_encode($data['data'], JSON_PRESERVE_ZERO_FRACTION)
                ];
            }

            return $options;
        }

        /**
         * Checks specified response and returns proper exception.
         * @param ResponseInterface $response
         * @param RequestInterface $request
         * @return LSException
         */
        protected function getProperExceptionForResponse(ResponseInterface $response, RequestInterface $request): LSException
        {
            $body = json_decode((string)$response->getBody(), true);

            switch ($response->getStatusCode()) {
                case 400:
                    $exception = BadRequestException::createNewWithRequestResponse($request, $response);
                    break;
                case 401:
                    $exception = AuthException::createNewWithRequestResponse($request, $response);
                    $exception->setErrorType((string)$body['meta']['error_type']);
                    $exception->setHint((string)$body['meta']['hint']);
                    break;
                case 402:
                    switch ($body['code']) {
                        case 4001:
                            $exception = FeatureHardLimitException::createNewWithRequestResponse($request, $response);
                            break;
                        case 4002:
                            $exception = FeatureSoftLimitException::createNewWithRequestResponse($request, $response);
                            break;
                        case 4003:
                            $exception = FeatureTotalLimitException::createNewWithRequestResponse($request, $response);
                            break;
                        default:
                            $exception = FeatureLimitException::createNewWithRequestResponse($request, $response);
                    }
                    $exception->setLimit($body['meta']['limit']);
                    $exception->setFeature($body['meta']['feature']);
                    break;
                case 403:
                    if (isset($body['meta']['feature'])) {
                        $exception = NoFeatureException::createNewWithRequestResponse($request, $response);
                        $exception->setFeature($body['meta']['feature']);
                        $exception->setPlans($body['meta']['plans']);
                    } else {
                        $exception = NoPermissionsException::createNewWithRequestResponse($request, $response);
                    }
                    break;
                case 404:
                    $exception = NotFoundException::createNewWithRequestResponse($request, $response);
                    $exception->setEntityType($body['meta']['entity_type']);
                    break;
                case 405:
                    $exception = MethodNotAllowedException::createNewWithRequestResponse($request, $response);
                    break;
                case 413:
                    $exception = EntityTooLargeException::createNewWithRequestResponse($request, $response);
                    break;
                case 422:
                    $exception = ValidationFailedException::createNewWithRequestResponse($request, $response);
                    $exception->setErrorsData($body['meta']['errors']);
                    break;
                case 429:
                    $exception = RateLimitException::createNewWithRequestResponse($request, $response);
                    break;
                case 503:
                    $exception = ApplicationOfflineException::createNewWithRequestResponse($request, $response);
                    break;
                case 500:
                default:
                    $exception = ServerException::createNewWithRequestResponse($request, $response);
            }

            return $exception;
        }

        /**
         * Prepares url for list action.
         * @param string $endpointUrl
         * @param ListParameters|null $parameters
         * @return string
         */
        protected function prepareListUrl(string $endpointUrl, ListParameters $parameters = null): string
        {
            $params = [];
            if (!is_null($parameters)) {
                if ($parameters->hasQ()) {
                    $params[] = 'q=' . $parameters->getQ();
                }
                if ($parameters->hasFilter()) {
                    $params[] = 'filter=' . urlencode($parameters->getFilter());
                }
                if ($parameters->hasWith()) {
                    $params[] = 'with=' . $parameters->getWith();
                }
                if ($parameters->hasLimit()) {
                    $params[] = 'limit=' . $parameters->getLimit();
                }
                if ($parameters->hasOffset()) {
                    $params[] = 'offset=' . $parameters->getOffset();
                }
                if ($parameters->hasSort()) {
                    $params[] = 'sort=' . $parameters->getSort();
                }
            }

            if (!empty($params)) {
                $endpointUrl .= '?' . implode('&', $params);
            }

            return $this->baseUrl . $endpointUrl;
        }

        /**
         * prepares URL for get action
         * @param string $endpointUrl
         * @param GetParameters|null $parameters
         * @return string
         */
        protected function prepareGetUrl(string $endpointUrl, GetParameters $parameters = null): string
        {
            $params = [];
            if (!is_null($parameters)) {
                if ($parameters->hasWidth()) {
                    $params[] = 'with=' . $parameters->getWith();
                }
            }

            if (!empty($params)) {
                $endpointUrl .= '?' . implode('&', $params);
            }

            return $this->baseUrl . $endpointUrl;
        }

        /**
         * Prepares URL for pdf action
         * @param string $endpointUrl
         * @param PdfParameters|null $parameters
         * @return string
         */
        protected function preparePdfUrl(string $endpointUrl, PdfParameters $parameters = null): string
        {
            $params = [];
            if (!is_null($parameters)) {
                if ($parameters->hasOptions()) {
                    $params[] = 'options=' . $parameters->getOptions();
                }
            }

            if (!empty($params)) {
                $endpointUrl .= '?' . implode('&', $params);
            }

            return $this->baseUrl . $endpointUrl;
        }

        /**
         * Prepares URL for preview action
         * @param string $endpointUrl
         * @param PreviewParameters|null $parameters
         * @return string
         */
        protected function preparePreviewUrl(string $endpointUrl, PreviewParameters $parameters = null): string
        {
            $params = [];
            if (!is_null($parameters)) {
                if ($parameters->hasSize()) {
                    $params[] = 'size=' . $parameters->getSize();
                }

                if ($parameters->hasPage()) {
                    $params[] = 'page=' . $parameters->getPage();
                }
            }

            if (!empty($params)) {
                $endpointUrl .= '?' . implode('&', $params);
            }

            return $this->baseUrl . $endpointUrl;
        }
    }