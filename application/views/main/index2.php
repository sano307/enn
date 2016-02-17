<div class="post_writing" align=center>
<p>home/index Page</p>
<a>로고</a><br>
    <form id="postWrite_form" action="/post/post_write/<?=$_SESSION['login_idx']?>/1" method="post" enctype="multipart/form-data">
        <textarea id="postContent" name="postContent" rows="10" cols="50" placeholder="글을 작성해주세요."></textarea><br>
        <input type="file" name="postImages[]"  accept="image/*" multiple/><br>
        <input type="submit" value="글작성" ><li class="fi-pencil"></li>
    </form>

    <?php
    // foreach ( $getPostInfo as $row ) {
    //     echo "<ul>";
    //     if ( $row['p_postThumbExt'] == "0" ) {
    //         echo "<li><a href='/detail_timeline/index/{$row['p_idx']}/{$row['c_idx']}' style='color: black;'>{$row['p_postThumbName']}</a></li>";
    //     } else {
    //         $argImage = $row['p_postThumbName'] . "." . $row['p_postThumbExt'];
    //         if ( $row['c_idx'] != 1 ) {
    //             echo "<li><a href='/detail_timeline/index/{$row['p_idx']}/{$row['c_idx']}'><img src='/public/img/camp/$getNowMemberNum/$argImage' ></a></li>";
    //         } else {
    //             echo "<li><a href='/detail_timeline/index/{$row['p_idx']}/{$row['c_idx']}'><img src='/public/img/member/$getNowMemberNum/$argImage'></a></li>";
    //         }
    //     }
    //     echo "<li>Hits : {$row['p_postHits']}</li>";
    //     echo "<li>Goods : {$row['p_postGoods']}</li>";
    //     echo "</ul>";
    // }
    ?>
</div>
<!-- <script>
$(document).ready(function() {
    $('postWrite_form').submit(function() {
        if ( $('#postContent').val() == '' ) {
            alert("포스트 내용을 입력해주세요!");
            return false;
        } else {
            return true;
        }
    });
});
</script> -->
