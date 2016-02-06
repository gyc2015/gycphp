<?php

define('BASE_PATH', dirname(dirname(__FILE__)).'/');
define('CONFIG_PATH', BASE_PATH.'config/');
define('DB_PATH', BASE_PATH.'db/');
define('DOC_PATH', BASE_PATH.'doc/');
define('LIB_PATH', BASE_PATH.'lib/');
define('WWW_PATH', BASE_PATH.'www/');
define('APP_PATH', BASE_PATH.'app/');
define('MVC_PATH', BASE_PATH.'MVC/');

require_once(MVC_PATH.'app.class.php');
require_once(MVC_PATH.'control.class.php');
require_once(MVC_PATH.'model.class.php');
require_once(MVC_PATH.'view.class.php');
require_once(MVC_PATH.'tools.class.php');
tools::load_configs();


?>
