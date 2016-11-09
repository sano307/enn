<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Templates extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function logout() {
        $this->load->model('start_model');
        $this->start_model->currentDisconnect($_SESSION['login_idx']);

        unset($_SESSION['login_idx']);
        unset($_SESSION['login_nickname']);
        unset($_SESSION['login_profileThumbName']);
        unset($_SESSION['login_profileThumbExt']);

        $this->load->view('start/index');
    }
}
