<?php

/**
 * File with all the configuration and tokens
 */
$config = require (__DIR__ . '/../config.php');


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


