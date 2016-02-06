<?php

require_once('./config.php');

try {
	$app = new App("blog");
	$app->init_database();

#	$app->parser = new GetRequestParser();
#	$app->parse_action();

	$app->load_action('header', 'test');
	$app->just_do_it();

	$app->load_module('foot');

	$app->render();

	$app->release_module('header');
	$app->release_module('foot');
} catch (Exception $ex) {
    echo $ex->getMessage();
}

?>


