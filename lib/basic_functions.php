<?php
if (!defined('3DS_DEPOT')) die('Private area.');

// Stop if the config file doesn't exist
if (\file_exists(__DIR__.'/../config/tdlg.php')) {
	require_once(__DIR__.'/../config/tdlg.php');
} else die('Site not configured.');

// Load our required files
require_once(__DIR__.'/vendor/autoload.php');
require_once(__DIR__.'/mysql.php');
require_once(__DIR__.'/cookies.php');

// DB Stuff
$db = new \Mysqlidb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Init template stuff
$loader = new \Twig_Loader_Filesystem(TEMPLATES_ROOT);
$twig = new \Twig_Environment($loader, [
    'cache' => COMPILED_TPL,
]);

// CURL DL'r
function curlDl($path) {
	$ch = \curl_init();
	\curl_setopt($ch, CURLOPT_URL, $path);
	\curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	\curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	\curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	\curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	$retValue = \curl_exec($ch);
	\curl_close($ch);
	return $retValue;
}
