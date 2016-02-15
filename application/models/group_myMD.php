<?php
 
class group_myMD
{
   function __construct($db) {
      try {
         $this->db = $db;
      } catch (PDOException $e) {
         exit('데이터베이스 연결에 오류가 발생했습니다.');
      }
   }

   function group_my_select($logining_m_idx){
      $sql="select c.c_idx,c.m_idx,c_campName,c.c_campIntroduction,c.c_campRegion,c.c_campImgName,c.c_campImgExt,c.c_campThumbName,c.c_campThumbExt,c.c_campTheNumber 
from camp c, camp_member cm 
where c.c_idx=cm.c_idx && cm.m_idx=".$logining_m_idx." && cm.cm_joinStateCamp=1";
      $query=$this->db->prepare($sql);
      $query->execute();
      return $query->fetchAll();
   }

   function group_request($c_idx,$m_idx){
      $sql="INSERT into camp_member  VALUES('',$m_idx,$c_idx,'1')";
      $query=$this->db->prepare($sql);
      $query->execute();
   }

   function group_my_bye($bye_g_idx,$m_idx){
      //자신이 쓴 댓글 삭제
      // 자신이 캠프에 쓴 글의 댓글 삭제
      // 자신이 쓴 포스트의 이미지 삭제
      // 자신이 쓴 포스트 삭제
      //캠프회원정보 삭제

      $sql="DELETE FROM camp 
      WHERE c_idx=$bye_g_idx && m_idx=$m_idx";
      $query=$this->db->prepare($sql);
      $query->execute();
   }
}