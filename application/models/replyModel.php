<?php
class replyModel extends CI_Model{
function __construct() {
        parent::__construct();
    }
public function getReplyLIst( $replyNum ) {
        $p_idx = (int)$replyNum;
        // $sql = "select * from post_reply where p_idx = $p_idx order by pr_idx desc";
        $sql = "select m.m_nickname,pr.pr_idx,pr.m_idx,pr.p_idx,pr.pr_content,pr.pr_registedTime from post_reply pr,member m where pr.m_idx=m.m_idx && pr.p_idx = $p_idx order by pr.pr_idx desc";
        // $query = $this -> db -> prepare($sql);
        // $query -> execute();
        // return $query -> fetchAll();
        return $this->db->query($sql)->result();
    }
    public function reply_write( $argValue )
    {
        $m_idx = $argValue['m_idx'];
        $p_idx = $argValue['p_idx'];
        $replyContent = strip_tags($argValue['replyContent']);
        $sql = "insert into post_reply(m_idx, p_idx, pr_content) values($m_idx, $p_idx, '$replyContent')";
        return $this->db->query($sql);
    }
    public function reply_update( $argValue )
    {
        $pr_idx = (int)$argValue['pr_idx'];
        $Content = strip_tags($argValue['replyContent']);
        $sql = "update post_reply set pr_content = '$Content' where pr_idx = $pr_idx";
        $this->db->query($sql);
    }
    public function reply_delete( $argValue )
    {
        $pr_idx = $argValue;
        $sql = "delete from post_reply where pr_idx = $pr_idx";
        // $query = $this -> db -> prepare($sql);
        $this->db->query($sql);
    }
}
