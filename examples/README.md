# Introduction
The example folder is a standalone software package, that will its self include & download the smallinvoice api wrapper and other required packages (via composer). It can be copied to a location of your choice to run it.

# Requirements
To be able to use the library and examples you have to install composer. Further information available at https://getcomposer.org/download/

# Setup
Download and setup the required packages automatically (execute from within this folder)

```
composer install
```
or if you are using composer via the php package:
```
php composer.phar install
```

Most PHP examples require you to pass credentials as environment variables (like Client ID & Secret).  

# Client credentials examples
Client credentials is the authorization method if you will be accessing your own data of your own account.

To run the example of creating a contact execute the following (and adapt to run other examples).

If you have issues passing the environment variables (not all setups pass environment variables to the PHP script) adapt the File **Provider.php** and enter your credentials there.
```
CLIENT_ID=clientid CLIENT_SECRET=clientsecret php ClientCredentials/Contacts/Create.php
```

# Authorization Code grant examples
The Authorization Code grant is the way to obtain a Refresh Token (and other credentials) from a foreign user, that allows you access to specific parts of his data, without him giving you full access to his account.

1. Place the whole directory *examples* into the root directory of your webserver (composer must be installed & setup) so that you can access **http://localhost/examples/AuthorizationCode/InteractiveAuthorizationProcess.php** via your browser.

1. You need to create a client ID with type 'Authorization Code' with the obove mentioned URL (or adapted URL if you have decided to put it in a subfolder etc)

1. Enter the Client-ID and Client secret in the File **InteractiveAuthorizationProcess.php**

1. Access the URL and go through the workflow of authorization to obtain the refresh token

1. Now you can use this refresh token (that does not expire, but can be revoked by the user) to run the example
```
CLIENT_ID=clientid CLIENT_SECRET=clientsecret REFRESH_TOKEN=theabovereceivedtoken php AuthorizationCode/ContactList.php
```

All examples listed in the ClientCredentials folder will also work for the AuthorizationCode grant assuming you additionally pass the Refresh token as second parameter when creating the Endpoint object (after passing $provider) and use the correct Client-ID & Secret.

# Exception handling
Most usual exceptions can be caught and contain valuable information about the error that occured (for example ValidationExceptions).
The examples in the folder **ExceptionHandling** show you ways of how to expect and handle various exceptions.