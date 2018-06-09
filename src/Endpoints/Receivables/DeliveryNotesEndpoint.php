<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Receivables;

    use LourensSystems\ApiWrapper\Endpoints\Parameters\GetParameters;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\PdfParameters;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\PreviewParameters;
    use LourensSystems\ApiWrapper\Exception\LSException;
    use LourensSystems\ApiWrapper\Interfaces\PdfInterface;
    use LourensSystems\ApiWrapper\Interfaces\PreviewInterface;
    use LourensSystems\ApiWrapper\Response\Response;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;
    use LourensSystems\ApiWrapper\Interfaces\CreateInterface;
    use LourensSystems\ApiWrapper\Interfaces\DeleteInterface;
    use LourensSystems\ApiWrapper\Interfaces\GetInterface;
    use LourensSystems\ApiWrapper\Interfaces\ListInterface;
    use LourensSystems\ApiWrapper\Interfaces\UpdateInterface;
    use LourensSystems\ApiWrapper\Endpoints\AbstractEndpoint;

    /**
     * Class DeliveryNotesEndpoint
     * @package smallinvoice\api2\Endpoints\Receivables
     */
    class DeliveryNotesEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, PdfInterface, PreviewInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_RECEIVABLES_DELIVERY_NOTES_LIST = '/receivables/delivery-notes';
        const ENDPOINT_RECEIVABLES_DELIVERY_NOTES_GET = '/receivables/delivery-notes/{deliveryNoteId}';
        const ENDPOINT_RECEIVABLES_DELIVERY_NOTES_PDF = '/receivables/delivery-notes/{deliveryNoteId}/pdf';
        const ENDPOINT_RECEIVABLES_DELIVERY_NOTES_PREVIEW = '/receivables/delivery-notes/{deliveryNoteId}/preview';
        const ENDPOINT_RECEIVABLES_DELIVERY_NOTES_POST = '/receivables/delivery-notes';
        const ENDPOINT_RECEIVABLES_DELIVERY_NOTES_PUT = '/receivables/delivery-notes/{deliveryNoteId}';
        const ENDPOINT_RECEIVABLES_DELIVERY_NOTES_CHANGE_STATUS = '/receivables/delivery-notes/{deliveryNoteId}/change-status';
        const ENDPOINT_RECEIVABLES_DELIVERY_NOTES_SEND_BY_POST = '/receivables/delivery-notes/{deliveryNoteId}/send-by-post';
        const ENDPOINT_RECEIVABLES_DELIVERY_NOTES_SEND_BY_EMAIL = '/receivables/delivery-notes/{deliveryNoteId}/send-by-email';
        const ENDPOINT_RECEIVABLES_DELIVERY_NOTES_DELETE = '/receivables/delivery-notes/{deliveryNoteIds}';


        protected $scopes = ['delivery_note'];

        /**
         * Gets list of delivery notes.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_RECEIVABLES_DELIVERY_NOTES_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified delivery note.
         *
         * @param int $deliveryNoteId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $deliveryNoteId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_RECEIVABLES_DELIVERY_NOTES_GET, $parameters);
            $url = str_replace('{deliveryNoteId}', $deliveryNoteId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets PDF of specified delivery note.
         *
         * @param int $deliveryNoteId
         * @param PdfParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getPdf(int $deliveryNoteId, PdfParameters $parameters = null): Response
        {
            $url = $this->preparePdfUrl(static::ENDPOINT_RECEIVABLES_DELIVERY_NOTES_PDF, $parameters);
            $url = str_replace('{deliveryNoteId}', $deliveryNoteId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets preview of specified delivery note.
         *
         * @param int $deliveryNoteId
         * @param PreviewParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getPreview(int $deliveryNoteId, PreviewParameters $parameters = null): Response
        {
            $url = $this->preparePreviewUrl(static::ENDPOINT_RECEIVABLES_DELIVERY_NOTES_PREVIEW, $parameters);
            $url = str_replace('{deliveryNoteId}', $deliveryNoteId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new delivery note.
         *
         * @param array $deliveryNoteData
         * @return Response
         * @throws LSException
         */
        public function create(array $deliveryNoteData): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_RECEIVABLES_DELIVERY_NOTES_POST;

            return $this->callApi(self::METHOD_POST, $url, $deliveryNoteData);
        }

        /**
         * Updates specified delivery note.
         *
         * @param int $deliveryNoteId
         * @param array $deliveryNoteData
         * @return Response
         * @throws LSException
         */
        public function update(int $deliveryNoteId, array $deliveryNoteData): Response
        {
            $url = str_replace('{deliveryNoteId}', $deliveryNoteId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_DELIVERY_NOTES_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $deliveryNoteData);
        }

        /**
         * Changes status of specified delivery note.
         *
         * @param int $deliveryNoteId
         * @param array $changeStatusData
         * @return Response
         * @throws LSException
         */
        public function changeStatus(int $deliveryNoteId, array $changeStatusData): Response
        {
            $url = str_replace('{deliveryNoteId}', $deliveryNoteId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_DELIVERY_NOTES_CHANGE_STATUS);

            return $this->callApi(self::METHOD_PATCH, $url, $changeStatusData);
        }

        /**
         * Sends specified delivery note by post.
         *
         * @param int $deliveryNoteId
         * @param array $sendingData
         * @return Response
         * @throws LSException
         */
        public function sendByPost(int $deliveryNoteId, array $sendingData): Response
        {
            $url = str_replace('{deliveryNoteId}', $deliveryNoteId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_DELIVERY_NOTES_SEND_BY_POST);

            return $this->callApi(self::METHOD_PATCH, $url, $sendingData);
        }

        /**
         * Sends specified delivery note by email.
         *
         * @param int $deliveryNoteId
         * @param array $sendingData
         * @return Response
         * @throws LSException
         */
        public function sendByEmail(int $deliveryNoteId, array $sendingData): Response
        {
            $url = str_replace('{deliveryNoteId}', $deliveryNoteId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_DELIVERY_NOTES_SEND_BY_EMAIL);

            return $this->callApi(self::METHOD_PATCH, $url, $sendingData);
        }

        /**
         * Delete specified delivery notes.
         *
         * @param array $deliveryNoteIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $deliveryNoteIds): Response
        {
            $url = str_replace('{deliveryNoteIds}', implode(',', $deliveryNoteIds),
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_DELIVERY_NOTES_DELETE);

            return $this->callApi(self::METHOD_DELETE, $url);
        }
    }