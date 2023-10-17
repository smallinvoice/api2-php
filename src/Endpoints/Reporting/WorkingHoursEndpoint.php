<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Reporting;

    use smallinvoice\api2\Wrapper\Endpoints\AbstractEndpoint;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Interfaces\CreateInterface;
    use smallinvoice\api2\Wrapper\Interfaces\DeleteInterface;
    use smallinvoice\api2\Wrapper\Interfaces\GetInterface;
    use smallinvoice\api2\Wrapper\Interfaces\ListInterface;
    use smallinvoice\api2\Wrapper\Interfaces\UpdateInterface;
    use smallinvoice\api2\Wrapper\Response\Response;

    /**
     * Class WorkingHoursEndpoint
     * @package smallinvoice\api2\Endpoints\Reporting
     */
    class WorkingHoursEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const REPORTING_WORKING_HOURS_LIST = '/reporting/working-hours';
        const REPORTING_WORKING_HOURS_GET = '/reporting/working-hours/{timeId}';
        const REPORTING_WORKING_HOURS_POST = '/reporting/working-hours';
        const REPORTING_WORKING_HOURS_PUT = '/reporting/working-hours/{timeId}';
        const REPORTING_WORKING_HOURS_DELETE = '/reporting/working-hours/{timeIds}';

        protected $scopes = ['working_hours'];

        /**
         * Gets list of working hours.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::REPORTING_WORKING_HOURS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified working hours.
         *
         * @param int $id
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $id, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::REPORTING_WORKING_HOURS_GET, $parameters);
            $url = $this->replaceId($id, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new working hours entry.
         *
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function create(array $data): Response
        {
            $url = $this->baseUrl . static::REPORTING_WORKING_HOURS_POST;

            return $this->callApi(self::METHOD_POST, $url, $data);
        }

        /**
         * Updates existing working hours entry.
         *
         * @param int $id
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function update(int $id, array $data): Response
        {
            $url = $this->baseUrl . static::REPORTING_WORKING_HOURS_PUT;
            $url = $this->replaceId($id, $url);

            return $this->callApi(self::METHOD_PUT, $url, $data);
        }

        /**
         * Deletes specified working hours entries.
         *
         * @param array $ids
         * @return Response
         * @throws LSException
         */
        public function delete(array $ids): Response
        {
            $url = $this->baseUrl . static::REPORTING_WORKING_HOURS_DELETE;
            $url = $this->replaceId(implode(',', $ids), $url, '{timeIds}');

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Helper function for replacing {timeId} or different placeholder in URL.
         *
         * @param $replacement
         * @param string $subject
         * @param string $placeholder
         * @return string
         */
        protected function replaceId($replacement, string $subject, string $placeholder = '{timeId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }
    }