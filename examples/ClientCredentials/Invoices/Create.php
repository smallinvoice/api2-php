<?php
    declare(strict_types=1);

    require_once __DIR__ . '/../../vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Receivables\InvoicesEndpoint;
    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;
    use LourensSystems\ApiWrapper\Exception\ValidationFailedException;

    $provider = require_once __DIR__ . '/../../Provider.php';

    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    /** @var InvoicesEndpoint $invoices */
    $invoices = new InvoicesEndpoint($provider);

    try {
        // init faker
        $faker = Faker\Factory::create();

        // create contact
        $contact = $contacts->create([
            'relation'     => ['CL'],
            'type'         => 'C',
            'name'         => $faker->name,
            'email'        => $faker->safeEmail,
            'currency'     => 'CHF',
            'main_address' => [
                'country'  => $faker->countryCode,
                'street'   => $faker->streetAddress,
                'postcode' => $faker->postcode,
                'city'     => $faker->city,
            ]
        ])->getItem();

        // create an invoice
        $invoice = $invoices->create([
            'contact_id'     => $contact->id,
            'contact_address_id' => $contact->main_address_id,
            'date' => date('Y-m-d'),
            'due' => date('Y-m-d', strtotime("+30 day")),
            'currency' => 'CHF',
            'language' => 'de',
            'positions' => [
                [
                    'type' => 'N',
                    'catalog_type' => 'P',
                    'name' => $faker->sentence(3),
                    'description' => $faker->sentence(8),
                    'price' => (float)(rand(100,9000) . '.' . rand(10,99)),
                    'amount' => (float)1,
                    'unit_id' => 7,
                    'vat' => 7.7,
                ],
            ],
        ])->getItem();

        print_r($invoice);

    }  catch (ValidationFailedException $e) {
        // expecting to see what fields are not valid
        print_r($e->getFieldKeys());
        // print out more datailed info about invalid fields
        print_r($e->getErrorsData());
    } catch (Exception $e) {
        print_r($e->getMessage());
    }