
<div align=center>
	<li><a href="/buddy_my/member_search">친구검색</a></li>
	<a href='<?php echo URL; ?>buddy_my/index?m_idx=<?php echo @$_SESSION['login_idx']?>'>나의친구</a>
	<a href='<?php echo URL; ?>buddy_my/request?m_idx=<?php echo @$_SESSION['login_idx']?>'>친구신청</a><br>
</div>
<table class="table" border="1" align="center">
	<tr>
		<td>
			친구추천<br>
			<!--<form action="<?/*=URL;*/?>buddy_my/recommend" method="post">
				<input type="text" name="searchRecommend" placeholder="search">
				<input type="submit" value="검색">
			</form>-->
				<br><br>
				<?php
					foreach($recommendBuddyList as $row) {
						echo "<a href=".URL."timeline/index/".$row -> m_idx.">".$row -> m_nickname."</a><br>";
					}
				?>
		</td>
		<td>
			친구목록<br>
			<form action="/buddy_my/buddy_search" method="post">
				<input type="text" name="searchNickname_my" placeholder="search">
				<input type="submit" value="검색">
			</form>
				<br><br>
				<?php
				$searchNickname_my = isset($_POST['searchNickname_my']) ? $_POST['searchNickname_my'] : null;
				if(!$searchNickname_my)
					foreach($buddy_list as $row) {
						echo "<a href=".URL."timeline/index?b_requestedMember=".$row -> b_requestedMember.">".$row -> b_requestedMember."</a><br>";
					}
				else {
					foreach($buddy_SearchList as $row) {
						echo "<a href=".URL."timeline/index?b_requestedMember=".$row -> b_requestedMember.">".$row -> b_requestedMember."</a><br>";
					}
				}
				?>
		</td>
	</tr>
</table>
