<?php
class Controller {
	public $db = null;		// db연결 객체

		function __construct() {
			$this->dbConnect();
		}

		private function dbConnect(){
			$options = array(
				// 에러를 어떻게 표시할 지에 대한 설정
				// PDO::ERRMODE_WARNING : 에러가 발생하면 이를 표시한다.
				// PDO::ERRMODE_SILENT: 에러가 발생해도 표시하지 않도록
				// PDO::ERRMODE_EXCEPTION : 예외 처리 설정에 따른다.
				PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ, 
				PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING);
			//$db를 생성
			// config.php에 정의한 상수에 대한 값을 입력 
			// options은 배열로 저장한 값이 된다. 
			$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname='.DB_NAME.';charset=utf8',DB_USER,DB_PASS,$options);
		}

		// 각각의 컨트롤러에서 model 파일을 열어 실행하고 새로운 model객체를 생성
		public function loadModel($model_name){
			require 'application/models/' . strtolower($model_name) . '.php';
			return new $model_name($this->db);
		}

			public function uploadImageErrorCheck($argImageErrorCode)
	{
		switch ($argImageErrorCode) {
			case 0:
				break;
			case 1:
				echo "업로드한 파일의 용량이 php.ini의 upload_max_filesize 변수보다 큽니다.";
				break;
			case 2:
				echo "업로드한 파일이 HTML Form에서 지정한 MAX_FILE_SIZE 지시어보다 큽니다.";
				break;
			case 3:
				echo "파일 일부분만 전송되었습니다.";
				break;
			case 4:
				echo "파일이 전송되지 않았습니다.";
				break;
			case 6:
				echo "임시 폴더가 없습니다.";
				break;
			case 7:
				echo "디스크에 파일 쓰기를 실패했습니다.";
				break;
			case 8:
				echo "확장에 의해 파일 업로드가 중지되었습니다.";
				break;
		}
	}

	public function IsImageCheck( $argPostImageInfo ) {
		$target_dir = $argPostImageInfo['saveFolderName'];
		$target_image = $argPostImageInfo['name'] . "." . $argPostImageInfo['ext'];
		$target_file = $target_dir . basename($target_image);
		$imageFileType = $argPostImageInfo['ext'];
		$IsUpload['check'] = 1; // 오류 체크 변수
		$IsUpload['msg'] = "";

		/*
		getimagesize는 이미지의 정보를 추출해주는 함수
		Array (
		[0] => 이미지의 width값
		[1] => 이미지의 height값
		[2] => 이미지의 Type Flag ( 각 이미지의 확장자마다 반환되는 정수가 다름 )
		[3] => 이미지의 width값, height값
		[bits] => 비트 수
		[chnnels] => 채널 번호
		[mime] => 현재 이미지의 확장자
		)
		*/
		$IsfileCheck = getimagesize($argPostImageInfo['tmp_name']);

		// 만약, 이미지의 정보가 없을 경우, 오류 체크 변수를 0으로
		if (!$IsfileCheck) {
			$IsUpload['check'] = 0;
			$IsUpload['msg'] = "NotImageFile";
			return $IsUpload;
		}

		// 만약, 업로드 할 폴더가 존재 하지 않을 경우, 오류 체크 변수를 0으로
		if (file_exists($target_file)) {
			$IsUpload['check'] = 0;
			$IsUpload['msg'] = "AlreadyExistsFile";
			return $IsUpload;
		}

		// 만약, 업로드 한 이미지의 사이즈가 5MB를 넘을 경우, 오류 체크 변수를 0으로
		if ($argPostImageInfo['size'] > 50000000) {
			$IsUpload['check'] = 0;
			$IsUpload['msg'] = "OverSizeFile";
			return $IsUpload;
		}

		$fileExtensionArr = array("jpg", "png", "jpeg", "gif");
		// 만약, 업로드 한 이미지의 확장자와 위의 배열에 저장되어 확장자가 하나라도 일치하지 않을 경우, 오류 체크 변수를 0으로
		if (!in_array($imageFileType, $fileExtensionArr)) {
			$IsUpload['check'] = 0;
			$IsUpload['msg'] = "OtherExtensionFile";
			return $IsUpload;
		}

		return $IsUpload;
	}

	public function imageUploading( $argPostImageInfo ) {
		$target_dir = $argPostImageInfo['saveFolderPath'];
		$target_image = $argPostImageInfo['name'] . "." . $argPostImageInfo['ext'];
		$target_file = $target_dir . basename($target_image);

		if (!move_uploaded_file($argPostImageInfo['tmp_name'], $target_file)) {
			header("Location: /application/views/main/alert.php?error=UploadingFailed");
		}
	}

	// 원본이 저장되는 폴더 경로, 원본이 저장되는 파일 이름, 원본의 확장자
    public function imageResization( $resizeImageInfo, $argWidth, $argHeight ) {
        list($width, $height) = getimagesize($resizeImageInfo['open_name']);
        $newwidth = $argWidth;
        $newheight = $argHeight;

        $thumb = imagecreatetruecolor($newwidth, $newheight);

        $source = "";
        if ( $resizeImageInfo['ext'] == "jpg" || $resizeImageInfo['ext'] == "jpeg" ) { $source = imagecreatefromjpeg($resizeImageInfo['open_name']); }
        elseif ( $resizeImageInfo['ext'] == "png" ) { $source = imagecreatefrompng($resizeImageInfo['open_name']); }
        elseif ( $resizeImageInfo['ext'] == "gif" ) { $source = imagecreatefromgif($resizeImageInfo['open_name']); }

        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        if ( $resizeImageInfo['ext'] == "jpg" || $resizeImageInfo['ext'] == "jpeg" ) { imagejpeg($thumb, $resizeImageInfo['saveFolderPath'], 9); }
        elseif ( $resizeImageInfo['ext'] == "png" ) { imagepng($thumb, $resizeImageInfo['saveFolderPath'], 9); }
        elseif ( $resizeImageInfo['ext'] == "gif") { imagegif($thumb, $resizeImageInfo['saveFolderPath'], 9); }

        $resizedImageInfo['name'] = $resizeImageInfo['name'];
        $resizedImageInfo['ext'] = $resizeImageInfo['ext'];
        return $resizedImageInfo;
    }

    // 원하는 경로에 폴더 생성
	public function createDirectory( $createDirectoryPath ){
		if( !is_dir( $createDirectoryPath ) ){
			mkdir( $createDirectoryPath, 0777, true );
		}
	}

	public function createCommonProfileIMG(){
		
	}
}