<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Timeline extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		public function index( $m_idx ) {
			// $timeline_model = $this->loadModel("timelineModel");
			$this->load->model('timelineModel');
			// member -> nickname, profile
			// $timelineMemberInfo = $timeline_model->getMemberInfo($m_idx);
			$timelineMemberInfo = $this->timelineModel->getMemberInfo($m_idx);

			// post ->
			// $timelinePostInfo = $timeline_model->getPostInfo($m_idx);
			$timelinePostInfo = $this->timelineModel->getPostInfo($m_idx);
			// group ->
			// $timelineGroupInfo = $timeline_model->getGroupInfo($m_idx);
			$timelineGroupInfo = $this->timelineModel->getGroupInfo($m_idx);

			// require 'application/views/_templates/header.php';
			$this->load->view('_templates/header');
			$this->load->view('timeline/index',array('timelineMemberInfo'=>$timelineMemberInfo,
																					 'timelinePostInfo'=>$timelinePostInfo,
																					'timelineGroupInfo'=>$timelineGroupInfo));
			$this->load->view('_templates/footer');
		}
	}
