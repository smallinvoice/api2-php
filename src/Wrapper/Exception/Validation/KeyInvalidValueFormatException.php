<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Validation;

    /**
     * Class KeyInvalidValueFormatException
     * @package smallinvoice\api2\Wrapper\Exception\Validation
     */
    class KeyInvalidValueFormatException extends KeyException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 1103;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid value format';

    }