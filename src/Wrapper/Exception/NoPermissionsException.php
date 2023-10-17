<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    use smallinvoice\api2\Wrapper\Exception\Interfaces\StickToDefaultValues;
    use smallinvoice\api2\Wrapper\Exception\Traits\RequestResponse;
    use smallinvoice\api2\Wrapper\Exception\Traits\StickToDefaultValuesImplementation;

    /**
     * Class NoPermissionsException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class NoPermissionsException extends LSException implements StickToDefaultValues
    {

        use RequestResponse;
        use StickToDefaultValuesImplementation;

        /**
         * Default exception code
         * @var int
         */
        protected $defaultCode = 5000;

        /**
         * Default exception message
         * @var string
         */
        protected $defaultMessage = 'User does not have sufficient permissions to perform this action';
    }