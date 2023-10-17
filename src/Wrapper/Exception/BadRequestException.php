<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Interfaces\StickToDefaultValues;
    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;
    use smallinvoice\api2\Wrapper\Exception\Traits\StickToDefaultValuesImplementation;

    /**
     * Class BadRequestException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class BadRequestException extends LSException implements StickToDefaultValues
    {

        use RequestResponse;
        use StickToDefaultValuesImplementation;

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 2000;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'Bad request';
    }