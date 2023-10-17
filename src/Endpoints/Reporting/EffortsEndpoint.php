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
     * Class EffortsEndpoint
     * @package smallinvoice\api2\Endpoints\Reporting
     */
    class EffortsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const REPORTING_EFFORTS_LIST = '/reporting/efforts';
        const REPORTING_EFFORTS_GET = '/reporting/efforts/{effortId}';
        const REPORTING_EFFORTS_POST = '/reporting/efforts';
        const REPORTING_EFFORTS_PUT = '/reporting/efforts/{effortId}';
        const REPORTING_EFFORTS_DELETE = '/reporting/efforts/{effortIds}';

        protected $scopes = ['effort'];

        /**
         * Gets list of efforts.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::REPORTING_EFFORTS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified effort.
         *
         * @param int $id
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $id, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::REPORTING_EFFORTS_GET, $parameters);
            $url = $this->replaceId($id, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new effort entry.
         *
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function create(array $data): Response
        {
            $url = $this->baseUrl . static::REPORTING_EFFORTS_POST;

            return $this->callApi(self::METHOD_POST, $url, $data);
        }

        /**
         * Updates existing effort entry.
         *
         * @param int $id
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function update(int $id, array $data): Response
        {
            $url = $this->baseUrl . static::REPORTING_EFFORTS_PUT;
            $url = $this->replaceId($id, $url);

            return $this->callApi(self::METHOD_PUT, $url, $data);
        }

        /**
         * Deletes specified efforts entries.
         *
         * @param array $ids
         * @return Response
         * @throws LSException
         */
        public function delete(array $ids): Response
        {
            $url = $this->baseUrl . static::REPORTING_EFFORTS_DELETE;
            $url = $this->replaceId(implode(',', $ids), $url, '{effortIds}');

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Helper function for replacing {effortId} or different placeholder in URL.
         *
         * @param $replacement
         * @param string $subject
         * @param string $placeholder
         * @return string
         */
        protected function replaceId($replacement, string $subject, string $placeholder = '{effortId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }
    }