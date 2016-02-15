<?php
class DBConnection {
	function __construct($db) {
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('데이터베이스 연결에 오류가 발생했습니다.');
		}
	}
	 public function group_request($argValue, $argName, $argImg, $argRegion, $argLimitPerson, $argIntroduction) {
         $sql = "insert into camp(m_idx, c_campName, c_campImgName, c_campRegion, c_campTheNumber, c_campIntroduction) values(". $argValue .", '".$argName. "','', '" .$argRegion ."', " .$argLimitPerson .", '". $argIntroduction ."')";
         $query = $this -> db -> prepare($sql);
         $query -> execute();
      }
}