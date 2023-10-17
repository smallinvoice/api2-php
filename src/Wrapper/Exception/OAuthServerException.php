<?php
    declare(strict_types=1);

    namespace smallinvoice\api2\Wrapper\Exception;

    /**
     * Class OAuthServerException
     * @package smallinvoice\api2\Wrapper\Exception
     */
    class OAuthServerException extends \League\OAuth2\Server\Exception\OAuthServerException
    {

        /**
         * Required scopes missing error.
         * @param array $requiredScopes
         * @param null $redirectUri
         * @return OAuthServerException
         */
        public static function requiredScopesMissing(array $requiredScopes, $redirectUri = null): OAuthServerException
        {
            $errorMessage = 'Some of the required scopes are missing in the request';
            $hint = sprintf('End user has to generate access token with: [`%s`] scopes included',
                implode('` `', $requiredScopes));

            return new static($errorMessage, 11, 'required_scopes_missing', 400, $hint, $redirectUri);
        }

        /**
         * Invalid scopes error.
         * @param array $invalidScopes
         * @param null $redirectUri
         * @return OAuthServerException
         */
        public static function invalidScopes(array $invalidScopes, $redirectUri = null): OAuthServerException
        {
            $errorMessage = 'Some of the requested scopes are invalid, unknown, or malformed';
            $hint = sprintf('Invalid scopes: [`%s`]', implode('` `', $invalidScopes));

            return new static($errorMessage, 12, 'invalid_scopes', 400, $hint, $redirectUri);
        }
    }