<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\BadRequest;

    use smallinvoice\api2\Wrapper\Exception\BadRequestException;

    /**
     * Class InvalidLimitValueException
     * @package smallinvoice\api2\Wrapper\Exception\BadRequest
     */
    class InvalidLimitValueException extends BadRequestException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 2103;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid limit value. Limit cannot be <= 0 or > 200';
    }