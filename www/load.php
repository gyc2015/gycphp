<?php

function load_configs() {
    global $config;

    $files = tools::find_files(CONFIG_PATH, "*.php");
    foreach ($files as $file)
        include_once($file);
}

?>