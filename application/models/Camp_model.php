<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Camp_model extends CI_Model {
   function __construct() {
      parent::__construct();
   }

   public function getCampInfo( $m_idx ) {
      $campNumber = $this->db->get_where('Camp_member', array('m_idx' => $m_idx))->result();

      $row = [];
      foreach ( $campNumber as $row ) {
         $query = $this->db->get_where('Camp', array('c_idx' => $campNumber[0]->c_idx))->result();
         $row = $query[0];
      }

      return $row;
   }
}