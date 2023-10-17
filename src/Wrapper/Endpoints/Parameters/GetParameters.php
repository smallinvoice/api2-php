<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Endpoints\Parameters;

    /**
     * Class GetParameters
     * @package smallinvoice\api2\Wrapper\Endpoints\Parameters
     */
    class GetParameters
    {

        /**
         * Value of "with" parameter.
         * @var string
         */
        protected $with;

        /**
         * Sets value of "with" parameter.
         * @param string $with
         * @return GetParameters
         */
        public function setWith(string $with): GetParameters
        {
            $this->with = $with;

            return $this;
        }

        /**
         * Checks if there's any value set of "with" parameter.
         * @return bool
         */
        public function hasWidth(): bool
        {
            return !is_null($this->with);
        }

        /**
         * Gets value of "with" parameter.
         * @return string|null
         */
        public function getWith()
        {
            return $this->with;
        }
    }