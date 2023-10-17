<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Catalog\Products;

    use smallinvoice\api2\Wrapper\Endpoints\AbstractEndpoint;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;
    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Interfaces\CreateInterface;
    use smallinvoice\api2\Wrapper\Interfaces\DeleteInterface;
    use smallinvoice\api2\Wrapper\Interfaces\GetInterface;
    use smallinvoice\api2\Wrapper\Interfaces\ListInterface;
    use smallinvoice\api2\Wrapper\Interfaces\UpdateInterface;
    use smallinvoice\api2\Wrapper\Response\Response;

    /**
     * Class ProductsEndpoint
     * @package smallinvoice\api2\Endpoints\Catalog\Products
     */
    class ProductsEndpoint extends AbstractEndpoint implements GetInterface, ListInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_CATALOG_PRODUCTS_LIST = '/catalog/products';
        const ENDPOINT_CATALOG_PRODUCTS_GET = '/catalog/products/{productId}';
        const ENDPOINT_CATALOG_PRODUCTS_POST = '/catalog/products';
        const ENDPOINT_CATALOG_PRODUCTS_PUT = '/catalog/products/{productId}';
        const ENDPOINT_CATALOG_PRODUCTS_DELETE = '/catalog/products/{productIds}';

        protected $scopes = ['catalog'];

        /**
         * Gets list of products.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_CATALOG_PRODUCTS_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified product.
         *
         * @param int $productId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $productId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_CATALOG_PRODUCTS_GET, $parameters);
            $url = $this->replaceId($productId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new product.
         *
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function create(array $data): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_CATALOG_PRODUCTS_POST;

            return $this->callApi(self::METHOD_POST, $url, $data);
        }

        /**
         * Updates specified product.
         *
         * @param int $productId
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function update(int $productId, array $data): Response
        {
            $url = $this->replaceId($productId, $this->baseUrl . static::ENDPOINT_CATALOG_PRODUCTS_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $data);
        }

        /**
         * Delete specified products.
         *
         * @param array $productIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $productIds): Response
        {
            $url = $this->replaceId(implode(',', $productIds),
                $this->baseUrl . static::ENDPOINT_CATALOG_PRODUCTS_DELETE,
                '{productIds}');

            return $this->callApi(self::METHOD_DELETE, $url);
        }

        /**
         * Helper function for replacing ids in ulr.
         *
         * @param mixed $replacement
         * @param string $subject
         * @param string $placeholder
         * @return string
         */
        protected function replaceId($replacement, string $subject, string $placeholder = '{productId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }
    }

