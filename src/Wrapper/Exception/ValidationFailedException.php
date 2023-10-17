<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;

    /**
     * Class ValidationFailedException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class ValidationFailedException extends LSException
    {

        use RequestResponse;

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 1000;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid data';

        /**
         * Data of all gathered errors: [ 'key' => 'string', 'code' => int, 'message' => 'string']
         * @var array
         */
        private $errorsData = [];

        /**
         * Sets array with data of all gathered errors.
         * @param array $errorsData
         */
        public function setErrorsData(array $errorsData)
        {
            $this->errorsData = $errorsData;
        }

        /**
         * Gets data of all gathered errors. Returns [ 'key' => 'string', 'code' => int, 'message' => 'string']
         * @return array
         */
        public function getErrorsData(): array
        {
            return $this->errorsData;
        }

        /**
         * Gets array of all keys of all gathered errors.
         * @return array
         */
        public function getFieldKeys(): array
        {
            $keys = [];
            foreach ($this->getErrorsData() as $metaError) {
                $keys[] = $metaError['key'];
            }

            return $keys;
        }
    }