<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset = "utf-8">
   <meta http-equiv="X-UV-Compatible" content="IE=edge">
   <title> 한일 소통 SNS - 緣(Enn)SNS</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
           <!-- 기본 파운데이션(foundation) 첨부-->
                   <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
                   <link rel="stylesheet" href="<?php echo URL;?>/foundation/css/normalize.css">
                   <link rel="stylesheet" href="<?php echo URL;?>/foundation/css/foundation.css">
                   <link rel="stylesheet" href="<?php echo URL;?>/foundation/css/app.css">
                   <script src="<?php echo URL;?>/foundation/js/vendor/modernizr.js"></script>

           <!-- 기본 파운데이션(foundation) 첨부 끝 -->


           <!-- 파운데이션 탑메뉴 css -->
                   <link rel="stylesheet" href="<?php echo URL;?>/public/css/topmenu_foundation.css">
           <!-- 파운데이션 탑메뉴 css 끝 -->
<head>
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
         <!--  -->
        <?php
        // 프로필 사진이 없는 경우
            if (! $_SESSION['login_profileThumbName'] ) {
        ?>
            <img src='/public/img/common/common_profileImg.png'>
        <?php
            }else{
        // 프로필 사진이 있는 경우
        ?>
            <img src="/public/img/member/<?= $_SESSION['login_idx'] ?>/<?= $_SESSION['login_profileThumbName'] ?>.<?= $_SESSION['login_profileThumbExt'] ?>">
        <?php
            }
        ?>
    </a>
    </div>
    <!-- 로고이미지 끝 -->

    <!-- 탑메뉴  -->
    <section class="top-bar-section">
      <ul class="center-buttons">
        <li class="divider"></li>
        <li><a href="/buddy_my/index"><i class="fi-male-female"></i></a></li>
        <li class="divider"></li>
        <li><a href="/group_my/index/<?=$_SESSION['login_idx']?>"><i class="fi-social-myspace"></i></a></li>
        <li class="divider"></li>
        <li><a href="/user/profile_edit/<?=$_SESSION['login_idx']?>"><i class="fi-wrench"></i></a></li>
        <li class="divider"></li>
        <li><a href="/templates/logout"><i class="fi-x"></i></a></li>
        <li class="divider"></li>
        <li><a class="right-off-canvas-toggle menu-icon" ><span>buddy</span></a></li>
      </ul>
    </section>
    <!-- 탑메뉴 끝  -->
  </nav>

  <div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">
      <aside class="right-off-canvas-menu">
      친구1<br>
      친구2

      </aside>

      <section class="main-section">
        <a class="exit-off-canvas"></a>
