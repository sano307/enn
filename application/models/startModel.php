<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StartModel extends CI_Controller{
    function __construct( $db ) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('데이터베이스 연결에 오류가 발생했습니다.');
        }
    }

    public function getRegionOfNation( $selectedNation ) {
        $nation = strip_tags( $selectedNation );
        $sql = "SELECT nri_region FROM nation_region WHERE nri_nation = '$selectedNation'";
        $query = $this->db->prepare( $sql );
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getNewMemberNum() {
        $sql = "show table status like 'member'";
        $query = $this->db->prepare( $sql );
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function login( $argLoginMemberInfo ) {
        $memberID = strip_tags($argLoginMemberInfo['id']);
        $memberPasswd = strip_tags($argLoginMemberInfo['passwd']);
        $sql="SELECT m_idx, m_nickname FROM member WHERE m_memberID=:login_email&&m_memberPasswd=:login_password";
        $query=$this->db->prepare( $sql );
        $query->execute(array('login_email'=>$memberID,'login_password'=>$memberPasswd));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getMemberProfileInfo( $m_idx ) {
        $idx = (int)$m_idx;

        $sql = "SELECT m_profileThumbName, m_profileThumbExt FROM member WHERE m_idx = ".$m_idx;
        $query = $this->db->prepare( $sql );
        $query->execute();
        return $query->fetch();
    }

    public function insertMemberInfo_notProfileImage( $memberInfo ) {
        $idx = (int)$memberInfo['idx'];
        $id = strip_tags($memberInfo['id']);
        $passwd = strip_tags($memberInfo['passwd']);
        $nickname = strip_tags($memberInfo['nickname']);
        $nationally = strip_tags($memberInfo['nationally']);
        $region = strip_tags($memberInfo['region']);
        $sex = strip_tags($memberInfo['sex']);

        $sql = "INSERT INTO member (m_idx, m_memberID, m_memberPasswd, m_nickname, m_nationally, m_region, m_sex) VALUES (:idx, :memberID, :memberPasswd, :nickname, :nationally, :region, :sex)";
        $query = $this->db->prepare( $sql );
        $result['joinCheck'] = $query->execute( array(':idx' => $idx, ':memberID'  => $id, ':memberPasswd' => $passwd, ':nickname' => $nickname, ':nationally' => $nationally, ':region' => $region, ':sex' => $sex) );
        $result['lastInsertId'] = $this->db->lastInsertId();
        return $result;
    }

    public function insertMemberInfo_ProfileImage( $memberInfo, $profileImgInfo, $profileThumbInfo ) {
        $idx = (int)$memberInfo['idx'];
        $id = strip_tags($memberInfo['id']);
        $passwd = strip_tags($memberInfo['passwd']);
        $nickname = strip_tags($memberInfo['nickname']);
        $nationally = strip_tags($memberInfo['nationally']);
        $region = strip_tags($memberInfo['region']);
        $sex = strip_tags($memberInfo['sex']);
        $profileName = strip_tags($profileImgInfo['name']);
        $profileExt = strip_tags($profileImgInfo['ext']);
        $profileThumbName = strip_tags($profileThumbInfo['name']);
        $profileThumbExt = strip_tags($profileThumbInfo['ext']);

        $sql = "INSERT INTO member (m_idx, m_memberID, m_memberPasswd, m_nickname, m_nationally, m_region, m_sex, m_profileImgName, m_profileImgExt, m_profileThumbName, m_profileThumbExt) VALUES (:idx, :memberID, :memberPasswd, :nickname, :nationally, :region, :sex, :profileImgName, :profileImgExt, :profileThumbName, :profileThumbExt)";
        $query = $this->db->prepare( $sql );
        $result['joinCheck'] = $query->execute( array(':idx' => $idx, ':memberID'  => $id, ':memberPasswd' => $passwd, ':nickname' => $nickname, ':nationally' => $nationally, ':region' => $region, ':sex' => $sex, ':profileImgName' => $profileName, ':profileImgExt' => $profileExt, ':profileThumbName' => $profileThumbName, ':profileThumbExt' => $profileThumbExt) );
        $result['lastInsertId'] = $this->db->lastInsertId();
        return $result;
    }
}
