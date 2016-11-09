<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends CI_Controller  {
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    // 포스트 작성
    public function post_write ( $m_idx ) {
        $this->load->model('postModel');
        $state = isset($_POST['state']) ? $_POST['state'] : null;
        $postInfo['m_idx'] = $m_idx;                    // 포스트를 작성한 회원번호
        $postInfo['p_title'] = $_POST['title'];        // 작성한 포스트의 제목
        $postInfo['p_content'] = $_POST['content'];   // 작성한 포스트의 내용
        $postImages = $_FILES['images'];                // 포스트에 업로드한 이미지들의 정보

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
            $save_path =  $_SERVER['DOCUMENT_ROOT'] . '/public/img/member/' . $postInfo['m_idx'] . '/' . $imageInfo[$iCount]['pa_postImgName'] . '.' . $imageInfo[$iCount]['pa_postImgExt'];
            move_uploaded_file($tmp_path, $save_path);
        }

        $writeInfo['m_idx'] = $postInfo['m_idx'];
        $writeInfo['c_idx'] = null;
        $writeInfo['p_title'] = $postInfo['p_title'];
        $writeInfo['p_content'] = $postInfo['p_content'];
        $writeInfo['p_postThumbName'] = $imageInfo[0]['pa_postImgName'];
        $writeInfo['p_postThumbExt'] = $imageInfo[0]['pa_postImgExt'];
        $writeInfo['p_postHits'] = 0;
        $writeInfo['p_postGoods'] = 0;

        $p_idx = $this->postModel->setMemberPost($writeInfo);

        $cnt = count($imageInfo);
        for ( $iCount = 0; $iCount < $cnt; $iCount++ ) {
            $imageInfo[$iCount]['p_idx'] = $p_idx;
            $this->postModel->setMemberPostImage($imageInfo[$iCount]);
        }

        if ( $state === 'timeline' ) {
            header("Location: /timeline/index/$m_idx");
        } else {
            header("Location: /main/index");
        }
    }

/*    // 포스트 작성
    public function post_writ( $m_idx ) {
        $this->load->model('postModel');

        $postInfo['m_idx'] = $m_idx;    // 포스트를 작성한 회원번호
        $postInfo['p_content'] = $_POST['postContent'];   // 작성한 포스트의 내용
        $postImages = $_FILES['postImages'];                        // 포스트에 업로드한 이미지들의 정보
        $postImageCount = count($postImages['name']);               // 포스트에 업로드한 이미지의 수

        $postThumbInfo['name'] = "";
        $postThumbInfo['ext'] = "";
        //c_idx는 그룹에서 쓴 글이 아니므로 1번
        if($postInfo['c_idx'] == null){
            $saveFolderName = $_SESSION['login_idx'];    // 포스트 작성자의 회원 고유 번호
            $saveFolderPath = "public/img/member/" . $saveFolderName . "/";      // 이미지가 저장되는 폴더 경로
        }else{ //그룹내에서 쓴 글
            $saveFolderName = $postInfo['c_idx'];    // 포스트 작성자의 회원 고유 번호
            $saveFolderPath = "public/img/camp/" . $saveFolderName . "/";      // 이미지가 저장되는 폴더 경로
        }
        $postRegistrationTimeInfo = date("Ymd_His", time());     // 포스트가 등록된 시간

        if ($postImages['error'][0] == 4) {
            // 이미지가 업로드 되지 않았을 경우

            // 작성한 포스트의 내용 중 20byte까지의 문자열을 잘라서 이미지대신 보여준다.
            // member->p_postThumbName에 넣어주고, member->p_postThumbExt는 0로 설정해준다.
            if (strlen($postInfo['content']) < 30) {
                $postThumbInfo['name'] = $postInfo['content'];
            } else {
                $postThumbInfo['name'] = substr($postInfo['content'], 0, 30) . "...";
            }

            $postThumbInfo['ext'] = 0;

            $this->postModel->insertNewPostInfo($postInfo, $postThumbInfo);
        } else {
            // 이미지가 업로드 됬을 경우
            for ( $iCount = 0; $iCount < $postImageCount; $iCount++ ) {
                $this->uploadImageErrorCheck($postImages['error'][$iCount]);
            }

            for ( $iCount = 0; $iCount < $postImageCount; $iCount++ ) {
                $postImageInfo[$iCount]['saveFolderName'] = $saveFolderName;
                $postImageInfo[$iCount]['saveFolderPath'] = $saveFolderPath;
                $postImageInfo[$iCount]['ext'] = pathinfo($postImages['name'][$iCount], PATHINFO_EXTENSION);
                $postImageInfo[$iCount]['name'] = $saveFolderName . "_" . $postRegistrationTimeInfo . "-" . str_pad($iCount + 1, 2, "0", STR_PAD_LEFT);
                $postImageInfo[$iCount]['tmp_name'] = $postImages['tmp_name'][$iCount];
                $postImageInfo[$iCount]['size'] = $postImages['size'][$iCount];
                $result = $this->IsImageCheck($postImageInfo[$iCount]);

                if ($result['check'] == 0) {
                    header("Location: /application/views/main/alert.php?error={$result['msg']}");
                    exit;
                }
            }

            for ( $iCount = 0; $iCount < $postImageCount; $iCount++ ) {
                $this->imageUploading($postImageInfo[$iCount]);
                if ( $iCount == 0 ) {
                    $postThumbInfo['open_name'] = $saveFolderPath . $saveFolderName . "_" . $postRegistrationTimeInfo . "-" . str_pad(1, 2, "0", STR_PAD_LEFT) . "." . $postImageInfo[$iCount]['ext'];
                    $postThumbInfo['ext'] = $postImageInfo[$iCount]['ext'];
                    $postThumbInfo['name'] = $saveFolderName . "_" . $postRegistrationTimeInfo . "_Thumb";
                    $postThumbInfo['saveFolderPath'] = $saveFolderPath . $postThumbInfo['name'] . "." . $postThumbInfo['ext'];

                    list($width, $height) = getimagesize($postThumbInfo['open_name']);
                    $newwidth = 200;
                    $newheight = 200;

                    $thumb = imagecreatetruecolor($newwidth, $newheight);

                    $source = "";
                    if ( $postImageInfo[$iCount]['ext'] == "jpg" || $postImageInfo[$iCount]['ext'] == "jpeg" ) { $source = imagecreatefromjpeg($postThumbInfo['open_name']); }
                    elseif ( $postImageInfo[$iCount]['ext'] == "png" ) { $source = imagecreatefrompng($postThumbInfo['open_name']); }
                    elseif ( $postImageInfo[$iCount]['ext'] == "gif" ) { $source = imagecreatefromgif($postThumbInfo['open_name']); }

                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                    if ( $postImageInfo[$iCount]['ext'] == "jpg" || $postImageInfo[$iCount]['ext'] == "jpeg" ) { imagejpeg($thumb, $postThumbInfo['saveFolderPath']); }
                    elseif ( $postImageInfo[$iCount]['ext'] == "png" ) { imagepng($thumb, $postThumbInfo['saveFolderPath']); }
                    elseif ( $postImageInfo[$iCount]['ext'] == "gif") { imagegif($thumb, $postThumbInfo['saveFolderPath']); }
                }
            }

            $lastInsertId = "";
            for ( $iCount = 0; $iCount < $postImageCount; $iCount++ ) {
                if ( $iCount == 0 ) {
                    $lastInsertId = $this->postModel->insertNewPostInfo($postInfo, $postThumbInfo,$c_idx);
                }

                $postImageInfo[$iCount]['lastInsertId'] = $lastInsertId;
                $this->postModel->insertNewImageInfo($postImageInfo[$iCount]);
            }
        }


        $getPostInfo = $this->postModel->getMemberPostInfo($_SESSION['login_idx']);
        $getNowMemberNum = $this->postModel->getPostWriterNum($_SESSION['login_nickname']);


            // 개인페이지에서 글을 썼을 경우
        header("Location: /timeline/index/".$_SESSION['login_idx']);
    }*/

    public function post_delete( $p_idx ){
        //  $detail_model = $this->loadModel('detail_timelineMD');
        $this->load->model('detail_timelineMD');

        $this->detail_timelineMD->deleteSpecificPostReplyInfo($p_idx);
        $this->detail_timelineMD->deleteSpecificPostImageInfo($p_idx);
        $this->detail_timelineMD->deleteSpecificPostInfo($p_idx);

        //  $postInfo = $detail_model->getSpecificPostInfo($p_idx);
        $postInfo = $this->detail_timelineMD->getSpecificPostInfo($p_idx);
        $postImageSaveFolderPath = "../public/img/member/$postInfo->m_idx/";

        // $postImageCount[0]에 포스트에 등록된 이미지의 카운트가 들어있음
        //  $postImageInfo = $detail_model->getSpecificPostImageInfo($p_idx);
        $postImageInfo = $this->detail_timelineMD->getSpecificPostImageInfo($p_idx);

        header('Location: /timeline/index/'.$_SESSION['login_idx']);
       /* foreach ( $postImageInfo as $row ) {
            $temp = $postImageSaveFolderPath . $postImageInfo->pa_postImgName . "." . $postImageInfo->pa_postImgExt;
            var_dump($temp);
        }*/
    }

    public function post_like( $p_idx ){
        $m_idx=$_SESSION['login_idx'];
        // $group_detail_model = $this->loadModel('detail_timelineMD');
        $this->load->model('detail_timelineMD');
        $this->detail_timelineMD->post_like($p_idx,$m_idx);

        header('location:'. URL .'/detail_timeline/index/'.$p_idx.'/'.$m_idx);
    }

    public function post_modify( $p_idx ){
        // $timeline_model = $this->loadModel('detail_timelineMD');
        $this->load->model('detail_timelineMD');
        $modify_post_info=$this->detail_timelineMD->getSpecificPostInfo( $p_idx );
        $modify_post_image=$this->detail_timelineMD->getSpecificPostImageInfo( $p_idx );

        // require 'application/views/_templates/header.php';
        // require 'application/views/timeline/detail_post_modify.php';
        // require 'application/views/_templates/footer.php';
        $this->load->view('timeline/detail_post_modify',array(
            'modify_post_info'=>$modify_post_info,
            'modify_post_image'=>$modify_post_image
        ));
    }

    public function post_modify_process( ) {
        $c_idx = $_POST['c_idx'];
        $post_update_p_idx=$_POST['p_idx'];
        $post_update_content=$_POST['content'];
        $postRegistrationTimeInfo = date("Ymd_His", time());
        $this->load->model('detail_timelineMD');
        $this->detail_timelineMD->post_update($post_update_p_idx,$post_update_content,$postRegistrationTimeInfo);

        header('location:'. URL .'/detail_timeline/index/'.$post_update_p_idx.'/'.$c_idx.'/'.$_SESSION['login_idx']);
    }

    public function post_search(){

    }

    public function post_search_result(){

    }
}
