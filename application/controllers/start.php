<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('start_model');
	}

	public function index() {
		$this->load->view('../views/start/index.php');
	}

	public function getRegion() {
		$postData = json_decode(file_get_contents("php://input"), true);
		$country = $postData['country'];
		$result = $this->start_model->getRegion($country);

		$arr = [];
		$iCount = 0;

		foreach( $result as $row ) {
			$arr[$iCount] = $row;
			$iCount++;
		}

		echo json_encode($arr);
	}

	public function getWholeRegion() {
		$result = $this->start_model->getWholeRegion();

		$arr = [];
		$iCount = 0;

		foreach( $result as $row ) {
			$arr[$iCount] = $row;
			$iCount++;
		}

		echo json_encode($arr);
	}

	public function toJoin() {
		$postData = json_decode(file_get_contents("php://input"));
		$joinInfo['m_memberID'] = $postData->joinData->email;
		$joinInfo['m_memberPasswd'] = $postData->joinData->passwd;
		$joinInfo['m_nickname'] = $postData->joinData->nickname;
		$joinInfo['m_nationally'] = $postData->joinData->country;
		$joinInfo['m_region'] = $postData->joinData->region;
		$joinInfo['m_sex'] = $postData->joinData->sex;

		$result = $this->start_model->IsMemberId($joinInfo['m_memberID']);

		$arr = [];
		$temp = new stdClass();
		if ( !$result ) {
			// 중복되지 않은 아이디라면
			$result = $this->start_model->IsMemberNickname($joinInfo['m_nickname']);
			if ( !$result ) {
				// 중복되지 않은 닉네임이라면
				$m_idx = $this->start_model->setNewMember($joinInfo);

				$imageSavePath = $_SERVER['DOCUMENT_ROOT'] . '/public/img/member/' . $m_idx;
				mkdir($imageSavePath);
				$temp->msg = 'success';
			} else {
				// 중복된 닉네임이라면
				$temp->msg = 'alreadyNickname';
			}
		} else {
			// 중복된 아이디라면
			$temp->msg = 'alreadyID';
		}

		$arr = $temp;
		echo json_encode($arr);
	}

	public function toLogin() {
		$postData = json_decode(file_get_contents("php://input"));
		$loginInfo['m_memberID'] = $postData->loginData->email;
		$loginInfo['m_memberPasswd'] = $postData->loginData->passwd;

		$result = $this->start_model->IsMember($loginInfo);

		$arr = [];
		$temp = new stdClass();
		if ( !$result ) {
			// 로그인 실패
			$temp->msg = 'failed';
		} else {
			// 로그인 성공
			$this->start_model->currentConnect($result[0]->m_idx);
			$temp->msg = 'success';
			$temp->nickname = $result[0]->m_nickname;
			$_SESSION['login_idx'] = $result[0]->m_idx;
			$_SESSION['login_nickname'] = $result[0]->m_nickname;
		}

		$arr = $temp;
		echo json_encode($arr);
	}
}
