<?php
// $modify_post_info;
  foreach($modify_post_image as $row){
    echo $row->pa_postImgName;
    echo $row->pa_postImgExt;
  }
?>
<div id="post_modify">
  <form id="post_modify_form" action="/post/post_modify_process/<?= $modify_post_info->p_idx ?>/<?=$modify_post_info->c_idx ?>" method="post">
  <table>
    <tr>
      <td>내용 : <br><textarea name="content" cols="20" rows="10"><?= $modify_post_info->p_content ?></textarea></td>
      <?php
        $saveImagePath = "";
        if ( $modify_post_info->c_idx == '1' ) {
          // 개인페이지에서 작성한 포스트
          $saveImagePath = "/public/img/member/" . $modify_post_info->m_idx . "/";
        } else {
          // 캠프페이지에서 작성한 포스트
          $saveImagePath = "/public/img/camp/" . $modify_post_info->c_idx . "/";
        }

        foreach( $modify_post_image as $row ) {
          $temp = $saveImagePath . $row->pa_postImgName . "." . $row->pa_postImgExt;
          echo "<td><img src='$temp'><input type='radio' name='$row->pa_idx'></td>";
        }
      ?>
      <td><input type="reset" value="되돌리기"></td>

          <td><input type="submit" value="수정완료"></td>
      
    </tr>
  </table>
</form>
</div>
