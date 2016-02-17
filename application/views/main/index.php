<link rel='stylesheet' href='<?php echo URL;?>/public/css/main/buddyrecommend.css'>
<link rel='stylesheet' href='<?php echo URL;?>/public/css/main/grouprecommend.css'>
<link rel='stylesheet' href='<?php echo URL;?>/public/css/main/notice.css'>
<script src="<?php echo URL;?>/public/js/postwrite.js"></script>
<br>
<div>
<form id="postWrite_form" action="/post/post_write/<?=$_SESSION['login_idx']?>/1" method="post" enctype="multipart/form-data">
    <textarea id="postContent" name="postContent" rows="1" cols="10" placeholder="글을 작성해주세요."></textarea><br>
    <input type="file" name="postImages[]"  accept="image/*" multiple/><br>
    <button>버튼</button>
</form>
</div>
<br>
<div class="row">
  <div class="large-12 columns">

    <div class="row">

    <!-- <div class="large-4 small-12 columns">
      <img src="http://placehold.it/500x500&amp;text=Logo">
      <div class="hide-for-small panel">
        <h3>Header</h3>
        <h5 class="subheader">Risus ligula, aliquam nec fermentum vitae, sollicitudin eget urna. Donec dignissim
        nibh fermentum odio ornare sagittis.</h5>
      </div>
      <a href="#">
        <div class="panel callout radius">
          <h6>99&nbsp; items in your cart</h6>
        </div>
      </a>
    </div> -->

      <div class="large-12 columns">
        <div class="row">
          <?php
            $getNowMemberNum=$_SESSION['login_idx'];
            foreach ( $getPostInfo as $row ) {
           ?>
          <div class="large-4 small-4 columns">
                <div class="image-wrapper overlay-fade-in">
            <?php
                  if ( $row->p_postThumbExt == "0" ) {
                      echo "<a href='/detail_timeline/index/{$row->p_idx}/{$row->c_idx}'style='color: black;'><h3>{$row->p_postThumbName}</h3><img src='/public/img/common/no_picture_post.png' alt=''></a>";
                  } else {
                      $argImage = $row->p_postThumbName . "." . $row->p_postThumbExt;
                      if ( $row->c_idx != 1 ) {
                          echo "<a href='<?php echo URL;?>/detail_timeline/index/{$row->p_idx}/{$row->c_idx}' title='Title'><img src='/public/img/camp/$getNowMemberNum/$argImage' alt=''></a>";
                      } else {
                          echo "<a href='/public/img/member/$getNowMemberNum/$argImage' title=''><img src='/public/img/member/$getNowMemberNum/$argImage' alt=''></a>";
                      }
                  }
            ?>
              <!--  -->
              <div class="image-overlay-content">
                <h2>내용이냐?<?=$row->p_content?></h2>
                <p class="price">좋냐?<?=$row->p_postGoods?></p>
                <a href="#" class="button">버튼이냐?</a>
              </div>
              <!--  -->
            </div>
          </div>
          <?php
              }
          ?>
        </div>

      </div>
    </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/js/foundation.min.js"></script>
  <script>
        $(document).foundation();
  </script>
</body>
</html>
