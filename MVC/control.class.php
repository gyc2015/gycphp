<?php

/*
 * control - 各个模块的控制基类
 */
class control
{
	# 构建模块的app,保证引用传递
	protected $app;

    # 父模块，若模块由app直接创建，则为null
    protected $parent;
    public function get_parent() {
		return $this->parent;
	}

	# 模块名称
	protected $name;
	public function get_name() {
		return $this->name;
	}

	# 模块根目录
	protected $module_root;
	public function get_module_root() {
		return $this->module_root;
	}

	public function __construct(App &$app, &$parent) {
		$this->name = get_class($this);
		$this->app = &$app;

	    if (null == $parent)
            $this->module_root = $this->app->get_app_root().$this->name."/";
        else
            $this->module_root = $parent->get_module_root().$this->name."/";
		$this->parent = &$parent;

		$this->load_model();
		$this->load_view();
	}

	# 模块的子模块
	private $modules;
	public function get_modules() {
        return $this->modules;
    }
	public function get_module($mname) {
		return $this->modules[$mname];
	}

	/*
	 * load_module - 装载模块
	 *
	 * @mname: 模块名称
	 */
	public function load_module($mname) {
		if (!is_array($this->modules))
			$this->modules = array();

        tools::load_module_class($mname, $this->module_root.$mname."/");

		if (!isset($this->modules[$mname]))
			$this->modules[$mname] = new $mname($this->app, $this);
	}

	/*
	 * release_module - 释放模块
	 *
	 * @mname: 模块名称
	 */
	public function release_module($mname) {
		unset($this->modules[$mname]);
	}

	# model
	protected $model;
	protected function load_model() {
		$m_file = $this->module_root."model.php";
		if (!file_exists($m_file))
			return;
		else
			include_once($m_file);

		$model_class = $this->name."M";
		if (!class_exists($model_class))
			return;

		$this->model = new $model_class($this);
	}

	# view
	protected $view;
	protected function load_view() {
		$v_file = $this->module_root."view.php";
		if (file_exists($v_file)) {
			
			include_once($v_file);
			$view_class = $this->name."V";
			if (class_exists($model_class))
				$this->view = new $view_class($this);
		} else {
			$this->view = new view($this);
		}

	}

	/*
	 * render - 渲染页面
	 */
	public function render() {
		echo '<p>'.get_class($this).'->'.__function__.'</p>';
        foreach ($this->modules as $module)
			$module->render();
	}


}

?>
