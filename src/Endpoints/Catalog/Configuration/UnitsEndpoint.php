<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Catalog\Configuration;

    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Interfaces\GetInterface;
    use smallinvoice\api2\Wrapper\Interfaces\ListInterface;
    use smallinvoice\api2\Wrapper\Response\Response;
    use smallinvoice\api2\Wrapper\Endpoints\AbstractEndpoint;

    /**
     * Class UnitsEndpoint
     * @package smallinvoice\api2\Endpoints\Catalog\Configuration
     */
    class UnitsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface
    {

        const ENDPOINT_CATALOG_CONFIGURATION_UNITS_LIST = '/catalog/configuration/units';
        const ENDPOINT_CATALOG_CONFIGURATION_UNITS_GET = '/catalog/configuration/units/{unitId}';

        protected $scopes = ['configuration'];

        /**
         * Gets list of units.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_CATALOG_CONFIGURATION_UNITS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details about specified unit.
         *
         * @param int $unitId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $unitId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_CATALOG_CONFIGURATION_UNITS_GET, $parameters);
            $url = str_replace('{unitId}', (string)$unitId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }


    }