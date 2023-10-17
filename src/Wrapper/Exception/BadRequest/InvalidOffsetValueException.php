<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\BadRequest;

    use smallinvoice\api2\Wrapper\Exception\BadRequestException;

    /**
     * Class InvalidOffsetValueException
     * @package smallinvoice\api2\Wrapper\Exception\BadRequest
     */
    class InvalidOffsetValueException extends BadRequestException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 2104;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid offset value. Offset cannot be < 0';
    }