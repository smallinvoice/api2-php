<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Endpoints\Catalog\Products;

    use LourensSystems\ApiWrapper\Endpoints\AbstractEndpoint;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\GetParameters;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;
    use LourensSystems\ApiWrapper\Exception\LSException;
    use LourensSystems\ApiWrapper\Interfaces\CreateInterface;
    use LourensSystems\ApiWrapper\Interfaces\DeleteInterface;
    use LourensSystems\ApiWrapper\Interfaces\GetInterface;
    use LourensSystems\ApiWrapper\Interfaces\ListInterface;
    use LourensSystems\ApiWrapper\Interfaces\UpdateInterface;
    use LourensSystems\ApiWrapper\Response\Response;

    /**
     * Class CategoriesEndpoint
     * @package smallinvoice\api2\Endpoints\Catalog\Products
     */
    class CategoriesEndpoint extends AbstractEndpoint implements GetInterface, ListInterface, CreateInterface, UpdateInterface, DeleteInterface
    {

        const ENDPOINT_CATALOG_PRODUCTS_CATEGORIES_LIST = '/catalog/products/categories';
        const ENDPOINT_CATALOG_PRODUCTS_CATEGORIES_GET = '/catalog/products/categories/{categoryId}';
        const ENDPOINT_CATALOG_PRODUCTS_CATEGORIES_POST = '/catalog/products/categories';
        const ENDPOINT_CATALOG_PRODUCTS_CATEGORIES_PUT = '/catalog/products/categories/{categoryId}';
        const ENDPOINT_CATALOG_PRODUCTS_CATEGORIES_DELETE = '/catalog/products/categories/{categoryIds}';

        protected $scopes = ['catalog'];

        /**
         * Gets list of product categories.
         *
         * @param ListParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function list(ListParameters $parameters = null): Response
        {
            $url = $this->prepareListUrl(static::ENDPOINT_CATALOG_PRODUCTS_CATEGORIES_LIST, $parameters);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Gets details of specified product category.
         *
         * @param int $categoryId
         * @param GetParameters|null $parameters
         * @return Response
         * @throws LSException
         */
        public function get(int $categoryId, GetParameters $parameters = null): Response
        {
            $url = $this->prepareGetUrl(static::ENDPOINT_CATALOG_PRODUCTS_CATEGORIES_GET, $parameters);
            $url = $this->replaceId($categoryId, $url);

            return $this->callApi(self::METHOD_GET, $url);
        }

        /**
         * Creates new product category.
         *
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function create(array $data): Response
        {
            $url = $this->baseUrl . static::ENDPOINT_CATALOG_PRODUCTS_CATEGORIES_POST;

            return $this->callApi(self::METHOD_POST, $url, $data);
        }

        /**
         * Updates specified product category.
         *
         * @param int $categoryId
         * @param array $data
         * @return Response
         * @throws LSException
         */
        public function update(int $categoryId, array $data): Response
        {
            $url = $this->replaceId($categoryId, $this->baseUrl . static::ENDPOINT_CATALOG_PRODUCTS_CATEGORIES_PUT);

            return $this->callApi(self::METHOD_PUT, $url, $data);
        }

        /**
         * Deletes specified product categories.
         *
         * @param array $categoryIds
         * @return Response
         * @throws LSException
         */
        public function delete(array $categoryIds): Response
        {
            $url = $this->replaceId(implode(',', $categoryIds),
                $this->baseUrl . static::ENDPOINT_CATALOG_PRODUCTS_CATEGORIES_DELETE, '{categoryIds}');

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
        protected function replaceId($replacement, string $subject, string $placeholder = '{categoryId}'): string
        {
            return str_replace($placeholder, $replacement, $subject);
        }
    }

