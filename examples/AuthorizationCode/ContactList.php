<?php
    declare(strict_types=1);

    require_once __DIR__ . '/../vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;

    if (!isset($_ENV['REFRESH_TOKEN'])) {
        throw new \Exception('Missing environment data');
    }

    $provider = require_once __DIR__ . '/../Provider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider, $_ENV['REFRESH_TOKEN']);

    $listParameters = new ListParameters();
    do {
        $response = $contacts->list($listParameters);
        $responseItems = $response->getItems();

        foreach ($responseItems as $item) {
            print_r($item);
        }

        $listParameters->setNextOffset();
    } while ($responseItems->hasNext());