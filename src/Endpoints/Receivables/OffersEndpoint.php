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
     * Class OffersEndpoint
     * @package smallinvoice\api2\Endpoints\Receivables
     */
    class OffersEndpoint extends AbstractEndpoint implements ListInterface, GetInterface, PdfInterface, PreviewInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_RECEIVABLES_OFFERS_LIST = '/receivables/offers';
        const ENDPOINT_RECEIVABLES_OFFERS_GET = '/receivables/offers/{offerId}';
        const ENDPOINT_RECEIVABLES_OFFERS_PDF = '/receivables/offers/{offerId}/pdf';
        const ENDPOINT_RECEIVABLES_OFFERS_PREVIEW = '/receivables/offers/{offerId}/preview';
        const ENDPOINT_RECEIVABLES_OFFERS_POST = '/receivables/offers';
        const ENDPOINT_RECEIVABLES_OFFERS_PUT = '/receivables/offers/{offerId}';
        const ENDPOINT_RECEIVABLES_OFFERS_CHANGE_STATUS = '/receivables/offers/{offerId}/change-status';
        const ENDPOINT_RECEIVABLES_OFFERS_SEND_BY_POST = '/receivables/offers/{offerId}/send-by-post';
        const ENDPOINT_RECEIVABLES_OFFERS_SEND_BY_EMAIL = '/receivables/offers/{offerId}/send-by-email';
        const ENDPOINT_RECEIVABLES_OFFERS_DELETE = '/receivables/offers/{offerIds}';


        protected $scopes = ['offer'];

        /**
         * Gets list of offers.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_RECEIVABLES_OFFERS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified offer.
         *
         * @param int $offerId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $offerId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_RECEIVABLES_OFFERS_GET, $parameters);
            $url = str_replace('{offerId}', $offerId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets PDF of specified offer.
         *
         * @param int $offerId
         * @param PdfParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getPdf(int $offerId, PdfParameters $parameters = null): Response
        {
            $url = $this->preparePdfUrl(static::ENDPOINT_RECEIVABLES_OFFERS_PDF, $parameters);
            $url = str_replace('{offerId}', $offerId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets preview of specified offer.
         *
         * @param int $offerId
         * @param PreviewParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function getPreview(int $offerId, PreviewParameters $parameters = null): Response
        {
            $url = $this->preparePreviewUrl(static::ENDPOINT_RECEIVABLES_OFFERS_PREVIEW, $parameters);
            $url = str_replace('{offerId}', $offerId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new offer.
         *
         * @param array $offerData
         * @return Response
         * @throws LSException
         */
        public function create(array $offerData): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_RECEIVABLES_OFFERS_POST;

            return $this->callApi(self::METHOD_POST, $url, $offerData);
        }

        /**
         * Updates specified offer.
         *
         * @param int $offerId
         * @param array $offerData
         * @return Response
         * @throws LSException
         */
        public function update(int $offerId, array $offerData): Response
        {
            $url = str_replace('{offerId}', $offerId, $this->baseUrl . static::ENDPOINT_RECEIVABLES_OFFERS_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $offerData);
        }

        /**
         * Changes status of specified offer.
         *
         * @param int $offerId
         * @param array $changeStatusData
         * @return Response
         * @throws LSException
         */
        public function changeStatus(int $offerId, array $changeStatusData): Response
        {
            $url = str_replace('{offerId}', $offerId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_OFFERS_CHANGE_STATUS);

            return $this->callApi(self::METHOD_PATCH, $url, $changeStatusData);
        }

        /**
         * Sends specified offer by post.
         *
         * @param int $offerId
         * @param array $sendingData
         * @return Response
         * @throws LSException
         */
        public function sendByPost(int $offerId, array $sendingData): Response
        {
            $url = str_replace('{offerId}', $offerId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_OFFERS_SEND_BY_POST);

            return $this->callApi(self::METHOD_PATCH, $url, $sendingData);
        }

        /**
         * Sends specified offer by email.
         *
         * @param int $offerId
         * @param array $sendingData
         * @return Response
         * @throws LSException
         */
        public function sendByEmail(int $offerId, array $sendingData): Response
        {
            $url = str_replace('{offerId}', $offerId,
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_OFFERS_SEND_BY_EMAIL);

            return $this->callApi(self::METHOD_PATCH, $url, $sendingData);
        }

        /**
         * Delete specified offers.
         *
         * @param array $offerIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $offerIds): Response
        {
            $url = str_replace('{offerIds}', implode(',', $offerIds),
                $this->baseUrl . static::ENDPOINT_RECEIVABLES_OFFERS_DELETE);

            return $this->callApi(self::METHOD_DELETE, $url);
        }
    }