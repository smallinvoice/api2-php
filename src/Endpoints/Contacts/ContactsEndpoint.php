<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Contacts;

    use LourensSystems\ApiWrapper\Endpoints\Parameters\GetParameters;
    use LourensSystems\ApiWrapper\Exception\LSException;
    use LourensSystems\ApiWrapper\Response\Response;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;
    use LourensSystems\ApiWrapper\Interfaces\CreateInterface;
    use LourensSystems\ApiWrapper\Interfaces\DeleteInterface;
    use LourensSystems\ApiWrapper\Interfaces\GetInterface;
    use LourensSystems\ApiWrapper\Interfaces\ListInterface;
    use LourensSystems\ApiWrapper\Interfaces\UpdateInterface;
    use LourensSystems\ApiWrapper\Endpoints\AbstractEndpoint;

    /**
     * Class ContactsEndpoint
     * @package smallinvoice\api2\Endpoints\Contacts
     */
    class ContactsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_CONTACT_LIST = '/contacts';
        const ENDPOINT_CONTACT_GET = '/contacts/{contactId}';
        const ENDPOINT_CONTACT_POST = '/contacts';
        const ENDPOINT_CONTACT_PUT = '/contacts/{contactId}';
        const ENDPOINT_CONTACT_DELETE = '/contacts/{contactIds}';
        const ENDPOINT_CONTACT_ASSIGN_GROUPS = '/contacts/{contactId}/assign-groups/{groupsIds}';
        const ENDPOINT_CONTACT_REMOVE_GROUPS = '/contacts/{contactId}/remove-groups/{groupsIds}';


        protected $scopes = ['contact'];

        /**
         * Gets list of contacts.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_CONTACT_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified contact.
         *
         * @param int $contactId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $contactId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_CONTACT_GET, $parameters);
            $url = str_replace('{contactId}', $contactId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new contact.
         *
         * @param array $contactData
         * @return Response
         * @throws LSException
         */
        public function create(array $contactData): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_CONTACT_POST;

            return $this->callApi(self::METHOD_POST, $url, $contactData);
        }

        /**
         * Updates specified contact.
         *
         * @param int $contactId
         * @param array $contactData
         * @return Response
         * @throws LSException
         */
        public function update(int $contactId, array $contactData): Response
        {
            $url = str_replace('{contactId}', $contactId, $this->baseUrl . static::ENDPOINT_CONTACT_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $contactData);
        }

        /**
         * Delete specified contacts.
         *
         * @param array $contactIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $contactIds): Response
        {
            $url = str_replace('{contactIds}', implode(',', $contactIds),
                $this->baseUrl . static::ENDPOINT_CONTACT_DELETE);

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Assigns specified groups to specified contact
         *
         * @param int $contactId
         * @param array $groupsIds
         * @return Response
         * @throws LSException
         */
        public function assignGroups(int $contactId, array $groupsIds)
        {
            $url = str_replace('{contactId}', $contactId, $this->baseUrl . self::ENDPOINT_CONTACT_ASSIGN_GROUPS);
            $url = str_replace('{groupsIds}', implode(',', $groupsIds), $url);

            return $this->callApi(self::METHOD_PATCH, $url);
        }

        /**
         * Removes specified groups from specified contact
         *
         * @param int $contactId
         * @param array $groupsIds
         * @return Response
         * @throws LSException
         */
        public function removeGroups(int $contactId, array $groupsIds)
        {
            $url = str_replace('{contactId}', $contactId, $this->baseUrl . self::ENDPOINT_CONTACT_REMOVE_GROUPS);
            $url = str_replace('{groupsIds}', implode(',', $groupsIds), $url);

            return $this->callApi(self::METHOD_PATCH, $url);
        }


    }