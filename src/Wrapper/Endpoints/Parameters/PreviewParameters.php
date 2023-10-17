<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Endpoints\Parameters;

    /**
     * Class PreviewParameters
     * @package smallinvoice\api2\Wrapper\Endpoints\Parameters
     */
    class PreviewParameters
    {

        /**
         * Value of "size" parameter (width in pixels).
         * @var int
         */
        private $size;

        /**
         * Value of "page" parameter.
         * @var int
         */
        private $page;

        /**
         * Sets value of "size" parameter (value passed as width in pixels).
         * @param int $size
         * @return PreviewParameters
         */
        public function setSize(int $size): PreviewParameters
        {
            $this->size = $size;

            return $this;
        }

        /**
         * Sets value of "page" parameter.
         * @param int $page
         * @return PreviewParameters
         */
        public function setPage(int $page): PreviewParameters
        {
            $this->page = $page;

            return $this;
        }

        /**
         * Checks if there's any value set of "size" parameter.
         * @return bool
         */
        public function hasSize(): bool
        {
            return !is_null($this->size);
        }

        /**
         * Checks if there's any value set of "page" parameter.
         * @return bool
         */
        public function hasPage(): bool
        {
            return !is_null($this->page);
        }

        /**
         * Gets value of "size" parameter (width in pixels).
         * @return int|null
         */
        public function getSize()
        {
            return $this->size;
        }

        /**
         * Gets value of "page" parameter.
         * @return int|null
         */
        public function getPage()
        {
            return $this->page;
        }

    }