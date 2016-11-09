<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class reply extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model("replyModel");
    }
    public function index()
    {
        $p_idx = isset($_POST['p_idx']) ? $_POST['p_idx'] : 1;
        $reply_list = $this->replyModel -> getReplyList( $p_idx );

        $this->load->view('timeline/detail_post');
        /*require 'application/views/_templates/header.php';
        require 'application/views/reply/index.php';
        require 'application/views/_templates/footer.php';*/
    }

    public function reply_write()
    {
        $replyValue['m_idx'] = isset($_POST['current_m_idx']) ? $_POST['current_m_idx'] : null;
        $replyValue['p_idx'] = isset($_POST['p_idx']) ? $_POST['p_idx'] : null;
        $c_idx = isset($_POST['c_idx']) ? $_POST['c_idx'] : null;
        if($replyValue['m_idx'] != null && $replyValue['p_idx'] != null){
            $replyValue['replyContent'] = isset($_POST['replyContent']) ? $_POST['replyContent'] : null;
            //  $reply_model = $this -> loadModel("replyModel");
            //  $reply_model -> reply_write( $replyValue );
            $this->replyModel->reply_write($replyValue);
        }

        header('location: '. URL .'detail_timeline/index/'.$replyValue['p_idx']."/".$c_idx."/".$replyValue['m_idx']);
    }

    public function reply_update($pr_idx,$p_idx)
    {
        $updateValue['pr_idx'] = isset($pr_idx) ? $pr_idx : 1;
        $updateValue['replyContent'] = isset($_POST['replyContent']) ? $_POST['replyContent'] : null;

        if($p_idx){
            $reply_list = $this->replyModel -> getReplyList( $p_idx );

            $this->load->view('reply/update', array('reply_list'=>$reply_list));
        } else {
            $this->replyModel -> reply_update( $updateValue );

            $p_idx = isset($p_idx) ? $p_idx : null;
            $reply_list = $this->replyModel -> getReplyList( $p_idx );


            // require 'application/views/_templates/header.php';
            // require 'application/views/reply/update.php';
            // require 'application/views/_templates/footer.php';
            $this->load->view('reply/update',array('reply_list'=>$reply_list));
        }
    }
    public function reply_delete($pr_idx, $p_idx, $c_idx)
    {
        $replyNum = isset($pr_idx) ? $pr_idx: null;
        $postNum = $p_idx;
        $campNum = $c_idx;
        echo $campNum, $postNum;

        if($replyNum != null){
            // $reply_model -> reply_delete( $replyNum );
            $this->replyModel->reply_delete($replyNum);
        }
        header('location: '. URL. 'detail_timeline/index/'.$postNum."/".$campNum."/".$_SESSION['login_idx']);
    }
}
