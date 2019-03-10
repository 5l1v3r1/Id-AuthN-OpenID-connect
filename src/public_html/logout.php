<?php

	require __DIR__ . '/../include/utils.php';


	if (!isset ($_SESSION)) { session_start (); }

	logout ();
?>
