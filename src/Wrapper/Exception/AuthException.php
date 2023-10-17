<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;

    /**
     * Class AuthException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class AuthException extends LSException
    {

        use RequestResponse;

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 0;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Authentication error occurred';

        /**
         * Type of error
         * @var string
         */
        private $errorType = '';

        /**
         * Optional hint what might have gone wrong
         * @var string
         */
        private $hint = '';

        /**
         * @param string $errorType
         */
        public function setErrorType(string $errorType)
        {
            $this->errorType = $errorType;
        }

        /**
         * @param string $hint
         */
        public function setHint(string $hint)
        {
            $this->hint = $hint;
        }

        /**
         * @return string
         */
        public function getErrorType(): string
        {
            return $this->errorType;
        }

        /**
         * @return string
         */
        public function getHint(): string
        {
            return $this->hint;
        }
    }