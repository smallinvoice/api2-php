<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Auth;

    use smallinvoice\api2\Wrapper\Endpoints\AbstractEndpoint;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Response\Response;

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