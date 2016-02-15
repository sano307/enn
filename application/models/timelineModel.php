<?php
class timelineModel {
	function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('데이터베이스 연결에 오류가 발생했습니다.');
        }
    }

    public function getMemberInfo( $m_idx ) {
        $idx = (int)$m_idx;

        $sql = "SELECT * FROM member WHERE m_idx = {$idx}";
        $query = $this->db->prepare( $sql );
        $query->execute();
        return $query->fetchAll();
    }

    public function getPostInfo( $m_idx ) {
		$idx = (int)$m_idx;

		$sql = "SELECT * FROM post WHERE m_idx= {$idx} order by p_idx desc";
        $query = $this->db->prepare( $sql );
        $query->execute();
        return $query->fetchAll();
    }

    public function getGroupInfo( $m_idx ) {
      $sql="select c.c_idx,c.m_idx,c_campName,c.c_campIntroduction,c.c_campRegion,c.c_campImgName,c.c_campImgExt,c.c_campThumbName,c.c_campThumbExt,c.c_campTheNumber
from camp c, camp_member cm
where c.c_idx=cm.c_idx && cm.m_idx=$m_idx && cm_joinStateCamp=1";
      $query=$this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
   }
}
