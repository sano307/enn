<?php

class detail_timelineMD
{
   function __construct($db) {
      try {
         $this->db = $db;
      } catch (PDOException $e) {
         exit('데이터베이스 연결에 오류가 발생했습니다.');
      }
   }

   public function getSpecificPostInfo( $post_idx ) {
      $idx = (int)$post_idx;

      $sql = "SELECT m.m_idx, m.m_nickname, m.m_profileImgName, m.m_profileImgExt, p.p_idx, p.c_idx, p.p_content, p.p_registedTime, p.p_postHits, p.p_postGoods FROM post p, member m WHERE p.m_idx = m.m_idx AND p_idx = {$idx}";
      $query = $this->db->prepare( $sql );
      $query->execute();
      return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getSpecificPostImageInfo( $post_idx ) {
        $idx = (int)$post_idx;

        $sql = "SELECT * FROM post_attach WHERE p_idx = {$idx}";
        $query = $this->db->prepare( $sql );
        $query->execute();
        return $query->fetchAll();
    }

    public function getSpecificPostReplyInfo( $post_idx ) {
         $idx = (int)$post_idx;

         $sql = "SELECT pr.pr_idx, pr.m_idx, pr.pr_content, pr.pr_registedTime, pr.p_idx, m.m_nickname, m.m_profileImgName, m.m_profileImgExt FROM post_reply pr, member m WHERE pr.m_idx = m.m_idx AND pr.p_idx = {$idx}";
         $query = $this->db->prepare( $sql );
         $query->execute();
         return $query->fetchAll();
    }

    public function post_update($post_update_p_idx,$post_update_content,$postRegistrationTimeInfo){
        $sql="UPDATE post SET p_content='$post_update_content',p_registedTime='$postRegistrationTimeInfo' where p_idx=$post_update_p_idx";
        $query = $this->db->prepare($sql);
        $query->execute();
    }


    function post_like_check($m_idx,$p_idx){
      $sql="SELECT * FROM post_goods where m_idx=$m_idx&&p_idx=$p_idx";
      $query = $this->db->prepare( $sql );
      $query->execute();
      return $query->fetch();
    }

   function post_like($p_idx,$m_idx){
      $sql="INSERT INTO post_goods VALUES($m_idx,$p_idx)";
      $query = $this->db->prepare($sql);
      $query->execute();
      $sql="UPDATE post SET p_postGoods=p_postGoods+1 where p_idx=$p_idx";
      $query = $this->db->prepare($sql);
      $query->execute();

   }

   function deleteSpecificPostReplyInfo( $post_idx ) {
      $idx = (int)$post_idx;

      $sql = "DELETE FROM post_reply WHERE p_idx = {$idx}";
      $query = $this->db->prepare($sql);
      $query->execute();
   }

   function deleteSpecificPostImageInfo( $post_idx ) {
      $idx = (int)$post_idx;

      $sql = "DELETE FROM post_attach WHERE p_idx = {$idx}";
      $query = $this->db->prepare($sql);
      $query->execute();
   }

   function deleteSpecificPostPostInfo( $post_idx ) {
      $idx = (int)$post_idx;

      $sql = "DELETE FROM post WHERE p_idx = {$idx}";
      $query = $this->db->prepare($sql);
      $query->execute();
   }

}
