<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Interfaces\StickToDefaultValues;
    use smallinvoice\api2\Wrapper\Exception\Validation\KeyException;

    /**
     * Class ValidationException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class ValidationException extends LSException
    {

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
         * Array of exceptions indexed with keys
         * @var \Exception[]
         */
        private $exceptions = [];

        /**
         * Checks if there's any exception's data gathered
         * @return bool
         */
        public function isNotEmpty(): bool
        {
            return !empty($this->exceptions);
        }

        /**
         * Checks whether there's already an exception assigned for specified key
         * @param string $key
         * @return bool
         */
        public function exceptionKeyExists($key): bool
        {
            return array_key_exists($key, $this->exceptions);
        }

        /**
         * Gets first of gathered exceptions.
         * @return \Exception|null
         */
        public function getFirstException()
        {
            if ($this->isNotEmpty()) {
                return current($this->exceptions);
            }

            return null;
        }

        /**
         * Gets all gathered exceptions
         * @return \Exception[]
         */
        public function getExceptions(): array
        {
            return $this->exceptions;
        }

        /**
         * Gets data of all gathered exceptions. Returns array with following indexes: key, code, message
         * @return array
         */
        public function getExceptionsData(): array
        {
            $errors = [];
            foreach ($this->exceptions as $key => $exception) {
                $error = array(
                    'key'     => $key,
                    'code'    => $exception instanceof LSException && $exception instanceof StickToDefaultValues ? ($exception->overwriteCode() ? $exception->getCode() : $exception->getDefaultCode()) : $exception->getCode(),
                    'message' => $exception instanceof LSException && $exception instanceof StickToDefaultValues ? ($exception->overwriteMessage() ? $exception->getMessage() : $exception->getDefaultMessage()) : $exception->getMessage(),
                );

                $errors[] = $error;
            }

            return $errors;
        }

        /**
         * Adds exception
         * @param string $key
         * @param \Exception $e
         */
        public function addException(string $key, \Exception $e)
        {
            $this->exceptions[$key] = $e;
        }

        /**
         * Adds KeyException
         * @param KeyException $e
         */
        public function addKeyException(KeyException $e)
        {
            $this->exceptions[$e->getKey()] = $e;
        }


        /**
         * Throws first from gathered exceptions
         * @throws \Exception
         */
        public function throwFirst()
        {
            if ($this->isNotEmpty()) {
                throw $this->getFirstException();
            }
        }

        /**
         * Throws itself if there's any exception data gathered
         * @throws ValidationException
         */
        public function throwIfNotEmpty()
        {
            if ($this->isNotEmpty()) {
                throw $this;
            }
        }
    }
