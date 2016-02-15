<?php
	class timeline extends Controller{
		public function index( $m_idx ) {
			$timeline_model = $this->loadModel("timelineModel");
			// member -> nickname, profile
			$timelineMemberInfo = $timeline_model->getMemberInfo($m_idx);
			// post ->
			$timelinePostInfo = $timeline_model->getPostInfo($m_idx);
			// group ->  
			$timelineGroupInfo = $timeline_model->getGroupInfo($m_idx);

			require 'application/views/_templates/header.php';
			require 'application/views/timeline/index.php';
			require 'application/views/_templates/footer.php';
		}
	}