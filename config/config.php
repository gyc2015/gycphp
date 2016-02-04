<?php

$config->version    = '0.0';            # MVC的系统框架版本
$config->encoding   = 'UTF-8';          # 默认编码.
$config->cookieLife = time() + 2592000; # cookie的生存期.
$config->timezone   = 'Asia/Shanghai';  # 时区,参考http://www.php.net/manual/en/timezones.php

$config->prompt->module = 'm';          # 调用模块的提示符
$config->prompt->func   = 'f';          # 调用函数的提示符.

$config->base_root      = BASE_PATH;
$config->conf_root      = CONFIG_PATH;
$config->db_root        = DB_PATH;
$config->doc_root       = DOC_PATH;
$config->lib_root       = LIB_PATH;
$config->plugin_root    = PLUGIN_PATH;
$config->www_root       = WWW_PATH;
$config->app_root       = APP_PATH;
$config->MVC_root		= MVC_PATH;

$config->db->host       = 'localhost';  # 数据库地址 - 目前数据库只支持MySQL
$config->db->db_name    = 'erp';        # 数据库名称
$config->db->user       = 'erpadmin';   # 用户
$config->db->passwd     = 'u3b0pdu4';   # 密码

$config->web->root = 'gyc';

?>
