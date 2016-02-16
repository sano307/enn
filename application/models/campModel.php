<?php
class campModel extends CI_Model{
  function __construct() {
      parent::__construct();
  }


    function camp_my($c_idx){ //select m.m_idx, m.c_idx, c.c_campName, c.c_campImgName, c.c_campImgExt from camp c,camp_member m where m.c_idx = c.c_idx and m.m_idx = 17;
        $sql = "select c.c_campName, c.c_campImgName, c.c_campImgExt, c.c_campThumbName, c.c_campThumbExt from camp c,camp_member m where m.c_idx = c.c_idx and m.m_idx =".$c_idx;
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function insertGroupLeader($m_idx,$c_idx){
        $sql = "INSERT INTO camp_member(m_idx,c_idx,cm_joinStateCamp) values (:m_idx, :c_idx, :cm_joinStateCamp)";
        $query = $this -> db -> prepare($sql);
        $query -> execute(array(":m_idx" => $m_idx, ":c_idx" => $c_idx, ":cm_joinStateCamp" => '1'));
    }

    public function getNewCreateCampNum() {
        $sql = "show table status like 'camp'";
        $query = $this->db->prepare( $sql );
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function group_request( $argCreateGroupInfo ) {
        $leader = (int)$argCreateGroupInfo['leader'];
        $campName = strip_tags($argCreateGroupInfo['name']);
        $campIntroduction = strip_tags($argCreateGroupInfo['introduction']);
        $campRegion = strip_tags($argCreateGroupInfo['region']);
        $campTheNumber = (int)$argCreateGroupInfo['number'];

        $sql = "INSERT INTO camp(m_idx, c_campName, c_campIntroduction, c_campRegion, c_campTheNumber) values (:leader, :campName, :campIntroduction, :campRegion, :campTheNumber)";
        $query = $this -> db -> prepare($sql);
        $query -> execute(array(":leader" => $leader, ":campName" => $campName, ":campIntroduction" => $campIntroduction, ":campRegion" => $campRegion, ":campTheNumber" => $campTheNumber));
    }

    public function insertNewGroupInfo_ProfileImage( $argCreateGroupInfo, $argCreateGroupProfileInfo, $argCreateGroupThumbInfo ) {
        $leader = (int)$argCreateGroupInfo['leader'];
        $campName = strip_tags($argCreateGroupInfo['name']);
        $campIntroduction = strip_tags($argCreateGroupInfo['introduction']);
        $campRegion = strip_tags($argCreateGroupInfo['region']);
        $campProfileName = strip_tags($argCreateGroupProfileInfo['name']);
        $campProfileExt = strip_tags($argCreateGroupProfileInfo['ext']);
        $campThumbName = strip_tags($argCreateGroupThumbInfo['name']);
        $campThumbExt = strip_tags($argCreateGroupThumbInfo['ext']);
        $campTheNumber = (int)$argCreateGroupInfo['number'];

        $sql = "INSERT INTO camp (m_idx, c_campName, c_campIntroduction, c_campRegion, c_campImgName, c_campImgExt, c_campThumbName, c_campThumbExt, c_campTheNumber) values (:leader, :campName, :campIntroduction, :campRegion, :campImgName, :campImgExt, :campThumbName, :campThumbExt, :campTheNumber)";
        $query = $this -> db -> prepare($sql);
        $query -> execute(array(":leader" => $leader, ":campName" => $campName, ":campIntroduction" => $campIntroduction, ":campRegion" => $campRegion, ":campImgName" => $campProfileName, ":campImgExt" => $campProfileExt, ":campThumbName" => $campThumbName, ":campThumbExt" => $campThumbExt, ":campTheNumber" => $campTheNumber));
        return $this->db->lastInsertId();
    }

    public function insertNewGroupInfo_notProfileImage( $argCreateGroupInfo ) {
        $leader = (int)$argCreateGroupInfo['leader'];
        $campName = strip_tags($argCreateGroupInfo['name']);
        $campIntroduction = strip_tags($argCreateGroupInfo['introduction']);
        $campRegion = strip_tags($argCreateGroupInfo['region']);
        $campTheNumber = (int)$argCreateGroupInfo['number'];

        $sql = "INSERT INTO camp (m_idx, c_campName, c_campIntroduction, c_campRegion, c_campTheNumber) values (:leader, :campName, :campIntroduction, :campRegion, :campTheNumber)";
        $query = $this -> db -> prepare($sql);
        $query -> execute(array(":leader" => $leader, ":campName" => $campName, ":campIntroduction" => $campIntroduction, ":campRegion" => $campRegion, ":campTheNumber" => $campTheNumber));
        return $this->db->lastInsertId;
    }

    public function insertNewGroupMemberInfo( $groupMemberInfo ) {
        $m_idx = (int)$groupMemberInfo['m_idx'];
        $c_idx = (int)$groupMemberInfo['c_idx'];

        $sql = "INSERT INTO camp_member (m_idx, c_idx, cm_joinStateCamp) VALUES (:m_idx, :c_idx, :cm_joinStateCamp)";
        $query = $this->db->prepare( $sql );
        $query->execute(array(':m_idx' => $m_idx, ':c_idx' => $c_idx, ':cm_joinStateCamp' => '1'));
    }

    public function getMainGroupRecommend(){
        $sql = "select * from camp order by c_idx desc limit 5";
        // $query = $this->db->prepare($sql);
        // $query->execute();
        // return $query->fetchAll();
        return $this->db->query($sql)->result();
    }
}
