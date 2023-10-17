<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Traits;

    /**
     * Trait StickToDefaultValuesImplementation
     * @package smallinvoice\api2\Wrapper\Exception\Traits
     */
    trait StickToDefaultValuesImplementation
    {

        /**
         * Should exception's default message be overwritten
         * @var bool
         */
        private $overwriteMessage = false;

        /**
         * Should exception's default code be overwritten
         * @var bool
         */
        private $overwriteCode = false;

        /**
         * Sets whether exception's default message should be overwritten or not
         * @param bool $overwrite
         * @return $this
         */
        public function setOverwriteMessage(bool $overwrite = true)
        {
            $this->overwriteMessage = $overwrite;

            return $this;
        }

        /**
         * Sets whether exception's default code should be overwritten or not
         * @param bool $overwrite
         * @return $this
         */
        public function setOverwriteCode(bool $overwrite = true)
        {
            $this->overwriteCode = $overwrite;

            return $this;
        }

        /**
         * Should exception's default message be overwritten
         * @return bool
         */
        public function overwriteMessage(): bool
        {
            return $this->overwriteMessage;
        }

        /**
         * Should exception's default code be overwritten
         * @return bool
         */
        public function overwriteCode(): bool
        {
            return $this->overwriteCode;
        }

    }