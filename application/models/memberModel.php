<?php
class memberModel {
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('데이터베이스 연결에 오류가 발생했습니다.');
        }
    }

    public function updateMemberInfo_notProfileImage( $argMemberInfo ) {
        $idx = (int)$argMemberInfo['idx'];
        $nickname = strip_tags($argMemberInfo['nickname']);
        $passwd = strip_tags($argMemberInfo['password']);
        $region = strip_tags($argMemberInfo['region']);

        $sql = "UPDATE member SET m_nickname = :nickname, m_memberPasswd = :passwd, m_region = :region where m_idx = :idx";
        $query = $this->db->prepare( $sql );
        $query->execute( array(':idx' => $idx, ':nickname' => $nickname, ':passwd' => $passwd, ':region' => $region) );
    }

    public function updateMemberInfo_ProfileImage( $argMemberInfo, $argProfileImgInfo, $argProfileThumbInfo ) {
        $idx = (int)$argMemberInfo['idx'];
        $nickname = strip_tags($argMemberInfo['nickname']);
        $passwd = strip_tags($argMemberInfo['password']);
        $region = strip_tags($argMemberInfo['region']);
        $profileName = strip_tags($argProfileImgInfo['name']);
        $profileExt = strip_tags($argProfileImgInfo['ext']);
        $profileThumbName = strip_tags($argProfileThumbInfo['name']);
        $profileThumbExt = strip_tags($argProfileThumbInfo['ext']);

        $sql = "UPDATE member SET m_nickname = :nickname, m_memberPasswd = :passwd, m_region = :region, m_profileImgName = :profileImgName, m_profileImgExt = :profileImgExt, m_profileThumbName = :profileThumbName, m_profileThumbExt = :profileThumbExt where m_idx = :idx";
        $query = $this->db->prepare( $sql );
        $query->execute( array(':idx' => $idx, ':nickname' => $nickname, ':passwd' => $passwd, ':region' => $region, ':profileImgName' => $profileName, ':profileImgExt' => $profileExt, ':profileThumbName' => $profileThumbName, ':profileThumbExt' => $profileThumbExt) );
    }

    public function getPreviousProfileInfo( $argMemberInfo ) {
        $idx = (int)$argMemberInfo;

        $sql = "SELECT m_profileImgName, m_profileImgExt, m_profileThumbName, m_profileThumbExt FROM member WHERE m_idx = {$idx}";
        $query = $this->db->prepare( $sql );
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}