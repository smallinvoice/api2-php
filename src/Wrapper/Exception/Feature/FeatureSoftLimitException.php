<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Feature;

    /**
     * Class FeatureSoftLimitException
     * @package smallinvoice\api2\Wrapper\Exception\Feature
     */
    class FeatureSoftLimitException extends FeatureLimitException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 4002;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'The following soft limit has been reached for the current plan';
    }