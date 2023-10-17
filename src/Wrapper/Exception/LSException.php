<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use Exception;

    /**
     * Class LSException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class LSException extends Exception
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 0;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Error occurred';

        /**
         * LSException constructor.
         * @param string $message
         * @param int $code
         * @param Exception|null $previous
         */
        public function __construct($message = "", $code = 0, \Exception $previous = null)
        {
            $message = $message ?: $this->getDefaultMessage();
            $code = $code ?: $this->getDefaultCode();
            parent::__construct($message, $code, $previous);
        }

        /**
         * Gets default exception code
         * @return int
         */
        public function getDefaultCode(): int
        {
            return $this->defaultCode;
        }

        /**
         * Gets default exception message
         * @return string
         */
        public function getDefaultMessage(): string
        {
            return $this->defaultMessage;
        }
    }