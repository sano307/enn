<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    // 나라 선택에 따른 지역 검색
    public function getRegion( $country ) {
        $sql = "SELECT nri_region FROM nation_region WHERE nri_nation = ?";
        return $this->db->query($sql, array($country))->result();
    }
}