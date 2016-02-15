<?php
class group_new extends Controller {
    public function index() {
        require 'application/views/_templates/header.php';
        require 'application/views/group_new/index.php';
        require 'application/views/_templates/footer.php';
    }

    public function add() {
        if($_POST['korea']=='null'){
            $region=$_POST['japan'];
        }
        else{
            $region=$_POST['korea'];
        }

        if (!$_POST["campName"] || (!$_POST['korea']||!$_POST['japan'])) {
            echo "<script>alert('필수항목의 작성이 되지 않았습니다.')</script>";
            echo "<script>location.replace('/new_group/index')</script>";
        } else {
            $createCampInfo['leader'] = $_SESSION['login_idx'];
            $createCampInfo['name'] = isset($_POST['campName']) ? $_POST['campName'] : null;
            $createCampInfo['introduction'] = isset($_POST['campIntroduction']) ? $_POST['campIntroduction'] : null;
            $createCampInfo['region'] = $region;
            $createCampInfo['number'] = isset($_POST['campLimitPerson']) ? $_POST['campLimitPerson'] : null;

            $campImg = $_FILES['campImg'];

            $camp_model = $this->loadModel('campModel');
            $saveFolderName = $camp_model->getNewCreateCampNum();
            $saveFolderName = $saveFolderName['Auto_increment'];
            $saveFolderPath = "public/img/camp/" . $saveFolderName . "/";
            $this->createDirectory($saveFolderPath);
            $createGroupTimeInfo = date("Ymd_His", time());

            if ($campImg['error'] != 4) {
                // 파일을 전송했을 경우
                if ($campImg['error'] == 0) {
                    // 용량, 전체 전송, 임시 폴더 유무, 디스크에 파일 쓰기 유무, 확장에 의한 중지 유무를 통과했을 경우
                    $groupImgInfo['saveFolderName'] = $saveFolderName;
                    $groupImgInfo['saveFolderPath'] = $saveFolderPath;
                    $groupImgInfo['ext'] = pathinfo($campImg['name'], PATHINFO_EXTENSION);
                    $groupImgInfo['name'] = $saveFolderName . "_" . $createGroupTimeInfo;
                    $groupImgInfo['tmp_name'] = $campImg['tmp_name'];
                    $groupImgInfo['size'] = $campImg['size'];
                    $result = $this->IsImageCheck($groupImgInfo);

                    if ($result['check'] == 0) {
                        header("Location: /application/views/common/imageUploadError.php?error={$result['msg']}");
                        exit;
                    }

                    $this->imageUploading($groupImgInfo);
                    $resizeImageInfo['open_name'] = $groupImgInfo['saveFolderPath'] . $groupImgInfo['name'] . "." . $groupImgInfo['ext'];
                    $resizeImageInfo['ext'] = $groupImgInfo['ext'];
                    $resizeImageInfo['name'] = $groupImgInfo['name'] . "_Profile";
                    $resizeImageInfo['saveFolderPath'] = $groupImgInfo['saveFolderPath'] . $resizeImageInfo['name'] . "." . $resizeImageInfo['ext'];
                    $groupProfileInfo = $this->imageResization($resizeImageInfo, 200, 200);

                    $resizeImageInfo['open_name'] = $groupImgInfo['saveFolderPath'] . $groupImgInfo['name'] . "." . $groupImgInfo['ext'];
                    $resizeImageInfo['ext'] = $groupImgInfo['ext'];
                    $resizeImageInfo['name'] = $groupImgInfo['name'] . "_Thumb";
                    $resizeImageInfo['saveFolderPath'] = $groupImgInfo['saveFolderPath'] . $resizeImageInfo['name'] . "." . $resizeImageInfo['ext'];
                    $groupThumbInfo = $this->imageResization($resizeImageInfo, 100, 100);

                    $temp = $groupImgInfo['saveFolderPath'] . $groupImgInfo['name'] . "." . $groupImgInfo['ext'];
                    unlink($temp);

                    $c_idx = $camp_model->insertNewGroupInfo_ProfileImage($createCampInfo,$groupProfileInfo, $groupThumbInfo);

                    // 그룹장을 그룹 회원 테이블에 입력
                    $campMemberInfo['m_idx'] = $_SESSION['login_idx'];
                    $campMemberInfo['c_idx'] = $c_idx;
                    $camp_model->insertNewGroupMemberInfo($campMemberInfo);
                    $campLeaderNum = $campMemberInfo['m_idx'];

                    header("Location: /group_my/index/$campLeaderNum");
                } else {
                    // 위의 조건을 만족하지 않아서 통과하지 못했을 경우
                    $this->uploadImageErrorCheck($campImg['error']);
                    header("Location: /group_new/index");
                }
            } else {
                // 파일을 전송하지 않았을 경우
                $c_idx = $camp_model->insertNewGroupInfo_notProfileImage($createCampInfo);

                // 그룹장을 그룹 회원 테이블에 입력
                $campMemberInfo['m_idx'] = $_SESSION['login_idx'];
                $campMemberInfo['c_idx'] = $c_idx;
                $camp_model->insertNewGroupMemberInfo($campMemberInfo);
                $campLeaderNum = $campMemberInfo['m_idx'];

                header("Location: /group_my/index/$campLeaderNum");
            }
        }
    }
}