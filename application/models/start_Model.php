<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Start_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    // 전체 지역 검색
    public function getWholeRegion() {
        $sql = "SELECT nri_region FROM nation_region";
        return $this->db->query($sql)->result();
    }

    // 나라 선택에 따른 지역 검색
    public function getRegion( $country ) {
        $sql = "SELECT nri_region FROM nation_region WHERE nri_nation = ?";
        return $this->db->query($sql, array($country))->result();
    }

    // 새로운 멤버 정보 입력
    public function setNewMember( $joinInfo ) {
        $this->db->insert('Member', $joinInfo);
        return $this->db->insert_id();
    }

    // 아이디와 비밀번호 체크
    public function IsMember( $loginInfo ) {
        return $this->db->get_where('Member', array('m_memberID' => $loginInfo['m_memberID'], 'm_memberPasswd' => $loginInfo['m_memberPasswd']))->result();
    }

    // 아이디 체크
    public function IsMemberId( $email ) {
        return $this->db->get_where('Member', array('m_memberID' => $email))->result();
    }

    // 닉네임 체크
    public function IsMemberNickname( $nickname ) {
        return $this->db->get_where('Member', array('m_nickname' => $nickname))->result();
    }

    // 로그인된 상태로 업데이트
    public function currentConnect( $login_idx ) {
        $sql = "UPDATE member SET m_connectionState = 1 WHERE m_idx = $login_idx";
        $this->db->query($sql);
    }

    // 로그아웃된 상태로 업데이트
    public function currentDisconnect( $login_idx ) {
        $sql = "UPDATE member SET m_connectionState = 0 WHERE m_idx = $login_idx";
        $this->db->query($sql);
    }
}