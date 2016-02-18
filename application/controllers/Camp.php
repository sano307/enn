<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Camp extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('camp_model');
    }

    public function index() {
        $myCampInfo = $this->camp_model->getCampInfo($_SESSION['login_idx']);

        $this->load->view('../views/_templates/header.php');
        $this->load->view('../views/camp/index.php', array('myCampInfo' => $myCampInfo));
        $this->load->view('../views/_templates/footer.php');
    }

    public function toCreate() {
        $postData = json_decode(file_get_contents("php://input"));
        $campInfo['m_idx'] = $postData->campData->idx;
        $campInfo['c_campName'] = $postData->campData->name;
        $campInfo['c_campIntroduction'] = $postData->campData->introduction;
        $campInfo['c_campCountry'] = $postData->campData->country;
        $campInfo['c_campRegion'] = $postData->campData->region;

        $result = $this->camp_model->IsCampName($campInfo['m_idx']);

        $arr = [];
        $temp = new stdClass();
        if ( !$result ) {
            // 중복되지 않은 아이디라면
            $result = $this->start_model->IsMemberNickname($joinInfo['m_nickname']);
            if ( !$result ) {
                // 중복된 닉네임이라면
                // 중복되지 않은 닉네임이라면
                $result = $this->start_model->setNewMember($joinInfo);
                if ( !$result ) {
                    // 새로운 회원 정보 입력 실패
                    $temp->msg = 'failed';
                } else {
                    // 새로운 회원 정보 입력 성공
                    $temp->msg = 'success';
                }
            } else {
                // 중복되지 않은 닉네임이라면
                $temp->msg = 'alreadyNickname';
            }
        } else {
            // 중복된 아이디라면
            $temp->msg = 'alreadyID';
        }

        $arr = $temp;
        echo json_encode($arr);
    }
}
