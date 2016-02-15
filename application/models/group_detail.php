<?php
   class group_detail extends Controller{

      public function index($detail_c_idx){
         $group_detail_model = $this->loadModel('groupMD');
         $groupdata=$group_detail_model->group_detail($detail_c_idx);

         require 'application/views/_templates/header.php';
         require 'application/views/group_detail/index.php';
         require 'application/views/_templates/footer.php';
      }

   }