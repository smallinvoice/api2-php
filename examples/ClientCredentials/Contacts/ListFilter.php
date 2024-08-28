<?php
    declare(strict_types=1);

    require_once __DIR__ . '/../../vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\ListParameters;

    $provider = require_once __DIR__ . '/../../Provider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    try {
        // create contact and print it out from sever response
        $contacts->create([
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
        ]);

        // prepare some data
        $listParameters = (new ListParameters())->setFilterArray([
            'and' => [
                ['currency' => 'CHF'],
                ['type' => 'C']
            ]
        ]);

        do {
            // list contacts which has currency set to CHF AND are type of "company"
            $responseItems = $contacts->list($listParameters)->getItems();

            foreach ($responseItems as $item) {
                print_r($item);
            }

            $listParameters->setNextOffset();
        } while ($responseItems->hasNext());
    } catch (Exception $e) {
        print_r($e->getMessage());
    }