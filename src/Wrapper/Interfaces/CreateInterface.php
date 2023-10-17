<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Interfaces;

    use smallinvoice\api2\Wrapper\Response\Response;

    /**
     * Interface CreateInterface
     * @package smallinvoice\api2\Wrapper\Interfaces
     */
    interface CreateInterface
    {

        /**
         * Creates new entity
         * @param array $data
         * @return Response
         */
        public function create(array $data): Response;

    }