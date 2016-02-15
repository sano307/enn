<?php
   class group_my extends Controller{
      public function index($logining_m_idx){
         $group_my_model = $this->loadModel('group_myMD');
         $group_my_model=$group_my_model->group_my_select($logining_m_idx);
         
         require 'application/views/_templates/header.php';
         require 'application/views/group_my/index.php'; 
         require 'application/views/_templates/footer.php';
      }

      public function group_request($c_idx,$m_idx){
         $group_my_model = $this->loadModel('group_myMD');
         $group_my_model->group_request($c_idx,$m_idx);
 
         header("Location: /group_search/index");
      }

      public function group_bye($bye_g_idx,$m_idx){
         $group_my_model = $this->loadModel('group_myMD');
         $group_my_model->group_my_bye($bye_g_idx,$m_idx);
         
         require 'application/views/_templates/header.php';
         require 'application/views/group_my/index.php';
         require 'application/views/_templates/footer.php';      
      }
      public function group_create(){
         require 'application/views/_templates/header.php';
         require 'application/views/new_group/index.php';
         require 'application/views/_templates/footer.php';
      }
   }