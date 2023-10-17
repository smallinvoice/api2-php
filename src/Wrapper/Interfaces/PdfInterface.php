<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Interfaces;

    use smallinvoice\api2\Wrapper\Endpoints\Parameters\PdfParameters;
    use smallinvoice\api2\Wrapper\Response\Response;

    /**
     * Interface PdfInterface
     * @package smallinvoice\api2\Wrapper\Interfaces
     */
    interface PdfInterface
    {

        /**
         * Gets PDF of specified id
         * @param int $id
         * @param PdfParameters|null $parameters
         * @return Response
         */
        public function getPdf(int $id, PdfParameters $parameters = null): Response;

    }