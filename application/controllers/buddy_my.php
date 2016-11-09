<?php
class Buddy_my extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('buddyModel');
		$this->load->helper('alert');
	}

	public function index() {
		$buddy_list = $this->buddyModel->getBuddyList($_SESSION['login_idx']);

		$searchValue['m_idx'] = isset($_SESSION['login_idx']) ? $_SESSION['login_idx'] : null;
		$memberRegion = $this->buddyModel->getMemberRegion( $searchValue['m_idx'] );
		$searchValue['m_nationally'] = $memberRegion['m_nationally'];
		$searchValue['m_region'] = $memberRegion['m_region'];

		$recommendBuddyList = $this->buddyModel->getRecommendBuddyList($searchValue);

		$this->load->view('_templates/header');
		$this->load->view('buddy_my/index', array('buddy_list'=>$buddy_list, 'recommendBuddyList'=>$recommendBuddyList));
		$this->load->view('_templates/footer');
	}

	public function add($request_idx) {
		 $buddyRequestedInfo = $_SESSION['login_idx'];            // 친구신청을 요청한 회원 고유 번호
		 //$buddyRequestedInfo['nickname'] = $_SESSION['login_nickname'];   // 친구신청을 요청한 회원 닉네임
		 $buddyAceeptedInfo = $request_idx;                     // 친구신청을 받은 회원 고유 번호
		 //$buddyAceeptedInfo['nickname'] = $_POST['nickname'];            // 친구신청을 받은 회원 닉네임

		 // 이미 친구 신청이 되어 있는지 검사
		 // 1, 2 / 2, 1
		 $result = $this->buddyModel->IsBuddyCheck( $buddyRequestedInfo, $buddyAceeptedInfo );
		 $msg = 0;

		 if ( !$result ) {
				// 친구 신청이 되어 있지 않다면
				// 위의 회원들의 정보를 buddy table에 입력
				$msg = 1;
				$this->buddyModel->insertNewBuddyInfo( $buddyRequestedInfo, $buddyAceeptedInfo );
		 } else {
				// 친구 신청이 되어 있다면
				// 이미 친구 신청이 되어 있다는 alert를 띄운다.
		 }

		 /*header("Location: /application/views/buddy_my/alert.php?msg=$msg");*/
		alert($msg);
	}

	public function delete($b_midx, $request_idx) {
		$msg = 4;

		$this->buddyModel->deleteBuddy($b_midx, $request_idx);
		alert($msg);
	}

	public function request() {
		$buddy_ok = isset($_POST['buddyOK']) ? $_POST['buddyOK'] : null;
		$buddy_no = isset($_POST['buddyNO']) ? $_POST['buddyNO'] : null;
		$buddy_idx = isset($_POST['b_idx']) ? $_POST['b_idx'] : null;
		$request_idx = isset($_POST['b_request_m_idx']) ? $_POST['b_request_m_idx'] : null;
		$loginMemberNum = $_SESSION['login_idx'];
		/*$requestedMember = $_SESSION['login_nickname'];*/

		$buddy_RequestList = $this->buddyModel->getRequestBuddyList($loginMemberNum);

		if($buddy_ok) {
			$this->buddyModel->addBuddy($buddy_ok, $loginMemberNum, $buddy_idx, $request_idx);
			$buddy_ok = null;
			$msg = 2;
			alert($msg);
			/*echo "<script>alert('친구추가 완료!')</script>";
			echo "<script>location.replace('/buddy_my/request')</script>";*/
		} else if($buddy_no) {
			$this->buddyModel->addBuddy($buddy_no, $loginMemberNum, $buddy_idx, $request_idx);
			$buddy_no = null;
			$msg = 3;
			alert($msg);
			/*echo "<script>alert('친구신청을 거절하였습니다.')</script>";
			echo "<script>location.replace('/buddy_my/request')</script>";*/
		} else {
			$this->load->view('_templates/header');
			$this->load->view('buddy_my/request',array('buddy_RequestList'=>$buddy_RequestList) );
			$this->load->view('_templates/footer');
		}
	}

	public function buddy_search() {
		$buddySearchInfo['m_idx'] = $_SESSION['login_idx'];
		$buddySearchInfo['searchNickname_my'] = isset($_POST['searchNickname_my']) ? $_POST['searchNickname_my'] : null;

		$memberRegion = $this->buddyModel->getMemberRegion( $buddySearchInfo['m_idx'] );
		$buddySearchInfo['m_nationally'] = $memberRegion['m_nationally'];
		$buddySearchInfo['m_region'] = $memberRegion['m_region'];

		if( $buddySearchInfo['searchNickname_my'] != null) {
			// buddy_my_search
			$buddy_SearchList = $this->buddyModel->getSearchBuddyList_My($buddySearchInfo);
			$recommendBuddyList = $this->buddyModel->getRecommendBuddyList($buddySearchInfo);
		} else {
			header('location: /buddy_my/index');
		}

		$this->load->view('_templates/header');
		$this->load->view('buddy_my/index', array('buddy_SearchList' => isset($buddy_SearchList) ? $buddy_SearchList : null,
													'recommendBuddyList' => isset($recommendBuddyList) ? $recommendBuddyList : null));
		$this->load->view('_templates/footer');

	}
	public function member_search()
	{
		$memberSearchInfo['searchMemberNum'] = $_SESSION['login_idx'];
		$memberSearchInfo['searchNickname'] = isset($_POST['buddySearch']) ? $_POST['buddySearch'] : null;

		if ($memberSearchInfo['searchNickname'] != null) {
			// member_search
			$buddy_SearchList = $this->buddyModel->getSearchBuddyList($memberSearchInfo);
		}

		$this->load->view('_templates/header');
		$this->load->view('buddy_my/search', isset($buddy_SearchList) ? array('buddy_SearchList'=>$buddy_SearchList) : null);
		$this->load->view('_templates/footer');
	}
}
