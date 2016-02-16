<?php

class masterModel  extends CI_Model{
    function __construct($db) {
        parent::__construct();

    }

    public function memberSearchList( $argValue ) {
        $sql = "select * from member where m_nickname like '%". strval($argValue) ."%'";
        $query = $this -> db -> prepare($sql);
        $query -> execute();
        return $query -> fetchAll();
    }

    public function campSearchList( $argValue ) {
        $sql = "select * from camp where c_campName like '%". strval($argValue) ."%'";
        $query = $this -> db -> prepare($sql);
        $query -> execute();
        return $query -> fetchAll();
    }

    public function postSearchList( $argValue ) {
        $sql = "select * from post where p_content like '%". strval($argValue) ."%'";
        $query = $this -> db -> prepare($sql);
        $query -> execute();
        return $query -> fetchAll();
    }

    // 삭제할 멤버와 관련된 모든 테이블의 정보를 삭제한다.
    public function memberDeleteInfo( $memberNum ) {
        $sql = "delete from post_goods where m_idx = $memberNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from post_attach where p_idx in (select p_idx from post where m_idx = $memberNum)";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from post_reply where m_idx = $memberNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from post where m_idx = $memberNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from buddy where m_idx = $memberNum or b_requestedMember like (select m_nickname from member where m_idx = $memberNum)";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from camp_notice where c_idx in (select c_idx from camp where m_idx = $memberNum)";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from camp_member where m_idx = $memberNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from camp where m_idx = $memberNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from member where m_idx = $memberNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();
    }

    // camp 삭제 시 camp에 작성된 포스트와 포스트에 해당하는 이미지, 댓글을 같이 삭제
    public function campDeleteInfo( $campNum ) {
        $sql = "delete from post_goods where p_idx = (select p_idx from post where c_idx = $campNum)";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from post_attach where p_idx in (select p_idx from post where c_idx = $campNum)";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from post_reply where p_idx in (select p_idx from post where c_idx = $campNum)";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from post where c_idx = $campNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from camp_notice where c_idx = $campNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from camp_member where c_idx = $campNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from camp where c_idx = $campNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();
    }

    // 포스트 삭제 시 해당 포스트에 등록된 이미지와 댓글을 같이 삭제
    public function postDeleteInfo( $postNum ) {
        $sql = "delete from post_goods where p_idx = $postNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from post_attach where p_idx = $postNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from post_reply where p_idx = $postNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();

        $sql = "delete from post where p_idx = $postNum";
        $query = $this -> db -> prepare($sql);
        $query -> execute();
    }

    public function masterNoticeInsertInfo( $master_idx, $noticeTitle, $noticeContent ) {
        $masterNum = (int)$master_idx;
        $Title = strip_tags($noticeTitle);
        $Content = strip_tags($noticeContent);

        $sql = "insert into admin_notice(a_idx, n_noticeTitle, n_noticeContent) values($masterNum, '$Title', '$Content')";
        $query = $this -> db -> prepare($sql);
        $query -> execute();
    }

    public function masterNoticeList( ) {
        $sql = "select * from admin_notice";
        $query = $this -> db -> prepare($sql);
        $query -> execute();
        return $query -> fetchAll();
    }
}
