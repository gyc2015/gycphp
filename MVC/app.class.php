<?php

class App
{
    # 应用名称
    private $name;
    public function get_name() {
        return $this->name;
    }

    # 应用根目录
    private $app_root;
    public function get_app_root() {
        return $this->app_root;
    }

    # Uniform Resource Identifier
    private $URI;
    public function get_URI() {
        return $this->URI;
    }

	/*
     * 构造函数
     *
     * @name: 子系统名称
     * @app_root: 子系统路径，默认在base_root/app/下的同名目录
     */
    public function __construct($name = '', $app_root = '') {
        $this->name = $name;

        if (trim($app_root) != '') {
            $this->app_root = realpath($app_root)."/";
        } else {
            $this->app_root = APP_PATH.$this->name."/";
        }
        if (!is_dir($this->app_root))
            throw new Exception("在目录{$this->appRoot}中无法找到相应的应用"."file:".__FILE__."line:".__LINE__);

        $this->URI = $_SERVER['REQUEST_URI'];
		$this->load_config();
    }

	/*
	 * load_config - 装载应用的配置文件
	 *
	 * 约定应用的配置文件为app_root下的config.php文件
	 */
    private function load_config() {
        $file = $this->app_root.'config.php';
        if (file_exists($file))
            include_once($file);
    }

	# 应用的各个模块
	private $modules;
	public function get_modules() {
        return $this->modules;
    }
	public function get_module($mname) {
		return $this->modules[$mname];
	}

	private $cur_mname;
	private $cur_func;
	private $cur_params;
	/*
	 * load_module - 装载模块
	 *
	 * @mname: 模块名称
	 */
	public function load_module($mname) {
		if (!is_array($this->modules))
			$this->modules = array();

        tools::load_module_class($mname, $this->app_root.$mname."/");

		if (!isset($this->modules[$mname]))
			$this->modules[$mname] = new $mname($this);
	}

	/*
	 * release_module - 释放模块
	 *
	 * @mname: 模块名称
	 */
	public function release_module($mname) {
		unset($this->modules[$mname]);
	}

	# 数据库
	private $db;
	public function get_db() {
		return $this->db;
	}

	/*
	 * init_database - 初始化数据库
	 */
	public function init_database() {
        if (isset($this->db))
            return;

        global $config;
        tools::load_lib("mysql");
        $this->db = new Mysql_DB($config->db->host, $config->db->db_name, $config->db->user, $config->db->passwd);
	}

    # 动作解析器
    public $parser;

	/*
	 * parse_action - 解析action
	 */
	public function parse_action() {
        $mname = $this->parser->acquire_module();
        $func = $this->parser->acquire_func();
        $params = $this->parser->acquire_params();

		$this->load_action($mname, $func, $params);
	}

    /*
     * load_action - 装载动作
     *
     * $mname: 模块名称
     * $func: 函数名称
     * $params: 函数参数列表 顺序相关
     */
	public function load_action($mname, $func, $params = array()) {
		$this->cur_mname = $mname;
		$this->cur_func = $func;
		$this->cur_params = $params;

		$this->load_module($mname);	
	}


	/*
	 * just_do_it - 执行预装载函数
	 */
	public function just_do_it() {
        # 通过反射机制设置函数的参数
        $d_params = array();
        $method_reflection = new reflectionMethod($this->cur_mname, $this->cur_func);
        foreach ($method_reflection->getParameters() as $param) {
            $param_name = $param->getName();
            if (isset($this->cur_params[$param_name])) {
                $tmp = $this->cur_params[$param_name];
            } else {
                if ($param->isDefaultValueAvailable())
                    $tmp = $param->getDefaultValue();
                else
                    throw new Exception("参数'".$param_name."'不能为空. file:".__FILE__." line:".__LINE__);
            }
            $d_params[$param_name] = $tmp;
        }
        $this->cur_params = $d_params;

        # 加载
        call_user_func_array(array(&$this->modules[$this->cur_mname], $this->cur_func), $this->cur_params);
	}

	/*
	 * render - 渲染页面
	 */
	public function render() {
        foreach ($this->modules as $module)
			$module->render();
	}
}

abstract class RequestParser {
    abstract public function acquire_module();
    abstract public function acquire_func();
    abstract public function acquire_params();
}

class GetRequestParser extends RequestParser {
    public function acquire_module() {
        global $config;
        return $_GET[$config->module_prompt];
    }

    public function acquire_func() {
        global $config;
        return $_GET[$config->func_prompt];
    }

    public function acquire_params() {
        global $config;
        foreach ($_GET as $name => $value) {
            if ($name == $config->module_prompt || $name == $config->func_prompt)
                continue;
            $params[$name] = $value;
        }
        return $params;
    }
}

class PostRequestParser extends RequestParser {
    public function acquire_module() {
        global $config;
        return $_POST[$config->module_prompt];
    }

    public function acquire_func() {
        global $config;
        return $_POST[$config->func_prompt];
    }

    public function acquire_params() {
        global $config;
        foreach ($_POST as $name => $value) {
            if ($name == $config->module_prompt || $name == $config->func_prompt)
                continue;
            $params[$name] = $value;
        }
        return $params;
    }
}


?>
