<?php
/**
  * 3DS Depot CLI Helper.
  *
  * Do not touch, please.
  */


if (php_sapi_name() != 'cli') {
	die('Must run from command line');
}

define('3DS_DEPOT', 1);
require_once(__DIR__.'/lib/basic_functions.php');

while (true) {
	\cli\line('=======================================');
	\cli\line('========= 3DS Depot CLI Menu ==========');
	\cli\line('=======================================');
	\cli\line();

	$choice = \cli\menu([
		'updateDB'	=> 'Import/Update 3DSDB Data',
		'quit'		=> 'Exit'
	], null, 'Select an Option');

	\cli\line();

	if ($choice == 'quit') break;
	else {
		if(function_exists($choice)) {
			\call_user_func($choice);
		} else \cli\err('Function does not exist.');
	}
}

function updateDB() {
	global $db;

	$z = new \XMLReader;
	$c = new \DOMDocument;
	$x = \curlDl('http://3dsdb.com/xml.php');
	$z->xml($x);
	$c->loadXML($x);
	$bar = new \cli\progress\Bar('Importing from 3DSDB', $c->getElementsByTagName('release')->length);

	while ($z->read() && $z->name !== 'release');
	while ($z->name === 'release')
	{
		$node = new \SimpleXMLElement($z->readOuterXML());

		// Insert to DB the game
		// Use replace to not build up the ids to the sky on each import
		$db->replace('games', [
			'titleid'	=> (string)$node->titleid,
			'name'		=> (string)$node->name,
			'region'	=> (string)$node->region,
			'serial'	=> (string)$node->serial
		]);

		$z->next('release');
		$bar->tick();
	}
	$z->close();
	exit();
}