<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;

    /**
     * Class ServerException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class ServerException extends LSException
    {

        use RequestResponse;

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 0;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Internal server error';
    }