<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Contacts\Configuration;

    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Response\Response;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;
    use smallinvoice\api2\Wrapper\Interfaces\CreateInterface;
    use smallinvoice\api2\Wrapper\Interfaces\DeleteInterface;
    use smallinvoice\api2\Wrapper\Interfaces\GetInterface;
    use smallinvoice\api2\Wrapper\Interfaces\ListInterface;
    use smallinvoice\api2\Wrapper\Interfaces\UpdateInterface;
    use smallinvoice\api2\Wrapper\Endpoints\AbstractEndpoint;

    /**
     * Class GroupsEndpoint
     * @package smallinvoice\api2\Endpoints\Contacts\Configuration
     */
    class GroupsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_CONTACT_CONFIGURATION_GROUPS_LIST = '/contacts/configuration/groups';
        const ENDPOINT_CONTACT_CONFIGURATION_GROUPS_GET = '/contacts/configuration/groups/{groupId}';
        const ENDPOINT_CONTACT_CONFIGURATION_GROUPS_POST = '/contacts/configuration/groups';
        const ENDPOINT_CONTACT_CONFIGURATION_GROUPS_PUT = '/contacts/configuration/groups/{groupId}';
        const ENDPOINT_CONTACT_CONFIGURATION_GROUPS_DELETE = '/contacts/configuration/groups/{groupsIds}';


        protected $scopes = ['contact'];

        /**
         * Gets list of groups
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_CONTACT_CONFIGURATION_GROUPS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets data of specified group
         *
         * @param int $groupId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $groupId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_CONTACT_CONFIGURATION_GROUPS_GET, $parameters);
            $url = str_replace('{groupId}', $groupId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new group
         *
         * @param array $groupData
         * @return Response
         * @throws LSException
         */
        public function create(array $groupData): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_CONTACT_CONFIGURATION_GROUPS_POST;

            return $this->callApi(self::METHOD_POST, $url, $groupData);
        }


        /**
         * Updates specified group
         *
         * @param int $groupId
         * @param array $groupData
         * @return Response
         * @throws LSException
         */
        public function update(int $groupId, array $groupData): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_CONTACT_CONFIGURATION_GROUPS_PUT;
            $url = str_replace('{groupId}', $groupId, $url);

            return $this->callApi(self::METHOD_PUT, $url, $groupData);
        }

        /**
         * Deletes specified groups
         *
         * @param array $groupIds Comma separated ids.
         * @return Response
         * @throws LSException
         */
        public function delete(array $groupIds): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_CONTACT_CONFIGURATION_GROUPS_DELETE;
            $url = str_replace('{groupsIds}', implode(',', $groupIds), $url);

            return $this->callApi(self::METHOD_DELETE, $url);
        }
    }

