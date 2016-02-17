<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
class templates extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	public function logout() {
		unset($_SESSION['login_idx']);
		unset($_SESSION['login_nickname']);

		$this->load->view('start/index');
	}
}
