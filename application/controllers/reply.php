<?php
   class reply extends Controller {
      public function index()
      {
         $p_idx = isset($_POST['p_idx']) ? $_POST['p_idx'] : 1;
         $reply_model = $this -> loadModel("replyModel");
         $reply_list = $reply_model -> getReplyList( $p_idx );

         /*require 'application/views/_templates/header.php';
         require 'application/views/reply/index.php';
         require 'application/views/_templates/footer.php';*/
      }

      public function reply_write($m_idx,$p_idx)
      {
         $replyValue['m_idx'] = isset($m_idx) ? $m_idx : null;
         $replyValue['p_idx'] = isset($p_idx) ? $p_idx : null;
         $c_idx = isset($_POST['c_idx']) ? $_POST['c_idx'] : null;
         if($replyValue['m_idx'] != null && $replyValue['p_idx'] != null){
               $replyValue['replyContent'] = isset($_POST['replyContent']) ? $_POST['replyContent'] : null;
               $reply_model = $this -> loadModel("replyModel");
               $reply_model -> reply_write( $replyValue );
         }

         header('location: '. URL .'detail_timeline/index/'.$replyValue['p_idx']."/".$c_idx);
      }

      public function reply_update()
      {
         $p_idx = isset($_POST['p_idx']) ? $_POST['p_idx'] : null;
         $updateValue['pr_idx'] = isset($_POST['pr_idx']) ? $_POST['pr_idx'] : 1;
         $updateValue['replyContent'] = isset($_POST['replyContent']) ? $_POST['replyContent'] : null;
         $reply_model = $this -> loadModel("replyModel");
         $reply_model -> reply_update( $updateValue );
         if($p_idx){
            $reply_list = $reply_model -> getReplyList( $p_idx );

            require 'application/views/_templates/header.php';
            require 'application/views/reply/index.php';
            require 'application/views/_templates/footer.php';
         } else {
            $p_idx = isset($_GET['p_idx']) ? $_GET['p_idx'] : null;
            $reply_list = $reply_model -> getReplyList( $p_idx );

            require 'application/views/_templates/header.php';
            require 'application/views/reply/update.php';
            require 'application/views/_templates/footer.php';
         }
      }
      public function reply_delete($pr_idx, $p_idx, $c_idx)
      {
         $replyNum = isset($pr_idx) ? $pr_idx: null;
         $postNum = $p_idx;
         $campNum = $c_idx;
         echo $campNum, $postNum;

         if($replyNum != null){
            $reply_model = $this -> loadModel("replyModel");
            $reply_model -> reply_delete( $replyNum );
         } 
         header('location: '. URL. 'detail_timeline/index/'.$postNum."/".$campNum);
      }
   }