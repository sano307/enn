<?php

class master extends CI_Controller {
	public function index() {
		$master_model = $this -> loadModel('masterModel');
		$master_notice = $master_model -> masterNoticeList();

		require 'application/views/_templates/header.php';
		require 'application/views/master/index.php';
		require 'application/views/_templates/footer.php';
	}

	public function search() {
		$category = isset($_POST['category']) ? $_POST['category'] : null;
		$totalsearch = isset($_POST['totalsearch']) ? $_POST['totalsearch'] : null;
		$master_model = $this -> loadModel('masterModel');
		if($category == "member") {
			$memberSearchList = $master_model -> memberSearchList($totalsearch);
		}
		else if($category == "camp"){
			$campSearchList = $master_model -> campSearchList( $totalsearch );
		}
		else if($category == "post"){
			$postSearchList = $master_model -> postSearchList( $totalsearch );
		}

		require 'application/views/_templates/header.php';
		require 'application/views/master/index.php';
		require 'application/views/_templates/footer.php';
	}
	public function delete_info() {
		$memberNum = isset($_GET['m_idx']) ? $_GET['m_idx'] : null;
		$campNum = isset($_GET['c_idx']) ? $_GET['c_idx'] : null;
		$postNum = isset($_GET['p_idx']) ? $_GET['p_idx'] : null;
		$master_model = $this -> loadModel('masterModel');
		if( $memberNum ) {
			$master_model-> memberDeleteinfo( $memberNum );
		} elseif( $campNum ) {
			$master_model -> campDeleteInfo( $campNum );
		} elseif( $postNum ) {
			$master_model -> postDeleteInfo( $postNum );
		}

		header('location:'. URL .'master/search');
	}
	public function notice( $m_idx ) {
		$master_idx = (int)$m_idx;
		$noticeTitle = isset($_POST['noticeTitle']) ? $_POST['noticeTitle'] : null;
		$noticeContent = isset($_POST['noticeContent']) ? $_POST['noticeContent'] : null;
		$master_model = $this -> loadModel('masterModel');
		$master_model -> masterNoticeInsertInfo( $master_idx, $noticeTitle, $noticeContent );

	}
}
