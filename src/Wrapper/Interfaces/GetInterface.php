<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Interfaces;

    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;
    use smallinvoice\api2\Wrapper\Response\Response;

    /**
     * Interface GetInterface
     * @package smallinvoice\api2\Wrapper\Interfaces
     */
    interface GetInterface
    {

        /**
         * Gets data of specified entity
         * @param int $id
         * @param GetParameters $parameters
         * @return Response
         */
        public function get(int $id, GetParameters $parameters = null): Response;

    }