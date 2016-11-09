<?php
class postModel extends CI_Model{
  function __construct() {
      parent::__construct();
  }

    // 메인페이지나 타임라인에서 포스트를 작성시 정보 입력
    public function setMemberPost( $writeInfo ) {
        $this->db->set('p_registedTime', 'NOW()', false);
        $this->db->insert('post', $writeInfo);
        return $this->db->insert_id();
    }

    // 메인페이지나 타임라인에서 포스트를 작성시 이미지 정보 입력
    public function setMemberPostImage( $writeImageInfo ) {
        $this->db->insert('post_attach', $writeImageInfo);
    }

    public function insertNewPostInfo( $argPostInfo, $argPostThumbInfo) {
        $argPostWriter = (int)$argPostInfo['writer'];
        $argPostContent = strip_tags($argPostInfo['content']);
        $argPostThumbName = strip_tags($argPostThumbInfo['name']);
        $argPostThumbExt = strip_tags($argPostThumbInfo['ext']);

        /*$sql = "SELECT m_idx FROM member WHERE m_nickname = '$argPostWriter'";
        // $query = $this->db->prepare( $sql );
        // $query->execute();
        // $argPostWriterNum = $query->fetchColumn(0);
        $argPostWriterNum = $this->db->query($sql)->row_array();*/

        $sql = "INSERT INTO post (m_idx,c_idx, p_content, p_postThumbName, p_postThumbExt, p_postHits, p_postGoods) VALUES ($argPostWriter, null, '$argPostContent', '$argPostThumbName', '$argPostThumbExt', 0, 0)";
        $this->db->query($sql);
        return $this->db->insert_Id();
    }

    public function insertNewImageInfo( $argPostImageInfo ) {
        $argPostNum = (int)$argPostImageInfo['lastInsertId'];
        $argImageName = strip_tags($argPostImageInfo['name']);
        $argImageExt = strip_tags($argPostImageInfo['ext']);

        $sql = "INSERT INTO post_attach (p_idx, pa_postImgName, pa_postImgExt) VALUES ($argPostNum, $argImageName, $argImageExt)";
        $this->db->query($sql);
    }

    public function getMemberPostInfo( $argPostWriterm_idx ) {
        $argPostWriterNum = $argPostWriterm_idx;

        $sql = "SELECT * FROM post WHERE m_idx = {$argPostWriterNum}"."  order by p_idx desc limit 7";
        // $query = $this->db->prepare( $sql );
        // $query->execute();
        // return $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->db->query($sql)->result();
    }



}
