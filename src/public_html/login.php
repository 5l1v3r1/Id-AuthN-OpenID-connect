<?php
require __DIR__ . '/../include/utils.php';

if (empty ($_POST ["provider"]))
{
	echo 'Error trying to authenticate.';
	exit ();
}


if (!isset ($_SESSION)) { session_start (); }

$_SESSION ["provider"] = $_POST ["provider"];

/* The function authenticate() already checks if the provider exists */
//try
//{
	authenticate ();
//}
//catch (Jumbojett\OpenIDConnectClientException $ex)
//{ /* We don't really care about errors... */ }

