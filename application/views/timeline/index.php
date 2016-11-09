<style>
    /*카드 css*/
    @import url(//fonts.googleapis.com/css?family=Roboto:400,500,300,100,700,900);
    .card {
        font-family: 'Roboto', sans-serif;
        overflow: hidden;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        color: #272727;
        border-radius: 2px; }
    .card .title {
        line-height: 3rem;
        font-size: 1.5rem;
        font-weight: 300; }
    .card .content {
        padding: 1.3rem;
        font-weight: 300;
        border-radius: 0 0 2px 2px; }
    .card p {
        margin: 0; }
    .card .action {
        border-top: 1px solid rgba(160, 160, 160, 0.5);
        padding: 0.3rem;
        text-align: center;}
    .card a {
        color: black;
        margin-right: 1.3rem;
        transition: color 0.3s ease;
        text-transform: uppercase;
        text-decoration: none; }
    .card .image {
        position: relative; }

    .card .image img {
        border-radius: 2px 2px 0 0; }
    /*카드 css 끝*/


    /*버튼css*/
    .fancy.button {
        background-color: #fff;
        *zoom: 1;
        filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0, startColorstr='#FFFFFFFF', endColorstr='#FFEFEFEF');
        background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #ffffff), color-stop(73%, #f7f7f7), color-stop(100%, #efefef));
        background-image: -webkit-linear-gradient(top, #ffffff 0%, #f7f7f7 73%, #efefef 100%);
        background-image: -moz-linear-gradient(top, #ffffff 0%, #f7f7f7 73%, #efefef 100%);
        background-image: -o-linear-gradient(top, #ffffff 0%, #f7f7f7 73%, #efefef 100%);
        background-image: linear-gradient(top, #ffffff 0%, #f7f7f7 73%, #efefef 100%);
        border: 1px solid rgba(52, 73, 94, 0.2);
        color: rgba(52, 152, 219, 0.7);
        font-size: 0.75em;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }
    .fancy.button:hover {
        color: #3498db;
        background-color: #fff;
        *zoom: 1;
        filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0, startColorstr='#FFFFFFFF', endColorstr='#FFEDEDED');
        background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #ffffff), color-stop(73%, #efefef), color-stop(100%, #ededed));
        background-image: -webkit-linear-gradient(top, #ffffff 0%, #efefef 73%, #ededed 100%);
        background-image: -moz-linear-gradient(top, #ffffff 0%, #efefef 73%, #ededed 100%);
        background-image: -o-linear-gradient(top, #ffffff 0%, #efefef 73%, #ededed 100%);
        background-image: linear-gradient(top, #ffffff 0%, #efefef 73%, #ededed 100%);
        border-color: rgba(52, 73, 94, 0.3);
        -webkit-box-shadow: 0px 0px 6px rgba(52, 73, 94, 0.1);
        -moz-box-shadow: 0px 0px 6px rgba(52, 73, 94, 0.1);
        box-shadow: 0px 0px 6px rgba(52, 73, 94, 0.1);
    }
    .fancy.button:active {
        -webkit-box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1) inset;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1) inset;
    }
    /*버튼 css 끝*/

</style>
<script type="text/javascript" src="<?php echo URL; ?>/foundation/js/foundation.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>/foundation/js/scl/jquery-ias.min.js"></script>

<link rel='stylesheet' href='<?php echo URL;?>/public/css/main/buddyrecommend.css'>
<link rel='stylesheet' href='<?php echo URL;?>/public/css/main/grouprecommend.css'>
<link rel='stylesheet' href='<?php echo URL;?>/public/css/main/notice.css'>
<script src="<?php echo URL;?>/public/js/postwrite.js"></script>
<script type="text/javascript">
        jQuery.ias({
            container : '.wrap', // main container where data goes to append
            item: '.item', // single items
            pagination: '.nav', // page navigation
            next: '.nav a', // next page selector
            loader: '<img src="<?php echo URL; ?>/foundation/img/scl/ajax-loader.gif"/>', // loading gif
            triggerPageThreshold: 3 // show load more if scroll more than this
        });
</script>
<br>
<br>
<div class="row">
    <div class="large-3 columns" style="height: 150px;">
        <div class="card">
            <div class="image">
                <?php if ( !$timelineMemberInfo[0]->m_profileImgName ) { ?>
                    <img src='/public/img/common/common_profileImg.png' alt='profile image'></center>
                <?php } else { ?>
                    <img src="/public/img/member/<?= $timelineMemberInfo[0]->m_idx ?>/<?= $timelineMemberInfo[0]->m_profileImgName ?>.<?= $timelineMemberInfo[0]->m_profileImgExt ?>" alt='profile image'>
                <?php } ?>
            </div>
            <div class="content">
                <p>
                <h3><?= $timelineMemberInfo[0]->m_nickname; ?>
                    <?php
                    if ($timelineMemberInfo[0]->m_region == 'F') {
                        echo "(<i class='fi-female-symbol'></i>)";
                    } else {
                        echo "(<i class='fi-male-symbol'></i>)";
                    }
                    ?>
                </h3>
                <i class='fi-map'></i>:<strong><?= $timelineMemberInfo[0]->m_nationally; ?></strong>
                <i class='fi-marker'></i><strong><?= $timelineMemberInfo[0]->m_region; ?></strong>
                <br>
                </p>
            </div>
            <div class="action">
                <a><i class="fi-male-female"></i> 2 </a>
                <a><i class="fi-social-myspace"></i> 2 </a>
            </div>
            <div class="action">
                <?php
                if ($_SESSION['login_idx'] != $timelineMemberInfo[0]->m_idx) {
                    if (!$buddystate) {
                        ?>
                        <a href="/buddy_my/add/<?= $timelineMemberInfo[0]->m_idx ?>"><img
                                src="/public/img/common/buddystatePlus.png" width='25px'></a>
                    <?php
                    } else {
                    ?>
                        <a href="#" onclick="identify()"><img
                                src="/public/img/common/buddystateMinus.png" width='25px'></a>
                        <script>
                            function identify() {
                                if (confirm("삭제하시겠습니까?")) {
                                    location.href = "/buddy_my/delete/<?= $timelineMemberInfo[0]->m_idx ?>/<?= $_SESSION['login_idx'] ?>";
                                }
                            }
                        </script>
                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
<div class="wrap">
    <div class="large-6 columns">
        <div class="row" style="color: black;">
            <fieldset>
                <legend>Post Write</legend>
                <form action="/post/post_write/<?= $_SESSION['login_idx']; ?>" method="post" enctype="multipart/form-data">
                    제목 : <input type="text" name="title" required/>
                    내용 : <textarea name="content" required></textarea>
                    <input type="file" name="images[]" accept="image/*" multiple/>
                    <input type="hidden" name="state" value="timeline" />
                    <button type="submit" class="button tiny info" style="font-weight: bold; font-size: 18px;">Post Writing</button>
                </form>
            </fieldset>
        </div>

        <?php
        $current_m_idx=$_SESSION['login_idx'];
        if ( !$timelinePostInfo ) {
            echo "<h3><i class='fi-x'></i>첫 포스트를 작성해주세요.</h3>";
        } else {
            $postThumbSavePath = "/public/img/member/";
            foreach ( $timelinePostInfo as $row ) {
                ?>
                <div class="row">
                  <div class="item" id="item-<?php echo $row -> p_idx; ?>">
                    <div class="card" style="height: 400px;">
                        <div class="content">
                            <!-- 포스트 글쓴이 포스트 -->
                            <div class="large-2 columns small-3">
                                <?php if ( !$timelineMemberInfo[0]->m_profileImgName ) { ?>
                                    <a href='/timeline/index/<?=$row->m_idx?>'><img src='/public/img/common/common_profileImg.png'  alt='profile image'><br><small><?= $timelineMemberInfo[0]->m_nickname; ?></small></a>
                                <?php } else { ?>
                                    <a href='/timeline/index/<?=$row->m_idx?>'><img src="/public/img/member/<?= $timelineMemberInfo[0]->m_idx ?>/<?= $timelineMemberInfo[0]->m_profileImgName ?>.<?= $timelineMemberInfo[0]->m_profileImgExt ?>"  alt='profile image'><br><small><?= $timelineMemberInfo[0]->m_nickname; ?></small></a>
                                <?php } ?>
                            </div>
                            <div class="large-10 columns">
                                <p>
                                    <?php
                                    echo "<span class='data' style='font-weight: bold; font-size: 20px;'>".$row->p_registedTime."</span>";
                                        if($row->p_postThumbName){
                                        $temp = $postThumbSavePath . $row->m_idx . "/" . $row->p_postThumbName . "." . $row->p_postThumbExt;
                                    ?>
                                    <br>
                                    <a href="#" data-reveal-id="videoModal<?=$row->p_idx?>">
                                      <img src='<?=$temp?>' style='width:100%'>
                                    <br><?=$row->p_content?>&hellip;</a>

                                <div id="videoModal<?=$row->p_idx?>" class="reveal-modal large" data-reveal aria-labelledby="videoModalTitle" aria-hidden="true" role="dialog">
                                    <h2 id="videoModalTitle"><i class="fi-paperclip"></i> Detail Post<hr></h2>
                                    <div class="flex-video widescreen vimeo">
                                        <iframe src="/detail_timeline/index/<?=$row->p_idx?>/<?=$row->c_idx?>/<?=$current_m_idx?>" frameborder="0" ></iframe>
                                    </div>


                                    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                                </div>


                                <?php
                                }
                                else{
                                    ?>
                                    <br>
                                    <a href="#" data-reveal-id="videoModal<?=$row->p_idx?>"><?=$row->p_content?>&hellip;</a>

                                    <div id="videoModal<?=$row->p_idx?>" class="reveal-modal large" data-reveal aria-labelledby="videoModalTitle" aria-hidden="true" role="dialog">
                                        <h2 id="videoModalTitle"><i class="fi-paperclip"></i> Detail Post<hr></h2>
                                        <div class="flex-video widescreen vimeo">
                                            <iframe src="http://localhost/detail_timeline/index/<?=$row->p_idx?>/<?=$row->c_idx?>/<?=$current_m_idx?>" frameborder="0" ></iframe>
                                        </div>


                                        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                                    </div>

                                    <?php
                                }
                                ?>
                                </p>
                                <div class="action">
                                    <a href=""><i class="fi-heart"><?=$row->p_postGoods?></i>개</a>
                                    <a href=""><i class="fi-comments"><?=$row->p_postHits?></i>개</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                    <?php if (isset($next)): ?>
                        <div class="nav">
                            <a href='/timeline/scroll/<?=$next?>/<?=$timelineMemberInfo[0]->m_idx?>'>Next</a>
                        </div>
                    <?php endif?>
                </div>
              </div>
                <?php
            }}
        ?>
        <!--  -->
    </div>
</div>

    <aside class="large-3 columns hide-for-small">
        <!-- <p><img src="http://placehold.it/300x440&text=[ad]"/></p> -->
        <p><h3>Offline Camp</h3></p>
        <p><img src="/public/img/common/timeline_add.jpg"/></p>
        <p><img src="/public/img/common/timeline_add2.jpg"/></p>
    </aside>
</div>
