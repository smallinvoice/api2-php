<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Validation;

    /**
     * Class KeyValueRequiredException
     * @package smallinvoice\api2\Wrapper\Exception\Validation
     */
    class KeyValueRequiredException extends KeyException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 1100;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Value is required';

    }