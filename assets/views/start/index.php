<script>
    $(document).ready(function() {
        $("#coin-slider").coinslider();
    });
</script>

<img src="../../../img/logo.png" style="width:350px; height: 300px; margin-left: 750px; margin-top: 20px; padding-bottom: 50px  "><br><br><br>

<div id="wrapper">
    <section>
        <div id="coin-slider">
            <img src="/public/img/main1.jpg">
            <span>우리 우정 오랫도록!</span>

            <img src="/public/img/main2.jpg">
            <span>교류회 뒷풀이중 한 컷</span>

            <img src="/public/img/main3.jpg">
            <span>케고 공원에서 일본인 친구들과!</span>
        </div>
    </section>

</div>
<br><br><br><br><br>
<div id="home" ng-controller="indexController">
    <div class="row">
        <div class="small-11 small-centered columns">
            <div class="choose">
                <label>Your Choose</label>
                <a class="inside" ng-click="login()" role="button">Login</a>
                <a class="inside" ng-click="join()" role="button">Join</a>
            </div>
        </div>
    </div>
</div>
