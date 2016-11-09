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
<div class="row">
	<div class="large-12 columns">
		<!-- 친구추천 -->
		<hr>
		<h1><i class="fi-lightbulb"></i>Recommend Buddy</h1>
		<div class="row">
			<?php if ($recommendBuddyList) { ?>
				<?php
				$cnt = count($recommendBuddyList);
				var_dump($cnt);

				for ($iCount = 0; $iCount < $cnt; $iCount++) {
					echo "<div class='small-4 columns'>";

					if ($iCount == 0) {
						echo "<div class='image-wrapper overlay-fade-in'>";
					} else if ($iCount == 1) {
						echo "<div class='image-wrapper overlay-slide-in-left'>";
					} else if ($iCount == 2) {
						echo "<div class='image-wrapper overlay-fade-in-new-background'>";
					}

					if (!$recommendBuddyList[$iCount]->m_profileImgName) {
						echo "<img src='/public/img/common/common_profileImg.png'?>";
					} else {
						echo "<img src='/public/img/member/<?=$recommendBuddyList[$iCount] -> m_idx ?>/<?=$recommendBuddyList[$iCount] -> m_profileImgName?>.<?=$recommendBuddyList[0] -> m_profileImgExt ?>' />";
					}

					echo "<div class='image-overlay-content'>";
					echo "<h3><a href='/timeline/index/{$recommendBuddyList[$iCount]->m_idx}'>{$recommendBuddyList[$iCount]->m_nickname}</a></h3>";
					echo "<p class='price'>{$recommendBuddyList[$iCount]->m_region}</p>";
					echo "<a href='/buddy_my/add/{$recommendBuddyList[$iCount]->m_idx}' class='button'>친구신청</a>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
				}
			} ?>
		</div>
		<br>
		<!-- 친구추천end -->
		<hr>
		<h1><i class="fi-clipboard-notes"></i>BuddyList</h1>
		<form action="/buddy_my/buddy_search" method="post">
			<input type="text" name="searchNickname_my" placeholder="search">
			<input type="submit" value="검색">
		</form>
		<br>
		<!--  -->
		<div class="row results">
			<div class="large-12 columns ">
				<div class="search-results">
					<?php
					$searchNickname_my = isset($_POST['searchNickname_my']) ? $_POST['searchNickname_my'] : null;
					if(!$searchNickname_my)
						foreach( $buddy_list as $row ) { ?>
							<div class="row ">
								<div class="large-2 columns">
									<?php if ($row->m_profileImgName) { ?>
										<img src="/public/img/member/<?= $row->b_request_m_idx ?>/<?= $row->m_profileImgName ?>.<?= $row->m_profileImgExt ?>"
											 style="width: 75px; height: 75px;">
									<?php } else { ?>
										<img src="/public/img/common/common_profileImg.png"
											 style="width: 75px; height: 75px;">
									<?php } ?>
								</div>
								<div class="large-10 columns">
									<div class="row">
										<div class="large-9 columns">
											<h2><a href="/timeline/index/<?=$row->b_request_m_idx?>"><?php echo $row -> m_nickname ?>(<?=$row->m_sex?>)</a></h2>
										</div>
										<div class="large-3 columns">
											<a href="/buddy_my/delete/<?=$row->b_midx?>/<?=$row->b_request_m_idx?>"  class="button  expand medium"><span>bye buddy!</span></a>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<?php
						}
					else {
						foreach($buddy_SearchList as $row) {
							?>
							<div class="row ">
								<div class="large-2 columns">
									<?php if ($row->m_profileImgName) { ?>
										<img src="/public/img/member/<?= $row->b_request_m_idx ?>/<?= $row->m_profileImgName ?>.<?= $row->m_profileImgExt ?>" style="width: 75px; height: 75px;">
									<?php } else { ?>
										<img src="/public/img/common/common_profileImg.png" style="width: 75px; height: 75px;">
									<?php } ?>
								</div>
								<div class="large-10 columns">
									<div class="row">
										<div class=" large-9 columns">
											<h2><a href="/timeline/index/<?=$row->b_request_m_idx?>"><?php echo $row -> m_nickname ?>(<?=$row->m_sex?>)</a></h2>
										</div>
										<div class=" large-3 columns">
											<a href="/buddy_my/delete/<?=$row->b_midx?>/<?=$row->b_request_m_idx?>"  class="button  expand medium"><span>bye buddy!</span></a>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
