<?php
if (!defined('3DS_DEPOT')) die('Private area.');

// Define DB Constants
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', '3ds_depot');

// Define secure constants
define('COOKIE_PRIV', "");

// Define folder paths
define('SITE_ROOT', '');
define('TEMPLATES_ROOT', SITE_ROOT . '\templates');

// Define URL config
define('HTTP_SITE', '3ds-depot.dev');
define('FORCE_HTTPS', true); // Set this to false if you terminate SSL early.