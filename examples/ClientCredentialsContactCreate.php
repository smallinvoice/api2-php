<?php
    declare(strict_types=1);

    require_once __DIR__ . '/vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;

    $provider = require_once 'ClientCredentialsProvider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    try {
        // init faker
        $faker = Faker\Factory::create();

        // create contact and print it out from sever response
        $contact = $contacts->create([
            'relation'     => ['CL'], //see API docs
            'type'         => 'C',  //see API docs
            'name'         => $faker->name,
            'email'        => $faker->safeEmail,
            'currency'     => $faker->currencyCode,
            'main_address' => [
                'country'  => $faker->countryCode,
                'street'   => $faker->streetAddress,
                'postcode' => $faker->postcode,
                'city'     => $faker->city,
            ]
        ])->getItem();

        print_r($contact);
    } catch (Exception $e) {
        print_r($e->getMessage());
    }