<?php

	class Timeline extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->database();

		}
		public function index( $m_idx ) {

			$this->load->model('timelineModel');
			$timelineMemberInfo = $this->timelineModel->getMemberInfo($m_idx);
			$timelinePostInfo = $this->timelineModel->getPostInfo($m_idx,1,3);
			$timelineGroupInfo = $this->timelineModel->getGroupInfo($m_idx);
			$this->load->model('BuddyModel');
			$login_idx=$_SESSION['login_idx'];
			$buddystate = $this->BuddyModel->IsBuddyCheck($m_idx,$login_idx);
			// require 'application/views/_templates/header.php';
			$p=null;
			$page = (int) (!$p) ? 1 : $p+1;
			$this->load->view('_templates/header');
			$this->load->view('timeline/index',array('timelineMemberInfo'=>$timelineMemberInfo,
																					 'timelinePostInfo'=>$timelinePostInfo,
																					'timelineGroupInfo'=>$timelineGroupInfo,
																					'buddystate'=>$buddystate,'next' => $page));
			$this->load->view('_templates/footer');
		}
		public function scroll($p=0,$m_idx){
			$this->load->helper('url');
			$this->load->model('timelineModel');
			$limit = 3;
			$page = (int) (!$p) ? 1 : $p+1;
			$timelinePostInfo = $this->timelineModel->getPostInfo($m_idx,$page,$limit);
			$timelineMemberInfo = $this->timelineModel->getMemberInfo($m_idx);
			$this->load->view('/timeline/index', array('timelineMemberInfo'=>$timelineMemberInfo,
													'timelinePostInfo' => $timelinePostInfo , 'next' => $page));
		}
	}
