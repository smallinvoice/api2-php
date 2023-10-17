<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Interfaces;

    /**
     * Interface StickToDefaultValues
     * @package smallinvoice\api2\Wrapper\Exception\Interfaces
     */
    interface StickToDefaultValues
    {

        /**
         * Sets whether exception's default message should be overwritten or not
         * @param bool $overwrite
         * @return $this
         */
        public function setOverwriteMessage(bool $overwrite = true);

        /**
         * Sets whether exception's default code should be overwritten or not
         * @param bool $overwrite
         * @return $this
         */
        public function setOverwriteCode(bool $overwrite = true);

        /**
         * Should exception's default message be overwritten
         * @return bool
         */
        public function overwriteMessage(): bool;

        /**
         * Should exception's default code be overwritten
         * @return bool
         */
        public function overwriteCode(): bool;


    }