<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\OAuth2\Client\Provider;

    use GuzzleHttp\Exception\BadResponseException;
    use GuzzleHttp\Exception\ClientException;
    use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
    use League\OAuth2\Client\Token\AccessToken;
    use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
    use Psr\Http\Message\RequestInterface;
    use Psr\Http\Message\ResponseInterface;

    /**
     * Class Provider
     * @package smallinvoice\api2\Wrapper\OAuth2\Client\Provider
     */
    class Provider extends \League\OAuth2\Client\Provider\AbstractProvider
    {

        use BearerAuthorizationTrait;

        /**
         * @var string
         */
        protected $baseUrl;

        /**
         * @var string
         */
        protected $urlAuthorize;

        /**
         * @var string
         */
        protected $urlAccessToken;

        /**
         * @var string
         */
        protected $urlResourceOwnerDetails;

        /**
         * Sets base API URL.
         * @param string $baseUrl
         */
        public function setBaseUrl(string $baseUrl)
        {
            $this->baseUrl = $baseUrl;
        }

        /**
         * Gets base API URL
         * @return string
         */
        public function getBaseUrl(): string
        {
            return $this->baseUrl;
        }

        /**
         * @inheritdoc
         */
        public function getBaseAuthorizationUrl()
        {
            return isset($this->urlAuthorize) ? $this->urlAuthorize : $this->getBaseUrl() . '/auth/authorize';
        }

        /**
         * @inheritdoc
         */
        public function getBaseAccessTokenUrl(array $params)
        {
            return isset($this->urlAccessToken) ? $this->urlAccessToken : $this->getBaseUrl() . '/auth/access-tokens';
        }

        /**
         * @inheritdoc
         */
        public function getResourceOwnerDetailsUrl(AccessToken $token)
        {
            return isset($this->urlResourceOwnerDetails) ? $this->urlResourceOwnerDetails : $this->getBaseUrl() . '/auth/owner';
        }

        /**
         * @inheritdoc
         */
        protected function createResourceOwner(array $response, AccessToken $token)
        {
            return new ResourceOwner($response);
        }

        /**
         * @inheritdoc
         */
        protected function getDefaultScopes()
        {
            return [];
        }

        /**
         * @inheritdoc
         *
         * league/oauth2-client v1 parses the response inside getResponse() (and has no
         * getParsedResponse()), while v2 returns the raw ResponseInterface here and moves
         * parsing to getParsedResponse(). To stay compatible with both:
         *  - on v2 we defer to the parent (raw response) and parse/wrap in getParsedResponse();
         *  - on v1 we parse here and wrap provider errors as a Guzzle ClientException.
         */
        public function getResponse(RequestInterface $request)
        {
            if (method_exists('League\OAuth2\Client\Provider\AbstractProvider', 'getParsedResponse')) {
                return parent::getResponse($request);
            }

            return $this->parseAndCheckResponse($request, $this->sendRequest($request));
        }

        /**
         * @inheritdoc
         *
         * Only used on league/oauth2-client v2+ (getAccessToken() calls getParsedResponse()).
         */
        public function getParsedResponse(RequestInterface $request)
        {
            try {
                $response = $this->getResponse($request);
            } catch (BadResponseException $e) {
                $response = $e->getResponse();
            }

            return $this->parseAndCheckResponse($request, $response);
        }

        private function parseAndCheckResponse(RequestInterface $request, ResponseInterface $response)
        {
            try {
                $parsed = $this->parseResponse($response);
                $this->checkResponse($response, $parsed);
            } catch (IdentityProviderException $e) {
                throw new ClientException($e->getMessage(), $request, $response);
            } catch (\UnexpectedValueException $e) {
                throw new ClientException($e->getMessage(), $request, $response);
            }

            return $parsed;
        }

        /**
         * @inheritdoc
         */
        protected function checkResponse(ResponseInterface $response, $data)
        {
            if ($response->getStatusCode() != 200 && $response->getStatusCode() != 201) {
                throw new IdentityProviderException(
                    isset($data['error']) ? $data['error'] : $response->getReasonPhrase(),
                    $response->getStatusCode(),
                    $response
                );
            }
        }
    }