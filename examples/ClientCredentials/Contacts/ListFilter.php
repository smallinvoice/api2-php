<?php
    declare(strict_types=1);

    require_once __DIR__ . '/../../vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;

    $provider = require_once __DIR__ . '/../../Provider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    try {
        // init faker
        $faker = Faker\Factory::create();

        // create contact and print it out from sever response
        $contacts->create([
            'relation'     => ['CL'], //see API docs
            'type'         => 'C',  //see API docs
            'name'         => $faker->name,
            'email'        => $faker->safeEmail,
            'currency'     => 'CHF',
            'main_address' => [
                'country'  => $faker->countryCode,
                'street'   => $faker->streetAddress,
                'postcode' => $faker->postcode,
                'city'     => $faker->city,
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