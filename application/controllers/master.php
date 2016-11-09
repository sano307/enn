<?php

class Master extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->Model('masterModel');
	}

	public function index() {
		$master_notice = $this->masterModel -> masterNoticeList();

		$this->load->view('_templates/header');
		$this->load->view('master/index', array('master_notice' => $master_notice));
		$this->load->view('_templates/footer');
	}

	public function search() {
		$category = isset($_POST['category']) ? $_POST['category'] : null;
		$totalsearch = isset($_POST['totalsearch']) ? $_POST['totalsearch'] : null;

		$master_notice = $this->masterModel -> masterNoticeList();

		if($category == "member") {
			$memberSearchList = $this->masterModel -> memberSearchList($totalsearch);
		}
		else if($category == "camp"){
			$campSearchList = $this->masterModel -> campSearchList( $totalsearch );
		}
		else if($category == "post"){
			$postSearchList = $this->masterModel -> postSearchList( $totalsearch );
		}

		$this->load->view('_templates/header');
		$this->load->view('master/index', array('memberSearchList' => isset($memberSearchList) ? $memberSearchList : null,
				 								   'campSearchList' => isset($campSearchList) ? $campSearchList : null,
												   'postSearchList' => isset($postSearchList) ? $postSearchList : null,
												   'master_notice' => $master_notice));
		$this->load->view('_templates/footer');
	}
	public function delete_info() {
		$memberNum = isset($_GET['m_idx']) ? $_GET['m_idx'] : null;
		$campNum = isset($_GET['c_idx']) ? $_GET['c_idx'] : null;
		$postNum = isset($_GET['p_idx']) ? $_GET['p_idx'] : null;

		if( $memberNum ) {
			$this->masterModel-> memberDeleteinfo( $memberNum );
		} elseif( $campNum ) {
			$this->masterModel -> campDeleteInfo( $campNum );
		} elseif( $postNum ) {
			$this->masterModel -> postDeleteInfo( $postNum );
		}

		header('location:/master/search');
	}
	public function notice( $m_idx ) {
		$master_idx = (int)$m_idx;
		$noticeTitle = isset($_POST['noticeTitle']) ? $_POST['noticeTitle'] : null;
		$noticeContent = isset($_POST['noticeContent']) ? $_POST['noticeContent'] : null;

		$this->masterModel -> masterNoticeInsertInfo( $master_idx, $noticeTitle, $noticeContent );

	}
}
