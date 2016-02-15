<?php
class userModel {
    function __construct( $db ) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('데이터베이스 연결에 오류가 발생했습니다.');
        }
    }

    public function getLoginMemberInfo( $argLoginMemberNum ) {
        $m_idx = (int)$argLoginMemberNum;
        $sql = "SELECT * FROM member WHERE m_idx = {$m_idx}";
        $query = $this->db->prepare( $sql );
        $query->execute();
        return $query->fetchAll();
    }

    public function IsNickname( $inputNickname ) {
        $nickname = strip_tags( $inputNickname );
        $sql = "SELECT * FROM member WHERE m_nickname = '$nickname'";
        $query = $this->db->prepare( $sql );
        $query->execute();
        return $query->fetch();
    }
}