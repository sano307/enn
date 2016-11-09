<?php

class BuddyModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    // 친구 목록

    public function getBuddyList($argLoginMemberNum) {  // , $argRequestedMember
        $acceptedMemberNum = (int)$argLoginMemberNum;
        //$requestedMember = strip_tags($argRequestedMember);

        $sql = "select m.m_nickname, m.m_sex,m.m_nationally,m.m_region, m.m_profileImgName, m.m_profileImgExt ,b.b_request_m_idx, b.m_idx b_midx from member m, Buddy b where b.b_acceptanceStateBuddy = '1' and b.m_idx = $acceptedMemberNum and m.m_idx = b.b_request_m_idx";
        return $this->db->query($sql)->result();
    }

    public function getMyBuddyIdx( $m_idx ) {
        $m_idx = (int)$m_idx;
        $sql = "SELECT b_request_m_idx FROM buddy WHERE m_idx = $m_idx";
        return $this->db->query($sql)->result();
    }

    public function getMyBuddyInfo( $m_idx ) {
        $m_idx = (int)$m_idx;
        $sql = "SELECT m_idx, m_memberID, m_nickname FROM member WHERE m_idx = $m_idx and m_connectionState = 1";
        return $this->db->query($sql)->result();
    }

    // 신청받은 친구 목록
    public function getRequestBuddyList($argBuddySearchMemberNum)
    {
        $acceptedMemberNum = (int)$argBuddySearchMemberNum;

        $sql = "select m.m_nickname, b.m_idx b_midx, m.m_idx m_idx, b.b_idx, b.b_request_m_idx, m.m_region, m.m_connectionState, m.m_profileImgName, m.m_profileImgExt from Buddy b, member m where b.b_acceptanceStateBuddy = '0' and b.m_idx = {$acceptedMemberNum} and m.m_idx = b.b_request_m_idx";
        return $this->db->query($sql)->result();
    }

    // 신청받은 친구수락 혹은 거절
    public function addBuddy($argValue, $acceptNum, $b_idx, $request_idx)
    {
        if ($argValue == 1) {
            $sql = "update Buddy set b_acceptanceStateBuddy = 1 where m_idx = $acceptNum and b_idx = $b_idx";
            $this->db->query($sql);
            $sql = "insert into Buddy(m_idx, b_request_m_idx, b_acceptanceStateBuddy) values($request_idx, $acceptNum, '1')";
            $this->db->query($sql);
        } else {
            $sql = "delete from Buddy where b_idx = $b_idx";
            $this->db->query($sql);
        }
    }
    public function deleteBuddy($accept_idx, $request_idx)
    {
        $sql = "delete from buddy where (m_idx = $accept_idx and b_request_m_idx = $request_idx) or (m_idx = $request_idx and b_request_m_idx = $accept_idx)";
        $this->db->query($sql);
    }

    public function getSearchBuddyList($argBuddySearchInfo)
    {
        $searchNickname = strip_tags($argBuddySearchInfo['searchNickname']);
        $searchMemberNum = (int)$argBuddySearchInfo['searchMemberNum'];

        $sql = "select * from Member where m_idx != $searchMemberNum AND m_nickname like '$searchNickname'";
        return $this->db->query($sql)->result();
    }

    public function getSearchBuddyList_My($argBuddySearchInfo)
    {
        $searchNickname = strip_tags($argBuddySearchInfo['searchNickname_my']);
        $searchMemberNum = (int)$argBuddySearchInfo['m_idx'];

        $sql = "select m.m_idx m_idx, m.m_nickname, m.m_sex, m.m_profileImgName, m.m_profileImgExt, b.m_idx b_midx, b.b_request_m_idx from member m, buddy b where b.m_idx = $searchMemberNum and m.m_idx = b.b_request_m_idx and m.m_nickname like '%$searchNickname%'";
        return $this->db->query($sql)->result();
    }

    public function getMemberRegion($argValue)
    {
        $loginMemberNum = (int)$argValue;

        $sql = "select m_nationally, m_region from member where m_idx = $loginMemberNum";
        return $this->db->query($sql)->row_array(PDO::FETCH_ASSOC);
    }

    // 추천 친구 목록(국적이 다르고 지역이 같은 멤버 출력)
    public function getRecommendBuddyList($argMemberInfo)
    {
        $loginMemberNum = (int)$argMemberInfo['m_idx'];
        $loginMemberNation = strip_tags($argMemberInfo['m_nationally']);
        $loginMemberRegion = strip_tags($argMemberInfo['m_region']);

        $sql = "select * from member where m_idx != $loginMemberNum and m_nationally != '$loginMemberNation' order by m_idx desc limit 0,3";// and m_region = '$loginMemberRegion'
        return $this->db->query($sql)->result();
    }

    // 추천 친구 검색(국적이 다르고 지역이 같은 멤버 중 검색 키워드와 같은 멤버 출력)
    public function getSearchRecommendList($argValue)
    {
        $loginMemberNum = (int)$argValue['m_idx'];
        $loginMemberNation = strip_tags($argValue['m_nationally']);
        $loginMemberRegion = strip_tags($argValue['m_region']);
        $searchRecommend = strip_tags($argValue['searchRecommend']);

        $sql = "select * from member where m_idx != $loginMemberNum and m_nationally != '$loginMemberNation' and m_region = '$loginMemberRegion' and m_nickname like '$searchRecommend'";
        return $this->db->query($sql)->result();
    }

    // main페이지 새로운 친구 3명 출력
    public function getMainBuddyRecommend()
    {
        $sql = "select * from member order by m_idx desc limit 3";
        return $this->db->query($sql)->result();
    }

    public function IsBuddyCheck($requestedInfo, $acceptedInfo)
    {
      $requested_idx = $requestedInfo;
      $accepted_idx = $acceptedInfo;
        $sql = "SELECT * FROM buddy WHERE (m_idx = $accepted_idx AND b_request_m_idx = '$requested_idx') OR (m_idx = $requested_idx AND b_request_m_idx = '$accepted_idx')";
        return $this->db->query($sql)->result();
    }

    // 판단 후에, 두 회원간의 친구 요청이 없다면 친구 요청
    public function insertNewBuddyInfo($requestedInfo, $acceptedInfo)
    {
        $request_idx = $requestedInfo;
        $accepted_idx = $acceptedInfo;

        $sql = "INSERT INTO buddy (m_idx, b_request_m_idx, b_acceptanceStateBuddy) VALUES ($accepted_idx, $request_idx, '0')";
        $this->db->query($sql);
    }
}
