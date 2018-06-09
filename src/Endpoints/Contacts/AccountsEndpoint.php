<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Contacts;

    use LourensSystems\ApiWrapper\Endpoints\Parameters\GetParameters;
    use LourensSystems\ApiWrapper\Exception\LSException;
    use LourensSystems\ApiWrapper\Response\Response;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;
    use LourensSystems\ApiWrapper\Exception\InvalidUseException;
    use LourensSystems\ApiWrapper\Interfaces\CreateInterface;
    use LourensSystems\ApiWrapper\Interfaces\DeleteInterface;
    use LourensSystems\ApiWrapper\Interfaces\GetInterface;
    use LourensSystems\ApiWrapper\Interfaces\ListInterface;
    use LourensSystems\ApiWrapper\Interfaces\UpdateInterface;
    use LourensSystems\ApiWrapper\Endpoints\AbstractEndpoint;

    /**
     * Class AccountsEndpoint
     * @package smallinvoice\api2\Endpoints\Contacts
     */
    class AccountsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_CONTACT_ACCOUNTS_LIST = '/contacts/{contactId}/accounts';
        const ENDPOINT_CONTACT_ACCOUNTS_GET = '/contacts/{contactId}/accounts/{accountId}';
        const ENDPOINT_CONTACT_ACCOUNTS_POST = '/contacts/{contactId}/accounts';
        const ENDPOINT_CONTACT_ACCOUNTS_PUT = '/contacts/{contactId}/accounts/{accountId}';
        const ENDPOINT_CONTACT_ACCOUNTS_DELETE = '/contacts/{contactId}/accounts/{accountsIds}';


        protected $scopes = ['contact'];

        /**
         * Contact id
         * @var int
         */
        private $contactId;

        /**
         * Sets contact id
         *
         * @param int $contactId
         */
        public function setContactId(int $contactId)
        {
            $this->contactId = $contactId;
        }

        /**
         * Lists accounts of specified contact
         *
         * @param int $contactId
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function listForContact(int $contactId, ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_CONTACT_ACCOUNTS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $this->replaceContactId($contactId, $url));
        }

        /**
         * Lists accounts of current contact
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $this->checkContactId();

            return $this->listForContact($this->contactId, $parameters);
        }

        /**
         * Gets data of specified contact's account
         *
         * @param int $contactId
         * @param int $accountId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getForContact(int $contactId, int $accountId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_CONTACT_ACCOUNTS_GET, $parameters);
            $url = $this->replaceContactId($contactId, $url);
            $url = $this->replaceAccountId($accountId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets data of specified account of current contact
         *
         * @param int $accountId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $accountId, GetParameters $parameters = null): Response
        {
            $this->checkContactId();

            return $this->getForContact($this->contactId, $accountId, $parameters);
        }

        /**
         * Creates account for specified contact
         *
         * @param int $contactId
         * @param array $accountData
         * @return Response
         * @throws LSException
         */
        public function createForContact(int $contactId, array $accountData): Response
        {
            $url = $this->replaceContactId($contactId, $this->baseUrl . static::ENDPOINT_CONTACT_ACCOUNTS_POST);

            return $this->callApi(self::METHOD_POST, $url, $accountData);
        }

        /**
         * Creates account for current contact
         *
         * @param array $accountData
         * @return Response
         * @throws LSException
         */
        public function create(array $accountData): Response
        {
            $this->checkContactId();

            return $this->createForContact($this->contactId, $accountData);
        }

        /**
         * Updates specified contact's account
         *
         * @param int $contactId
         * @param int $accountId
         * @param array $accountData
         * @return Response
         * @throws LSException
         */
        public function updateForContact(int $contactId, int $accountId, array $accountData): Response
        {
            $url = $this->replaceContactId($contactId, $this->baseUrl . static::ENDPOINT_CONTACT_ACCOUNTS_PUT);
            $url = $this->replaceAccountId($accountId, $url);

            return $this->callApi(self::METHOD_PUT, $url, $accountData);
        }

        /**
         * Updates specified account of current contact
         *
         * @param int $accountId
         * @param array $accountData
         * @return Response
         * @throws LSException
         */
        public function update(int $accountId, array $accountData): Response
        {
            $this->checkContactId();

            return $this->updateForContact($this->contactId, $accountId, $accountData);
        }

        /**
         * Deletes specified contact's accounts
         *
         * @param int $contactId
         * @param array $accountIds
         * @return Response
         * @throws LSException
         */
        public function deleteForContact(int $contactId, array $accountIds): Response
        {
            $url = $this->replaceContactId($contactId, $this->baseUrl . static::ENDPOINT_CONTACT_ACCOUNTS_DELETE);
            $url = str_replace('{accountsIds}', implode(',', $accountIds), $url);

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Deletes specified accounts of current contact
         *
         * @param array $accountIds .
         * @return Response
         * @throws LSException
         */
        public function delete(array $accountIds): Response
        {
            $this->checkContactId();

            return $this->deleteForContact($this->contactId, $accountIds);
        }

        /**
         * Helper function for replacing {contactId} placeholder in URL.
         *
         * @param int $contactId
         * @param string $subject
         * @return string
         */
        private function replaceContactId(int $contactId, string $subject): string
        {
            return str_replace('{contactId}', $contactId, $subject);
        }

        /**
         * Helper function for replacing {accountId} placeholder in URL.
         *
         * @param int $accountId
         * @param string $subject
         * @return string
         */
        private function replaceAccountId(int $accountId, string $subject): string
        {
            return str_replace('{accountId}', $accountId, $subject);
        }

        /**
         * Checks whether there is current contact id set
         *
         * @throws InvalidUseException
         */
        private function checkContactId()
        {
            if (is_null($this->contactId)) {
                throw new InvalidUseException('Contact id should be first set by setContactId method.');
            }
        }
    }

