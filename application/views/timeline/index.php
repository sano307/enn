<link rel="stylesheet" href="<?php echo URL;?>/public/css/timeline_profile/profile_card.css">
<div class="row">
    <div class="large-12 columns">
        <div class="panel">
            <!-- 타임라인 프로필카드 -->
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
                                <li><a href="#" class="button"> Post <span>432 </span></a></li>
                                <li><a href="#" class="button"> Buddy <span>432 </span></a></li>
                                <li><a href="#" class="button"> Group <span>432 </span></a></li>
                             </ul>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
            <!-- 타임라인 프로필카드 끝 -->
        </div>
    </div>
</div>

<div class="row">

<!-- 해당 멤버의 그룹 -->
    <div class="large-3 columns ">
      <?php
      if ( !$timelineGroupInfo ) {
          echo "No Camp";
      } else {
          $campThumbSavePath = "/public/img/camp/";
          foreach ( $timelineGroupInfo as $row ) {
              $temp = $campThumbSavePath . $row->c_idx . "/" . $row->c_campThumbName . "." . $row->c_campThumbExt;
              echo "<div class='panel'>";
              echo "<a href='/group_detail/index/$row->c_idx'><img src='$temp'></a>";
              echo "<div class='section-container vertical-nav' data-section data-options='deep_linking: false; one_up: true'>
              </div>
          </div>";
          }
      }
      ?>
    </div>
<!-- 해당 멤버의 그룹원본 끝-->

<div class="large-6 columns">

<!-- 해당유저 포스트 원본 -->
    <div class="row">
          <!-- 포스트 글쓴이 포스트 -->
        <div class="large-2 columns small-3">
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
        <div class="large-10 columns">
            <p><strong><?= $timelineMemberInfo[0]->m_nickname; ?> said:</strong>

            </p>
            <ul class="inline-list">
                <li><a href="">Reply</a></li>
                <li><a href="">Share</a></li>
            </ul>
            <h6>2 Comments</h6>
            <div class="row">
                <div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>
                <div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>
            </div>
            <div class="row">
                <div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>
                <div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>
            </div>
        </div>
    </div>

    <hr/>
<!-- 해당 유저 포스트 끝 -->
<!--  -->
<?php
if ( !$timelinePostInfo ) {
    echo "<li>작성된 포스트가 없습니다.</li>";
} else {
    $postThumbSavePath = "/public/img/member/";
    foreach ( $timelinePostInfo as $row ) {
?>
        <div class="row">
              <!-- 포스트 글쓴이 포스트 -->
            <div class="large-2 columns small-3">
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
            <div class="large-10 columns">
                <p><strong><?= $timelineMemberInfo[0]->m_nickname; ?> said:</strong>
                    <?php
                    if($row->p_postThumbName!=0){
                      $temp = $postThumbSavePath . $row->m_idx . "/" . $row->p_postThumbName . "." . $row->p_postThumbExt;
                      echo "<a href='/detail_timeline/index/{$row->p_idx}/{$row->c_idx}'><img src='$temp' style='width:45px'>$row->p_content</a>";
                    }
                    else{
                      echo "<a href='/detail_timeline/index/{$row->p_idx}/{$row->c_idx}'>$row->p_content</a>";
                    }
                     ?>
                </p>
                <ul class="inline-list">
                    <li><a href="">Reply</a></li>
                    <li><a href="">Share</a></li>
                </ul>
            </div>
        </div>

        <hr/>
        <?php
      }}
      ?>
<!--  -->
</div>


<aside class="large-3 columns hide-for-small">
<p><img src="http://placehold.it/300x440&text=[ad]"/></p>
<p><img src="http://placehold.it/300x440&text=[ad]"/></p>
</aside>
</div>
