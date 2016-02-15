
<?php
	class group extends Controller {

		public function group_my(){
         require 'application/views/_templates/header.php';
         require 'application/views/group_my/index.php';
         require 'application/views/_templates/footer.php';
      }

		public function group_post_write() {
			
		}

		public function create(){
	         require 'application/views/_templates/header.php';
	         require 'application/views/new_group/index.php';
	         require 'application/views/_templates/footer.php';
      	}

		public function group_detail(){
         require 'application/views/_templates/header.php';
         require 'application/views/group_detail/index.php';
         require 'application/views/_templates/footer.php';
      	}

		public function group_search() {

		}
	}
