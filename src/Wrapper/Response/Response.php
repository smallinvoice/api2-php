<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Response;

    /**
     * Class Response
     * @package smallinvoice\api2\Wrapper\Response
     */
    class Response extends \GuzzleHttp\Psr7\Response
    {

        /**
         * Response parsed body object
         * @var \stdClass
         */
        protected $parsedBody;

        /**
         * Creates Response object from Psr7Response object
         * @param \GuzzleHttp\Psr7\Response $response
         * @return Response
         */
        public static function createFromResponse(\GuzzleHttp\Psr7\Response $response): Response
        {
            $newResponse = new static($response->getStatusCode(), $response->getHeaders(), $response->getBody(),
                $response->getProtocolVersion(), $response->getReasonPhrase());

            return $newResponse;
        }

        /**
         * Returns response body as an object
         * @return \stdClass
         */
        public function getParsedBody(): \stdClass
        {
            if (!$this->parsedBody) {
                $this->parsedBody = \GuzzleHttp\json_decode((string)$this->getBody());
            }

            return $this->parsedBody;
        }

        /**
         * Gets ResponseItem object created from Response
         * @return ResponseItem
         * @throws ResponseException
         */
        public function getItem(): ResponseItem
        {
            return ResponseItem::createFromResponse($this);
        }

        /**
         * Gets ResponseItems object created from Response
         * @return ResponseItems
         * @throws ResponseException
         */
        public function getItems(): ResponseItems
        {
            return ResponseItems::createFromResponse($this);
        }

        /**
         * Gets ResponseFile object created from Response
         * @return ResponseFile
         * @throws ResponseException
         */
        public function getFile(): ResponseFile
        {
            return ResponseFile::createFromResponse($this);
        }
    }