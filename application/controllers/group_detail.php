<?php
   class group_detail extends Controller{

      public function index($detail_c_idx){
         $group_detail_model = $this->loadModel('groupMD');
         $groupinfo=$group_detail_model->group_info($detail_c_idx);
         $groupnotice=$group_detail_model->group_notice($detail_c_idx);
         $grouppost=$group_detail_model->group_post($detail_c_idx);
         $group_join_m_idx_check=$group_detail_model->group_join_m_idx_checking($detail_c_idx,$_SESSION['login_idx']);
         require 'application/views/_templates/header.php';
         require 'application/views/group_detail/index.php';
         require 'application/views/_templates/footer.php';
      }
      
   }