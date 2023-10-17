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
     * Class InvoicesEndpoint
     * @package smallinvoice\api2\Endpoints\Receivables
     */
    class InvoicesEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, PdfInterface, PreviewInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_RECEIVABLES_INVOICES_LIST = '/receivables/invoices';
        const ENDPOINT_RECEIVABLES_INVOICES_GET = '/receivables/invoices/{invoiceId}';
        const ENDPOINT_RECEIVABLES_INVOICES_PDF = '/receivables/invoices/{invoiceId}/pdf';
        const ENDPOINT_RECEIVABLES_INVOICES_PREVIEW = '/receivables/invoices/{invoiceId}/preview';
        const ENDPOINT_RECEIVABLES_INVOICES_POST = '/receivables/invoices';
        const ENDPOINT_RECEIVABLES_INVOICES_PUT = '/receivables/invoices/{invoiceId}';
        const ENDPOINT_RECEIVABLES_INVOICES_CHANGE_STATUS = '/receivables/invoices/{invoiceId}/change-status';
        const ENDPOINT_RECEIVABLES_INVOICES_SEND_BY_POST = '/receivables/invoices/{invoiceId}/send-by-post';
        const ENDPOINT_RECEIVABLES_INVOICES_SEND_BY_EMAIL = '/receivables/invoices/{invoiceId}/send-by-email';
        const ENDPOINT_RECEIVABLES_INVOICES_DELETE = '/receivables/invoices/{invoiceIds}';


        protected $scopes = ['invoice'];

        /**
         * Gets list of invoices.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_RECEIVABLES_INVOICES_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified invoice.
         *
         * @param int $invoiceId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $invoiceId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_RECEIVABLES_INVOICES_GET, $parameters);
            $url = str_replace('{invoiceId}', $invoiceId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets PDF of specified invoice.
         *
         * @param int $invoiceId
         * @param PdfParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getPdf(int $invoiceId, PdfParameters $parameters = null): Response
        {
            $url = $this->preparePdfUrl(static::ENDPOINT_RECEIVABLES_INVOICES_PDF, $parameters);
            $url = str_replace('{invoiceId}', $invoiceId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets preview of specified invoice.
         *
         * @param int $invoiceId
         * @param PreviewParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getPreview(int $invoiceId, PreviewParameters $parameters = null): Response
        {
            $url = $this->preparePreviewUrl(static::ENDPOINT_RECEIVABLES_INVOICES_PREVIEW, $parameters);
            $url = str_replace('{invoiceId}', $invoiceId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new invoice.
         *
         * @param array $invoiceData
         * @return Response
         * @throws LSException
         */
        public function create(array $invoiceData): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_RECEIVABLES_INVOICES_POST;

            return $this->callApi(self::METHOD_POST, $url, $invoiceData);
        }

        /**
         * Updates specified invoice.
         *
         * @param int $invoiceId
         * @param array $invoiceData
         * @return Response
         * @throws LSException
         */
        public function update(int $invoiceId, array $invoiceData): Response
        {
            $url = str_replace('{invoiceId}', $invoiceId, $this->baseUrl . static::ENDPOINT_RECEIVABLES_INVOICES_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $invoiceData);
        }

        /**
         * Changes status of specified invoice.
         *
         * @param int $invoiceId
         * @param array $changeStatusData
         * @return Response
         * @throws LSException
         */
        public function changeStatus(int $invoiceId, array $changeStatusData): Response
        {
            $url = str_replace('{invoiceId}', $invoiceId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_INVOICES_CHANGE_STATUS);

            return $this->callApi(self::METHOD_PATCH, $url, $changeStatusData);
        }

        /**
         * Sends specified invoice by post.
         *
         * @param int $invoiceId
         * @param array $sendingData
         * @return Response
         * @throws LSException
         */
        public function sendByPost(int $invoiceId, array $sendingData): Response
        {
            $url = str_replace('{invoiceId}', $invoiceId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_INVOICES_SEND_BY_POST);

            return $this->callApi(self::METHOD_PATCH, $url, $sendingData);
        }

        /**
         * Sends specified invoice by email.
         *
         * @param int $invoiceId
         * @param array $sendingData
         * @return Response
         * @throws LSException
         */
        public function sendByEmail(int $invoiceId, array $sendingData): Response
        {
            $url = str_replace('{invoiceId}', $invoiceId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_INVOICES_SEND_BY_EMAIL);

            return $this->callApi(self::METHOD_PATCH, $url, $sendingData);
        }

        /**
         * Delete specified invoices.
         *
         * @param array $invoiceIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $invoiceIds): Response
        {
            $url = str_replace('{invoiceIds}', implode(',', $invoiceIds),
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_INVOICES_DELETE);

            return $this->callApi(self::METHOD_DELETE, $url);
        }
    }