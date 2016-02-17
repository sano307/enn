<link rel='stylesheet' href='<?php echo URL; ?>/public/css/main/buddyrecommend.css'>
<link rel='stylesheet' href='<?php echo URL; ?>/public/css/main/grouprecommend.css'>
<link rel='stylesheet' href='<?php echo URL; ?>/public/css/main/notice.css'>

<!-- 공지사항 -->
<div class="row">
    <div class="small-6 small-centered columns">

        <div data-alert class="alert-box info">
            <strong>Oops</strong> - The most dreadful word in nuclear physics.
            <a href="#" class="close">&times;</a>
        </div>
        <div data-alert class="alert-box alert">
            <strong>Error</strong> - You are the error.
            <a href="#" class="close">&times;</a>
        </div>
        <div data-alert class="alert-box success">
            <strong>Yay!</strong> - You accomplished a simple task!
            <a href="#" class="close">&times;</a>
        </div>

    </div>
</div>
<!-- 공지사항 끝 -->
<div class="row">
    <div class="large-12 columns">
        <div class="panel">
            <h1>오늘의 새로운 친구</h1>

            <div class="row">
                <?php
                foreach ($getBuddyRecommend as $row) {
                    ?>
                    <div class="small-4 columns">
                        <div class="image-wrapper overlay-fade-in">
                            <?php
                            // 프로필 사진이 없는 경우
                            if (!@$_SESSION['login_profileThumbName']) {
                                ?>
                                <img src='/public/img/common/common_profileImg.png' alt='profile image'>
                                <?php
                            } else {
                                // 프로필 사진이 있는 경우
                                ?>
                                <img
                                    src="/public/img/member/<?= $row->m_idx ?>/<?= $row->m_profileImgName ?>.<?= $row->m_profileImgExt ?>"
                                    alt='profile image'>
                                <?php
                            }
                            ?>
                            <div class="image-overlay-content">
                                <p class="price"><a
                                        href='<?php echo URL; ?>timeline/index/<?= $row->m_idx ?>'><?= $row->m_nickname ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>


<div class="row">

    <h4>오늘의 새로운 그룹</h4>

    <div class="large-3 columns ">
        <?php
        foreach ($getGroupRecommend as $row) {
            ?>
            <div class="panel">
                <div class="row">
                    <div>
                        <div class="service">
                            <div class="service-icon-box">
                                <?php
                                if ($row->c_campThumbName == null) {
                                    echo "등록된 사진이 없습니다.";
                                } else {
                                    echo "<img src='" . URL . "public/img/camp/" . $row->c_idx . "/" . $row->c_campImgName . "." . $row->c_campImgExt . "'  alt='' class='service-icon'>";
                                }
                                ?>

                                <div class="section-container vertical-nav" data-section
                                     data-options="deep_linking: false; one_up: true">
                                </div>
                            </div>
                            <h4 class="service-heading"><?= $row->c_campName ?></h4>

                            <p class="service-description"><?= $row->c_campRegion ?> <?= $row->c_campIntroduction ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="large-6 columns">
        <div class="row">
            <form id="postWrite_form" action="/post/post_write/<?= $_SESSION['login_idx'] ?>/1" method="post"
                  enctype="multipart/form-data">
                <textarea id="postContent" name="postContent" rows="10" cols="50"
                          placeholder="글을 작성해주세요."></textarea><br>
                <input type="file" name="postImages[]" accept="image/*" multiple/><br>
                <input type="submit" value="글작성">
            </form>
        </div>
        <hr/>
        <div class="row">
            <div class="large-2 columns small-3"><img src="http://placehold.it/80x80&text=[img]"/></div>
            <div class="large-10 columns">
                <p><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod
                    commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork
                    biltong.</p>
                <ul class="inline-list">
                    <li><a href="">Reply</a></li>
                    <li><a href="">Share</a></li>
                </ul>
                <h6>2 Comments</h6>

                <div class="row">
                    <div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>
                    <div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod
                            commodo, chuck duis velit. Aute in reprehenderit</p></div>
                </div>
                <div class="row">
                    <div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>
                    <div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod
                            commodo, chuck duis velit. Aute in reprehenderit</p></div>
                </div>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="large-2 columns small-3"><img src="http://placehold.it/80x80&text=[img]"/></div>
            <div class="large-10 columns">
                <p><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod
                    commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork
                    biltong.</p>
                <ul class="inline-list">
                    <li><a href="">Reply</a></li>
                    <li><a href="">Share</a></li>
                </ul>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="large-2 columns small-3"><img src="http://placehold.it/80x80&text=[img]"/></div>
            <div class="large-10 columns">
                <p><strong>Some Person said:</strong> Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod
                    commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork
                    biltong.</p>
                <ul class="inline-list">
                    <li><a href="">Reply</a></li>
                    <li><a href="">Share</a></li>
                </ul>
                <h6>2 Comments</h6>

                <div class="row">
                    <div class="large-2 columns small-3"><img src="http://placehold.it/50x50&text=[img]"/></div>
                    <div class="large-10 columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod
                            commodo, chuck duis velit. Aute in reprehenderit</p></div>
                </div>
            </div>
        </div>

    </div>


    <aside class="large-3 columns hide-for-small">
        <p><img src="http://placehold.it/300x440&text=[ad]"/></p>

        <p><img src="http://placehold.it/300x440&text=[ad]"/></p>
    </aside>
</div>
