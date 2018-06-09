<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Catalog\Services;

    use LourensSystems\ApiWrapper\Endpoints\AbstractEndpoint;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\GetParameters;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;
    use LourensSystems\ApiWrapper\Exception\LSException;
    use LourensSystems\ApiWrapper\Interfaces\CreateInterface;
    use LourensSystems\ApiWrapper\Interfaces\DeleteInterface;
    use LourensSystems\ApiWrapper\Interfaces\GetInterface;
    use LourensSystems\ApiWrapper\Interfaces\ListInterface;
    use LourensSystems\ApiWrapper\Interfaces\UpdateInterface;
    use LourensSystems\ApiWrapper\Response\Response;

    /**
     * Class ServicesEndpoint
     * @package smallinvoice\api2\Endpoints\Catalog\Services
     */
    class ServicesEndpoint extends AbstractEndpoint implements GetInterface, ListInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_CATALOG_SERVICES_LIST = '/catalog/services';
        const ENDPOINT_CATALOG_SERVICES_GET = '/catalog/services/{serviceId}';
        const ENDPOINT_CATALOG_SERVICES_POST = '/catalog/services';
        const ENDPOINT_CATALOG_SERVICES_PUT = '/catalog/services/{serviceId}';
        const ENDPOINT_CATALOG_SERVICES_DELETE = '/catalog/services/{serviceIds}';

        protected $scopes = ['catalog'];

        /**
         * Gets list of services.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_CATALOG_SERVICES_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified service.
         *
         * @param int $serviceId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $serviceId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_CATALOG_SERVICES_GET, $parameters);
            $url = $this->replaceId($serviceId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new service.
         *
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function create(array $data): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_CATALOG_SERVICES_POST;

            return $this->callApi(self::METHOD_POST, $url, $data);
        }

        /**
         * Updates specified service.
         *
         * @param int $serviceId
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function update(int $serviceId, array $data): Response
        {
            $url = $this->replaceId($serviceId, $this->baseUrl . static::ENDPOINT_CATALOG_SERVICES_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $data);
        }

        /**
         * Delete specified services.
         *
         * @param array $serviceIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $serviceIds): Response
        {
            $url = $this->replaceId(implode(',', $serviceIds), $this->baseUrl . static::ENDPOINT_CATALOG_SERVICES_DELETE,
                '{serviceIds}');

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Helper function for replacing ids in ulr.
         *
         * @param mixed $replacement
         * @param string $subject
         * @param string $placeholder
         * @return string
         */
        protected function replaceId($replacement, string $subject, string $placeholder = '{serviceId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }
    }

