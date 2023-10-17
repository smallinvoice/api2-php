<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Interfaces\StickToDefaultValues;
    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;
    use smallinvoice\api2\Wrapper\Exception\Traits\StickToDefaultValuesImplementation;

    /**
     * Class NotFoundException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class NotFoundException extends LSException implements StickToDefaultValues
    {

        use RequestResponse;
        use StickToDefaultValuesImplementation;

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 3000;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Entity not found';

        /**
         * Type of entity that does not exist
         * @var string
         */
        private $entityType = '';

        /**
         * Creates new exception for specified entity type
         * @param string $entityType
         * @param string $message
         * @param int $code
         * @return NotFoundException
         */
        public static function createNew($entityType, $message = '', $code = 0): NotFoundException
        {
            $new = new static($message, $code);
            $new->setEntityType($entityType);

            return $new;
        }

        /**
         * Sets type of the entity that does not exist
         * @param string $entityType
         */
        public function setEntityType(string $entityType)
        {
            $this->entityType = $entityType;
        }

        /**
         * Gets entity type that does not exist
         * @return string
         */
        public function getEntityType(): string
        {
            return $this->entityType;
        }
    }