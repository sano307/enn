<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function index() {
		$this->load->view('start/index');
	}


	public function getRegion() {
		header("Content-Type: application/json");
		$temp = json_decode($_POST['sent_data']);
		$selectedNationally = $temp[0]->nationally;

		$start_model = $this->loadModel('startModel');
		$regionInfo = $start_model->getRegionOfNation( $selectedNationally );
		$data = $regionInfo;
		unset($regionInfo);

		echo json_encode($data);
	}

	public function login(){
		$this->load->model('StartModel');
		$loginMemberInfo['id'] = $_POST['email'];
		$loginMemberInfo['passwd'] = $_POST['password'];
		$result = $this->StartModel->login($loginMemberInfo);
		if( $result == false ) {
			// 로그인 실패
			header("Location: /start/index/");
		} else {
			// 로그인 성공
			$_SESSION['login_idx'] = $result->m_idx;
			$_SESSION['login_nickname'] = $result->m_nickname;

			// $profileInfo = $result->getMemberProfileInfo($_SESSION['login_idx']);
			$_SESSION['login_profileThumbName'] = $profileInfo->m_profileThumbName;
			$_SESSION['login_profileThumbExt'] = $profileInfo->m_profileThumbExt;

			header("Location: /home/index");
		}
	}

	public function join() {
		// 회원가입할 때의 정보를 받아온다.
		$joinMemberInfo['id'] = $_POST['email'];
		$joinMemberInfo['nickname'] = $_POST['name'];
		$joinMemberInfo['passwd'] = $_POST['password'];
		$joinMemberInfo['sex'] = $_POST['sex'];
		$joinMemberInfo['nationally'] = $_POST['nationally'];
		$joinMemberInfo['region'] = $_POST['region'];

		// 프로필 이미지
		$profileImg = $_FILES['profileImg'];

		$start_model = $this->loadModel('startModel');

		$result = $start_model->getNewMemberNum();
		$joinMemberInfo['idx'] = $result['Auto_increment'];					// 현재 등록되는 회원 고유 번호
		$saveFolderName = $joinMemberInfo['idx'];								// 프로필 사진이 저장되는 폴더 번호
		$saveFolderPath = "public/img/member/" . $saveFolderName . "/";      // 프로필 사진이 저장되는 폴더 경로
		$this->createDirectory( $saveFolderPath );								// 프로필 사진이 저장되는 경로에 폴더 만들기
		$memberInfoInsertTimeInfo = date("Ymd_His", time());                 	// 회원 등록 시간
		$result = "";

		if ( $profileImg['error'] != 4 ) {
			// 파일을 전송했을 경우
			if ( $profileImg['error'] == 0 ) {
				// 용량, 전체 전송, 임시 폴더 유무, 디스크에 파일 쓰기 유무, 확장에 의한 중지 유무를 통과했을 경우
				$profileImgInfo['saveFolderName'] = $saveFolderName;
				$profileImgInfo['saveFolderPath'] = $saveFolderPath;
				$profileImgInfo['ext'] = pathinfo($profileImg['name'], PATHINFO_EXTENSION);
				$profileImgInfo['name'] = $saveFolderName . "_" . $memberInfoInsertTimeInfo;
				$profileImgInfo['tmp_name'] = $profileImg['tmp_name'];
				$profileImgInfo['size'] = $profileImg['size'];
				$result = $this->IsImageCheck($profileImgInfo);

				if ($result['check'] == 0) {
					header("Location: /application/views/common/imageUploadError.php?error={$result['msg']}");
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

				$result = $start_model->insertMemberInfo_ProfileImage($joinMemberInfo, $memberProfileInfo, $memberProfileThumbInfo);
			} else {
				// 위의 조건을 만족하지 않아서 통과하지 못했을 경우
				$this->uploadImageErrorCheck($profileImg['error']);
				rmdir($saveFolderPath);
			}
		} else {
			// 파일을 전송하지 않았을 경우
			$result = $start_model->insertMemberInfo_notProfileImage( $joinMemberInfo );
		}

		if( $result['joinCheck'] == 1 ){
			// insert success
			$createDirectoryPath = "./public/img/member/" . $result['lastInsertId'];
			$this->createDirectory($createDirectoryPath);
			$result = $start_model->login($joinMemberInfo);

			$_SESSION['login_idx'] = $result['m_idx'];
			$_SESSION['login_nickname'] = $result['m_nickname'];

			$profileInfo = $start_model->getMemberProfileInfo($_SESSION['login_idx']);
			$_SESSION['login_profileThumbName'] = $profileInfo->m_profileThumbName;
			$_SESSION['login_profileThumbExt'] = $profileInfo->m_profileThumbExt;

			header("Location: /home/index");
		} else {
			// insert failed
			header("Location: /start/index");
		}
	}
}
