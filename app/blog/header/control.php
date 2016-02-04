<?php

class header extends control
{
	public function test() {
		echo '<p><<<<<<<<<<<<<<<<<<<<</p>';
		echo '<p>'.get_class($this).'->'.__function__.'</p>';
		$this->view->world = $this->model->get_world();

		echo '<p><<<<<'.count($this->modules).'<<<<<<<<<<<<<<<</p>';
	}

	public function render() {
		$this->view->display('hello');

		parent::render();
	}
}


?>
