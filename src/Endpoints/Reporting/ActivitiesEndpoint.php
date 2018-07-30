<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Reporting;

    use LourensSystems\ApiWrapper\Endpoints\AbstractEndpoint;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\GetParameters;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;
    use LourensSystems\ApiWrapper\Exception\LSException;
    use LourensSystems\ApiWrapper\Interfaces\GetInterface;
    use LourensSystems\ApiWrapper\Interfaces\ListInterface;
    use LourensSystems\ApiWrapper\Response\Response;

    /**
     * Class ActivitiesEndpoint
     * @package smallinvoice\api2\Endpoints\Reporting
     */
    class ActivitiesEndpoint extends AbstractEndpoint implements ListInterface, GetInterface
    {

        const REPORTING_ACTIVITIES_LIST = '/reporting/activities';
        const REPORTING_ACTIVITY_GET = '/reporting/activities/{activityId}';

        protected $scopes = ['activity'];

        /**
         * Gets list of activities.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::REPORTING_ACTIVITIES_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified activity.
         *
         * @param int $id
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $id, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::REPORTING_ACTIVITY_GET, $parameters);
            $url = $this->replaceId($id, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Helper function for replacing {activityId} or different placeholder in URL.
         *
         * @param $replacement
         * @param string $subject
         * @param string $placeholder
         * @return string
         */
        protected function replaceId($replacement, string $subject, string $placeholder = '{activityId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }
    }