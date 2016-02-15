
<div style="border:5px double; width:1000px; padding:20px;">
    <h3 align="center">공지사항</h3><br>
    <div style="border:2px double; padding:20px;">
        <?php foreach($master_notice as $row) { ?>
        #<?=@$row -> n_noticeTitle;?> : <?=@$row -> n_noticeContent;?>
        <?php } ?>
    </div><br>
    <form action="<?=URL;?>master/notice/<?=$_SESSION['login_idx']?>" method="post">
        <input type="text" name="noticeTitle" placeholder="제목을 입력하세요."><br><br>
        <textarea name="noticeContent" placeholder="내용을 입력하세요." cols="50" rows="5" style="resize:none;"></textarea><br>
        <input type="submit" value="작성">
    </form>
</div><br>
<div align="center">
<form action="<?php echo URL;?>master/search" method="post">
    <input type="radio" name="category" value="member" checked> 회원
    <input type="radio" name="category" value="camp"> 그룹
    <input type="radio" name="category" value="post"> 포스트
    <input type="text" name="totalsearch">
    <input type="submit" value="검색">
</form>
</div><br>
<div style="border:5px double; width:530px; padding:20px; text-align:center;">
<table style="border:5px double cornflowerblue; padding:10px; text-align:center;">
    <?php if(@$_POST['category'] == "member") {
        echo "<tr><td>Num</td><td>ID</td><td>Nickname</td><td>Password</td><td>Nationally</td><td>Region</td><td>sex</td>";
        echo "<tr>";
        foreach($memberSearchList as $row) {
            echo "<td>".$row -> m_idx."</td><td>".$row -> m_memberID."</td><td>".$row -> m_nickname."</td><td>".$row -> m_memberPasswd."</td><td>".$row -> m_nationally."</td><td>".$row -> m_region."</td><td>".$row -> m_sex."</td><td><a href=".URL."/master/delete_info?m_idx=".$row -> m_idx.">삭제</a></td>";
            echo "</tr>";
        }
    } elseif(@$_POST['category'] == "camp") {
        echo "<tr><td>CampName</td><td>Leader</td><td>Region</td>";
        echo "<tr>";
        foreach($campSearchList as $row) {
            echo "<td>".$row -> c_campName."</td><td>".$row -> m_idx."</td><td>".$row -> c_campRegion."</td><td><a href=".URL."/master/delete_info?c_idx=".$row -> c_idx.">삭제</a></td>";
            echo "</tr>";
        }
    } elseif(@$_POST['category'] == "post") {
        echo "<tr><td>Num</td><td>member</td><td>content</td><td>registedTime</td>";
        echo "<tr>";
        foreach($postSearchList as $row) {
            echo "<td>".$row -> p_idx."</td><td>".$row -> m_idx."</td><td>".$row -> p_content."</td><td>".$row -> p_registedTime."</td><td><a href=".URL."/master/delete_info?p_idx=".$row -> p_idx.">삭제</a></td>";
            echo "</tr>";
        }
    }?>
</table>
</div>
