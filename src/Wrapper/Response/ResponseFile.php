<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Response;

    /**
     * Class ResponseFile
     * @package smallinvoice\api2\Wrapper\Response
     */
    class ResponseFile
    {

        /**
         * @var Response
         */
        private $response;

        /**
         * ResponseFile constructor.
         * @param Response $response
         */
        public function __construct(Response $response)
        {
            $this->response = $response;
        }

        /**
         * Creates ResponseFile object from Response
         * @param Response $response
         * @return ResponseFile
         * @throws ResponseException
         */
        public static function createFromResponse(Response $response): ResponseFile
        {
            if (!$response->hasHeader('Content-Type')) {
                throw new ResponseException('Property item not set');
            }

            return new static($response);
        }

        /**
         * Saves file to location
         * @param $file
         * @throws ResponseException
         */
        public function saveTo($file)
        {
            if (!file_put_contents($file, $this->response->getBody()->getContents())) {
                throw new ResponseException('could not save file');
            }
        }
    }
