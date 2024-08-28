<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Contacts;

    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\PdfParameters;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\PreviewParameters;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Interfaces\PdfInterface;
    use smallinvoice\api2\Wrapper\Interfaces\PreviewInterface;
    use smallinvoice\api2\Wrapper\Response\Response;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;
    use smallinvoice\api2\Wrapper\Interfaces\CreateInterface;
    use smallinvoice\api2\Wrapper\Interfaces\DeleteInterface;
    use smallinvoice\api2\Wrapper\Interfaces\GetInterface;
    use smallinvoice\api2\Wrapper\Interfaces\ListInterface;
    use smallinvoice\api2\Wrapper\Interfaces\UpdateInterface;
    use smallinvoice\api2\Wrapper\Endpoints\AbstractEndpoint;

    /**
     * Class LettersEndpoint
     * @package smallinvoice\api2\Endpoints\Contacts
     */
    class LettersEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, PdfInterface, PreviewInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_CONTACTS_LETTERS_LIST = '/contacts/letters';
        const ENDPOINT_CONTACTS_LETTERS_GET = '/contacts/letters/{letterId}';
        const ENDPOINT_CONTACTS_LETTERS_PDF = '/contacts/letters/{letterId}/pdf';
        const ENDPOINT_CONTACTS_LETTERS_PREVIEW = '/contacts/letters/{letterId}/preview';
        const ENDPOINT_CONTACTS_LETTERS_POST = '/contacts/letters';
        const ENDPOINT_CONTACTS_LETTERS_PUT = '/contacts/letters/{letterId}';
        const ENDPOINT_CONTACTS_LETTERS_CHANGE_STATUS = '/contacts/letters/{letterId}/change-status';
        const ENDPOINT_CONTACTS_LETTERS_SEND_BY_POST = '/contacts/letters/{letterId}/send-by-post';
        const ENDPOINT_CONTACTS_LETTERS_SEND_BY_EMAIL = '/contacts/letters/{letterId}/send-by-email';
        const ENDPOINT_CONTACTS_LETTERS_DELETE = '/contacts/letters/{letterIds}';


        protected $scopes = ['letter'];

        /**
         * Gets list of letters.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_CONTACTS_LETTERS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified letter.
         *
         * @param int $letterId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $letterId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_CONTACTS_LETTERS_GET, $parameters);
            $url = str_replace('{letterId}', (string)$letterId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets PDF of specified letter.
         *
         * @param int $letterId
         * @param PdfParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getPdf(int $letterId, PdfParameters $parameters = null): Response
        {
            $url = $this->preparePdfUrl(static::ENDPOINT_CONTACTS_LETTERS_PDF, $parameters);
            $url = str_replace('{letterId}', (string)$letterId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets preview of specified letter.
         *
         * @param int $letterId
         * @param PreviewParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getPreview(int $letterId, PreviewParameters $parameters = null): Response
        {
            $url = $this->preparePreviewUrl(static::ENDPOINT_CONTACTS_LETTERS_PREVIEW, $parameters);
            $url = str_replace('{letterId}', (string)$letterId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new letter.
         *
         * @param array $letterData
         * @return Response
         * @throws LSException
         */
        public function create(array $letterData): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_CONTACTS_LETTERS_POST;

            return $this->callApi(self::METHOD_POST, $url, $letterData);
        }

        /**
         * Updates specified letter.
         *
         * @param int $letterId
         * @param array $letterData
         * @return Response
         * @throws LSException
         */
        public function update(int $letterId, array $letterData): Response
        {
            $url = str_replace('{letterId}', (string)$letterId,
                $this->baseUrl . static::ENDPOINT_CONTACTS_LETTERS_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $letterData);
        }

        /**
         * Changes status of specified letter.
         *
         * @param int $letterId
         * @param array $changeStatusData
         * @return Response
         * @throws LSException
         */
        public function changeStatus(int $letterId, array $changeStatusData): Response
        {
            $url = str_replace('{letterId}', (string)$letterId,
                $this->baseUrl . static::ENDPOINT_CONTACTS_LETTERS_CHANGE_STATUS);

            return $this->callApi(self::METHOD_PATCH, $url, $changeStatusData);
        }

        /**
         * Sends specified letter by post.
         *
         * @param int $letterId
         * @param array $sendingData
         * @return Response
         * @throws LSException
         */
        public function sendByPost(int $letterId, array $sendingData): Response
        {
            $url = str_replace('{letterId}', (string)$letterId,
                $this->baseUrl . static::ENDPOINT_CONTACTS_LETTERS_SEND_BY_POST);

            return $this->callApi(self::METHOD_PATCH, $url, $sendingData);
        }

        /**
         * Sends specified letter by email.
         *
         * @param int $letterId
         * @param array $sendingData
         * @return Response
         * @throws LSException
         */
        public function sendByEmail(int $letterId, array $sendingData): Response
        {
            $url = str_replace('{letterId}', (string)$letterId,
                $this->baseUrl . static::ENDPOINT_CONTACTS_LETTERS_SEND_BY_EMAIL);

            return $this->callApi(self::METHOD_PATCH, $url, $sendingData);
        }

        /**
         * Delete specified letters.
         *
         * @param array $letterIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $letterIds): Response
        {
            $url = str_replace('{letterIds}', implode(',', $letterIds),
                $this->baseUrl . static::ENDPOINT_CONTACTS_LETTERS_DELETE);

            return $this->callApi(self::METHOD_DELETE, $url);
        }
    }