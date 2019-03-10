<?php

require __DIR__ . '/../include/utils.php';

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>OpenID Connect assignment</title>

	<link rel="stylesheet" href="css/style.css">

<?php
if (check_provider ("google"))
{
?>
	<!-- From https://developers.google.com/identity/sign-in/web/build-button -->
	<meta name="google-signin-client_id" content="<?php echo $config ["google"]["ID"] ?>">
<?php
}
?>

</head>
<body>

	<div id="login-panel">
		<h1>Login using one of the following OpenID Connect providers</h1>

			<div id="providers">
				<?php
/* Google */
if (check_provider ("google"))
{
?>
	<div id="google"></div>
	<script>
		function onSuccess(googleUser) {
			console.log ('Logged in as: ' + googleUser);
		}
		function onFailure(error) {
			console.log(error);
		}
		function renderButton() {
			gapi.signin2.render ('google', {
				'scope': 'profile email',
				'width': 240,
				'height': 50,
				'longtitle': true,
				'theme': 'light',
				'onsuccess': onSuccess,
				'onfailure': onFailure
			});
		}
	</script>

	<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
<?php
}
?>

		</div>
	</div>

</body>
</html>

