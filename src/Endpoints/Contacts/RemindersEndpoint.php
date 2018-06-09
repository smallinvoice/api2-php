<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Contacts;

    use LourensSystems\ApiWrapper\Endpoints\Parameters\GetParameters;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;
    use LourensSystems\ApiWrapper\Exception\LSException;
    use LourensSystems\ApiWrapper\Interfaces\CreateInterface;
    use LourensSystems\ApiWrapper\Interfaces\DeleteInterface;
    use LourensSystems\ApiWrapper\Interfaces\GetInterface;
    use LourensSystems\ApiWrapper\Interfaces\ListInterface;
    use LourensSystems\ApiWrapper\Interfaces\UpdateInterface;
    use LourensSystems\ApiWrapper\Response\Response;
    use LourensSystems\ApiWrapper\Endpoints\AbstractEndpoint;

    /**
     * Class RemindersEndpoint
     * @package smallinvoice\api2\Endpoints\Contacts
     */
    class RemindersEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_CONTACT_REMINDERS_LIST = '/contacts/reminders';
        const ENDPOINT_CONTACT_REMINDERS_GET = '/contacts/reminders/{reminderId}';
        const ENDPOINT_CONTACT_REMINDERS_POST = '/contacts/reminders';
        const ENDPOINT_CONTACT_REMINDERS_PUT = '/contacts/reminders/{reminderId}';
        const ENDPOINT_CONTACT_REMINDERS_DELETE = '/contacts/reminders/{remindersIds}';

        protected $scopes = ['contact_reminder'];

        /**
         * Gets list of reminders.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_CONTACT_REMINDERS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified reminder.
         *
         * @param int $reminderId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $reminderId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_CONTACT_REMINDERS_GET, $parameters);
            $url = $this->replaceReminderId($reminderId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new reminder.
         *
         * @param array $reminderData
         * @return Response
         * @throws LSException
         */
        public function create(array $reminderData): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_CONTACT_REMINDERS_POST;

            return $this->callApi(self::METHOD_POST, $url, $reminderData);
        }

        /**
         * Updates specified reminder.
         *
         * @param int $reminderId
         * @param array $remindedData
         * @return Response
         * @throws LSException
         */
        public function update(int $reminderId, array $remindedData): Response
        {
            $url = $this->replaceReminderId($reminderId, $this->baseUrl . static::ENDPOINT_CONTACT_REMINDERS_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $remindedData);
        }

        /**
         * Deletes specified reminders.
         *
         * @param array $reminderIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $reminderIds): Response
        {
            $url = $this->replaceReminderId(implode(',', $reminderIds),
                $this->baseUrl . static::ENDPOINT_CONTACT_REMINDERS_DELETE, '{remindersIds}');

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Helper function for replacing {reminderId} or different placeholder in URL.
         *
         * @param mixed $replacement
         * @param string $subject
         * @param string $placeholder
         * @return string
         */
        private function replaceReminderId($replacement, string $subject, string $placeholder = '{reminderId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }
    }