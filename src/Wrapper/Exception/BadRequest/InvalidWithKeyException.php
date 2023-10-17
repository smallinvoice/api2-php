<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\BadRequest;

    use smallinvoice\api2\Wrapper\Exception\BadRequestException;

    /**
     * Class InvalidWithKeyException
     * @package smallinvoice\api2\Wrapper\Exception\BadRequest
     */
    class InvalidWithKeyException extends BadRequestException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 2100;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid key for with listing parameter';
    }