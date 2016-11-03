<?php
/**
  * 3DS Depot Index.
  */

define('3DS_DEPOT', 1);
require_once(__DIR__.'/lib/basic_functions.php');
echo $twig->render('index.tpl');