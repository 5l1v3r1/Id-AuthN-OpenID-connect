<?php

/**
 * Needed to work with the library jumbojett/openid-connect-php
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * File with all the configuration and tokens
 */
$config = require (__DIR__ . '/../config.php');

use Jumbojett\OpenIDConnectClient;


/**
 * Checks if the selected provider has been configured
 *
 * @param string $provider
 *		A string with the name of the provider, as specified in the configuration
 *
 * @return boolean
 */
function check_provider ($provider)
{
	global $config;

	return (
		array_key_exists ($provider, $config)
		&& array_key_exists ("URL", $config [$provider])
		&& array_key_exists ("ID", $config [$provider])
		&& array_key_exists ("Secret", $config [$provider])
	);
}


/**
 * Checks the configuration file and returns a configured OpenIDConnectClient object.
 *
 * @return OpenIDConnectClient
 */
function init_OIDC ()
{
	global $config;

	if (!isset ($_SESSION)) { session_start (); }
	$provider = $_SESSION ["provider"];

	if (! check_provider ($provider))
	{
		return null;
	}

	$conf = $config [$provider];

	$oidc = new OpenIDConnectClient ($conf ["URL"], $conf ["ID"], $conf ["Secret"]);

	return $oidc;
}

/**
 * Performs the authentication using the selected provider.
 *
 * @return void
 */
function authenticate ()
{
	$oidc = init_OIDC ();
	$oidc->setRedirectURL ("https://" . $_SERVER ["SERVER_NAME"] . "/main.php");
	$oidc->addScope ("profile");
	$oidc->authenticate ();

	return;
}


/**
 * Gets the user info and stores it into the $_SESSION array.
 *
 * @return void
 */
function get_user_info ()
{
	$oidc = init_OIDC ();

	$oidc->requestUserInfo ("sub");
	foreach ($oidc as $key => $value)
	{
		if (is_array ($value))
		{
			$v = implode (", ", $value);
		}
		else
		{
			$v = $value;
		}
		$_SESSION ["attributes"][$key] = $v;
	}

echo '<hr/>';
	return;
}


/**
 * Performs the authentication using the selected provider.
 *
 * @return void
 */
function logout ()
{
	$oidc = init_OIDC ();
	$token = $oidc->requestClientCredentialsToken ();
	$redirect = "https://" . $_SERVER ["SERVER_NAME"] . "/logout.php";
	$oidc->signOut ($token, $redirect);

	return;
}
