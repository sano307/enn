<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Camp_model extends CI_Model {
   function __construct() {
      parent::__construct();
   }

   // 캠프으로 검색한 캠프를 리턴
   public function getSearchCamp( $campSearchInfo ) {
      $limit = 8;
      $offset = ($campSearchInfo['pageNum'] - 1) * $limit;

      $sql = "SELECT c.c_idx, c.m_idx, c.c_campName, c.c_campIntroduction, c.c_campCountry, c.c_campRegion, c.c_campImgName, c.c_campImgExt, count(*) as c_campMemberCount ";
      $sql .= "FROM camp c, camp_member cm ";
      $sql .= "WHERE c.c_idx = cm.c_idx ";
      $sql .= "AND c.c_campName = ? ";
      $sql .= "GROUP BY c.c_idx ";
      $sql .= "ORDER BY c.c_idx desc ";
      $sql .= "LIMIT " . $offset . ", " . $limit;

      $campListInfo = $this->db->query($sql, array($campSearchInfo['campName']))->result();

      foreach ( $campListInfo as $key => $value ) {
         $query = $this->db->get_where('camp_member', array('m_idx' => $campSearchInfo['m_idx'], 'c_idx' => $campListInfo[$key]->c_idx))->result();
         if ( !$query ) {
            $campListInfo[$key]->cm_joinStateCamp = '';
         } else {
            $campListInfo[$key]->cm_joinStateCamp = $query[0]->cm_joinStateCamp;
         }

         $sql = "SELECT count(*) as cm_theNumber FROM camp_member WHERE c_idx = {$campListInfo[$key]->c_idx}";
         $result = $this->db->query($sql)->result();
         $campListInfo[$key]->cm_theNumber = $result[0]->cm_theNumber;
      }

      return $campListInfo;
   }

   // 나라에 해당하는 캠프 리턴
   public function getCampByCountry( $campSearchInfo ) {
      $limit = 8;
      $offset = ($campSearchInfo['pageNum'] - 1) * $limit;

      $sql = "SELECT c.c_idx, c.m_idx, c.c_campName, c.c_campIntroduction, c.c_campCountry, c.c_campRegion, c.c_campImgName, c.c_campImgExt, count(*) as c_campMemberCount ";
      $sql .= "FROM camp c, camp_member cm ";
      $sql .= "WHERE c.c_idx = cm.c_idx ";
      $sql .= "AND c.c_campCountry = ? ";
      $sql .= "GROUP BY c.c_idx ";
      $sql .= "ORDER BY c.c_idx desc ";
      $sql .= "LIMIT " . $offset . ", " . $limit;

      $campListInfo = $this->db->query($sql, array($campSearchInfo['country']))->result();

      foreach ( $campListInfo as $key => $value ) {
         $query = $this->db->get_where('camp_member', array('m_idx' => $campSearchInfo['m_idx'], 'c_idx' => $campListInfo[$key]->c_idx))->result();
         if ( !$query ) {
            $campListInfo[$key]->cm_joinStateCamp = '';
         } else {
            $campListInfo[$key]->cm_joinStateCamp = $query[0]->cm_joinStateCamp;
         }

         $sql = "SELECT count(*) as cm_theNumber FROM camp_member WHERE c_idx = {$campListInfo[$key]->c_idx} AND cm_joinStateCamp = '1'";
         $result = $this->db->query($sql)->result();
         $campListInfo[$key]->cm_theNumber = $result[0]->cm_theNumber;
      }

      return $campListInfo;
   }

   // 지역에 해당하는 캠프 리턴
   public function getCampByRegion( $campSearchInfo ) {
      $limit = 8;
      $offset = ($campSearchInfo['pageNum'] - 1) * $limit;

      $sql = "SELECT c.c_idx, c.m_idx, c.c_campName, c.c_campIntroduction, c.c_campCountry, c.c_campRegion, c.c_campImgName, c.c_campImgExt, count(*) as c_campMemberCount ";
      $sql .= "FROM camp c, camp_member cm ";
      $sql .= "WHERE c.c_idx = cm.c_idx ";
      $sql .= "AND c.c_campRegion = ? ";
      $sql .= "GROUP BY c.c_idx ";
      $sql .= "ORDER BY c.c_idx desc ";
      $sql .= "LIMIT " . $offset . ", " . $limit;

      $campListInfo = $this->db->query($sql, array($campSearchInfo['region']))->result();

      foreach ( $campListInfo as $key => $value ) {
         $query = $this->db->get_where('camp_member', array('m_idx' => $campSearchInfo['m_idx'], 'c_idx' => $campListInfo[$key]->c_idx))->result();
         if ( !$query ) {
            $campListInfo[$key]->cm_joinStateCamp = '';
         } else {
            $campListInfo[$key]->cm_joinStateCamp = $query[0]->cm_joinStateCamp;
         }

         $sql = "SELECT count(*) as cm_theNumber FROM camp_member WHERE c_idx = {$campListInfo[$key]->c_idx} AND cm_joinStateCamp = '1'";
         $result = $this->db->query($sql)->result();
         $campListInfo[$key]->cm_theNumber = $result[0]->cm_theNumber;
      }

      return $campListInfo;
   }

   // 특정 캠프에 이미 신청이 진행중인지 확인
   public function IsCampMember( $memberInfo ) {
      $sql = "SELECT cm_joinStateCamp FROM camp_member WHERE m_idx = {$memberInfo['m_idx']} AND c_idx = {$memberInfo['c_idx']}";
      return $this->db->query($sql)->result();
   }

   // 특정 캠프에 새로운 멤버정보 입력
   public function setCampNewMember( $memberInfo ) {
      return $this->db->insert('camp_member', $memberInfo);
   }

   /* camp create */

   // 캠프명 중복 체크
   public function IsCampName( $campName ) {
      return $this->db->get_where('camp', array('c_campName' => $campName))->result();
   }

   // 새로운 캠프 생성
   public function setNewCamp( $campInfo ) {
      $this->db->insert('camp', $campInfo);
      return $this->db->insert_id();
   }

   // 특정 캠프에 회원 추가
   public function setNewCampMember( $campMemberInfo ) {
      $this->db->insert('camp_member', $campMemberInfo);
      return $this->db->insert_id();
   }

   // 현재 생성되어 있는 캠프를 지역별로 도출
   public function getWholeCampInfo() {
      $sql = "SELECT nri_nation, nri_region FROM nation_region";
      $regionInfo = $this->db->query($sql)->result();

      $cnt = count($regionInfo);
      for ( $iCount = 0; $iCount < $cnt; $iCount++ ) {
         $argRegion = $regionInfo[$iCount]->nri_region;
         $sql = "SELECT count(*) as c_campNumber FROM camp WHERE c_campRegion = '$argRegion'";
         $regionInfo[$iCount]->c_campNumber = $this->db->query($sql)->result();
      }

      return $regionInfo;
   }

   /* end of camp create */

   /* enter the camp */

   // 특정 캠프의 정보
   public function getCampInfo( $postInfo ) {
      return $this->db->get_where('camp', array('c_idx' => $postInfo['c_idx']))->result();
   }

   // 특정 캠프의 포스트 정보
   public function getCampPostInfo( $postInfo ) {
      $limit = 8;
      $offset = ($postInfo['pageNum'] - 1) * $limit;

      $this->db->order_by("p_idx", "desc");
      $this->db->limit($limit, $offset);
      return $this->db->get_where('post', array('c_idx' => $postInfo['c_idx']))->result();
   }

   // 특정 캠프의 포스트 작성
   public function setCampPost( $writeInfo ) {
      $this->db->set('p_registedTime', 'NOW()', false);
      $this->db->insert('post', $writeInfo);
      return $this->db->insert_id();
   }

   // 특정 캠프의 포스트에 등록된 이미지 정보 입력
   public function setCampPostImage( $writeImageInfo ) {
      $this->db->insert('post_attach', $writeImageInfo);
   }

   // 특정 포스트의 정보
   public function getCertainPostInfo( $p_idx ) {
      $sql = "SELECT * FROM member m, post p WHERE m.m_idx = p.m_idx AND p.p_idx = $p_idx";
      return $this->db->query($sql)->result();
   }

   // 특정 포스트의 이미지 정보
   public function getCertainPostImageInfo( $p_idx ) {
      return $this->db->get_where('post_attach', array('p_idx' => $p_idx))->result();
   }

   // 특정 포스트의 댓글 정보
   public function getCertainPostReplyInfo( $replyInfo ) {
      $limit = 8;
      $offset = ($replyInfo['pageNum'] - 1) * $limit;

      $sql = "SELECT * ";
      $sql .= "FROM member m, post_reply pr ";
      $sql .= "WHERE m.m_idx = pr.m_idx ";
      $sql .= "AND pr.p_idx = ? ";
      $sql .= "ORDER BY pr.pr_idx desc";

      return $this->db->query($sql, array($replyInfo['p_idx']))->result();
   }

   // 특정 포스트에 작성한 댓글
   public function setCertainPostReply( $writeReplyInfo ) {
      $this->db->set('pr_registedTime', 'now()', false);
      $this->db->insert('post_reply', $writeReplyInfo);
   }

   // 특정 포스트의 조회 수 +1
   public function setCertainPostHits( $p_idx ) {
      $sql = "UPDATE post SET p_postHits = p_postHits + 1 WHERE p_idx = $p_idx";
      $this->db->query($sql);
   }

   // 특정 포스트의 좋아요 추가
   public function setCertainPostGood( $goodInfo ) {
      $this->db->insert('post_goods', $goodInfo);

      $sql = "UPDATE post SET p_postGoods = p_postGoods + 1 WHERE p_idx = {$goodInfo['p_idx']}";
      $this->db->query($sql);
   }

   // 특정 포스트의 좋아요 삭제
   public function deleteCertainPostGood( $goodInfo ) {
      $this->db->delete('post_goods', array('p_idx' => $goodInfo['p_idx']));

      $sql = "UPDATE post SET p_postGoods = p_postGoods - 1 WHERE p_idx = {$goodInfo['p_idx']}";
      $this->db->query($sql);
   }

   // 특정 캠프에 가입을 요청한 회원정보
   public function getJoinRequestInfo( $c_idx ) {
      $result = $this->db->get_where('camp_member', array('c_idx' => $c_idx, 'cm_joinStateCamp' => '0'))->result();

      $memberInfo = [];
      $cnt = count($result);
      for ( $iCount = 0; $iCount < $cnt; $iCount++ ) {
         $temp = $this->db->get_where('member', array('m_idx' => $result[$iCount]->m_idx))->result();
         $memberInfo[$iCount] = $temp[0];
      }

      return $memberInfo;
   }

   // 특정 캠프에 가입 요청 정보를 거절
   public function setJoinRequestRefused( $m_idx ) {
      $this->db->delete('camp_member', array('m_idx' => $m_idx));
   }

   // 특정 캠프에 가입 요청 정보를 승인
   public function setJoinRequestApprove( $m_idx ) {
      $sql = "UPDATE camp_member SET cm_joinStateCamp = '1' WHERE m_idx = $m_idx";
      $this->db->query($sql);
   }

   /* end of enter the camp */

   /* my camp */

   // 현재 로그인한 유저의 캠프 정보
   public function getMyCampInfo( $m_idx ) {
      $myCampInfo = $this->db->get_where('camp_member', array('m_idx' => $m_idx, 'cm_joinStateCamp' => '1'))->result();

      $temp = [];
      $iCount = 0;
      foreach ( $myCampInfo as $key => $value ) {
         $temp[$iCount] = $this->db->get_where('camp', array('c_idx' => $myCampInfo[$key]->c_idx))->result();
         $iCount++;
      }

      return $temp;
   }

   /* end of my camp */
}