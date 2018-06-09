<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Reporting;

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
     * Class CostUnitsEndpoint
     * @package smallinvoice\api2\Endpoints\Reporting
     */
    class CostUnitsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const REPORTING_COST_UNITS_LIST = '/reporting/cost-units';
        const REPORTING_COST_UNITS_GET = '/reporting/cost-units/{costUnitId}';
        const REPORTING_COST_UNITS_POST = '/reporting/cost-units';
        const REPORTING_COST_UNITS_PUT = '/reporting/cost-units/{costUnitId}';
        const REPORTING_COST_UNITS_DELETE = '/reporting/cost-units/{costUnitIds}';

        protected $scopes = ['cost_unit'];

        /**
         * Gets list of cost units.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::REPORTING_COST_UNITS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details about specified cost unit.
         *
         * @param int $costUnitId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $costUnitId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::REPORTING_COST_UNITS_GET, $parameters);
            $url = $this->replaceId($costUnitId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new cost unit.
         *
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function create(array $data): Response
        {
            $url = $this->baseUrl . static::REPORTING_COST_UNITS_POST;

            return $this->callApi(self::METHOD_POST, $url, $data);
        }

        /**
         * Updates specified cost unit.
         *
         * @param int $costUnitId
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function update(int $costUnitId, array $data): Response
        {
            $url = $this->baseUrl . static::REPORTING_COST_UNITS_PUT;
            $url = $this->replaceId($costUnitId, $url);

            return $this->callApi(self::METHOD_PUT, $url, $data);
        }

        /**
         * Deletes specified cost units.
         *
         * @param array $costUnitIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $costUnitIds): Response
        {
            $url = $this->baseUrl . static::REPORTING_COST_UNITS_DELETE;
            $url = $this->replaceId(implode(',', $costUnitIds), $url, '{costUnitIds}');

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Helper function for replacing {costUnitId} or different placeholder in URL.
         *
         * @param mixed $replacement
         * @param string $subject
         * @param string $placeholder
         * @return string
         */
        protected function replaceId($replacement, string $subject, string $placeholder = '{costUnitId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }
    }