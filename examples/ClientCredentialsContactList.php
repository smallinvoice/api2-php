<?php
    declare(strict_types=1);

    require_once __DIR__ . '/vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;

    $provider = require_once 'ClientCredentialsProvider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    try {
        $hasMore = true;
        $listParameters = (new ListParameters())->setMaxLimit();

        while ($hasMore) {
            $responseItems = $contacts->list($listParameters)->getItems();

            var_dump($responseItems);

            if ($responseItems->hasNext()) {
                $listParameters->setNextOffset();
            } else {
                $hasMore = false;
            }
        }
    } catch (Exception $e) {
        print_r($e->getMessage());
    }