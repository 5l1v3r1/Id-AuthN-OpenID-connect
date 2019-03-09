<?php
require __DIR__ . '/../include/utils.php';

if (! empty ($_POST ["provider"]))
{
	$provider = $_POST ["provider"];

	/* The function authenticate() already checks if the provider exists */
	try
	{
		authenticate ($provider);
	}
	catch (Jumbojett\OpenIDConnectClientException $ex)
	{ /* We don't really care about errors... */ }

