<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Validation;

    /**
     * Class KeyInvalidValueException
     * @package smallinvoice\api2\Wrapper\Exception\Validation
     */
    class KeyInvalidValueException extends KeyException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 1102;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid value';

    }