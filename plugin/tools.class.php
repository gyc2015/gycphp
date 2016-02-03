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
}

?>