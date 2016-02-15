<!-- 포스트를 클릭했을 때 뜨는 해당 포스트의 상세 페이지 -->
<?php
$postImageInfo = isset($nowPostImageInfo) ? $nowPostImageInfo : null;
$postReplyInfo = isset($nowPostReplyInfo) ? $nowPostReplyInfo : null;
?>


<div id="detail_post" align=center>
   <ul>
      <li><?= $nowPostWriterInfo->p_idx ?></li>
      <li><?= $nowPostWriterInfo->m_nickname ?></li>
      <div id="sourceText"><?= $nowPostWriterInfo->p_content ?></div>
      <div id="translation"></div>
      <li><?= $nowPostWriterInfo->p_content ?></li>
      <!--  -->
          <script>
            function translateText(response) {
              document.getElementById("translation").innerHTML += "<br>" + response.data.translations[0].translatedText;
            }

            var newScript = document.createElement('script');
            newScript.type = 'text/javascript';
            var sourceText = escape(document.getElementById("sourceText").innerHTML);

            var source = 'https://www.googleapis.com/language/translate/v2?key=AIzaSyBDjE8Q53z6sD0dqbuy5sLeEVKzipdaJD4&source=ko&target=ja&callback=translateText&q=' + sourceText;
            newScript.src = source;
            document.getElementsByTagName('head')[0].appendChild(newScript);
          </script>

      <!--  -->
      <?php
        if($nowPostLikeState==null){
      ?>
      <li><a href = '/post/post_like/<?= $nowPostWriterInfo->p_idx ?>/<?=$nowPostCampInfo?>'> <i class="fi-heart"></i></a></li>
      <?php
      }
      ?>
      <?php
      if ( !$postImageInfo ) {
         // 이미지가 존재하지 않을 경우
      } else {
         // 이미지가 존재할 경우
         foreach ( $nowPostImageInfo as $row ) {
            if($nowPostCampInfo==1){
              echo "<li><img src='/public/img/member/{$nowPostWriterInfo->m_idx}/{$row->pa_postImgName}.{$row->pa_postImgExt}'></li>";
            }else{
              echo "<li><img src='/public/img/camp/{$nowPostCampInfo}/{$row->pa_postImgName}.{$row->pa_postImgExt}'></li>";
            }
         }
      }
      ?>
      <br>
      <li>댓글작성
            <form action="<?php echo URL; ?>reply/reply_write/<?=$_SESSION['login_idx'];?>/<?=$nowPostWriterInfo->p_idx;?>" method="post">

            <td><textarea name="replyContent" cols="30" rows="1" style="resize:none;"></textarea></td>
            <tr>
              <td>
                <!-- c_idx를 불러와야지 댓글을 작성후 다시 이페이지로 돌아올지 이미지의 경로를 설정해줄 수 있다. -->
                  <?php if($nowPostCampInfo != 1){
                    echo "<input type='hidden' value=$nowPostCampInfo name='c_idx'>";
                  } else {
                      echo "<input type='hidden' value=1 name='c_idx'>";
                  } ?>
                  <input type="submit" value="작성">
              </td>
            </tr>
        </form>
      </li>
      <table>
      <?php
      if ( !$postReplyInfo ) {
         // 댓글이 존재하지 않을 경우
         echo "<li>댓글이 존재하지 않습니다.</li>";
      } else {
         // 댓글이 존재할 경우
         echo"<tr><td>사진</td><td>내용</td><td>작성날짜</td><td>수정</td><td>삭제</td></tr>";

         foreach ( $postReplyInfo as $row ) {
            ?>

            <tr>

               <td width='20'>
                    <a href="/timeline/index/<?= $row->m_idx ?>">
                        <img src="/public/img/member/<?= $row->m_idx ?>/<?= $row->m_profileImgName ?>.<?= $row->m_profileImgExt ?>" style="width: 30px; height: 30px;">
                    </a>
                </td>
                <td><?=$row -> pr_content ?></td><td><?=$row -> pr_registedTime ?></td>
                <?php if($row -> m_idx == $_SESSION['login_idx']) { ?>
                <td><a href="<?=URL;?>reply/reply_update?pr_idx=<?=$row -> pr_idx?>&p_idx=<?=/*$row -> p_idx*/$current_p_idx?>">수정</a></td>
                <td><a href="<?=URL;?>reply/reply_delete/<?= $row -> pr_idx ?>/<?=$row -> p_idx?>/<?php if($nowPostCampInfo != 1) { echo $nowPostCampInfo;} else { echo '1'; } ?>">삭제</a></td>
            </tr>

            <?php
             }
         }
      }
      ?>
      </table>
   </ul>
</div>
<div id="detail_post_before" align="center">
   <a href="/home/index">홈으로</a>
</div>
<?php
  // 로그인 사용자가 작성한 글일때만 수정버튼 출력
  if($_SESSION['login_idx']==$nowPostWriterInfo->m_idx){
?>
<div id="detail_post_modify" align="center">
   <a href="/post/post_modify/<?=$nowPostWriterInfo->p_idx?>">글 수정</a>
</div>
<div id="detail_post_delete" align="center">
   <form action="/post/post_delete/<?= $nowPostWriterInfo->p_idx ?>" method="post">
      <input type="submit" value="글 삭제" onclick="return postDeleteCheck();">
   </form>
</div>
<?php
  }
 ?>
<script type="text/javascript">
   function postDeleteCheck() {
      return confirm("정말 삭제하시겠습니까?");
   }
</script>
