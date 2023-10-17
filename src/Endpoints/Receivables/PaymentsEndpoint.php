<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Receivables;

    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Response\Response;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;
    use smallinvoice\api2\Wrapper\Exception\InvalidUseException;
    use smallinvoice\api2\Wrapper\Interfaces\CreateInterface;
    use smallinvoice\api2\Wrapper\Interfaces\DeleteInterface;
    use smallinvoice\api2\Wrapper\Interfaces\GetInterface;
    use smallinvoice\api2\Wrapper\Interfaces\ListInterface;
    use smallinvoice\api2\Wrapper\Interfaces\UpdateInterface;
    use smallinvoice\api2\Wrapper\Endpoints\AbstractEndpoint;

    /**
     * Class PaymentsEndpoint
     * @package smallinvoice\api2\Endpoints\Receivables
     */
    class PaymentsEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_RECEIVABLES_INVOICES_PAYMENTS_LIST = '/receivables/invoices/{invoiceId}/payments';
        const ENDPOINT_RECEIVABLES_INVOICES_PAYMENTS_GET = '/receivables/invoices/{invoiceId}/payments/{paymentId}';
        const ENDPOINT_RECEIVABLES_INVOICES_PAYMENTS_POST = '/receivables/invoices/{invoiceId}/payments';
        const ENDPOINT_RECEIVABLES_INVOICES_PAYMENTS_PUT = '/receivables/invoices/{invoiceId}/payments/{paymentId}';
        const ENDPOINT_RECEIVABLES_INVOICES_PAYMENTS_DELETE = '/receivables/invoices/{invoiceId}/payments/{paymentIds}';

        protected $scopes = ['invoice'];

        /**
         * Invoice id
         * @var int
         */
        private $invoiceId;

        /**
         * Sets invoice id.
         *
         * @param int $invoiceId
         */
        public function setInvoiceId(int $invoiceId)
        {
            $this->invoiceId = $invoiceId;
        }

        /**
         * Gets lists of payments of specified invoice.
         *
         * @param int $invoiceId
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function listForInvoice(int $invoiceId, ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_RECEIVABLES_INVOICES_PAYMENTS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $this->replaceInvoiceId($invoiceId, $url));
        }

        /**
         * Gets list of payments of current invoice.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws InvalidUseException
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $this->checkInvoiceId();

            return $this->listForInvoice($this->invoiceId, $parameters);
        }


        /**
         * Gets data of specified invoice's payment.
         *
         * @param int $invoiceId
         * @param int $paymentId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getForInvoice(int $invoiceId, int $paymentId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_RECEIVABLES_INVOICES_PAYMENTS_GET, $parameters);
            $url = $this->replaceInvoiceId($invoiceId, $url);
            $url = $this->replacePaymentId($paymentId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets data of specified payment of current invoice.
         *
         * @param int $paymentId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws InvalidUseException
         * @throws LSException
         */
        public function get(int $paymentId, GetParameters $parameters = null): Response
        {
            $this->checkInvoiceId();

            return $this->getForInvoice($this->invoiceId, $paymentId, $parameters);
        }

        /**
         * Creates new payment for specified invoice.
         *
         * @param int $invoiceId
         * @param array $paymentData
         * @return Response
         * @throws LSException
         */
        public function createForInvoice(int $invoiceId, array $paymentData): Response
        {
            $url = $this->replaceInvoiceId($invoiceId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_INVOICES_PAYMENTS_POST);

            return $this->callApi(self::METHOD_POST, $url, $paymentData);
        }

        /**
         * Creates new payment for current invoice.
         *
         * @param array $paymentData
         * @return Response
         * @throws InvalidUseException
         * @throws LSException
         */
        public function create(array $paymentData): Response
        {
            $this->checkInvoiceId();

            return $this->createForInvoice($this->invoiceId, $paymentData);
        }


        /**
         * Updates specified invoice's payment.
         *
         * @param int $invoiceId
         * @param int $paymentId
         * @param array $paymentData
         * @return Response
         * @throws LSException
         */
        public function updateForInvoice(int $invoiceId, int $paymentId, array $paymentData): Response
        {
            $url = $this->replaceInvoiceId($invoiceId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_INVOICES_PAYMENTS_PUT);
            $url = $this->replacePaymentId($paymentId, $url);

            return $this->callApi(self::METHOD_PUT, $url, $paymentData);
        }

        /**
         * Updates specified payment of current invoice.
         *
         * @param int $paymentId
         * @param array $paymentData
         * @return Response
         * @throws InvalidUseException
         * @throws LSException
         */
        public function update(int $paymentId, array $paymentData): Response
        {
            $this->checkInvoiceId();

            return $this->updateForInvoice($this->invoiceId, $paymentId, $paymentData);
        }

        /**
         * Deletes specified invoice's payments.
         *
         * @param int $invoiceId
         * @param array $paymentIds
         * @return Response
         * @throws LSException
         */
        public function deleteForInvoice(int $invoiceId, array $paymentIds): Response
        {
            $url = $this->replaceInvoiceId($invoiceId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_INVOICES_PAYMENTS_DELETE);
            $url = $this->replacePaymentId(implode(',', $paymentIds), $url, '{paymentIds}');

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Deletes specified payments of current invoice.
         *
         * @param array $paymentIds
         * @return Response
         * @throws InvalidUseException
         * @throws LSException
         */
        public function delete(array $paymentIds): Response
        {
            $this->checkInvoiceId();

            return $this->deleteForInvoice($this->invoiceId, $paymentIds);
        }


        /**
         * Helper function for replacing {invoiceId} placeholder in URL.
         *
         * @param int $invoiceId
         * @param string $subject
         * @return string
         */
        private function replaceInvoiceId(int $invoiceId, string $subject): string
        {
            return str_replace('{invoiceId}', $invoiceId, $subject);
        }

        /**
         * Helper function for replacing {paymentId} or different placeholder in URL.
         *
         * @param mixed $replacement
         * @param string $subject
         * @return string
         */
        private function replacePaymentId($replacement, string $subject, string $placeholder = '{paymentId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }

        /**
         * Checks whether there is current invoice id set
         *
         * @throws InvalidUseException
         */
        private function checkInvoiceId()
        {
            if (is_null($this->invoiceId)) {
                throw new InvalidUseException('Invoice id should be first set by setInvoiceId method.');
            }
        }
    }