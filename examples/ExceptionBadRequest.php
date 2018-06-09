<?php
    declare(strict_types=1);

    require_once __DIR__ . '/vendor/autoload.php';

    use smallinvoice\api2\Endpoints\Contacts\ContactsEndpoint;
    use smallinvoice\api2\Endpoints\Contacts\AddressesEndpoint;
    use LourensSystems\ApiWrapper\Endpoints\Parameters\ListParameters;
    use LourensSystems\ApiWrapper\Exception\BadRequestException;

    $provider = require_once 'ClientCredentialsProvider.php';
    /** @var ContactsEndpoint $contacts */
    $contacts = new ContactsEndpoint($provider);

    /** @var AddressesEndpoint $addresses */
    $addresses = new AddressesEndpoint($provider);

    try {
        // init faker
        $faker = Faker\Factory::create();

        // create contact and print it out from sever response
        $contactId = $contacts->create([
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
        ])->getItem()->id;

        // let system process data you sent
        sleep(1);

        // currently we have contact with one address (a default address); in order to obtain its id we need to call API
        $addressId = $addresses->listForContact($contactId,
            (new ListParameters())->setFilterArray(['default' => true]))->getItems()->current()->id;

        // now we want to delete this address which is not logical, and it is not allowed to delete the only address from contact; we expect BadRequestException
        $addresses->deleteForContact($contactId, [$addressId]);
    } catch (BadRequestException $e) {

        // handle in some way not allowed request
        print_r($e->getMessage());
    }