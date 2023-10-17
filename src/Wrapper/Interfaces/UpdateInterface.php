<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Interfaces;

    use smallinvoice\api2\Wrapper\Response\Response;

    /**
     * Interface UpdateInterface
     * @package smallinvoice\api2\Wrapper\Interfaces
     */
    interface UpdateInterface
    {

        /**
         * Updates specified entity
         * @param int $id
         * @param array $data
         * @return Response
         */
        public function update(int $id, array $data): Response;

    }