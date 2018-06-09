<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Auth;

    use LourensSystems\ApiWrapper\Endpoints\AbstractEndpoint;
    use LourensSystems\ApiWrapper\Exception\LSException;
    use LourensSystems\ApiWrapper\Response\Response;

    /**
     * Class ProfileEndpoint
     * @package smallinvoice\api2\Endpoints\Auth
     */
    class ProfileEndpoint extends AbstractEndpoint
    {

        const ENDPOINT_AUTH_PROFILE = '/auth/profile';

        protected $scopes = ['profile'];

        /**
         * Gets data of authenticated user's profile
         * @return Response
         * @throws LSException
         */
        public function get(): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_AUTH_PROFILE);

            return $this->callApi(static::METHOD_GET, $url);
        }
    }