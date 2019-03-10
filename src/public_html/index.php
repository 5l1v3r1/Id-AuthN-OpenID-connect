<?php
/**
 * File with all the configuration and tokens
 */
$config = require (__DIR__ . '/../config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>OpenID Connect assignment</title>

	<link rel="stylesheet" href="css/style.css">

	<!-- From https://developers.google.com/identity/sign-in/web/build-button -->
	<meta name="google-signin-client_id" content="<?php echo $config ["google"]["ID"] ?>">

</head>
<body>

	<div id="login-panel">
		<h1>Login using OpenID Connect</h1>

		<div id="providers">
			<div id="google"></div>
				<script>
					function onSuccess (googleUser) {

						let info = googleUser.getBasicProfile ();

						/* The data on the appropriate HTML elements down the page */
						document.getElementById ("user-mail").innerHTML = info.getEmail ();
						document.getElementById ("user-name").innerHTML = info.getName ();
						document.getElementById ("user-family").innerHTML = info.getFamilyName ();
						document.getElementById ("user-given").innerHTML = info.getGivenName ();
						document.getElementById ("user-id").innerHTML = info.getId ();
						document.getElementById ("user-image").innerHTML = '<img src="' + info.getImageUrl () + '" alt="User icon" />';
					}

					function onFailure (error) {

						alert ("Error trying to log-in");
					}

					function renderButton () {
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

					function signOut () {
						var auth2 = gapi.auth2.getAuthInstance ();
						auth2.signOut ().then (() => {
							alert ("User signed out.");

							noInfo = "? (User logged out)";
							document.getElementById ("user-mail").innerHTML = noInfo;
							document.getElementById ("user-name").innerHTML = noInfo;
							document.getElementById ("user-family").innerHTML = noInfo;
							document.getElementById ("user-given").innerHTML = noInfo;
							document.getElementById ("user-id").innerHTML = noInfo;
							document.getElementById ("user-image").innerHTML = noInfo;
						});
					}

				</script>
				<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>

		</div>

		<br/>
		<hr/>

		<div id="user-info">
			<h3>User information</h3>

			<dl id="user-attributes">

				<dt>Email</dt>
				<dd id="user-mail">??? (user not logged in)</dd>

				<dt>Name</dt>
				<dd id="user-name">??? (user not logged in)</dd>


				<dt>Family Name</dt>
				<dd id="user-family">??? (user not logged in)</dd>

				<dt>Given Name</dt>
				<dd id="user-given">??? (user not logged in)</dd>

				<dt>Id</dt>
				<dd id="user-id">??? (user not logged in)</dd>

				<dt>User Image</dt>
				<dd id="user-image">??? (user not logged in)</dd>
			</dl>
		</div>

		<button onclick="signout ()">Sign Out</button>
	</div>

</body>
</html>

