To be able to run examples you need to install all dependencies with composer as below (inside examples directory):

~~~
composer install
~~~
or if you are using composer via the php package:
~~~
php composer.phar install
~~~

Most PHP examples require you to pass credentials as environment variables (like Client ID & Secret).  
<h2>Client credentials grant examples</h2>
- creating contacts with client credentials grant:
~~~
CLIENT_ID=clientid CLIENT_SECRET=clientsecret php ClientCredentialsContactCreate.php
~~~
- listing contacts with client credentials grant:
~~~
CLIENT_ID=clientid CLIENT_SECRET=clientsecret php ClientCredentialsContactList.php
~~~
- obtaining contact by id with client credentials grant:
~~~
CLIENT_ID=clientid CLIENT_SECRET=clientsecret php ClientCredentialsContactGet.php
~~~
- updating existing contact with client credentials grant:
~~~
CLIENT_ID=clientid CLIENT_SECRET=clientsecret php ClientCredentialsContactUpdate.php
~~~
- updating existing contact with client credentials grant:
~~~
CLIENT_ID=clientid CLIENT_SECRET=clientsecret php ClientCredentialsContactUpdate.php
~~~
- delete existing contact with client credentials grant:
~~~
CLIENT_ID=clientid CLIENT_SECRET=clientsecret php ClientCredentialsContactDelete.php
~~~
- how to handle validation exceptions with client credentials grant:
~~~
CLIENT_ID=clientid CLIENT_SECRET=clientsecret php ValidationException.php
~~~
- how to handle 404, not found:
~~~
CLIENT_ID=clientid CLIENT_SECRET=clientsecret php NotFoundException.php
~~~
- bad request exceptions with client credentials:
~~~
CLIENT_ID=clientid CLIENT_SECRET=clientsecret php NotFoundException.php
~~~
<h2>Authorization Code grant example</h2>
- For obtaining contacts list by authorization code the file *AuthorizationCode.php* needs to be accessible via url (for example http://localhost/AuthorizationCode.php) and composer initiated.

<h2>Refresh Token examples</h2>
- In order to test the refresh token examples, you need to have obtained a refresh token via Authorization Code grant (see example) to be able to pass it along as environment variable.