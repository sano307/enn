<?php
class Application {
	//현재 클래스에서만 사용하도록 private
	// 클래스 지정
	private $controller = null;

	// 메서드 지정
	private $action = null;

	// 클래스 생성자
	public function __construct(){
		// 컨트롤러정상실행이 되지 않았을 경우 에러페이지 또는 에러메시지를 표시하기 위한 초기설정
		// 컨트롤러가 정상적으로 실행이 되면 true로 바뀐다.
		$cancontroll = false;
		$url = "";

		if(isset($_GET['url'])){
			$url = rtrim($_GET['url'],'/');	// URL의 /를 삭제
			$url = filter_var($url,FILTER_SANITIZE_URL);	// 주소에 포함되지 말아야할 문자를 제거
		}

		$params = explode('/',$url);	// URL의 /를 기준으로 나누어 배열로 리턴
		$counts = count($params);		// 배열의 크기

		// 자기 자신 객체를 접근한다. 아무것도 url이 입력되면 홈을 기본적인 클래스로 쓴다.
		$this->controller = "start";

		// params[0]이 존재한다면(클래스가 존재한다면)
		if(isset($params[0])){
			if($params[0]) $this->controller = $params[0];	//입력되어있는 params[0]을 클래스로 사용한다.
		}

		// 해당 키워드 밑의 객체.php파일이 존재하는지 확인
		if(file_exists('./application/controller/'. $this->controller.'.php')){
			require './application/controller/'.$this->controller.'.php';

			$this->controller = new $this->controller();	// 해당 객체의 인스턴스를 생성
			$this->action = "index";	// url뒤에 메소가 없다면 기본적으로 index를 사용

			// params[1]이 존재한다면
			if(isset($params[1])) {
				if($params[1]) $this->action = $params[1];	// 해당 메소드를 실행한다.
			}

			// url이 정상적으로 저장되어있다면
			if(method_exists($this->controller, $this->action)) {
				$cancontroll = true;	// false였던 값을 true로 바꾼다.

				switch($counts){
					case '0' :	// class
					case '1' : // method
					case '2' :	// parameter
						$this->controller->{$this->action}();
						break;
					case '3' :
						$this->controller->{$this->action}($params[2]);
						break;
					case '4' :
						$this->controller->{$this->action}($params[2],$params[3]);
						break;
					case '5' :
						$this->controller->{$this->action}($params[2],$params[3],$params[4]);
						break;
					case '6' :
						$this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5]);
						break;
					case '7' :
						$this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6]);
						break;
					case '8' :
						$this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7]);
						break;
					case '9' :
						$this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8]);
						break;
					case '10' :
						$this->controller->{$this->action}($params[2],$params[3],$params[4],$params[5],$params[6],$params[7],$params[8],$params[9]);
						break;
					}
				}
			}
			// 클래스, 메서드 또는 URL이 잘못 됬을 경우 = 에러
			if($cancontroll === false) echo "<!DOCTYPE html>
												<html>
													<head>
														<meta charset = 'utf-8'>
													</head>
													<body>
														<h1>Oops!!! 잘못된 접근입니다.</h1>
													</body>
												</html>";
		}
	}