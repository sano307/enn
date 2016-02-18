<?php
var_dump($_SESSION);
?>
<html lang="en">
<head>
   <meta charset = "utf-8">
   <meta http-equiv="X-UV-Compatible" content="IE=edge">
   <title> 한일 소통 SNS - 緣(Enn)SNS</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- foundation -->
    <link rel="stylesheet" href="<?php echo URL; ?>/foundation/css/normalize.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/foundation/css/foundation.css">
    <link rel="stylesheet" href="<?php echo URL; ?>foundation-icons/foundation-icons.css" type="text/css" />
    <!-- end of foundation -->

    <!-- public js -->
    <script src="<?php echo URL; ?>foundation/js/vendor/modernizr.js"></script>
    <script src="<?php echo URL; ?>foundation/js/vendor/jquery.js"></script>
    <script src="<?php echo URL; ?>foundation/js/foundation.min.js"></script>
    <!-- end of public js -->

    <!-- foundation top css -->
    <link rel="stylesheet" href="<?php echo URL; ?>/public/css/topmenu_foundation.css">
    <!-- end of foundation top css -->

    <!-- camp css -->
    <link rel="stylesheet" href="<?php echo URL; ?>assets/css/camp/index.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>assets/css/camp/choose.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>assets/css/public/page_transition.css" type="text/css" />
    <!-- end of camp css -->
</head>
<body>
  <nav class="top-bar" data-topbar>
    <!-- 사용자 프로필 이미지 -->
        <ul class="title-area">
          <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
        </ul>
    <!-- 사용자 프로필 이미지  끝-->

    <!-- 로고이미지 -->
    <div class="logo">
      <a href="/timeline/index/<?= $_SESSION['login_idx'] ?>">
            <img src='/public/img/common/common_profileImg.png'>
        </a>
    </div>
    <!-- 로고이미지 끝 -->

    <!-- 탑메뉴  -->
    <section class="top-bar-section">
      <ul class="center-buttons">
        <li class="divider"></li>
        <li><a href="/buddy_my/index"><i class="fi-male-female"></i></a></li>
        <li class="divider"></li>
        <li><a href="/camp"><i class="fi-social-myspace"></i></a></li>
        <li class="divider"></li>
        <li><a href="/user/profile_edit/<?=$_SESSION['login_idx']?>"><i class="fi-wrench"></i></a></li>
        <li class="divider"></li>
        <li><a href="/templates/logout"><i class="fi-x"></i></a></li>
        <li class="divider"></li>
        <li><a id="buddy" class="right-off-canvas-toggle menu-icon"><span>buddy</span></a></li>
          <script>
              $(document).ready(function() {
                  var buddyClick = false;

                  $("#buddy").click(function() {
                      if ( buddyClick === false ) {
                          buddyClick = true;
                          var id = '<?= $_SESSION['login_idx']; ?>';
                          var nickname = '<?= $_SESSION['login_nickname']; ?>';

                          $.ajax({
                              type: "post",         // 전송방식
                              url: "/main/getBuddy",    // 값을 넘겨줄 페이지 정보
                              dataType : "json",  // 보낼 데이터 타입
                              data: {id: id, nickname: nickname},   // 보낼 데이터 정보

                              // 정상적으로 값이 넘어오면 실행될 메서드
                              success: function( data ) {
                                  var temp = ''
                                  for ( var iCount = 0; iCount < data.length; iCount++ ) {
                                      temp = "<li>" + data[iCount].m_idx + " / " + data[iCount].m_memberID + " / " + data[iCount].m_nickname +"</li>";
                                      $("#my_buddy").append(temp);
                                  }
                              },

                              // 값이 넘어오지 않을 경우 실행될 메서드
                              error: function( xhr, status, errorThrown ) {
                                  alert( "Sorry, there was a problem!" );
                                  console.log( "Error: " + errorThrown );
                                  console.log( "Status: " + status );
                                  console.dir( xhr );
                              },

                              // 값이 정상적으로 넘어오거나 넘어오지 않아도 꼭 실행될 메서드
                              complete: function( xhr, status ) {
                                  //alert( "The request is complete!" );
                              }
                          });
                      } else {
                          buddyClick = false;
                          $("#my_buddy li").remove();
                      }
                  });
              });
          </script>
      </ul>
    </section>
    <!-- 탑메뉴 끝  -->
  </nav>

  <div class="off-canvas-wrap" data-offcanvas style="color: white;">
    <div class="inner-wrap">
      <aside class="right-off-canvas-menu">
          <div>
              <ul id="my_buddy"></ul>
          </div>
      </aside>

      <section class="main-section">
        <a class="exit-off-canvas"></a>
