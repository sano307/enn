<?php
class postModel extends CI_Model{
  function __construct() {
      parent::__construct();
  }

    public function insertNewPostInfo( $argPostInfo, $argPostThumbInfo) {
        $argPostWriter = strip_tags($argPostInfo['writer']);
        $argPostCamp_idx = strip_tags($argPostInfo['c_idx']);
        $argPostContent = strip_tags($argPostInfo['content']);
        $argPostThumbName = strip_tags($argPostThumbInfo['name']);
        $argPostThumbExt = strip_tags($argPostThumbInfo['ext']);

        $sql = "SELECT m_idx FROM member WHERE m_nickname = '$argPostWriter'";
        $query = $this->db->prepare( $sql );
        $query->execute();
        $argPostWriterNum = $query->fetchColumn(0);

        $sql = "INSERT INTO post (m_idx,c_idx, p_content, p_registedTime, p_postThumbName, p_postThumbExt, p_postHits, p_postGoods) VALUES (:m_idx,:c_idx, :p_content, :p_registedTime, :p_postThumbName, :p_postThumbExt, :p_postHits, :p_postGoods)";
        $query = $this->db->prepare( $sql );
        $query->execute( array(':m_idx' => $argPostWriterNum,':c_idx'=> $argPostCamp_idx, ':p_content' => $argPostContent, ':p_registedTime' =>  date("Y-m-d H:i:s"), ':p_postThumbName' => $argPostThumbName, ':p_postThumbExt' => $argPostThumbExt, ':p_postHits' => 0, ':p_postGoods' => 0) );
        return $this->db->lastInsertId();
    }

    public function insertNewImageInfo( $argPostImageInfo ) {
        $argPostNum = (int)$argPostImageInfo['lastInsertId'];
        $argImageName = strip_tags($argPostImageInfo['name']);
        $argImageExt = strip_tags($argPostImageInfo['ext']);

        $sql = "INSERT INTO post_attach (p_idx, pa_postImgName, pa_postImgExt) VALUES (:p_idx, :pa_postImgName, :pa_postImgExt)";
        $query = $this->db->prepare( $sql );
        $query->execute( array(':p_idx' => $argPostNum, ':pa_postImgName' => $argImageName, ':pa_postImgExt' => $argImageExt) );
    }

    public function getMemberPostInfo( $argPostWriterm_idx ) {
        $argPostWriterNum = $argPostWriterm_idx;

        $sql = "SELECT p_idx, c_idx, p_postThumbName, p_postThumbExt, p_postHits, p_postGoods FROM post WHERE m_idx = {$argPostWriterNum}"."  order by p_idx desc limit 7";
        // $query = $this->db->prepare( $sql );
        // $query->execute();
        // return $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->db->query($sql)->row();
    }


}
