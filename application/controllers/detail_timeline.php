<?php
class detail_timeline extends Controller {
	public function index( $p_idx, $c_idx ) {
         $detail_timeline = $this->loadModel('detail_timelineMD');
         $nowPostWriterInfo = $detail_timeline->getSpecificPostInfo($p_idx);
         $nowPostImageInfo = $detail_timeline->getSpecificPostImageInfo($p_idx);
         $nowPostReplyInfo = $detail_timeline->getSpecificPostReplyInfo($p_idx);
         $nowPostLikeState = $detail_timeline->post_like_check($_SESSION['login_idx'],$p_idx);
         $nowPostCampInfo = $c_idx;

         require 'application/views/_templates/header.php';
         require 'application/views/timeline/detail_post.php';
         require 'application/views/_templates/footer.php';
    }
}