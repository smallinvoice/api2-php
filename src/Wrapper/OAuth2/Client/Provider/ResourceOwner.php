<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\OAuth2\Client\Provider;

    use League\OAuth2\Client\Provider\ResourceOwnerInterface;

    /**
     * Class ResourceOwner
     * @package smallinvoice\api2\Wrapper\OAuth2\Client\Provider
     */
    class ResourceOwner implements ResourceOwnerInterface
    {

        /**
         * Data of authenticated user (resource owner)
         * @var array
         */
        protected $authUserData = [];

        /**
         * ResourceOwner constructor.
         * @param array $response
         */
        public function __construct(array $response = array())
        {
            $this->authUserData = array_key_exists('item', $response) ? $response['item'] : [];
        }

        /**
         * @inheritdoc
         */
        public function getId()
        {
            return array_key_exists('id', $this->authUserData) ? $this->authUserData['id'] : null;
        }

        /**
         * @inheritdoc
         */
        public function toArray()
        {
            return $this->authUserData;
        }
    }