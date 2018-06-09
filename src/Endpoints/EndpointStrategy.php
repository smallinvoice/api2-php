<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints;

    /**
     * Class EndpointStrategy
     * @package smallinvoice\api2\Endpoints
     */
    class EndpointStrategy extends \LourensSystems\ApiWrapper\Endpoints\EndpointStrategy
    {

        /**
         * Base api URL
         * @var string
         */
        protected static $apiURLProduction = 'https://api.smallinvoice.com/v2';

        /**
         * Base staging api URL
         * @var string
         */
        protected static $apiURLStaging = 'https://stage-api.smallinvoice.com/v2';

    }