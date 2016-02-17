<?php
class Main extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('start_Model');
    }

    public function index() {
        $this->load->view('index');
    }
}
?>