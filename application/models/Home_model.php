<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    // 나라 선택에 따른 지역 검색
    public function getRegion( $country ) {
        $sql = "SELECT nri_region FROM nation_region WHERE nri_nation = ?";
        return $this->db->query($sql, array($country))->result();
    }

    // 새로운 멤버 정보 입력
    public function setNewMember( $joinInfo ) {
        return $this->db->insert('Member', $joinInfo);
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
}