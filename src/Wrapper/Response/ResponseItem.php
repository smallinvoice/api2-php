<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Response;

    /**
     * Class ResponseItem
     * @package smallinvoice\api2\Wrapper\Response
     */
    class ResponseItem
    {

        /**
         * Item's values
         * @var \stdClass
         */
        private $values;

        /**
         * ResponseItem constructor.
         * @param \stdClass $values
         */
        public function __construct(\stdClass $values)
        {
            $this->values = $values;
        }

        /**
         * Creates ResponseItem object from Response
         * @param Response $response
         * @return ResponseItem
         * @throws ResponseException
         */
        public static function createFromResponse(Response $response): ResponseItem
        {
            $parsedResponseBody = $response->getParsedBody();
            if (!property_exists($parsedResponseBody, 'item')) {
                throw new ResponseException('Property item not set');
            }

            return new static($parsedResponseBody->item);
        }

        /**
         * Creates empty ResponseItem object
         * @return ResponseItem
         */
        public static function createEmpty(): ResponseItem
        {
            return new static(new \stdClass());
        }

        /**
         * Returns item's values in an array
         * @return array
         */
        public function getAsArray(): array
        {
            return \GuzzleHttp\json_decode(\GuzzleHttp\json_encode($this->values), true);
        }

        /**
         * Checks if specified key exists
         * @param string $key
         * @return bool
         */
        public function keyExists($key): bool
        {
            return property_exists($this->values, $key);
        }

        /**
         * Checks if item is equal to another item
         * @param ResponseItem $compareItem
         * @return bool
         */
        public function isEqual(ResponseItem $compareItem): bool
        {
            $values = $this->getAsArray();
            ksort($values);
            $compareValues = $compareItem->getAsArray();
            ksort($compareValues);

            return $values === $compareValues;
        }

        /**
         * Checks if item contains specified values (for keys that exist in the item)
         * @param array $compareValues
         * @return bool
         */
        public function checkValues(array $compareValues): bool
        {
            foreach ($compareValues as $key => $value) {
                if ($this->keyExists($key) && $this->$key !== $value) {
                    return false;
                }
            }

            return true;
        }

        /**
         * Gets item's value for specified key
         * @param string $key
         * @return mixed
         * @throws ResponseException
         */
        public function __get($key)
        {
            return $this->keyExists($key) ? $this->values->$key : null;
        }

    }