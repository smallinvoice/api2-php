<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Auth;

    use smallinvoice\api2\Wrapper\Endpoints\AbstractEndpoint;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Response\Response;

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