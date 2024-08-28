<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Receivables\Configuration;

    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Interfaces\GetInterface;
    use smallinvoice\api2\Wrapper\Interfaces\ListInterface;
    use smallinvoice\api2\Wrapper\Response\Response;
    use smallinvoice\api2\Wrapper\Endpoints\AbstractEndpoint;

    /**
     * Class IsrsEndpoint
     * @package smallinvoice\api2\Receivables\Configuration
     */
    class IsrsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface
    {

        const ENDPOINT_RECEIVABLES_CONFIGURATION_ISRS_LIST = '/receivables/configuration/isrs';
        const ENDPOINT_RECEIVABLES_CONFIGURATION_ISRS_GET = '/receivables/configuration/isrs/{isrId}';

        protected $scopes = ['configuration'];

        /**
         * Gets list of ISRs.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_RECEIVABLES_CONFIGURATION_ISRS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified ISR.
         *
         * @param int $isrId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $isrId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_RECEIVABLES_CONFIGURATION_ISRS_GET, $parameters);
            $url = str_replace('{isrId}', (string)$isrId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }
    }