<?php

class tools {
    /*
     * find_files - 查询@dir下后缀为@filename的文件名
     *
     * @dir: 待查询目录
     * @filename: 文件名
     */
    static public function find_files($dir, $filename = '') {
        $files = glob(realpath($dir).'/*'.$filename);
        return empty($files) ? array() : $files;
    }

    /*
     * load_lib - 装载库
     *
     * $lib: 库名
     */
    static public function load_lib($lib) {
        global $config;
        $lib_dir = $config->lib_root.$lib;
        if(!is_dir($lib_dir))
            throw new Exception("在目录[".$config->lib_root."]下没找到类库[".$lib."]");

        $lib_file = $lib_dir."/".$lib.'.php';
        if (!is_file($lib_file))
            throw new Exception("在目录[".$lib_dir."]下没找到入口文件[$lib_file]");

        require_once($lib_file);
    }

    /*
     * load_module_class - 加载模块控制类
     *
     * $module: 模块名称
     * $root: 模块的根目录
     */
    static public function load_module_class($module,$root) {
        $c_file = $root."control.php";

        if (!file_exists($c_file))
            throw new Exception("无法找到模块'".$module."'的控制文件. file:".__FILE__." line:".__LINE__);

        include_once($c_file);

        if (!class_exists($module))
            throw new Exception("在模块'".$module."'的控制文件中不存在相应的类. file:".__FILE__." line:".__LINE__);
    }

}

?>
