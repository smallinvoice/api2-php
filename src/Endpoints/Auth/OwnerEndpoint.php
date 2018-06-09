<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Auth;

    use LourensSystems\ApiWrapper\Endpoints\AbstractEndpoint;
    use LourensSystems\ApiWrapper\Exception\LSException;
    use LourensSystems\ApiWrapper\Response\Response;

    /**
     * Class OwnerEndpoint
     * @package smallinvoice\api2\Endpoints\Auth
     */
    class OwnerEndpoint extends AbstractEndpoint
    {

        const ENDPOINT_AUTH_OWNER = '/auth/owner';

        /**
         * Gets data of authenticated resource owner
         * @return Response
         * @throws LSException
         */
        public function get(): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_AUTH_OWNER);

            return $this->callApi(static::METHOD_GET, $url);
        }
    }