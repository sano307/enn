<br>
<br>
<div align=center>
	<div class="row">
			<div class="small-12 large-4 columns">
	      <a href="/buddy_my/index/<?php echo @$_SESSION['login_idx']?>" class="fancy radius button"><i class="fi-address-book"></i>My Buddy</a>
	    </div>
      <div class="small-12 large-4 columns">
        <a href="/buddy_my/member_search" class="fancy radius button"><i class="fi-magnifying-glass"></i>User Search</a>
      </div>
			<div class="small-12 large-4 columns">
	      <a href="/buddy_my/request/<?php echo @$_SESSION['login_idx']?>" class="fancy radius button"><i class="fi-plus"></i>Buddy Request</a>
	    </div>
	</div>
</div>


<div class="row results">
    <div class="large-12 columns ">
        <h1><i class="fi-checkbox"></i>Request Buddy</h1>
        <hr>
        <!-- 친구 신청 온 목록 -->
        <div class="search-results">
            <?php foreach ($buddy_RequestList as $row) { ?>
                <div class="row ">
                    <div class="large-2 columns">
                        <a href="#">
                            <?php if ($row->m_profileImgName) { ?>
                                <img
                                    src="/public/img/member/<?= $row->m_idx; ?>/<?= $row->m_profileImgName; ?>.<?= $row->m_profileImgExt; ?>"
                                    alt="book cover" class=" thumbnail">
                            <?php } else { ?>
                                <img src="/public/img/common/common_profileImg.png" alt="book cover"
                                     class=" thumbnail"/>
                            <?php } ?>
                        </a>
                    </div>
                    <div class="large-10 columns">
                        <div class="row">
                            <div class=" large-9 columns" style="color: black; font-size: 20px; font-weight: bold;">
                                <span>NickName : <a href="/timeline/index/<?= $row->m_idx ?>"><?php echo $row->m_nickname ?></a></span><br/>
                                <span>Region : <?= $row->m_region; ?></span><br/>
                                <span>Present State : <?php if ( $row->m_connectionState == 1 ) echo "Connect"; else echo "Disconnect"; ?></span><br/>
                            </div>
                            <div class=" large-3 columns">
                                <form action="/buddy_my/request" method='post'>
                                    <input type="hidden" name="buddyOK" value="1">
                                    <input type="hidden" name="m_idx" value="<?php echo $row->b_midx ?>">
                                    <input type="hidden" name="b_request_m_idx"
                                           value="<?php echo $row->b_request_m_idx ?>">
                                    <input type="hidden" name="b_idx" value="<?php echo $row->b_idx ?>">
                                    <input type="submit" value="OK Buddy!" class="button  expand medium">
                                </form>
                                <form action="/buddy_my/request" method='post'>
                                    <input type="hidden" name="buddyNO" value="-1">
                                    <input type="hidden" name="m_idx" value="<?php echo $row->b_midx ?>">
                                    <input type="hidden" name="b_idx" value="<?php echo $row->b_idx ?>">
                                    <input type="submit" value="Sorry!" class="button  expand medium">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            <?php } ?>
        </div>
    </div>
</div>
