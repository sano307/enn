<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('test_model');
        $this->load->helper('url');
        $this->load->library('upload');
    }

    public function index() {
        $this->load->view('../views/test/index.php');
    }

    public function getRegion( $country ) {
        $nowCountry = $country;
        $result = $this->test_model->getRegion($nowCountry);

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

    public function upload() {
        //Configure upload.
        $this->upload->initialize(array(
            "upload_path"   => "/"
        ));

        //Perform upload.
        if($this->upload->do_multi_upload("files")) {
            //Code to run upon successful upload.
            print_r($this->upload->get_multi_upload_data());
        }
    }

    public function upload_test()
    {
        $this->load->helper('form');
        $data['title'] = 'Multiple file upload';

        if ($this->input->post()) {
            $config = array(
                'upload_path' => './assets/img',
                'allowed_types' => 'gif|jpg|png',
                'max_size' => '2048'
            );

            // load Upload library
            $this->load->library('upload', $config);

            $this->upload->do_upload('uploadedimages');

            echo '<pre>';
            $uploaded = $this->upload->data();
            print_r($uploaded);
            echo '</pre>';
            echo '<hr />';
            echo '<pre>';
            print_r($this->upload->display_errors());
            echo '</pre>';
            exit();
        }
        $this->load->view('../views/test/upload.php', $data);
    }

    public function getBuddy() {
        $this->load->model('buddyModel');

        $result = $this->buddyModel->getMyBuddyNickname(2);

        $buddyList = [];
        foreach ( $result as $row ) {
            $temp = $this->buddyModel->getMyBuddyInfo($row->b_requestedMember);
            $buddyList = array_merge($buddyList, $temp);
        }

        var_dump($buddyList);
    }
}