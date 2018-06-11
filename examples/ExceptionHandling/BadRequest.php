<?php
    declare(strict_types=1);

    require_once __DIR__ . '/../vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;
    use smallinvoice\api2\Endpoints\Contacts\AddressesEndpoint;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;
    use LourensSystems\ApiWrapper\Exception\BadRequestException;

    $provider = require_once __DIR__ . '/../Provider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    /** @var AddressesEndpoint $addresses */
    $addresses = new AddressesEndpoint($provider);

    try {
        // init faker
        $faker = Faker\Factory::create();

        // create contact and print it out from sever response
        $contact = $contacts->create([
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
        ])->getItem();

        // we are trying to delete the only address (and main address) of the contact (which is not allowed). We expect BadRequestException
        $addresses->deleteForContact($contact->id, [$contact->main_address_id]);
    } catch (BadRequestException $e) {
        // handle in some way not allowed request
        print_r($e->getMessage());
    } catch (Exception $e) {
        // handle in some way not allowed request
        print_r($e->getMessage());
    }