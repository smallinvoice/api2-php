<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    /**
     * Class InvalidUseException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class InvalidUseException extends LSException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 0;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid code use';
    }