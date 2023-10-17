<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Endpoints\Parameters;

    /**
     * Class PdfParameters
     * @package smallinvoice\api2\Wrapper\Endpoints\Parameters
     */
    class PdfParameters
    {

        /**
         * Value of "options" parameter.
         * @var string
         */
        private $options;

        /**
         * Sets value of "options" parameter (value passed as an array)
         * @param array $options
         * @return PdfParameters
         */
        public function setOptionsArray(array $options): PdfParameters
        {
            $this->options = json_encode($options);

            return $this;
        }

        /**
         * Sets value of "options" parameter (value passed as a JSON string)
         * @param string $options
         * @return PdfParameters
         */
        public function setOptions(string $options): PdfParameters
        {
            $this->options = $options;

            return $this;
        }

        /**
         * Checks if there's any value set of "options" parameter.
         * @return bool
         */
        public function hasOptions(): bool
        {
            return !is_null($this->options);
        }

        /**
         * Gets value of "options" parameter.
         * @return string|null
         */
        public function getOptions()
        {
            return $this->options;
        }
    }