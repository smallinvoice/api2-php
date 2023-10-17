<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;

    /**
     * Class ApplicationOfflineException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class ApplicationOfflineException extends LSException
    {

        use RequestResponse;

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 8000;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Application is offline';
    }