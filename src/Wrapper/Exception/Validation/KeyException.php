<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Validation;

    use smallinvoice\api2\Wrapper\Exception\Interfaces\StickToDefaultValues;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Exception\Traits\StickToDefaultValuesImplementation;

    /**
     * Class KeyException
     * @package smallinvoice\api2\Wrapper\Exception\Validation
     */
    abstract class KeyException extends LSException implements StickToDefaultValues
    {

        use StickToDefaultValuesImplementation;

        /**
         * Key of a field
         * @var string
         */
        private $key;

        /**
         * Creates new exception for specified key
         * @param string $key
         * @param string $message
         * @param int $code
         * @return static
         */
        public static function createNew($key, $message = '', $code = 0)
        {
            $new = new static($message, $code);
            $new->setKey($key);

            return $new;
        }

        /**
         * Sets key
         * @param string $key
         */
        public function setKey(string $key)
        {
            $this->key = $key;
        }

        /**
         * Gets key
         * @return string
         */
        public function getKey(): string
        {
            return $this->key;
        }
    }