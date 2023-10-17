<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Validation;

    /**
     * Class KeyInvalidValueTypeException
     * @package smallinvoice\api2\Wrapper\Exception\Validation
     */
    class KeyInvalidValueTypeException extends KeyException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 1101;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid value type';

    }