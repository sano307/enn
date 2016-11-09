<html lang="en">
<head>
   <meta charset = "utf-8">
   <meta http-equiv="X-UV-Compatible" content="IE=edge">
   <title> 한일 소통 SNS - 緣(Enn)SNS</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- foundation -->
    <link rel="stylesheet" href="<?php echo URL; ?>/foundation/css/normalize.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/foundation/css/foundation.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/foundation-icons/foundation-icons.css" type="text/css" />
    <!-- end of foundation -->

    <!-- public js -->
    <script src="<?php echo URL; ?>/foundation/js/vendor/modernizr.js"></script>
    <script src="<?php echo URL; ?>/foundation/js/vendor/jquery.js"></script>
    <script src="<?php echo URL; ?>/foundation/js/foundation.min.js"></script>
    <!-- end of public js -->

    <!-- foundation top css -->
    <link rel="stylesheet" href="<?php echo URL; ?>/public/css/topmenu_foundation.css">
    <!-- end of foundation top css -->

    <!-- main css -->
    <link rel='stylesheet' href="<?php echo URL; ?>/public/css/imageHoverEffect.css">
    <!-- end of main css -->

    <!-- camp css -->
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/camp/index.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/camp/choose.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/public/pullout_search.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/public/switches_with_lables.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/public/drop_box.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/public/page_transition.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/public/modal_box.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/assets/css/public/ios_toggle.css" type="text/css" />
    <!-- end of camp css -->

    <script>
        var login_idx = <?= $_SESSION['login_idx']; ?>;
        var login_nickname = '<?= $_SESSION['login_nickname']; ?>';
    </script>
</head>
<body>
    <nav class="top-bar" data-topbar style="color: black;">
      <ul class="title-area">
        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>
      <!-- top menu -->
      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="center-buttons">
            <a href="/main/index"><img src="/public/img/logoimage.png" class="logo" style="width:150px; height:57px;" /></a>
          <?php
              if(!$_SESSION['login_idx']){
           ?>
          <li class="divider"></li>
          <li>
            <a href="/timeline/index/<?=$_SESSION['login_idx']?>" style="text-align:center">
              <img src='/public/img/member/<?=$_SESSION['login_idx']?>/<?=$_SESSION['login_profileThumbName']?>.<?=$_SESSION['login_profileThumbExt']?>' width='25px'>
               Timeline
            </a>
          </li>
          <?php
              }
              else{
          ?>
          <li class="divider"></li>
          <li>
            <a href="/timeline/index/<?=$_SESSION['login_idx']?>" style="text-align:center">
              <img src='/public/img/common/common_profileImg_Thumb.png' width='25px' > Timeline
            </a>
          </li>
          <?php
              }
          ?>

          <li class="divider"></li>
          <li class="icon-align"><a href="/buddy_my/index" style="text-align:center"><i class="fi-male-female"></i> Buddy</a></li>
          <li class="divider"></li>
          <li class="icon-align"><a id="buddy" class="right-off-canvas-toggle menu-icon" style="text-align:center"><i class="fi-address-book"></i> BuddyState</a></li>
          <li class="divider"></li>
          <li class="icon-align"><a href="/camp" style="text-align:center"><i class="fi-social-myspace"></i> Camp</a></li>
          <li class="divider"></li>
          <li class="icon-align"><a href="/user/profile_edit/<?=$_SESSION['login_idx']?>" style="text-align:center"><i class="fi-wrench"></i> Setting</a></li>
          <li class="divider"></li>
          <li class="icon-align"><a href="/templates/logout" style="text-align:center"><i class="fi-x"></i> Logout</a></li>
          <li class="divider"></li>
        <li class="divider"></li>


          <script>
              $(document).ready(function() {
                  var buddyClick = false;

                  $("#buddy").click(function() {
                      if ( buddyClick === false ) {
                          buddyClick = true;
                          var m_idx = '<?= $_SESSION['login_idx']; ?>';

                          $.ajax({
                              type: "post",         // 전송방식
                              url: "/main/getBuddy",    // 값을 넘겨줄 페이지 정보
                              dataType : "json",  // 보낼 데이터 타입
                              data: {m_idx: m_idx},   // 보낼 데이터 정보

                              // 정상적으로 값이 넘어오면 실행될 메서드
                              success: function( data ) {
                                  console.log(data);
                                  var temp = ''
                                  for ( var iCount = 0; iCount < data.length; iCount++ ) {
                                      temp = "<li><a href='/timeline/index/" + data[iCount].m_idx + "'>" + data[iCount].m_nickname +"</a></li>"; //+ data[iCount].m_idx + " / " + data[iCount].m_memberID + " / "
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
