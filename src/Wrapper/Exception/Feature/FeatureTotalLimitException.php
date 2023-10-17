<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Feature;

    /**
     * Class FeatureTotalLimitException
     * @package smallinvoice\api2\Wrapper\Exception\Feature
     */
    class FeatureTotalLimitException extends FeatureLimitException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 4003;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'The following total limit has been reached for the current package';
    }