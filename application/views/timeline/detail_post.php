<style>
    i.icon {
        display: inline-block;
        width: 32px;
        height: 32px;
        background: #ebebeb;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 0;
        margin-top: -16px;
    }
    i.icon::before {
        content: "";
        display: block;
        background: #c2c2c2;
        width: 10px;
        height: 10px;
        border-radius: 1000px;
        position: absolute;
        left: 50%;
        margin-left: -5px;
        top: 5px;
    }
    i.icon::after {
        content: "";
        display: block;
        background: #c2c2c2;
        width: 20px;
        height: 10px;
        border-radius: 1000px 1000px 0 0;
        display: block;
        position: absolute;
        left: 50%;
        margin-left: -10px;
        top: 15px;
    }

    h6.byline {
        padding-left: 0px;
        position: relative;
        margin-bottom: 15px;
        margin-top: 10px;
    }
    h6.byline .data {
        font-weight: 400;
    }
    h6.byline .label {
        font-size: 60%;
    }

    .commentContent {
        padding-left: 20px;
    }

    .indented.comment {
        padding-left: 15px;
        border-left: 1px solid #ebebeb;
    }

    .push {
        margin-bottom: 40px;
    }

    .bullets {
        margin-left: 30px;
    }
</style>

<!-- 포스트를 클릭했을 때 뜨는 해당 포스트의 상세 페이지 -->
<?php
$postImageInfo = isset($nowPostImageInfo) ? $nowPostImageInfo : null;
$postReplyInfo = isset($nowPostReplyInfo) ? $nowPostReplyInfo : null;
?>

<div class="row">
    <div class="large-30  small-20 columns">
        <!-- COMMENT -->
        <div class="comment">
            <section class="top">
                <h3 class="byline">
                    <a href="#">
                        <?php if( $nowPostWriterInfo->m_profileImgName ) { ?>
                            <img src="/public/img/member/<?=  $nowPostWriterInfo->m_idx ?>/<?=  $nowPostWriterInfo->m_profileImgName ?>.<?=  $nowPostWriterInfo->m_profileImgExt ?>" style="width: 30px; height: 30px;">
                        <?php } else { ?>
                            <img src="/public/img/common/common_profileImg.png" style="width: 30px; height: 30px;">
                        <?php } ?>
                        <?= $nowPostWriterInfo->m_nickname; ?></a>
                    <small>
                        <span class="data">
                            <?= $nowPostWriterInfo->p_registedTime; ?>
                        </span>
                    </small>
                    <?php if( $_SESSION['login_idx'] == $nowPostWriterInfo->m_idx ){ ?>
                        <i><a href="/post/post_modify/<?=$nowPostWriterInfo->p_idx?>">update</a></i>
                        <?php } ?>
                </h3>
            </section>
            <section class="content">
                <br>
                <p>
                    <?php if( $nowPostLikeState == null ) { ?>
                        <li><a href = '/post/post_like/<?= $nowPostWriterInfo->p_idx ?>'> <i class="fi-heart"></i></a></li>
                    <?php } ?>
                <?php foreach ( $nowPostImageInfo as $row ) {
                    echo "<img src='/public/img/member/{$nowPostWriterInfo->m_idx}/{$row->pa_postImgName}.{$row->pa_postImgExt}'>";
                } ?>

                <p>
                    본글<div id="sourceText"><?= $nowPostWriterInfo->p_content ?></div>
                </p>
                <hr>
                일본어 번역 : <div id="translation_ko"></div>
                <hr>
                한국어 번역 : <div id="translation_ja"></div>

                <hr>
                <!-- 트윗 공유버튼 -->
                <a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="ennsns">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                <!-- 트윗 공유버튼 끝 -->
                <!-- 페이스북 공유버튼 -->
                <a name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">공유하기</a>
                <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript">
                </script>
                <!-- 페이스북 공유버튼 끝 -->

                <a href="/post/post_like/<?=$nowPostWriterInfo->p_idx?>">Like <?=$nowPostWriterInfo->p_postGoods?></a><br><br>

            </section>
            <section class="actions">

                <hr>

                >>Write Reply
                <form action="/reply/reply_write" method="post">
                    <textarea name="replyContent" cols="30" rows="1" style="resize:none;"></textarea>
                    <!-- c_idx를 불러와야지 댓글을 작성후 다시 이페이지로 돌아올지 이미지의 경로를 설정해줄 수 있다. -->
                    <input type="hidden" name="current_m_idx" value="<?=$current_m_idx?>">
                    <input type="hidden" name="p_idx" value="<?=$nowPostWriterInfo->p_idx;?>">
                    <input type="submit" value="작성">
                </form>

            </section>

            <!--  -->
            <?php
            if ( !$postReplyInfo ) {
                // 댓글이 존재하지 않을 경우
                echo "No Reply...";
            } else {
                // 댓글이 존재할 경우
                foreach ( $postReplyInfo as $row ) {
                    ?>
                    <div class="indented comment">
                        <section class="top">
                            <h6 class="byline">
                                <a href="/timeline/index/<?= $row->m_idx ?>">
                                    <img src="/public/img/member/<?= $row->m_idx ?>/<?= $row->m_profileImgName ?>.<?= $row->m_profileImgExt ?>" style="width: 30px; height: 30px;">
                                    <?=$row->m_nickname?>
                                </a>
                                <small>said
                							<span class="data">
                								<?=$row -> pr_registedTime ?>
                							</span>
                                </small>
                            </h6>
                        </section>
                        <section class="content">
                            <div class="commentContent">
                                <?=$row -> pr_content ?>
                            </div>
                        </section>
                        <section class="actions">

                            <ul class="inline-list">
                                <?php
                                if($row -> m_idx == $_SESSION['login_idx']) { ?>
                                    <a href="/reply/reply_update/<?= $row -> pr_idx ?>/<?=$row -> p_idx?>">수정</a>
                                    <a href="/reply/reply_delete/<?= $row -> pr_idx ?>/<?=$row -> p_idx?>/<?php if($nowPostCampInfo != 1) { echo $nowPostCampInfo;} else { echo '1'; } ?>">삭제</a>
                                <?php } ?>
                            </ul>

                        </section>

                    </div>



                    <?php

                }
            }
            ?>
            <!--  -->

        </div>
    </div>

</div>

<!-- 번역기 -->
<script>
    function translateText_ko(response) {
        document.getElementById("translation_ko").innerHTML += "<br>" + response.data.translations[0].translatedText;
    }
    function translateText_ja(response) {
        document.getElementById("translation_ja").innerHTML += "<br>" + response.data.translations[0].translatedText;
    }

    var newScript = document.createElement('script');
    newScript.type = 'text/javascript';
    var sourceText = escape(document.getElementById("sourceText").innerHTML);

    var source = 'https://www.googleapis.com/language/translate/v2?key=AIzaSyBDjE8Q53z6sD0dqbuy5sLeEVKzipdaJD4&source=ko&target=ja&callback=translateText_ko&q=' + sourceText;
    newScript.src = source;
    document.getElementsByTagName('head')[0].appendChild(newScript);

    var newScript = document.createElement('script');
    newScript.type = 'text/javascript';
    var sourceText = escape(document.getElementById("sourceText").innerHTML);

    var source = 'https://www.googleapis.com/language/translate/v2?key=AIzaSyBDjE8Q53z6sD0dqbuy5sLeEVKzipdaJD4&source=ja&target=ko&callback=translateText_ja&q=' + sourceText;
    newScript.src = source;
    document.getElementsByTagName('head')[0].appendChild(newScript);
</script>

<!-- 번역기 끝 -->
<script type="text/javascript">
    function postDeleteCheck() {
        return confirm("정말 삭제하시겠습니까?");
    }
</script>
