<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	}

	public function index() {
		$this->load->model('postModel');
		$getPostInfo = $this->postModel->getMemberPostInfo($_SESSION['login_idx']);
		$this->load->model("buddyModel");
		$getBuddyRecommend = $this->buddyModel->getMainBuddyRecommend();
		$this->load->model("campModel");
		$getGroupRecommend = $this->campModel->getMainGroupRecommend();


		$this->load->view('_templates/header');
		$this->load->view('main/index',array('getBuddyRecommend'=>$getBuddyRecommend,
																				 'getPostInfo'=>$getPostInfo,
																			 	'getGroupRecommend'=>$getGroupRecommend));
		$this->load->view('_templates/footer');
	}
}
