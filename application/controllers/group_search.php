<?php
class group_search extends Controller {
	public function index(){
        if( @$_POST['korea']=='null' ){
        	$region=@$_POST['japan'];
        }
        else{
        	$region=@$_POST['korea'];
        }

        $group_model = $this->loadModel('groupMD');
        $result=$group_model->group_select($region);

        require 'application/views/_templates/header.php';
        require 'application/views/group_search/index.php';
        require 'application/views/_templates/footer.php';
      }

	public function groupSearching() {

	}
}
