<a href='<?= URL; ?>buddy_my/index?m_idx=<?=$_SESSION['login_idx']?>'>나의친구</a> <a href='<?= URL; ?>buddy_my/request?m_idx=<?= @$_SESSION['login_idx']?>'>친구신청</a><br>
<h3>나에게 온 친구신청</h3><br>
<?php if(!$buddy_RequestList) echo "신청목록이 없습니다."; ?>
<table>
    <?php foreach($buddy_RequestList as $row) { ?>
        <tr>
        <td><a href="<?= URL; ?>timeline/index"><?php echo $row -> b_requestedMember ?></a></td>
        <td><form action="<?php echo URL; ?>buddy_my/request" method='post'>
            <input type="hidden" name="buddyOK" value="1">
            <input type="hidden" name="m_idx" value="<?php echo $row -> m_idx ?>">
            <input type="hidden" name="b_requestedMember" value="<?php echo $row -> b_requestedMember ?>">
            <input type="submit" value="수락">
        </form></td>
        <td><form action="<?= URL; ?>buddy_my/request" method='post'>
            <input type="hidden" name="buddyNO" value="-1">
            <input type="hidden" name="m_idx" value="<?php echo $row -> m_idx ?>">
            <input type="hidden" name='b_requestedMember' value="<?php echo $row -> b_requestedMember ?>">
            <input type="submit" value="거절">
        </form></td></tr>
    <?php } ?>
</table>
