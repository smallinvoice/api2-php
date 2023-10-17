<?php
    declare(strict_types=1);

    require_once __DIR__ . '/../vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;
    use smallinvoice\api2\Wrapper\Exception\ValidationFailedException;

    $provider = require_once '../Provider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    try {
        // init faker
        $faker = Faker\Factory::create();

        // create contact to be updated
        $contacts->create([
            'relation'     => ['CL'], //see API docs
            'type'         => 'C',  //see API docs
            'name'         => $faker->name,
            'email'        => 'PASSING INVALID EMAIL CONTENT',
            'currency'     => 'CHF',
            'main_address' => [
                'country'  => $faker->countryCode,
                'street'   => $faker->streetAddress,
                'postcode' => $faker->postcode,
                'city'     => $faker->city,
            ]
        ]);
    } catch (ValidationFailedException $e) {
        // expecting to see what fields are not valid
        print_r($e->getFieldKeys());
        // print out more datailed info about invalid fields
        print_r($e->getErrorsData());
    } catch (Exception $e) {
        print_r($e->getMessage());
    }