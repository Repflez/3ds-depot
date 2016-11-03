<?php
use \Defuse\Crypto\Key as Key;

function setKey() {
	try {
		$key = Key::CreateNewRandomKey();
		// WARNING: Do NOT encode $key with bin2hex() or base64_encode(),
		// they may leak the key to the attacker through side channels.
	} catch (CryptoTestFailedException $ex) {
		die('Cannot safely create a key');
	} catch (CannotPerformOperationException $ex) {
		die('Cannot safely create a key');
	}

	return $key;
}

/**
 * Store ciphertext in a cookie
 *
 * @param string $name - cookie name
 * @param mixed $cookieData - cookie data
 * @param string $key - crypto key
 */
function setSafeCookie($name, $cookieData, $key) {
	try {
		$ciphertext = Key::Encrypt(json_encode($cookieData), $key);
	} catch (CryptoTestFailedException $ex) {
		die('Cannot safely perform encryption');
	} catch (CannotPerformOperationException $ex) {
		die('Cannot safely perform decryption');
	}

	return setcookie($name, $ciphertext);
}

/**
 * Decrypt a cookie, expand to array
 *
 * @param string $name - cookie name
 * @param string $key - crypto key
 */
function getSafeCookie($name, $key) {
	if (!isset($_COOKIE[$name])) {
		return array();
	}
	$ciphertext = $_COOKIE[$name];

	try {
		 $decrypted = Key::Decrypt($ciphertext, $key);
	} catch (InvalidCiphertextException $ex) { // VERY IMPORTANT
		  // Either:
		  //   1. The ciphertext was modified by the attacker,
		  //   2. The key is wrong, or
		  //   3. $ciphertext is not a valid ciphertext or was corrupted.
		  // Assume the worst.
		  die('DANGER! DANGER! The ciphertext has been tampered with!');
	} catch (CryptoTestFailedException $ex) {
		  die('Cannot safely perform encryption');
	} catch (CannotPerformOperationException $ex) {
		  die('Cannot safely perform decryption');
	}
	if (empty($decrypted)) {
			array();
	}

	return json_decode($decrypted, true);
}