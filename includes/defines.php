<?php

// defined('_SIASF_EXEC') or die('Acesso Restrito');

// Definições Globais
$parts = explode(DIRECTORY_SEPARATOR, APP_PATH_BASE);

// Definições 
define('APP_PATH_ROOT', implode(DIRECTORY_SEPARATOR, $parts));
define('APP_PATH_DOMAIN', APP_PATH_ROOT . '/domain');
define('APP_PATH_PERSISTENCE', APP_PATH_ROOT . '/persistence');
define('APP_PATH_SESSION', APP_PATH_ROOT . '/session');
define('APP_PATH_LIBRARIES', APP_PATH_ROOT . '/lib');
define('APP_PATH_CONFIGURATION', APP_PATH_ROOT . '/config');
define('APP_PATH_CONTROLLER', APP_PATH_ROOT . '/controller');
define('APP_PATH_COMMAND', APP_PATH_ROOT . '/command');
define('APP_PATH_UTIL', APP_PATH_ROOT . '/util');
define('APP_PATH_LOG', APP_PATH_ROOT . '/log');
define('APP_PATH_LANGUAGE', APP_PATH_ROOT . '/language');
?>