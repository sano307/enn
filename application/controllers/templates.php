<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
class templates extends CI_Controller {
	public function logout() {
		// logout -> start/index
		unset($_SESSION['login_idx']);
		unset($_SESSION['login_nickname']);
		$this->load->view('start/index');
	}
}
