<?php
    declare(strict_types=1);

    require_once __DIR__ . '/vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;

    $provider = require_once 'ClientCredentialsProvider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    try {
        // create contact to be updated
        $contactId = $contacts->create([
            'relation'     => ['CL'], //see API docs
            'type'         => 'C',  //see API docs
            'name'         => 'ACME GmbH',
            'email'        => 'info@testdomain.ch',
            'currency'     => 'CHF',
            'main_address' => [
                'country'  => 'CH',
                'street'   => 'Teststreet',
                'postcode' => '3000',
                'city'     => 'Bern'
            ]
        ])->getItem()->id;

        // print expected HTTP code 204
        print_r($contacts->delete([$contactId])->getStatusCode() . PHP_EOL);
    } catch (Exception $e) {
        print_r($e->getMessage());
    }