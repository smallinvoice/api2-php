<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;

    /**
     * Class MethodNotAllowedException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class MethodNotAllowedException extends LSException
    {

        use RequestResponse;

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 7000;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Method not allowed';

        /**
         * Allowed methods
         * @var array
         */
        protected $allowedMethods = [];

        /**
         * Creates new MethodNotAllowedException passing array of allowed methods
         * @param array $methods
         * @return MethodNotAllowedException
         */
        public static function createNew(array $methods)
        {
            $message = 'Method must be one of: ' . implode(', ', $methods);
            $e = new static($message);
            $e->setAllowedMethods($methods);

            return $e;
        }

        /**
         * Sets allowed methods array
         * @param array $allowedMethods
         * @return void
         */
        public function setAllowedMethods(array $allowedMethods)
        {
            $this->allowedMethods = $allowedMethods;
        }

        /**
         * Gets allowed methods array
         * @return array
         */
        public function getAllowedMethods(): array
        {
            return $this->allowedMethods;
        }
    }