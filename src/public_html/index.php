<?php


require __DIR__ . '/../include/utils.php';

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>OpenID Connect assignment</title>


	<!-- From https://github.com/necolas/css3-social-signin-buttons -->
	<link rel="stylesheet" href="css/auth-buttons.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>

	<div id="login-panel">
		<h1>Login using one of the following OpenID Connect providers</h1>
			<?php
/* Google */
if (check_provider ("google"))
{
?>
		<form action="/login.php" method="POST" accept-charset="utf-8">
			<input type="hidden" value="google" name="provider" />
			<button type="submit" class="btn-auth btn-google" id="google">
				Sign in with Google
			</button>
		</form>
<?php
}
?>

	</div>

</body>
</html>

