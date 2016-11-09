<?php
class userModel extends CI_Model{
    function __construct() {
        parent::__construct();

    }

    public function getLoginMemberInfo( $argLoginMemberNum ) {
        $m_idx = (int)$argLoginMemberNum;
        $sql = "SELECT * FROM member WHERE m_idx = {$m_idx}";

        return $this->db->query($sql)->result();
    }

    public function IsNickname( $inputNickname ) {
        $nickname = strip_tags( $inputNickname );
        $sql = "SELECT * FROM member WHERE m_nickname = '$nickname'";

        return $this->db->query($sql)->row_array();
    }
}