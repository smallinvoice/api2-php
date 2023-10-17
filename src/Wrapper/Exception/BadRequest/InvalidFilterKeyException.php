<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\BadRequest;

    use smallinvoice\api2\Wrapper\Exception\BadRequestException;

    /**
     * Class InvalidFilterKeyException
     * @package smallinvoice\api2\Wrapper\Exception\BadRequest
     */
    class InvalidFilterKeyException extends BadRequestException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 2101;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid filter key value';
    }