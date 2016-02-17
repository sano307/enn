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
    <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL; ?>/foundation/css/normalize.css">
    <link rel="stylesheet" href="<?php echo URL; ?>/foundation/css/foundation.css">
    <script src="<?php echo URL; ?>/foundation/js/vendor/modernizr.js"></script>
    <!-- end of foundation -->

    <!-- foundation top css -->
    <link rel="stylesheet" href="<?php echo URL; ?>/public/css/topmenu_foundation.css">
    <!-- end of foundation top css -->
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
