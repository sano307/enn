<?php
class User extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('userModel');
		$this->load->model('memberModel');
	}

	public function index() {

	}

	public function IsNickname() {
		header("Content-Type: application/json");
		$temp = json_decode($_POST['sent_data']);
		$inputNickname = $temp[0]->nickname;

		$data = [];
		$sent_data = new stdClass();

		$result = $this->userModel->IsNickname( $inputNickname );
		if ( !$result ) {
			$sent_data->result = true;
		} else {
			$sent_data->result = false;
		}

		$data = $sent_data;
		unset($sent_data);

		echo json_encode($data);
	}

	public function profile_edit() {
		$memberInfo = $this->userModel->getLoginMemberInfo($_SESSION['login_idx']);

		$this->load->view('_templates/header');
		$this->load->view('user/profileedit', array('memberInfo' => $memberInfo));
		$this->load->view('_templates/footer');
	}

	public function profile_delete() {
		$member_list = $this->memberModel->deleteMember($_SESSION['logining_idx']);
		/*session_destroy();*/
		$this->load->view('_templates/header');
		$this->load->view('start/index', array('member_list' => $member_list));
		$this->load->view('_templates/footer');
	}

	public function profile_update() {
		$memberInfo['idx'] = $_SESSION['login_idx'];		// 회원 고유 번호
		$memberInfo['nickname'] = $_POST['nickname'];		// 수정한 닉네임
		$memberInfo['password'] = $_POST['password'];		// 수정한 비밀번호
		$memberInfo['region'] = $_POST['region'];			// 수정한 지역
		$profileImg = $_FILES['profileImg'];				// 수정한 프로필 이미지

		$saveFolderName = $memberInfo['idx'];    //
		$saveFolderPath = "public/img/member/" . $saveFolderName . "/";      // 이미지가 저장되는 폴더 경로
		$memberInfoUpdateTimeInfo = date("Ymd_His", time());                 // 회원 정보가 수정된 시간

		if ( $profileImg['error'] != 4 ) {
			// 파일을 전송했을 경우
			if ( $profileImg['error'] == 0 ) {
				// 용량, 전체 전송, 임시 폴더 유무, 디스크에 파일 쓰기 유무, 확장에 의한 중지 유무를 통과했을 경우
				$profileImgInfo['saveFolderName'] = $saveFolderName;
				$profileImgInfo['saveFolderPath'] = $saveFolderPath;
				$profileImgInfo['ext'] = pathinfo($profileImg['name'], PATHINFO_EXTENSION);
				$profileImgInfo['name'] = $saveFolderName . "_" . $memberInfoUpdateTimeInfo;
				$profileImgInfo['tmp_name'] = $profileImg['tmp_name'];
				$profileImgInfo['size'] = $profileImg['size'];
				$result = $this->IsImageCheck($profileImgInfo);

				if ($result['check'] == 0) {
					header("Location: /application/views/user/alert.php?error={$result['msg']}");
					exit;
				}

				$this->imageUploading($profileImgInfo);
				$resizeImageInfo['open_name'] = $profileImgInfo['saveFolderPath'] . $profileImgInfo['name'] . "." . $profileImgInfo['ext'];
                $resizeImageInfo['ext'] = $profileImgInfo['ext'];
                $resizeImageInfo['name'] = $profileImgInfo['name'] . "_Profile";
                $resizeImageInfo['saveFolderPath'] = $profileImgInfo['saveFolderPath'] . $resizeImageInfo['name'] . "." . $resizeImageInfo['ext'];
                $memberProfileInfo = $this->imageResization($resizeImageInfo, 200, 200);

				$resizeImageInfo['open_name'] = $profileImgInfo['saveFolderPath'] . $profileImgInfo['name'] . "." . $profileImgInfo['ext'];
                $resizeImageInfo['ext'] = $profileImgInfo['ext'];
                $resizeImageInfo['name'] = $profileImgInfo['name'] . "_Thumb";
                $resizeImageInfo['saveFolderPath'] = $profileImgInfo['saveFolderPath'] . $resizeImageInfo['name'] . "." . $resizeImageInfo['ext'];
                $memberProfileThumbInfo = $this->imageResization($resizeImageInfo, 100, 100);
                $temp = $profileImgInfo['saveFolderPath'] . $profileImgInfo['name'] . "." . $profileImgInfo['ext'];
				unlink($temp);

				$profileImgInfo_previous = $this->memberModel->getPreviousProfileInfo($memberInfo['idx']);
				$beforeProfileImg = $profileImgInfo_previous['m_profileImgName'] . "." . $profileImgInfo_previous['m_profileImgExt'];
				$beforeProfileThumb = $profileImgInfo_previous['m_profileThumbName'] . "." . $profileImgInfo_previous['m_profileThumbExt'];
				$beforeProfileImgPath = $profileImgInfo['saveFolderPath'] . $beforeProfileImg;
				$beforeProfileThumbPath = $profileImgInfo['saveFolderPath'] . $beforeProfileThumb;
				unlink($beforeProfileImgPath);
				unlink($beforeProfileThumbPath);

				$this->memberModel->updateMemberInfo_ProfileImage($memberInfo, $memberProfileInfo, $memberProfileThumbInfo);
				$_SESSION['login_profileThumbName'] = $memberProfileThumbInfo['name'];
				$_SESSION['login_profileThumbExt'] = $memberProfileThumbInfo['ext'];
			} else {
				// 위의 조건을 만족하지 않아서 통과하지 못했을 경우
				$this->uploadImageErrorCheck($profileImg['error']);
			}
		} else {
			// 파일을 전송하지 않았을 경우
			$this->memberModel->updateMemberInfo_notProfileImage($memberInfo);
		}

		header("Location: /user/profile_edit/");
	}
}