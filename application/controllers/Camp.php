<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Camp extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('camp_model');
    }

    public function index() {
        $this->load->view('../views/_templates/header.php');
        $this->load->view('../views/camp/index.php');
        $this->load->view('../views/_templates/footer.php');
    }

    // 캠프이름으로 검색
    public function getSearchCamp() {
        $postData = json_decode(file_get_contents("php://input"));
        $searchInfo['campName'] = $postData->campName;
        $searchInfo['pageNum'] = $postData->page;

        $result = $this->camp_model->getSearchCamp($searchInfo);
    }

    // 새로운 캠프 생성
    public function toCreate() {
        $postData= $_POST['campData'];
        $campInfo['m_idx'] = $postData['m_idx'];
        $campInfo['c_campName'] = $postData['name'];
        $campInfo['c_campIntroduction'] = $postData['introduction'];
        $campInfo['c_campCountry'] = $postData['country'];
        $campInfo['c_campRegion'] = $postData['region'];

        $result = $this->camp_model->IsCampName($campInfo['c_campName']);

        $arr = [];
        $temp = new stdClass();
        if ( !$result ) {
            // 중복되지 않은 캠프 이름이라면
            $campImage = $_FILES['campImage'];

            if ( $campImage['error'][0] != 0 ) {
                return false;
            }

            $now = date('YmdHis');
            $campInfo['c_campImgName'] = $now . '_' . md5($campImage['name']) . '-represent';
            $campInfo['c_campImgExt'] = pathinfo($campImage['name'], PATHINFO_EXTENSION);

            // 캠프 등록
            $c_idx = $this->camp_model->setNewCamp($campInfo);

            $campMemberInfo['m_idx'] = $campInfo['m_idx'];
            $campMemberInfo['c_idx'] = $c_idx;
            $campMemberInfo['cm_joinStateCamp'] = '1';
            $this->camp_model->setNewCampMember($campMemberInfo);

            $imageSavePath = $_SERVER['DOCUMENT_ROOT'] . '/public/img/camp/' . $c_idx;
            mkdir($imageSavePath);

            $tmp_path = $campImage['tmp_name'];
            $save_path =  $_SERVER['DOCUMENT_ROOT'] . '/public/img/camp/' . $c_idx. '/' . $campInfo['c_campImgName'] . '.' . $campInfo['c_campImgExt'];
            move_uploaded_file($tmp_path, $save_path);

            $temp->msg = 'success';
        } else {
            // 중복된 캠프 이름이라면
            $temp->msg = 'already';
        }

        $arr = $temp;
        echo json_encode($arr);
    }

    // 선택한 나라에 해당하는 캠프 정보 리턴
    public function getCampByCountry() {
        $postData = json_decode(file_get_contents("php://input"));
        $campSearchInfo['country'] = $postData->country;
        $campSearchInfo['m_idx'] = $postData->m_idx;
        $campSearchInfo['pageNum'] = $postData->pageNum;
        $result = $this->camp_model->getCampByCountry($campSearchInfo);
        echo json_encode($result);
    }

    // 선택한 지역에 해당하는 캠프 정보 리턴
    public function getCampByRegion() {
        $postData = json_decode(file_get_contents("php://input"));
        $campSearchInfo['region'] = $postData->region;
        $campSearchInfo['m_idx'] = $postData->m_idx;
        $campSearchInfo['pageNum'] = $postData->pageNum;
        $result = $this->camp_model->getCampByRegion($campSearchInfo);
        echo json_encode($result);
    }

    // 클릭한 캠프가 나의 캠프인지 확인
    public function IsCampMember() {
        $postData = json_decode(file_get_contents("php://input"));
        $temp['c_idx'] = $postData->c_idx;
        $temp['m_idx'] = $postData->m_idx;
        $result = $this->camp_model->IsCampMember($temp);

        $arr = [];
        $temp = new stdClass();

        if( !$result ) {
            $temp->msg = 'not exist';
        } else if( $result[0]->cm_joinStateCamp === '0' ) {
            $temp->msg = 'join in process';
        } else {
            $temp->msg = 'exist';
        }

        $arr = $temp;
        echo json_encode($arr);
    }

    public function setCampNewMember() {
        $postData = json_decode(file_get_contents("php://input"));
        $campMemberInfo['c_idx'] = $postData->c_idx;
        $campMemberInfo['m_idx'] = $postData->m_idx;
        $campMemberInfo['cm_joinStateCamp'] = 0;

        $result = $this->camp_model->IsCampMember($campMemberInfo);

        $arr = [];
        $temp = new stdClass();
        if ( !$result ) {
            // 가입 신청이 진행중이지 않은 회원이라면
            $this->camp_model->setCampNewMember($campMemberInfo);
            $temp->msg = 'success';
        } else {
            // 가입 신청이 진행중인 회원이라면
            $temp->msg = 'join in process';
        }

        $arr = $temp;
        echo json_encode($arr);
    }

    public function getCampInfo() {
        $postData = json_decode(file_get_contents("php://input"));
        $postInfo['c_idx'] = $postData->c_idx;
        $postInfo['pageNum'] = $postData->page;

        $campInfo = $this->camp_model->getCampInfo($postInfo);
        $postInfo = $this->camp_model->getCampPostInfo($postInfo);

        $result = array_merge($campInfo, $postInfo);
        echo json_encode($result);
    }

    public function getCampPostInfo() {
        $postData = json_decode(file_get_contents("php://input"));
        $postInfo['c_idx'] = $postData->c_idx;
        $postInfo['pageNum'] = $postData->page;

        $result = $this->camp_model->getCampPostInfo($postInfo);
        echo json_encode($result);
    }

    public function toWrite() {
        $postData = $_POST['writeInfo'];
        $postImages = $_FILES['postImages'];
        $cnt = count($postImages['error']);
        for ( $iCount = 0; $iCount < $cnt; $iCount++ ) {
            if ( $postImages['error'][$iCount] != 0 ) {
                return false;
            }
        }

        $now = date('YmdHis');
        $imageInfo = [];
        for ( $iCount = 0; $iCount < $cnt; $iCount++ ) {
            $imageInfo[$iCount]['pa_postImgName'] = $now . '_' . md5($postImages['name'][$iCount]);
            $imageInfo[$iCount]['pa_postImgExt'] = pathinfo($postImages['name'][$iCount], PATHINFO_EXTENSION);

            $tmp_path = $postImages['tmp_name'][$iCount];
            $save_path =  $_SERVER['DOCUMENT_ROOT'] . '/public/img/camp/' . $postData['c_idx'] . '/' . $imageInfo[$iCount]['pa_postImgName'] . '.' . $imageInfo[$iCount]['pa_postImgExt'];
            move_uploaded_file($tmp_path, $save_path);
        }

        $writeInfo['m_idx'] = $postData['m_idx'];
        $writeInfo['c_idx'] = $postData['c_idx'];
        $writeInfo['p_title'] = $postData['title'];
        $writeInfo['p_content'] = $postData['content'];
        $writeInfo['p_postThumbName'] = $imageInfo[0]['pa_postImgName'];
        $writeInfo['p_postThumbExt'] = $imageInfo[0]['pa_postImgExt'];
        $writeInfo['p_postHits'] = 0;
        $writeInfo['p_postGoods'] = 0;

        $p_idx = $this->camp_model->setCampPost($writeInfo);

        $cnt = count($imageInfo);
        for ( $iCount = 0; $iCount < $cnt; $iCount++ ) {
            $imageInfo[$iCount]['p_idx'] = $p_idx;
            $this->camp_model->setCampPostImage($imageInfo[$iCount]);
        }

        $postInfo['c_idx'] = $postData['c_idx'];
        $postInfo['pageNum'] = $postData['page'];
        $result = $this->camp_model->getCampPostInfo($postInfo);
        echo json_encode($result);
    }

    // 현재 로그인한 회원이 가입된 캠프 정보
    public function getMyCampInfo() {
        $postData = json_decode(file_get_contents("php://input"));
        $m_idx = $postData->m_idx;

        $result = $this->camp_model->getMyCampInfo($m_idx);
        echo json_encode($result);
    }

    // 모든 지역의 캠프 생성 수
    public function getWholeCampInfo() {
        $result = $this->camp_model->getWholeCampInfo();
        echo json_encode($result);
    }

    // 특정 포스트의 댓글 가져오기
    public function getCertainPostInfo() {
        $postData = json_decode(file_get_contents("php://input"));
        $p_idx = $postData->p_idx;

        $replyInfo['p_idx'] = $p_idx;
        $replyInfo['pageNum'] = $postData->page;

        $this->camp_model->setCertainPostHits($p_idx);
        $certainPostInfo = $this->camp_model->getCertainPostInfo($p_idx);
        $certainPostImageInfo = $this->camp_model->getCertainPostImageInfo($p_idx);
        $certainPostReplyInfo = $this->camp_model->getCertainPostReplyInfo($replyInfo);

        $arr = [];
        $temp = new stdClass();

        $temp->certainPostInfo = $certainPostInfo;
        $temp->certainPostImageInfo = $certainPostImageInfo;
        $temp->certainPostReplyInfo = $certainPostReplyInfo;

        $arr = $temp;
        echo json_encode($arr);
    }

    // 댓글 달기
    public function setCertainPostReply() {
        $postData = json_decode(file_get_contents("php://input"));
        $replyInfo['m_idx'] = $postData->replyInfo->m_idx;
        $replyInfo['p_idx'] = $postData->replyInfo->p_idx;
        $replyInfo['pr_content'] = $postData->replyInfo->content;

        $this->camp_model->setCertainPostReply($replyInfo);

        $replyInfo['pageNum'] = $postData->replyInfo->page;
        $result = $this->camp_model->getCertainPostReplyInfo($replyInfo);
        echo json_encode($result);
    }

    // 좋아요 체크
    public function setCertainPostGood() {
        $postData = json_decode(file_get_contents("php://input"));
        $goodInfo['p_idx'] = $postData->p_idx;
        $goodInfo['m_idx'] = $postData->m_idx;

        $arr = [];
        $temp = new stdClass();
        if ( $postData->modal == 0 ) {
            // 좋아요가 체크된 상태가 아니라면
            $this->camp_model->setCertainPostGood($goodInfo);
            $temp->msg = 1;
        } else {
            // 좋아요가 체크된 상태라면
            $this->camp_model->deleteCertainPostGood($goodInfo);
            $temp->msg = 0;
        }

        $arr = $temp;
        echo json_encode($arr);
    }

    // 현재 캠프에 가입을 요청한 회원의 정보를 가져온다.
    public function getJoinRequestInfo() {
        $postData = json_decode(file_get_contents("php://input"));
        $c_idx = $postData->c_idx;

        $result = $this->camp_model->getJoinRequestInfo($c_idx);
        echo json_encode($result);
    }

    // 현재 캠프의 가입 요청을 거절
    public function setJoinRefused() {
        $postData = json_decode(file_get_contents("php://input"));
        $m_idx = $postData->m_idx;
        $c_idx = $postData->c_idx;

        $this->camp_model->setJoinRequestRefused($m_idx);
        $result = $this->camp_model->getJoinRequestInfo($c_idx);
        echo json_encode($result);
    }

    // 현재 캠프의 가입 요청을 승인
    public function setJoinApprove() {
        $postData = json_decode(file_get_contents("php://input"));
        $m_idx = $postData->m_idx;
        $c_idx = $postData->c_idx;

        $this->camp_model->setJoinRequestApprove($m_idx);
        $result = $this->camp_model->getJoinRequestInfo($c_idx);
        echo json_encode($result);
    }
}