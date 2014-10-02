<?php
require_once 'includes/autoload.inc.php';
if (file_exists('includes/config.inc.php'))
		require_once 'includes/config.inc.php';
else
	header ("Location: installer.class.php");
$CHome=USingleton::getInstance('CHome');
$CHome->costruisci();
?>
