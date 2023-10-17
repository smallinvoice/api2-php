<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Interfaces;

    use smallinvoice\api2\Wrapper\Endpoints\Parameters\PreviewParameters;
    use smallinvoice\api2\Wrapper\Response\Response;

    /**
     * Interface PreviewInterface
     * @package smallinvoice\api2\Wrapper\Interfaces
     */
    interface PreviewInterface
    {

        /**
         * Gets preview of specified id
         * @param int $id
         * @param PreviewParameters|null $parameters
         * @return Response
         */
        public function getPreview(int $id, PreviewParameters $parameters = null): Response;

    }