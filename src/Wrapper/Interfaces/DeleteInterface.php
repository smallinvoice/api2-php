<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Interfaces;

    use smallinvoice\api2\Wrapper\Response\Response;

    /**
     * Interface DeleteInterface
     * @package smallinvoice\api2\Wrapper\Interfaces
     */
    interface DeleteInterface
    {

        /**
         * Deletes specified entities
         * @param array $ids
         * @return Response
         */
        public function delete(array $ids): Response;

    }