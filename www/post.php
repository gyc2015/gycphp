<?php

require_once('./config.php');

try {
    # 创建一个子系统
	$app = new App("blog");
	$app->init_database();

    $app->parser = new PostRequestParser();
    $app->parse_action();
    $app->just_do_it();
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>
