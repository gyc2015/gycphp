<?php

# 各个模块的视图基类
class view
{
	# 模块
	protected $module;

    # 模块名称
    public function get_module_name() {
        return $this->module->get_name();
    }

	# 模块根目录
	public function get_module_root() {
		return $this->module->get_module_root();
	}

	# 构造函数
	public function __construct(&$module) {
		$this->module = &$module;
	}

	# html文档
	protected $__DOC;
	public function get_html() {
		return $this->__DOC;
	}

	# 显示
	public function display($func) {
		if(empty($this->__DOC))
		   	$this->parse($func);
        echo $this->__DOC;
        $this->__DOC = "";
	}

	# 解析视图
	protected function parse($func) {
		$mname = $this->get_module_name();

		$view_file = $this->get_module_root()."view/".$func.".html.php";
        $cwd = getcwd();
        chdir(dirname($view_file));
		extract((array)$this);
        ob_start();
        include $view_file;
        $this->__DOC = $this->__DOC.ob_get_contents();
        ob_end_clean();
        chdir($cwd);
	}

}


?>
