<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Interfaces;

    use smallinvoice\api2\Wrapper\Response\Response;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;

    /**
     * Interface ListInterface
     * @package smallinvoice\api2\Wrapper\Interfaces
     */
    interface ListInterface
    {

        /**
         * Lists entities
         * @param ListParameters $parameters
         * @return Response
         */
        public function list(ListParameters $parameters = null): Response;

    }