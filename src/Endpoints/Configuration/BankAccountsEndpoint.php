<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Configuration;

    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Interfaces\CreateInterface;
    use smallinvoice\api2\Wrapper\Interfaces\DeleteInterface;
    use smallinvoice\api2\Wrapper\Interfaces\GetInterface;
    use smallinvoice\api2\Wrapper\Interfaces\ListInterface;
    use smallinvoice\api2\Wrapper\Interfaces\UpdateInterface;
    use smallinvoice\api2\Wrapper\Response\Response;
    use smallinvoice\api2\Wrapper\Endpoints\AbstractEndpoint;

    /**
     * Class BankAccountsEndpoint
     * @package smallinvoice\api2\Endpoints\Configuration
     */
    class BankAccountsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_CONFIGURATION_BANK_ACCOUNTS_LIST = '/configuration/bank-accounts';
        const ENDPOINT_CONFIGURATION_BANK_ACCOUNTS_GET = '/configuration/bank-accounts/{accountId}';
        const ENDPOINT_CONFIGURATION_BANK_ACCOUNTS_POST = '/configuration/bank-accounts';
        const ENDPOINT_CONFIGURATION_BANK_ACCOUNTS_PUT = '/configuration/bank-accounts/{accountId}';
        const ENDPOINT_CONFIGURATION_BANK_ACCOUNTS_DELETE = '/configuration/bank-accounts/{accountsIds}';

        protected $scopes = ['configuration'];

        /**
         * Gets list of bank accounts.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_CONFIGURATION_BANK_ACCOUNTS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified bank account.
         *
         * @param int $accountId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $accountId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_CONFIGURATION_BANK_ACCOUNTS_GET, $parameters);
            $url = $this->replaceAccountId($accountId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new bank account.
         *
         * @param array $accountData
         * @return Response
         * @throws LSException
         */
        public function create(array $accountData): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_CONFIGURATION_BANK_ACCOUNTS_POST;

            return $this->callApi(self::METHOD_POST, $url, $accountData);
        }

        /**
         * Updates specified bank account.
         *
         * @param int $accountId
         * @param array $accountData
         * @return Response
         * @throws LSException
         */
        public function update(int $accountId, array $accountData): Response
        {
            $url = $this->replaceAccountId($accountId, $this->baseUrl . static::ENDPOINT_CONFIGURATION_BANK_ACCOUNTS_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $accountData);
        }

        /**
         * Deletes specified bank accounts.
         *
         * @param array $accountsIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $accountsIds): Response
        {
            $url = $this->replaceAccountId(implode(',', $accountsIds),
                $this->baseUrl . static::ENDPOINT_CONFIGURATION_BANK_ACCOUNTS_DELETE, '{accountsIds}');

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Helper function for replacing ids in URL.
         *
         * @param mixed $replacement
         * @param string $subject
         * @param string $placeholder
         * @return string
         */
        private function replaceAccountId($replacement, string $subject, string $placeholder = '{accountId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }
    }