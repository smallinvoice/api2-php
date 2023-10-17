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
     * Class ProjectsEndpoint
     * @package smallinvoice\api2\Endpoints\Reporting
     */
    class ProjectsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const REPORTING_PROJECTS_LIST = '/reporting/projects';
        const REPORTING_PROJECTS_GET = '/reporting/projects/{projectId}';
        const REPORTING_PROJECTS_POST = '/reporting/projects';
        const REPORTING_PROJECTS_PUT = '/reporting/projects/{projectId}';
        const REPORTING_PROJECTS_DELETE = '/reporting/projects/{projectIds}';
        const REPORTING_PROJECTS_CHANGE_STATUS = '/reporting/projects/{projectId}/change-status/{status}';

        protected $scopes = ['project'];

        /**
         * Gets list of projects.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::REPORTING_PROJECTS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified project.
         *
         * @param int $projectId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $projectId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::REPORTING_PROJECTS_GET, $parameters);
            $url = $this->replaceId($projectId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new project.
         *
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function create(array $data): Response
        {
            $url = $this->baseUrl . static::REPORTING_PROJECTS_POST;

            return $this->callApi(self::METHOD_POST, $url, $data);
        }

        /**
         * Updates specified project.
         *
         * @param int $projectId
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function update(int $projectId, array $data): Response
        {
            $url = $this->baseUrl . static::REPORTING_PROJECTS_PUT;
            $url = $this->replaceId($projectId, $url);

            return $this->callApi(self::METHOD_PUT, $url, $data);
        }

        /**
         * Deletes specified projects.
         *
         * @param array $projectIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $projectIds): Response
        {
            $url = $this->baseUrl . static::REPORTING_PROJECTS_DELETE;
            $url = $this->replaceId(implode(',', $projectIds), $url, '{projectIds}');

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Changes status of specified project.
         *
         * @param int $projectId
         * @param string $status
         * @return Response
         * @throws LSException
         */
        public function changeStatus(int $projectId, string $status): Response
        {
            $url = $this->baseUrl . static::REPORTING_PROJECTS_CHANGE_STATUS;
            $url = $this->replaceId($projectId, $url);
            $url = str_replace('{status}', $status, $url);

            return $this->callApi(self::METHOD_PATCH, $url);
        }

        /**
         * Helper function for replacing {projectId} or different placeholder in URL.
         *
         * @param $replacement
         * @param string $subject
         * @param string $placeholder
         * @return string
         */
        protected function replaceId($replacement, string $subject, string $placeholder = '{projectId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }
    }