<?php

define('BASE_PATH', dirname(dirname(__FILE__)).'/');
define('CONFIG_PATH', BASE_PATH.'config/');
define('DB_PATH', BASE_PATH.'db/');
define('DOC_PATH', BASE_PATH.'doc/');
define('LIB_PATH', BASE_PATH.'lib/');
define('PLUGIN_PATH', BASE_PATH.'plugin/');
define('WWW_PATH', BASE_PATH.'www/');
define('APP_PATH', BASE_PATH.'app/');
define('MVC_PATH', BASE_PATH.'MVC/');

require_once(MVC_PATH.'tools.class.php');
require_once(WWW_PATH.'/load.php');
load_configs();

try {
	require_once(MVC_PATH.'app.class.php');
	require_once(MVC_PATH.'control.class.php');
	require_once(MVC_PATH.'model.class.php');
	require_once(MVC_PATH.'view.class.php');

	$app = new App("blog");

	$app->init_database();

	$app->parse_uri();

	$app->load_module('header');
	$app->load_module('foot');

	$header = $app->get_module('header');
	$header->test();

	$app->render();

	$app->release_module('header');
	$app->release_module('foot');

	echo gettype($app);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>


