<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Feature;

    /**
     * Class FeatureHardLimitException
     * @package smallinvoice\api2\Wrapper\Exception\Feature
     */
    class FeatureHardLimitException extends FeatureLimitException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 4001;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'The following hard limit has been reached for the current package';
    }