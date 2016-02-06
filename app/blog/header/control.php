<?php

class header extends control
{
	public function test($var = 0) {
		$this->view->world = $this->model->get_world();
		$this->view->hehe = 'haha';

		echo '<p>'.$var.'</p>';
	}

	public function save_draft($draft) {
        $draft = json_decode($draft);
		echo 'md = '.$draft->md.'\\n';
		echo 'html = '.$draft->html.'\\n';
	}

	public function render() {
		$this->view->display('hello');

		parent::render();
	}
}


?>
