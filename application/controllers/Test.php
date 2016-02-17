<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('home_model');
        $this->load->helper('url');
    }

    public function index() {

    }

    public function getRegion( $country ) {
        $nowCountry = $country;
        $result = $this->home_model->getRegion($nowCountry);
        var_dump($result[0]->nri_region);

        $arr = [];
        $iCount = 0;

        foreach( $result as $row ) {
            $arr[$iCount] = $row;
            $iCount++;
        }

        var_dump($arr);
    }

    public function register() {
        $this->load->view('../views/test/register.php');
    }
}