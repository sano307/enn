<style>
.service {
width: 100%;
height: 320px;
margin: 80px 0;
text-align: center;
border: 1px solid #ddd;
-webkit-transition: all 0.3s ease;
transition: all 0.3s ease; }
.service .service-icon-box {
  position: relative;
  top: 100px;
  display: inline-block;
  margin-bottom: 40px;
  padding: 10px;
  background: white;
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease; }
.service .service-heading {
  position: relative;
  top: 80px;
  -webkit-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
  transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55); }
.service .service-description {
  width: 80%;
  margin: 0 auto;
  opacity: 0;
  -webkit-transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
  transition: all 600ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
  -webkit-transform: scale(0);
  -ms-transform: scale(0);
  transform: scale(0); }
.service .service-icon-box > img.service-icon {
  width: 40px; }
.service:hover {
  border-color: #00a8ff; }
.service:hover .service-icon-box {
  top: -30px; }
.service:hover .service-heading {
  top: -30px; }
.service:hover .service-description {
  opacity: 1;
  -webkit-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1); }

</style>
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
  <div class="large-12 columns ">
<h1><i class="fi-page-search"></i>User Search</h1>
<div align="center">
  <div class="large-4 columns ">
<form action="/buddy_my/member_search" method="post">
    <input type="text" id="buddySearch" name="buddySearch" placeholder="닉네임을 입력해주세요.">
    <!-- <input type="submit" value="검색"> -->
</form>
</div>
<br>

<?php
$buddySearch = isset($_POST['buddySearch']) ? $_POST['buddySearch'] : null;
if($buddySearch) {

    foreach($buddy_SearchList as $row) { ?>
        <img src=""></a>


<div class="row">
  <div class="small-6 small-centered columns">

    <div class="service">
      <div class="service-icon-box">
        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/5/5a/SpaceX_CRS-3.png/360px-SpaceX_CRS-3.png" alt="" class="service-icon">
      </div>
      <h4 class="service-heading"><a href="<?=URL;?>timeline/index/<?= $row->m_idx; ?>"><?=$row -> m_nickname ?></a></h4>
      <p class="service-description">
        친구내용<?=$row -> m_nationally ?>
        <?=$row -> m_region ?>
      </p>
    </div>

  </div>
</div>


<?php
    }
} else if(@$buddy_SearchList == null) {
        echo "검색결과가 없습니다.";
}
?>

</div>
<script>
    $('form').submit(function() {
        if ( $('#buddySearch').val() == '' ) {
            alert("검색할 닉네임을 입력해주세요!");
            return false;
        } else {
            return true;
        }
    })
</script>

</div>
</div>
