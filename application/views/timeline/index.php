<link rel='stylesheet' href='<?php echo URL;?>/public/css/main/buddyrecommend.css'>
<link rel='stylesheet' href='<?php echo URL;?>/public/css/main/grouprecommend.css'>
<link rel='stylesheet' href='<?php echo URL;?>/public/css/main/notice.css'>
<script src="<?php echo URL;?>/public/js/postwrite.js"></script>

<!--  -->
<link rel='stylesheet' href='<?php echo URL;?>/public/css/timeline_profile/timeline_title_img.css'>


    <article class="post">
      <a href="#">
        <center><img src="http://www.swtorstrategies.com/wp-content/uploads/2014/09/star_wars_battlefront_by_jfaron-d68rbaj.png" width="100%"/></center>
      </a>
      <div class="content">
        <div class="share">
          <span class="icon icon-heart"></span>
          <span class="count">친구몇명</span>
          <span class="icon icon-link"></span>
          <span class="count">그룹몇개</span>
        </div>
      </div>
    </article>

<!--  -->
<div class="row">


      <div class="large-3 columns ">
          <img src="/public/img/member/<?= $timelineMemberInfo[0]->m_idx ?>/<?= $timelineMemberInfo[0]->m_profileImgName ?>.<?= $timelineMemberInfo[0]->m_profileImgExt ?>"  alt='profile image'>
          <h2><a><?= $timelineMemberInfo[0]->m_nickname; ?></a></h2>
          <h5><a><?= $timelineMemberInfo[0]->m_memberID; ?></a></h5>
          <p>국적:<strong><?= $timelineMemberInfo[0]->m_nationally; ?></strong> <span class="verified"></span></p>
          <p>지역:<strong><?= $timelineMemberInfo[0]->m_region; ?></strong> <span class="verified"></span></p>
          <p>성별:<strong><?= $timelineMemberInfo[0]->m_sex; ?></strong> <span class="verified"></span></p>
      </div>

      <div class="large-7 columns">
        <div class="row">
          <form id="postWrite_form" action="/post/post_write/<?=$_SESSION['login_idx']?>/1" method="post" enctype="multipart/form-data">
              <textarea id="postContent" name="postContent" rows="5" cols="50" placeholder="글을 작성해주세요."></textarea><br>
              <input type="file" name="postImages[]"  accept="image/*" multiple/><br>
              <input type="submit" value="글작성" >
          </form>
        </div>
        <hr/>

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

  <!-- 해당 유저 포스트 끝 -->
        <aside class="large-2 columns hide-for-small">
          <p><img src="http://placehold.it/300x440&text=[ad]"/></p>
          <p><img src="http://placehold.it/300x440&text=[ad]"/></p>
        </aside>

  </div>
</div>
