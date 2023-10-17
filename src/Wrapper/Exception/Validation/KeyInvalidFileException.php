<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Validation;

    /**
     * Class KeyInvalidFileException
     * @package smallinvoice\api2\Wrapper\Exception\Validation
     */
    class KeyInvalidFileException extends KeyException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 1108;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid file';

    }