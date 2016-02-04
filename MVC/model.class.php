<?php

/*
 * 各个模块的模型基类
 */
class model
{
	# 模块
	protected $module;

	# 构造函数
	public function __construct(control $module) {
		$this->module = &$module;
	}
}

?>
