<?php
    declare(strict_types=1);
    session_start();

    require_once __DIR__ . '/../vendor/autoload.php';

    use smallinvoice\api2\Wrapper\OAuth2\Client\Provider\Provider;
    use smallinvoice\api2\Endpoints\EndpointStrategy;

    $clientID = ''; //INSERT YOUR CLIENT ID HERE
    $clientSecret = ''; //INSERT YOUR CLIENT SECRET HERE
    $redirectURI = ''; //INSERT YOUR REDIRECT URI HERE. IT HAS TO MATCH THE ONE YOU ENTERED WHEN CREATING THE CLIENT ID

    if (!$clientID || !$clientSecret || !$redirectURI) {
        exit('You have to enter the client id, secret and redirect URI first');
    }

    $provider = new Provider([
        'clientId'     => $clientID,
        'clientSecret' => $clientSecret,
        'redirectUri'  => $redirectURI,
        'baseUrl'      => EndpointStrategy::getApiURLProduction()
    ]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

<?php
    // If we don't have an authorization code then get one
    if (!isset($_GET['code'])) {

        // Fetch the authorization URL from the provider; this returns the
        // urlAuthorize option and generates and applies any necessary parameters
        // (e.g. state).l
        $authorizationUrl = $provider->getAuthorizationUrl(['scope' => 'contact']);

        // Get the state generated for you and store it to the session.
        $_SESSION['oauth2state'] = $provider->getState();

        // Redirect the user to the authorization URL.
        echo '<button onclick="window.open(\'' . $authorizationUrl . '\', \'\', \'width=972,height=660,modal=yes,alwaysRaised=yes\');">Obtain Authorization of user</button>';

        exit;
        // Check given state against previously stored one to mitigate CSRF attack
    } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
        exit('Invalid state');
    } else {
        if ($_GET['fromWindow'] == 1) {
            try {

                $accessToken = $provider->getAccessToken('authorization_code', [
                    'scope' => 'contact',
                    'code'  => $_GET['code']
                ]);

                echo '<pre>';

                echo 'Access token of user: <br><textarea style="width: 600px; height: 160px;">' . $accessToken->getToken() . '</textarea>';
                echo '<br><br>';
                echo 'Refresh token of user: <br><textarea style="width: 600px; height: 160px;">' . $accessToken->getRefreshToken() . '</textarea>';
                echo '<br><br>';
                echo '<button onclick="window.location.href=window.location.href.split(\'?\')[0]">Start over</button>';
                echo '<br><br>';
                echo '<button onclick="window.location.reload()">Obtain new Token with current Authorization Code</button>';

                echo '</pre>';
            } catch (Exception $e) {

                // Failed to get the access token or user details.
                exit($e->getMessage());
            }
        } else {
            echo "<script>
            (function() {
                if (window.opener) {
                    window.opener.location.href = window.document.location.href + '&fromWindow=1';
                    window.close();
                }
            }())
            </script>
            ";
            echo 'This should be closed by javascript';
        }
    }
?>

</body>
</html>