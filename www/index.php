<?php

define('BASE_PATH', dirname(dirname(__FILE__)).'/');
define('CONFIG_PATH', BASE_PATH.'config/');
define('DB_PATH', BASE_PATH.'db/');
define('DOC_PATH', BASE_PATH.'doc/');
define('LIB_PATH', BASE_PATH.'lib/');
define('PLUGIN_PATH', BASE_PATH.'plugin/');
define('WWW_PATH', BASE_PATH.'www/');

require_once(PLUGIN_PATH.'tools.class.php');
require_once(WWW_PATH.'/load.php');

load_configs();





define('INC_PATH', WWW_PATH.'includes');
if (file_exists(WWW_PATH.'config.php')) {
    require_once(WWW_PATH.'config.php');
}
require_once(WWW_PATH.'setting.php');
$protocol = $_SERVER['SERVER_PROTOCOL'];


hehe();


?>


