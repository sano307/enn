<?php

class BuddyModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    // 친구 목록
    public function getBuddyList( $argLoginMemberNum, $argRequestedMember ) {
    $acceptedMemberNum = (int)$argLoginMemberNum;
    $requestedMember = strip_tags($argRequestedMember);

    $sql = "select * from Buddy where b_acceptanceStateBuddy = 1 and (m_idx = $acceptedMemberNum or b_requestedMember = '$requestedMember')";
    return $this->db->query($sql) -> result();
}

    // 신청받은 친구 목록
    public function getRequestBuddyList( $argBuddySearchMemberNum ) {
        $acceptedMemberNum = (int)$argBuddySearchMemberNum;

        $sql = "select * from Buddy where b_acceptanceStateBuddy = '0' and m_idx = {$acceptedMemberNum}";
        return $this->db->query($sql) -> result();
    }

    // 신청받은 친구수락 혹은 거절
    public function addBuddy( $argValue, $acceptNum ) {
        if($argValue == 1) {
            $sql = "update Buddy set b_acceptanceStateBuddy = 1 where m_idx = $acceptNum";
            $this->db->query($sql);
        } else {
            $sql = "delete from Buddy where m_idx = $acceptNum";
            $this->db->query($sql);
        }
    }

    public function getSearchBuddyList( $argBuddySearchInfo ) {
        $searchNickname = strip_tags($argBuddySearchInfo['searchNickname']);
        $searchMemberNum = (int)$argBuddySearchInfo['searchMemberNum'];

        $sql = "select * from Member where m_idx != $searchMemberNum AND m_nickname like '$searchNickname'";
        return $this->db->query($sql) -> result();
    }

    public function getSearchBuddyList_My( $argBuddySearchInfo ) {
        $searchNickname = strip_tags($argBuddySearchInfo['searchNickname_my']);
        $searchMemberNum = (int)$argBuddySearchInfo['searchMemberNum'];

        $sql = "select * from buddy where m_idx = $searchMemberNum and b_requestedMember like '%$searchNickname%'";
        return $this->db->query($sql) -> result();
    }

    public function getMemberRegion( $argValue ) {
        $loginMemberNum = (int)$argValue;

        $sql = "select m_nationally, m_region from member where m_idx = $loginMemberNum";
        return $this->db->query($sql) -> row_array(PDO::FETCH_ASSOC);
    }

    // 추천 친구 목록(국적이 다르고 지역이 같은 멤버 출력)
    public function getRecommendBuddyList( $argMemberInfo ) {
        $loginMemberNum = (int)$argMemberInfo['m_idx'];
        $loginMemberNation = strip_tags($argMemberInfo['m_nationally']);
        $loginMemberRegion = strip_tags($argMemberInfo['m_region']);

        $sql = "select * from member where m_idx != $loginMemberNum and m_nationally != '$loginMemberNation' and m_region = '$loginMemberRegion'";
        return $this->db->query($sql) -> result();
    }

    // 추천 친구 검색(국적이 다르고 지역이 같은 멤버 중 검색 키워드와 같은 멤버 출력)
    public function getSearchRecommendList( $argValue ) {
        $loginMemberNum = (int)$argValue['m_idx'];
        $loginMemberNation = strip_tags($argValue['m_nationally']);
        $loginMemberRegion = strip_tags($argValue['m_region']);
        $searchRecommend = strip_tags($argValue['searchRecommend']);

        $sql = "select * from member where m_idx != $loginMemberNum and m_nationally != '$loginMemberNation' and m_region = '$loginMemberRegion' and m_nickname like '$searchRecommend'";
        return $this->db->query($sql) -> result();
    }

    // main페이지 새로운 친구 3명 출력
    public function getMainBuddyRecommend() {
        $sql = "select * from member order by m_idx desc limit 3";
        return $this->db->query($sql)->result();
    }

    public function IsBuddyCheck( $requestedInfo, $acceptedInfo ) {
        $requested_idx = (int)$requestedInfo['idx'];
        $requested_nickname = strip_tags($requestedInfo['nickname']);
        $accepted_idx = (int)$acceptedInfo['idx'];
        $accepted_nickname = strip_tags($acceptedInfo['nickname']);

        $sql = "SELECT * FROM buddy WHERE (m_idx = $accepted_idx AND b_requestedMember = '$requested_nickname') OR (m_idx = $requested_idx AND b_requestedMember = '$accepted_nickname')";
        return $this->db->query($sql) -> result();
    }

    // 판단 후에, 두 회원간의 친구 요청이 없다면 친구 요청
    public function insertNewBuddyInfo( $requestedInfo, $acceptedInfo ) {
        $requested_nickname = $requestedInfo;
        $accepted_idx = $acceptedInfo;

        $sql = "INSERT INTO buddy (m_idx, b_requestedMember, b_acceptanceStateBuddy) VALUES (:m_idx, :b_requestedMember, :b_acceptanceStateBuddy)";
        $this->db->query($sql, array(':m_idx' =>$accepted_idx,':b_requestedMember'=>$requested_nickname,':b_acceptanceStateBuddy'=>'0' ));
    }
}
