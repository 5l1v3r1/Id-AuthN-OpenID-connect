<?php
/**
 * Needed to work with the library jumbojett/openid-connect-php
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * File with all the configuration and tokens
 */
$config = require (__DIR__ . '/../config.php');


/**
 * Checks if the selected provider has been configured
 *
 * @param array $config
 *		An array with the configuration of the webpage
 *
 * @param string $provider
 *		A string with the name of the provider, as specified in the configuration
 *
 * @return boolean
 */
function check_provider ($config, $provider)
{
	return (
		array_key_exists ($provider, $config)
		&& array_key_exists ("URL", $config [$provider])
		&& array_key_exists ("ID", $config [$provider])
		&& array_key_exists ("Secret", $config [$provider])
	);
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>OpenID Connect assignment</title>

	<link rel="stylesheet" href="css/style.css">

<?php
/* Initialization of Google */
if (check_provider ($config, "Google"))
{
?>
	<!-- Extracted from https://developers.google.com/identity/sign-in/web/build-button -->
	<meta name="google-signin-client_id" content="<?php  echo $config ["Google"]["ID"]; ?>">
<?php
}
?>


</head>
<body>

	<div>
		<h1>Login using one of the following OpenID Connect providers</h1>
		<!-- Extracted from https://developers.google.com/identity/sign-in/web/build-button -->
		<div id="google-signin">Google</div>
		<script>
			function onSuccess (googleUser) {

				alert ('Logged in as: ' + googleUser.getBasicProfile ().getName ());
			}
			function onFailure (error) {

				alert (error);
			}
			function renderButton () {
				gapi.signin2.render ('google-signin', {
					'scope': 'profile email',
					'width': 240,
					'height': 50,
					'longtitle': true,
					'theme': 'dark',
					'onsuccess': onSuccess,
					'onfailure': onFailure
				});
			}
		</script>
		<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>


	</div>

</body>
</html>

