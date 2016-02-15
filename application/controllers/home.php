<?php
class home extends Controller {
	public function index() {
		$post_model = $this->loadModel("postModel");
		$getPostInfo = $post_model->getMemberPostInfo($_SESSION['login_nickname']);
		$getNowMemberNum = $post_model->getPostWriterNum($_SESSION['login_nickname']);

		$BR_model = $this->loadModel("buddyModel");
		$getBuddyRecommend = $BR_model->getMainBuddyRecommend();

		$CR_model = $this->loadModel("campModel");
		$getGroupRecommend = $CR_model->getMainGroupRecommend();

		require 'application/views/_templates/header.php';
    require 'application/views/main/index.php';
    require 'application/views/_templates/footer.php';
	}
}
