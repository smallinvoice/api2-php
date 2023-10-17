<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception\BadRequest;

    use smallinvoice\api2\Wrapper\Exception\BadRequestException;

    /**
     * Class InvalidSortKeyException
     * @package smallinvoice\api2\Wrapper\Exception\BadRequest
     */
    class InvalidSortKeyException extends BadRequestException
    {

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 2102;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Invalid sorting key value';
    }