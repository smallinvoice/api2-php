<?php
    declare(strict_types=1);

    use LourensSystems\ApiWrapper\OAuth2\Client\Provider\Provider;
    use smallinvoice\api2\Endpoints\EndpointStrategy;

    if (!isset($_ENV['CLIENT_ID']) || !isset($_ENV['CLIENT_SECRET'])) {
        throw new Exception('No client id or secret set as environment variable');
    }

    return new Provider(
        [
            'clientId'     => $_ENV['CLIENT_ID'], // The client ID assigned to you by the provider
            'clientSecret' => $_ENV['CLIENT_SECRET'], // The client password assigned to you by the provider
            'baseUrl'      => isset($_ENV['STAGING']) ? EndpointStrategy::getApiURLStaging() : EndpointStrategy::getApiURLProduction(),
        ]);