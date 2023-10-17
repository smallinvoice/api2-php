<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Validation;

    /**
     * Class KeyInvalidFileTypeException
     * @package smallinvoice\api2\Wrapper\Exception\Validation
     */
    class KeyInvalidFileTypeException extends KeyException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 1107;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid file type';

    }