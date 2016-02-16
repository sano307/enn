<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function index() {
		// $post_model = $this->loadModel("postModel");
		$this->load->model('postModel');
		// $result = $this->StartModel->login($loginMemberInfo);
		// $getPostInfo = $post_model->getMemberPostInfo($_SESSION['login_nickname']);
		$getPostInfo = $this->postModel->getMemberPostInfo($_SESSION['login_idx']);

		$this->load->model("buddyModel");
		$getBuddyRecommend = $this->buddyModel->getMainBuddyRecommend();
		$this->load->model("campModel");
		$getGroupRecommend = $this->campModel->getMainGroupRecommend();

		// require 'application/views/_templates/header.php';
		$this->load->view('_templates/header');
    // require 'application/views/main/index.php';
		$this->load->view('main/index',array('getBuddyRecommend'=>$getBuddyRecommend,
																				 'getPostInfo'=>$getPostInfo,
																			 	'getGroupRecommend'=>$getGroupRecommend));
    // require 'application/views/_templates/footer.php';
		$this->load->view('_templates/footer');
	}
}
