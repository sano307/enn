<?php
class detail_timelineMD extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

   public function getSpecificPostInfo( $p_idx ) {
       $p_idx = (int)$p_idx;

      $sql = "SELECT m.m_idx, m.m_nickname, m.m_profileImgName, m.m_profileImgExt, p.p_idx, p.c_idx, p.p_content, p.p_registedTime, p.p_postHits, p.p_postGoods FROM post p, member m WHERE p.m_idx = m.m_idx AND p_idx = {$p_idx}";
      return $this->db->query($sql)->row();
    }

    public function getSpecificPostImageInfo( $post_idx ) {
        $idx = (int)$post_idx;

        $sql = "SELECT * FROM post_attach WHERE p_idx = {$idx}";
        // $query = $this->db->prepare( $sql );
        // $query->execute();
        // return $query->fetchAll();
        return $this->db->query($sql)->result();
    }

    public function getSpecificPostReplyInfo( $post_idx ) {
         $idx = (int)$post_idx;

         $sql = "SELECT pr.pr_idx, pr.m_idx, pr.pr_content, pr.pr_registedTime, pr.p_idx, m.m_nickname, m.m_profileImgName, m.m_profileImgExt FROM post_reply pr, member m WHERE pr.m_idx = m.m_idx AND pr.p_idx = {$idx}";
        //  $query = $this->db->prepare( $sql );
        //  $query->execute();
        //  return $query->fetchAll();
        return $this->db->query($sql)->result();
    }

    public function post_update($post_update_p_idx,$post_update_content,$postRegistrationTimeInfo){
        $sql="UPDATE post SET p_content='$post_update_content',p_registedTime='$postRegistrationTimeInfo' where p_idx=$post_update_p_idx";
        // $query = $this->db->prepare($sql);
        // $query->execute();
        return $this->db->query($sql);
    }


    function post_like_check($m_idx,$p_idx){
      $sql="SELECT * FROM post_goods where m_idx=$m_idx&&p_idx=$p_idx";
      // $query = $this->db->prepare( $sql );
      // $query->execute();
      // return $query->fetch();
      return $this->db->query($sql)->result();
    }

   function post_like($p_idx,$m_idx){
      $sql="INSERT INTO post_goods VALUES($m_idx,$p_idx)";
      // $query = $this->db->prepare($sql);
      // $query->execute();
      $this->db->query($sql);
      $sql="UPDATE post SET p_postGoods=p_postGoods+1 where p_idx=$p_idx";
      // $query = $this->db->prepare($sql);
      // $query->execute();
      $this->db->query($sql);

   }

   function deleteSpecificPostReplyInfo( $post_idx ) {
      $idx = (int)$post_idx;

      $sql = "DELETE FROM post_reply WHERE p_idx = {$idx}";
      // $query = $this->db->prepare($sql);
      // $query->execute();
      $this->db->query($sql);
   }

   function deleteSpecificPostImageInfo( $post_idx ) {
      $idx = (int)$post_idx;

      $sql = "DELETE FROM post_attach WHERE p_idx = {$idx}";
      // $query = $this->db->prepare($sql);
      // $query->execute();
      $this->db->query($sql);
   }

   function deleteSpecificPostInfo( $post_idx ) {
      $idx = (int)$post_idx;

      $sql = "DELETE FROM post WHERE p_idx = {$idx}";
      // $query = $this->db->prepare($sql);
      // $query->execute();
      $this->db->query($sql);
   }

}
