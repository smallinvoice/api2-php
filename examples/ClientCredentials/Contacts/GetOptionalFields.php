<?php
    declare(strict_types=1);

    require_once __DIR__ . '/../../vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;
    use smallinvoice\api2\Wrapper\Endpoints\Parameters\GetParameters;

    $provider = require_once __DIR__ . '/../../Provider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    try {
        // init faker
        $faker = Faker\Factory::create();

        // create contact and print it out from sever response
        $contactId = $contacts->create([
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
        ])->getItem()->id;

        // print contact with optional field called "main_address", optional fields are defined in API docs.
        print_r($contacts->get($contactId, (new GetParameters())->setWith('main_address'))->getItem());
    } catch (Exception $e) {
        print_r($e->getMessage());
    }