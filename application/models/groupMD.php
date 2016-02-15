<?php
class groupMD
{
   function __construct($db) {
      try {
         $this->db = $db;
      } catch (PDOException $e) {
         exit('데이터베이스 연결에 오류가 발생했습니다.');
      }
   }
   function group_info($detail_c_idx){
      $sql="select * from camp where c_idx=".$detail_c_idx;
      $query=$this->db->prepare($sql);   
      $query->execute();
      return $query->fetch();
   }
   function group_notice($detail_c_idx){
      $sql="select * from camp_notice where c_idx=".$detail_c_idx;
      $query=$this->db->prepare($sql);   
      $query->execute();
      return $query->fetchAll();
   }
   function group_post($detail_c_idx){
      $sql="select * from post where c_idx=".$detail_c_idx."  order by p_idx desc";
      $query=$this->db->prepare($sql);   
      $query->execute();
      return $query->fetchAll();
   }
   function group_select($region){
      $sql="SELECT c_idx,m_idx,c_campName,
      c_campIntroduction,c_campRegion,
      c_campTheNumber,c_campThumbName,
      c_campThumbExt from camp 
      WHERE c_campRegion='".$region."'";
      $query=$this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
   }
   function group_join_m_idx_checking($detail_c_idx,$m_idx){
      $sql="SELECT cm_joinStateCamp FROM camp_member where c_idx=$detail_c_idx&&m_idx=$m_idx&&cm_joinStateCamp=1";
      $query=$this->db->prepare($sql);   
      $query->execute();
      return $query->fetch();
   }
}