<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Endpoints\Parameters;

    /**
     * Class ListParameters
     * @package smallinvoice\api2\Wrapper\Endpoints\Parameters
     */
    class ListParameters
    {

        /**
         * Max value of "limit" parameter
         */
        const LIMIT_MAX = 200;

        /**
         * Default value of "limit" parameter
         */
        const LIMIT_DEFAULT = 100;

        /**
         * Default value of "offset" parameter
         */
        const OFFSET_DEFAULT = 0;

        /**
         * Value of "q" parameter.
         * @var string
         */
        private $q;

        /**
         * Value of "filter" parameter.
         * @var string
         */
        private $filter;

        /**
         * Value of "with" parameter.
         * @var string
         */
        private $with;

        /**
         * Value of "sort" parameter.
         * @var string
         */
        private $sort;

        /**
         * Value of "limit" parameter.
         * @var int
         */
        private $limit;

        /**
         * Value of "offset" parameter.
         * @var int
         */
        private $offset;

        /**
         * Sets value of "q" parameter.
         * @param string $q
         * @return ListParameters
         */
        public function setQ(string $q): ListParameters
        {
            $this->q = $q;

            return $this;
        }

        /**
         * Sets value of "filter" parameter (value passed as an array).
         * @param array $filter
         * @return ListParameters
         */
        public function setFilterArray(array $filter): ListParameters
        {
            $this->filter = json_encode($filter);

            return $this;
        }

        /**
         * Sets value of "filter" parameter (value passed as a JSON string).
         * @param string $filter
         * @return ListParameters
         */
        public function setFilter(string $filter): ListParameters
        {
            $this->filter = $filter;

            return $this;
        }

        /**
         * Sets value of "with" parameter (value passed as an array).
         * @param array $with
         * @return ListParameters
         */
        public function setWithArray(array $with): ListParameters
        {
            $this->with = implode(',', $with);

            return $this;
        }

        /**
         * Sets value of "with" parameter (value passed as a string).
         * @param string $with
         * @return ListParameters
         */
        public function setWith(string $with): ListParameters
        {
            $this->with = $with;

            return $this;
        }

        /**
         * Sets value of "sort" parameter (value passed as an array).
         * @param array $sort
         * @return ListParameters
         */
        public function setSortArray(array $sort): ListParameters
        {
            $this->sort = implode(',', $sort);

            return $this;
        }

        /**
         * Sets value of "sort" parameter (value passed as a string)
         * @param string $sort
         * @return ListParameters
         */
        public function setSort(string $sort): ListParameters
        {
            $this->sort = $sort;

            return $this;
        }

        /**
         * Sets value of "limit" parameter.
         * @param int $limit
         * @return ListParameters
         */
        public function setLimit(int $limit): ListParameters
        {
            $this->limit = $limit;

            return $this;
        }

        /**
         * Sets value of "limit" parameter to be a max limit value.
         * @return ListParameters
         */
        public function setMaxLimit(): ListParameters
        {
            $this->setLimit(self::LIMIT_MAX);

            return $this;
        }

        /**
         * Sets value of "limit" parameter to be a default limit value.
         * @return ListParameters
         */
        public function setDefaultLimit(): ListParameters
        {
            $this->setLimit(self::LIMIT_DEFAULT);

            return $this;
        }

        /**
         * Sets value of "offset" parameter.
         * @param int $offset
         * @return ListParameters
         */
        public function setOffset(int $offset): ListParameters
        {
            $this->offset = $offset;

            return $this;
        }

        /**
         * Sets value of "offset" parameter to be next offset value (considering pagination).
         * @return ListParameters
         */
        public function setNextOffset(): ListParameters
        {
            return $this->setOffset($this->getNextOffset());
        }

        /**
         * Checks if there's any value set of "q" parameter.
         * @return bool
         */
        public function hasQ(): bool
        {
            return !is_null($this->q);
        }

        /**
         * Checks if there's any value set of "filter" parameter.
         * @return bool
         */
        public function hasFilter(): bool
        {
            return !is_null($this->filter);
        }

        /**
         * Checks if there's any value set of "with" parameter.
         * @return bool
         */
        public function hasWith(): bool
        {
            return !is_null($this->with);
        }

        /**
         * Checks if there's any value set of "sort" parameter.
         * @return bool
         */
        public function hasSort(): bool
        {
            return !is_null($this->sort);
        }

        /**
         * Checks if there's any value set of "limit" parameter.
         * @return bool
         */
        public function hasLimit(): bool
        {
            return !is_null($this->limit);
        }

        /**
         * Checks if there's any value set of "offset" parameter.
         * @return bool
         */
        public function hasOffset(): bool
        {
            return !is_null($this->offset);
        }

        /**
         * Gets value of "q" parameter.
         * @return string|null
         */
        public function getQ()
        {
            return $this->q;
        }

        /**
         * Gets value of "filter" parameter.
         * @return string|null
         */
        public function getFilter()
        {
            return $this->filter;
        }

        /**
         * Gets value of "with" parameter.
         * @return string|null
         */
        public function getWith()
        {
            return $this->with;
        }

        /**
         * Gets value of "sort" parameter.
         * @return string|null
         */
        public function getSort()
        {
            return $this->sort;
        }

        /**
         * Gets value of "limit" parameter.
         * @return int|null
         */
        public function getLimit()
        {
            return $this->limit;
        }

        /**
         * Gets value of "offset" parameter.
         * @return int|null
         */
        public function getOffset()
        {
            return $this->offset;
        }

        /**
         * Gets value of next offset (considering pagination).
         * @return int
         */
        public function getNextOffset(): int
        {
            return ($this->hasOffset() ? $this->getOffset() : self::OFFSET_DEFAULT) + ($this->hasLimit() ? $this->getLimit() : self::LIMIT_DEFAULT);
        }
    }