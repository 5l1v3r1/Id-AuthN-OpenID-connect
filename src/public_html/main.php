<?php
	require __DIR__ . '/../include/utils.php';
	if (!isset ($_SESSION)) { session_start (); }
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

	<a href="/index.php">Go back to the init page</a>

	<div id="login-panel">
		<form action="/logout.php" method="GET" accept-charset="utf-8">
			<button type="submit">Logout</button>
		</form>
<?php

	get_user_info ();

	var_dump ($_GET);

	echo "<hr/>";

	var_dump ($_SESSION);

	echo "<hr/>";

	$conf = $config [$_SESSION ["provider"]];

?>

	</div>

</body>
</html>

