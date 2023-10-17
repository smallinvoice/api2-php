<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Validation;

    /**
     * Class KeyValueCannotBeChangedException
     * @package smallinvoice\api2\Wrapper\Exception\Validation
     */
    class KeyValueCannotBeChangedException extends KeyException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 1104;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Value cannot be changed';

    }