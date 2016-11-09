<link rel='stylesheet' href='<?php echo URL; ?>/public/css/main/grouprecommend.css'>
<link rel='stylesheet' href='<?php echo URL; ?>/public/css/main/notice.css'>
<div class="row" style="color: black;">
    <fieldset>
        <legend>Post Write</legend>
        <form action="/post/post_write/<?= $_SESSION['login_idx']; ?>" method="post" enctype="multipart/form-data">
            제목 : <input type="text" name="title" required/>
            내용 : <textarea name="content" required></textarea>
            <input type="file" name="images[]" accept="image/*" multiple/>
            <button type="submit" class="button tiny info" style="font-weight: bold; font-size: 18px;">Post Writing</button>
        </form>
    </fieldset>
</div>
<div class="row">
    <?php foreach ( $getPostInfo as $row ) { ?>
    <div class="small-3 columns" style="color: black;">
        <div class="image-wrapper overlay-fade-in">
            <a href='/detail_timeline/index/<?= $row->p_idx ?>'>
                <?php if ($row->c_idx) {
                    echo "<img src='/public/img/camp/{$row->c_idx}/{$row->p_postThumbName}.{$row->p_postThumbExt}' style='width: 450px; height: 300px;'/>";
                } else {
                    echo "<img src='/public/img/member/{$_SESSION['login_idx']}/{$row->p_postThumbName}.{$row->p_postThumbExt}' style='width: 450px; height: 300px;'/>";
                }
                ?>
                <div class="image-overlay-content">
                    <h2>hits : <?= $row->p_postHits; ?></h2>

                    <h2>goods : <?= $row->p_postGoods; ?></h2>
                </div>
            </a>
        </div>
        <div>
            <?= $row->p_registedTime; ?><br/>
            <?= $row->p_title; ?><br/>
        </div>
    </div>
    <?php } ?>
</div>