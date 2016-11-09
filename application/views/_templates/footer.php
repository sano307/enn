<!-- 유저목록끝의 시작 -->

<!-- 유저 목록끝의 끝-->

<!-- 파운데이션 foundation js 첨부 -->
<script src="<?php echo URL; ?>/lib/angular/angular.js"></script>
<script src="<?php echo URL; ?>:3000/socket.io/socket.io.js"></script>
<script src="<?php echo URL; ?>/lib/angular/socket.js"></script>
<script src="<?php echo URL; ?>/lib/angular/angular-route.min.js"></script>
<script src="<?php echo URL; ?>/lib/angular/angular-animate.min.js"></script>
<script src="<?php echo URL; ?>/lib/angular/angular-named-toggle.js"></script>
<script src="<?php echo URL; ?>/lib/angular/ng-file-upload-all.min.js"></script>
<script src="<?php echo URL; ?>/lib/angular/angular-ui-router.min.js"></script>
<script src="<?php echo URL; ?>/lib/angular/mm-foundation-tpls-0.8.0.min.js"></script>
<script src="<?php echo URL; ?>/lib/prism/prism.js"></script>

<script src="<?php echo URL; ?>/assets/js/camp/route.js"></script>
<script src="<?php echo URL; ?>/assets/js/camp/controller.js"></script>
<script src="<?php echo URL; ?>/assets/js/camp/directive.js"></script>
<script>
  $(document).foundation();
</script>
<!-- 파운데이션 foundation js 첨부 끝 -->

<style>
    @charset "UTF-8";
    .hero {
        background: url("http://www.banksy-wallpaper.com/wallpapers/800x600/10-i-am-father.jpg") no-repeat center center;
        background-size: cover;
        height: 50vh;
        overflow: hidden;
    }

    .hero h1, .hero h2 {
        color: #fff;
        text-shadow: 1px 1px 1px #000;
        padding: 1rem 0 0 1rem;
        margin: 0;
    }

    .footer {
        background-color: #292c2f;
        text-align: center;
        font-size: 1.2rem;
        padding: 4rem;
    }

    .footer .inline-list a {
        display: inline-block;
        width: 2rem;
        height: 2rem;
        background-color: #33383b;
        border-radius: 2px;
        font-size: 1.5rem;
        color: #fff;
        text-align: center;
        line-height: 35px;
        margin: 0 3px 0 0;
    }

    .footer .contact {
        list-style-type: none;
        margin: 0;
        text-align: left;
        color: #fff;
    }

    .footer .contact li {
        margin-bottom: 2rem;
    }

    .footer .contact li p {
        padding-left: 5rem;
    }

    .footer .contact i {
        position: absolute;
        background-color: #33383b;
        color: #fff;
        font-size: 2rem;
        border-radius: 50%;
        line-height: 1;
        margin: 0 0 0 -4rem;
        vertical-align: middle;
        padding: .25em .45em;
    }

    .footer .copywrite {
        color: #8f9296;
        font-size: 0.875rem;
        margin: 0 0 1rem 0;
    }

    .footer .about {
        color: #92999f;
        font-size: 0.875rem;
        margin: 0 0 1rem 0;
    }

    .footer .footer-links a {
        list-style: none;
        font-weight: normal;
        color: #fff;
        padding: 3rem 0 2rem;
        margin: 0;
        font-size: 0.875rem;
    }

    .footer .footer-links a::after {
        content: "•";
        padding: 0 0.2rem 0 0.4rem;
    }

    .footer .footer-links a:last-child::after {
        content: "";
        padding: 0 0.4rem 0 0.8rem;
    }

    @media only screen and (min-width: 40.063em) {
        .footer p {
            text-align: left;
        }

        .footer .social {
            text-align: left;
            margin: 0;
        }

        .footer .contact {
            text-align: left;
        }

        .footer .contact > i {
            margin-right: 1rem;
        }
    }

    .footerlogo {
        color: #fff;
        font-size: 1.5rem;
    }

    .footerlogo i {
        margin-right: 0.5rem;
    }
</style>
<!-- footer style end -->

<footer class="footer">
    <div class="row">
        <div class="small-12 medium-6 large-5 columns">
            <p class="footerlogo"><i class="fi-shield"></i> 緣 EnnSNS</p>

            <p class="footer-links">
                <a href="#">Home</a>
                <a href="#">Timeline</a>
                <a href="#">BuddyState</a>
                <a href="#">Camp</a>
            </p>

            <p class="copywrite">Copywrite not copywrite &copy; 2016</p>
        </div>
        <div class="small-12 medium-6 large-4 columns">
            <ul class="contact">
                <li><p><i class="fi-marker"></i>Korea KB Deagu YJC WD3J 7team</p></li>
                <li><p><i class="fi-telephone"></i>+010-1234-1234</p></li>
                <li><p><i class="fi-mail"></i>enn@ennsns.com</p></li>
            </ul>
        </div>
        <div class="small-12 medium-12 large-3 columns">
            <p class="about">About Star Wars</p>

            <p class="about subheader">Strike me down, and I will become more powerful than you could possibly
                imagine.</p>
            <ul class="inline-list social">
                <a href="#"><i class="fi-social-facebook"></i></a>
                <a href="#"><i class="fi-social-twitter"></i></a>
                <a href="#"><i class="fi-social-linkedin"></i></a>
                <a href="#"><i class="fi-social-github"></i></a>
            </ul>
        </div>
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
</footer>
<script type="text/javascript" src="http://arrow.scrolltotop.com/arrow7.js"></script>
<noscript>Not seeing a <a href="http://www.scrolltotop.com/">Scroll to Top Button</a>? Go to our FAQ page for more info.
</noscript>
</body>
</html>
