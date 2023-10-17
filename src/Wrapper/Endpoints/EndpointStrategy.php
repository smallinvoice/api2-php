<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Endpoints;

    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\OAuth2\Client\Provider\Provider;

    /**
     * Class EndpointStrategy
     * @package smallinvoice\api2\Wrapper\Endpoints
     */
    class EndpointStrategy
    {

        /**
         * Production API URL (to be overwritten in extending classes)
         * @var string
         */
        protected static $apiURLProduction = '';

        /**
         * Staging API URL (to be overwritten in extending classes)
         * @var string
         */
        protected static $apiURLStaging = '';

        /**
         * Gets specified endpoint object by provider options (baseURL provider option is required)
         * @param string $class
         * @param array $providerOptions
         * @return AbstractEndpoint
         * @throws LSException
         */
        public static function getEndpoint(string $class, array $providerOptions): AbstractEndpoint
        {
            $provider = new Provider($providerOptions);

            return static::getEndpointByProvider($class, $provider);
        }

        /**
         * Gets specified endpoint object by provider object
         * @param string $class
         * @param Provider $provider
         * @param string|null $refreshToken
         * @return AbstractEndpoint
         * @throws LSException
         */
        public static function getEndpointByProvider(
            string $class,
            Provider $provider,
            string $refreshToken = null
        ): AbstractEndpoint {
            if (!$provider->getBaseUrl()) {
                throw new LSException('Base URL is missing in provider');
            }

            $endpoint = new $class($provider, $refreshToken);

            return $endpoint;
        }

        /**
         * Gets production API URL
         * @return string
         * @throws LSException
         */
        public static function getApiURLProduction(): string
        {
            if (!static::$apiURLProduction) {
                throw new LSException('Production API URL is missing');
            }

            return static::$apiURLProduction;
        }

        /**
         * Gets staging API URL
         * @return string
         * @throws LSException
         */
        public static function getApiURLStaging(): string
        {
            if (!static::$apiURLStaging) {
                throw new LSException('Staging API URL is missing');
            }

            return static::$apiURLStaging;
        }
    }