<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Traits;

    use Psr\Http\Message\RequestInterface;
    use Psr\Http\Message\ResponseInterface;

    /**
     * Trait RequestResponse
     * @package smallinvoice\api2\Wrapper\Exception\Traits
     */
    trait RequestResponse
    {

        /**
         * Request
         * @var RequestInterface
         */
        protected $request;

        /**
         * Response
         * @var ResponseInterface
         */
        protected $response;

        /**
         * Creates new object based on specified request and response
         * @param RequestInterface $request
         * @param ResponseInterface $response
         * @return static
         */
        public static function createNewWithRequestResponse(RequestInterface $request, ResponseInterface $response)
        {
            $body = json_decode((string)$response->getBody(), true);
            $e = new static($body['message'], $body['code']);

            $e->setRequest($request);
            $e->setResponse($response);

            return $e;
        }

        /**
         * Sets request
         * @param RequestInterface $request
         */
        public function setRequest(RequestInterface $request)
        {
            $this->request = $request;
        }

        /**
         * Sets response
         * @param ResponseInterface $response
         */
        public function setResponse(ResponseInterface $response)
        {
            $this->response = $response;
        }

        /**
         * Gets request
         * @return RequestInterface
         */
        public function getRequest(): RequestInterface
        {
            return $this->request;
        }

        /**
         * Gets response
         * @return ResponseInterface
         */
        public function getResponse(): ResponseInterface
        {
            return $this->response;
        }
    }