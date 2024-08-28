<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Receivables;

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
     * Class OrderConfirmationsEndpoint
     * @package smallinvoice\api2\Endpoints\Receivables
     */
    class OrderConfirmationsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, PdfInterface, PreviewInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_LIST = '/receivables/order-confirmations';
        const ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_GET = '/receivables/order-confirmations/{orderConfirmationId}';
        const ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_PDF = '/receivables/order-confirmations/{orderConfirmationId}/pdf';
        const ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_PREVIEW = '/receivables/order-confirmations/{orderConfirmationId}/preview';
        const ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_POST = '/receivables/order-confirmations';
        const ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_PUT = '/receivables/order-confirmations/{orderConfirmationId}';
        const ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_CHANGE_STATUS = '/receivables/order-confirmations/{orderConfirmationId}/change-status';
        const ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_SEND_BY_POST = '/receivables/order-confirmations/{orderConfirmationId}/send-by-post';
        const ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_SEND_BY_EMAIL = '/receivables/order-confirmations/{orderConfirmationId}/send-by-email';
        const ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_DELETE = '/receivables/order-confirmations/{orderConfirmationIds}';


        protected $scopes = ['order_confirmation'];

        /**
         * Gets list of order confirmations.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified order confirmation.
         *
         * @param int $orderConfirmationId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $orderConfirmationId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_GET, $parameters);
            $url = str_replace('{orderConfirmationId}', (string)$orderConfirmationId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets PDF of specified order confirmation.
         *
         * @param int $orderConfirmationId
         * @param PdfParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getPdf(int $orderConfirmationId, PdfParameters $parameters = null): Response
        {
            $url = $this->preparePdfUrl(static::ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_PDF, $parameters);
            $url = str_replace('{orderConfirmationId}', (string)$orderConfirmationId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets preview of specified order confirmation.
         *
         * @param int $orderConfirmationId
         * @param PreviewParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getPreview(int $orderConfirmationId, PreviewParameters $parameters = null): Response
        {
            $url = $this->preparePreviewUrl(static::ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_PREVIEW, $parameters);
            $url = str_replace('{orderConfirmationId}', (string)$orderConfirmationId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new order confirmation.
         *
         * @param array $orderConfirmationData
         * @return Response
         * @throws LSException
         */
        public function create(array $orderConfirmationData): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_POST;

            return $this->callApi(self::METHOD_POST, $url, $orderConfirmationData);
        }

        /**
         * Updates specified order confirmation.
         *
         * @param int $orderConfirmationId
         * @param array $orderConfirmationData
         * @return Response
         * @throws LSException
         */
        public function update(int $orderConfirmationId, array $orderConfirmationData): Response
        {
            $url = str_replace('{orderConfirmationId}', (string)$orderConfirmationId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $orderConfirmationData);
        }

        /**
         * Changes status of specified order confirmation.
         *
         * @param int $orderConfirmationId
         * @param array $changeStatusData
         * @return Response
         * @throws LSException
         */
        public function changeStatus(int $orderConfirmationId, array $changeStatusData): Response
        {
            $url = str_replace('{orderConfirmationId}', (string)$orderConfirmationId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_CHANGE_STATUS);

            return $this->callApi(self::METHOD_PATCH, $url, $changeStatusData);
        }

        /**
         * Sends specified order confirmation by post.
         *
         * @param int $orderConfirmationId
         * @param array $sendingData
         * @return Response
         * @throws LSException
         */
        public function sendByPost(int $orderConfirmationId, array $sendingData): Response
        {
            $url = str_replace('{orderConfirmationId}', (string)$orderConfirmationId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_SEND_BY_POST);

            return $this->callApi(self::METHOD_PATCH, $url, $sendingData);
        }

        /**
         * Sends specified order confirmation by email.
         *
         * @param int $orderConfirmationId
         * @param array $sendingData
         * @return Response
         * @throws LSException
         */
        public function sendByEmail(int $orderConfirmationId, array $sendingData): Response
        {
            $url = str_replace('{orderConfirmationId}', (string)$orderConfirmationId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_SEND_BY_EMAIL);

            return $this->callApi(self::METHOD_PATCH, $url, $sendingData);
        }

        /**
         * Delete specified order confirmations.
         *
         * @param array $orderConfirmationIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $orderConfirmationIds): Response
        {
            $url = str_replace('{orderConfirmationIds}', implode(',', $orderConfirmationIds),
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_ORDER_CONFIRMATIONS_DELETE);

            return $this->callApi(self::METHOD_DELETE, $url);
        }
    }