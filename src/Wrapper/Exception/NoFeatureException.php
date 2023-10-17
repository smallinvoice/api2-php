<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;

    /**
     * Class NoFeatureException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class NoFeatureException extends LSException
    {

        use RequestResponse;

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 4000;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'User does not have a proper plan to perform this action';

        /**
         * Feature name
         * @var string
         */
        private $feature = '';

        /**
         * Array of plans that provide missing feature
         * @var array
         */
        private $plans = [];

        /**
         * Creates new exception with specified feature
         * @param string $feature
         * @param string $plans
         * @return static
         */
        public static function createNew(string $feature, array $plans = []): NoFeatureException
        {
            $exception = new static();
            $exception->setFeature($feature);
            $exception->setPlans($plans);

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
         * Sets plans that provide missing feature
         * @param array $plans
         */
        public function setPlans(array $plans)
        {
            $this->plans = $plans;
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
         * Gets plans that provide missing feature
         * @return array
         */
        public function getPlans(): array
        {
            return $this->plans;
        }
    }