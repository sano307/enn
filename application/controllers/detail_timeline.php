<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Detail_timeline extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function index( $p_idx ) {
		$this->load->model('detail_timelineMD');
		$current_m_idx = $_SESSION['login_idx'];

		$nowPostWriterInfo = $this->detail_timelineMD->getSpecificPostInfo($p_idx);
		$nowPostImageInfo = $this->detail_timelineMD->getSpecificPostImageInfo($p_idx);
		$nowPostReplyInfo = $this->detail_timelineMD->getSpecificPostReplyInfo($p_idx);
		$nowPostLikeState = $this->detail_timelineMD->post_like_check($current_m_idx,$p_idx);
		$nowPostCampInfo = $nowPostWriterInfo->c_idx;

		$this->load->view('timeline/detail_post',array(
				'nowPostWriterInfo'=>$nowPostWriterInfo,
				'nowPostImageInfo'=>$nowPostImageInfo,
				'nowPostReplyInfo'=>$nowPostReplyInfo,
				'nowPostLikeState'=>$nowPostLikeState,
				'nowPostCampInfo'=>$nowPostCampInfo,
				'current_m_idx'=>$current_m_idx,
		));
	}
}
