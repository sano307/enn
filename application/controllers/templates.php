<?php
class templates extends Controller {
	public function logout() {
		// logout -> start/index
		unset($_SESSION['login_idx']);
		unset($_SESSION['login_nickname']);
		require 'application/views/start/index.php';
	}
}