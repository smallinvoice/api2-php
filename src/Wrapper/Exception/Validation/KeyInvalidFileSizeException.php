<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Validation;

    /**
     * Class KeyInvalidFileSizeException
     * @package smallinvoice\api2\Wrapper\Exception\Validation
     */
    class KeyInvalidFileSizeException extends KeyException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 1106;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid file size';

    }