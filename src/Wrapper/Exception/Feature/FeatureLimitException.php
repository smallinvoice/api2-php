<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\Feature;

    use smallinvoice\api2\Wrapper\Exception\LSException;
    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;

    /**
     * Class FeatureLimitException
     * @package smallinvoice\api2\Wrapper\Exception\Feature
     */
    class FeatureLimitException extends LSException
    {

        use RequestResponse;

        /**
         * Feature name
         * @var string
         */
        private $feature;

        /**
         * Limit number
         * @var int
         */
        private $limit;

        /**
         * Creates new exception with specified feature
         * @param string $feature
         * @param int $limit
         * @return static
         */
        public static function createNew(string $feature, int $limit)
        {
            $exception = new static();
            $exception->setFeature($feature);
            $exception->setLimit($limit);

            return $exception;
        }

        /**
         * Sets feature name
         * @param string $feature
         */
        public function setFeature(string $feature)
        {
            $this->feature = $feature;
        }

        /**
         * Sets limit number
         * @param int $limit
         */
        public function setLimit(int $limit)
        {
            $this->limit = $limit;
        }

        /**
         * Gets feature name
         * @return string
         */
        public function getFeature(): string
        {
            return $this->feature;
        }

        /**
         * Gets limit number
         * @return int
         */
        public function getLimit(): int
        {
            return $this->limit;
        }
    }