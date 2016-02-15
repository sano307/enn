<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset = "utf-8">
   <meta http-equiv="X-UV-Compatible" content="IE=edge">
   <title> 한일 소통 SNS - 緣(Enn)SNS</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- 부트스트랩 cdn -->
     <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
     <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <!-- 부트스트랩  cdn end-->


    <!-- foundation cdn start -->
          <!-- Latest compiled and minified CSS -->
          <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.css"> -->
          <!-- jQuery library -->
          <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->
          <!-- Latest compiled JavaScript -->
          <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/js/foundation.min.js"></script> -->
          <!-- Latest compiled modernizr -->
          <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script> -->
          <!-- <script>
            $(document).ready(function() {
                $(document).foundation();
            })
          </script> -->
    <!-- foundation cdn end -->
    <!-- foundation icon cdn start -->
        <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">

    <!-- foundation icon cdn end -->

   <div class="contains">
     <div id="menu" class="container nav">
         <div class="text-center">
             <ul id="menu">
                <li><a href="/home/index"><i class="fi-home"></i></a></li>
                 <li>
                  <a href="/timeline/index/<?= $_SESSION['login_idx'] ?>">
                     <!--  -->
                    <?php
                    // 프로필 사진이 없는 경우
                        if (! $_SESSION['login_profileThumbName'] ) {
                    ?>
                        <img src='/public/img/common/common_profileImg.png' style="width: 15px; height: 15px;" >
                    <?php
                        }else{
                    // 프로필 사진이 있는 경우
                    ?>
                        <img src="/public/img/member/<?= $_SESSION['login_idx'] ?>/<?= $_SESSION['login_profileThumbName'] ?>.<?= $_SESSION['login_profileThumbExt'] ?>" style="width: 15px; height: 15px;">
                    <?php
                        }
                    ?>
                </a>
                 </li>
                 <li><a href="/buddy_my/index"><i class="fi-male-female"></i></a></li>
                 <li><a href="/group_my/index/<?=$_SESSION['login_idx']?>"><i class="fi-social-myspace"></i></a></li>
                 <li><a href="/user/profile_edit/<?=$_SESSION['login_idx']?>"><i class="fi-wrench"></i></a></li>
                 <li><a href="/templates/logout"><i class="fi-x"></i></a></li>
             </ul>
         </div>
     </div>
   </div>
</head>
<body>
  <div class="contains">
    <div id="home" class="container folio text-center section">

    <!--  -->
