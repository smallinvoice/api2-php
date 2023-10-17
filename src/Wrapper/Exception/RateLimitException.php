<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;

    /**
     * Class RateLimitException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class RateLimitException extends LSException
    {

        use RequestResponse;

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 6000;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Too many requests';
    }