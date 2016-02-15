그룹 상세보기 
<table border="1">
   <tr>
      <td colspan="2">
         <?php 
          echo "<img src='/public/img/camp/{$groupinfo->c_idx}/{$groupinfo->c_campImgName}.{$groupinfo->c_campImgExt}'>";
            echo "<br>관리자번호 : ".$groupinfo->m_idx;
            echo "<br>그룹명: ".$groupinfo->c_campName;
            echo "<br>그룹소개: ".$groupinfo->c_campIntroduction;
            echo "<br>그룹지역: ".$groupinfo->c_campRegion;
            echo "<br>인원제한 수 : ".$groupinfo->c_campTheNumber;
  
            ?>
      </td>
   </tr>
   <tr>
      <td>
         --------------포스트 공지사항----------------<br>
         공지사항 내용 <br>
         <table border="1">
         <tr>
            <td>공지번호</td>
            <td>공지된 그룹번호</td>
            <td>제목</td>
            <td>내용</td>
            <td>기간</td>

         </tr>
         <?php
            foreach($groupnotice as $row){
               echo "<tr>";
               echo"<td>".$row->cn_idx;
               echo"</td><td>".$row->c_idx;
               echo"</td><td>".$row->cn_campNoticeTitle;
               echo"</td><td>".$row->cn_campNoticeContent;
               echo"</td><td>".$row->cn_campNoticeregistedTime;
               echo "</td></tr>";
            }
         ?>
         </table>
         <?php
            if($group_join_m_idx_check!=null){
         ?>
         ------------------그룹 글쓰기--------------------<br>
         그룹 글쓰기<br>
         <div class="post_writing">
             <form action="/post/post_write/<?=$_SESSION['login_idx']?>/<?=$groupinfo->c_idx?>" method="post" enctype="multipart/form-data">
                 <textarea id="postContent" name="postContent" rows="10" cols="50" placeholder="글을 작성해주세요."></textarea>
                 <input type="file" name="postImages[]"  accept="image/*" multiple/>
                 <input type="submit" name="posting" value="글 작성">
             </form>
         </div>
         <br>
         <?php
          }
          ?>
         ------------------그룹 타임라인--------------------<br>

            <?php
                
               foreach($grouppost as $row){
                echo"<div class='post_writing' align=center><ul>";
                  if ( $row->p_postThumbExt != "0" ) {
                    $postThumbSavePath = "/public/img/camp/".$row->c_idx."/"; 
                    $postThumbSaveName=$row->p_postThumbName.".".$row->p_postThumbExt;
                    $temp = $postThumbSavePath.$postThumbSaveName;
                    echo"<li><a href='/detail_timeline/index/{$row->p_idx}/{$row->c_idx}'><img src='$temp' ></a></li>";
                  } else {
                    echo"<li><a href='/detail_timeline/index/{$row->p_idx}/{$row->c_idx}'>{$row->p_postThumbName}</a></li>";
                  }
                  echo"<li>writer:{$row->m_idx}</li>";
                  echo"<li>Hits:{$row->p_postHits}</li>";
                  echo"<li>Goods:{$row->p_postGoods}</li>";
                  echo"</ul></div><br>";
               }
         ?>
         


      </td>
      <td>
        그룹 채팅방 <br> nodejs
      </td>
   </tr>
</table>

<script>
    $('form').submit(function() {
        if ( $('#postContent').val() == '' ) {
            alert("포스트 내용을 입력해주세요!");
            return false;
        } else {
            return true;
        }
    })
</script>
