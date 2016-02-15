<?php $current_p_idx = 1 ?>
<div style="border:5px double; width:500px; padding:20px;">
    댓글작성<br><br>
    <table>
        <tr>
            <form action="<?php echo URL; ?>reply/reply_write" method="post">
                <td><textarea name="replyContent" cols="50" rows="10" style="resize:none;"></textarea></td>
        <tr><td><input type="submit" value="작성"></td></tr>
        <input type="hidden" name="m_idx" value="<?php echo $_SESSION['login_idx']; ?>">
        <input type="hidden" name="p_idx" value="<?php echo $current_p_idx; ?>">
        </form>
        </tr>
        <tr><td><hr></td></tr>
        <table>
            <?php foreach($reply_list as $row) { ?>
                <tr><td width='20'><?=$row -> m_idx ?></td>
                    <form action="<?=URL;?>reply/reply_update" method="post">
                        <td><input type="text" name="replyContent" value="<?=$row -> pr_content ?>"></td>
                        <td><?=$row -> pr_registerTime ?></td>
                        <td><input type="submit" value="완료">
                            <input type="hidden" name="p_idx" value="<?=/*$row -> p_idx*/$current_p_idx?>">
                            <input type="hidden" name="pr_idx" value="<?=$row -> pr_idx?>"></td></form>
                        <form action="<?=URL;?>reply/reply_delete" method="post">
                            <td><input type="submit" value="삭제">
                                <input type="hidden" name="pr_idx" value="<?=/*$row -> pr_idx*/$current_p_idx ?>"></td></form>
                </tr>
            <?php } ?>
        </table>
    </table>
</div>