<style>
/*프로필*/
.bump {
  margin-top: 50px;
  padding-right: 30px;
  padding-left: 30px;
}

.profile-card {
  padding-top: 15px;
  padding-bottom: 0px;
  border-radius: 5px;
  background: #2B2937;
  overflow: hidden;
}
.profile-card h4 {
  font-family: "Proxima Nova","proxima-nova","Helvetica Neue",Helvetica,Arial,sans-serif;
  font-weight: 400;
  color: #fff;
  font-size: 30px;
  line-height: 26px;
}
.profile-card h4 span {
  font-size: 20px;
  color: #8C91A7;
  display: block;
}
.profile-card img {
  border-radius: 50%;
  border: 4px solid #69708C;
}
.profile-card .button-group {
  width: 101%;
}
.profile-card .button-group .button {
  margin-bottom: 0;
  border-top: none;
  border-left: none;
  border-right: 2px solid #2B2937;
  border-bottom: none;
  background-color: #394165;
  height: 80px;
  padding-top: 15px;
  margin-top: 20px;
  font-weight: 200;
  font-size: 16px;
  line-height: 26px;
  color: #8C91A7;
  box-shadow: none;
}
.profile-card .button-group .button span {
  display: block;
  font-size: 24px;
  font-weight: 600;
  color: #fff;
}
.profile-card p {
  font-size: 16px;
  margin-bottom: 0;
  color: #8C91A7;
}
.profile-card i {
  font-size: 26px;
  vertical-align: middle;
  padding-right: 5px;
  color: #394165;
}

@media only screen and (max-width: 767px) {
  .profile-card img {
    margin-left: auto;
    margin-right: auto;
    width: 40%;
  }
  .profile-card h4, .profile-card p {
    text-align: center;
  }
  .profile-card .button-group .button {
    font-size: 14px;
  }
  .profile-card .button-group .button span {
    font-size: 20px;
  }
}
</style>
<!-- 프로필 -->
<div class="row bump">
   <div class="small-12 large-6 columns">
      <div class="row">
         <div class="profile-card">
            <div class="small-12 large-4 columns">
              <?php
              // 프로필 사진이 없는 경우
                  if (! $_SESSION['login_profileThumbName'] ) {
              ?>
                  <img src='/public/img/common/common_profileImg.png'  alt='profile image'><br><?= $timelineMemberInfo[0]->m_nickname; ?>
              <?php
                  }else{
              // 프로필 사진이 있는 경우
              ?>
                    <img src="/public/img/member/<?= $timelineMemberInfo[0]->m_idx ?>/<?= $timelineMemberInfo[0]->m_profileImgName ?>.<?= $timelineMemberInfo[0]->m_profileImgExt ?>"  alt='profile image'>
              <?php
                  }
              ?>
            </div>
            <div class="small-12 large-8 columns">
               <h4><?= $timelineMemberInfo[0]->m_nickname; ?> <span><?= $timelineMemberInfo[0]->m_memberID; ?></span></h4>
               <p><i class="fi-male-female"></i><span><?php if($timelineMemberInfo[0]->m_sex=='F') echo"男"; else echo"女"; ?></span></p>
               <p><i class="fi-web"></i><?= $timelineMemberInfo[0]->m_nationally; ?></p>
               <p><i class="fi-trees"></i><?= $timelineMemberInfo[0]->m_region; ?></p>
            </div>
            <div class="row collapse">
               <ul class="button-group even-3">
                  <li><a href="#" class="button"> Buddy <span>432 </span></a></li>
                  <li><a href="#" class="button"> Group <span>432 </span></a></li>
                  <li><a href="#" class="button"> test <span>432 </span></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- 친구맺기 버튼 -->
<?php
if ( $timelineMemberInfo[0]->m_idx != $_SESSION['login_idx']) {
    // 다른사람의 타임라인일 경우
    echo "<form action='/buddy_my/add' method='post'>";
    echo "<input type='submit' value='친구신청'>";
    echo "<input type='hidden' name='idx' value='{$timelineMemberInfo[0]->m_idx}'>";
    echo "<input type='hidden' name='nickname' value='{$timelineMemberInfo[0]->m_nickname}'>";
    echo "</form>";
}
?>
<!-- 친구맺기 버튼 끝 -->
<!-- 해당유저의 그룹 -->
        <ul>
            <?php
            if ( !$timelineGroupInfo ) {
                echo "<li>가입된 캠프가 없습니다.</li>";
            } else {
                $campThumbSavePath = "/public/img/camp/";
                foreach ( $timelineGroupInfo as $row ) {
                    $temp = $campThumbSavePath . $row->c_idx . "/" . $row->c_campThumbName . "." . $row->c_campThumbExt;
                    echo "<li><a href='/group_detail/index/$row->c_idx'><img src='$temp'></a></li>";
                }
            }
            ?>
            </ul>

        <ul>


            </ul>
<!-- 해당유저의 그룹  끝-->
<!-- 타임라인 html -->
<div class="row">
    <?php
    if ( !$timelinePostInfo ) {
        echo "<li>작성된 포스트가 없습니다.</li>";
    } else {
      ?>

      <?php
        $postThumbSavePath = "/public/img/member/";
        foreach ( $timelinePostInfo as $row ) {
              if($row->p_postThumbName!=0){
                $temp = $postThumbSavePath . $row->m_idx . "/" . $row->p_postThumbName . "." . $row->p_postThumbExt;
                echo "<a href='/detail_timeline/index/{$row->p_idx}/{$row->c_idx}'><img src='$temp'></a></li>";
              }
              else{
                echo "<li><a href='/detail_timeline/index/{$row->p_idx}/{$row->c_idx}'>$row->p_content</a></li>";
              }
            }
          }

?>
</div>
