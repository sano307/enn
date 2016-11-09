<?php
class timelineModel extends CI_Model{
    function __construct() {
        parent::__construct();
    }

    // 현재 타임라인 회원의 정보
    public function getMemberInfo( $m_idx ) {
        $idx = (int)$m_idx;
        $sql = "SELECT * FROM member WHERE m_idx = {$idx}";
        return $this->db->query($sql)->result();
    }

    // 현재 타임라인 회원의 포스트 정보
    public function getPostInfo($m_idx,$page,$limit) {
        $idx = (int)$m_idx;
        $start = ($page * $limit) - $limit;
        $sql = "SELECT * FROM post WHERE m_idx= {$idx} order by p_idx desc LIMIT {$start}, {$limit}";
        return $this->db->query($sql)->result();
    }

    // 현재 타임라인 회원의 그룹 정보
    public function getGroupInfo( $m_idx ) {
        $sql = "SELECT c.c_idx,c.m_idx,c_campName,c.c_campIntroduction,c.c_campRegion,c.c_campImgName,c.c_campImgExt ";
        $sql .= "FROM camp c, camp_member cm ";
        $sql .= "WHERE c.c_idx = cm.c_idx && cm.m_idx = ? && cm_joinStateCamp = 1";
        return $this->db->query($sql, array('cm.m_idx' => $m_idx))->result();
   }
}
