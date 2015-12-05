
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="./assets/css/font-face.css"/>
    <link rel="stylesheet" href="./assets/css/preload.css"/>
    <link rel="stylesheet" href="./test.css">
    <link rel='stylesheet' id='yarppWidgetCss-css'  href='http://mightynice.com.au/wp-content/plugins/yet-another-related-posts-plugin/style/widget.css?ver=4.2.1' type='text/css' media='all' />
    <title>OAS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script src="assets/js/lib/modernizr-2.6.2.min.js"></script>
    <script src="assets/js/lib/jquery.js"></script>
    <script src="./assets/js/lib/requirejs-2.1.9.min.js"></script>
    <script src="http://mightynice.com.au/wp-content/themes/mightynice/js/libs/swiffy-7.2.0.min.js"></script>
    <script src="http://mightynice.com.au/wp-content/themes/mightynice/js/libs/snap.svg-0.4.1.min.js"></script>
    <script>
        (function() {
            var APP = {};
            APP.isTouchEnabled = window.Modernizr.touch && 'onorientationchange' in window;
            APP.triggerEvent = APP.isTouchEnabled ? 'touchend' : 'click';
            APP.isRetina = (window.devicePixelRatio > 1 || (window.matchMedia && window.matchMedia('(-webkit-min-device-pixel-ratio: 1.5),(-moz-min-device-pixel-ratio: 1.5),(min-device-pixel-ratio: 1.5)').matches));
            APP.isSurfaceDevice = (function() {
                var bool = false;
                try {
                    var msGesture = window.navigator && window.navigator.msPointerEnabled && window.MSGesture;
                    if (('ontouchstart' in window) || msGesture || window.DocumentTouch && document instanceof DocumentTouch) {
                        bool = true;
                        document.getElementsByTagName('html')[0].className += ' ua-surface';
                    }
                } catch(e) {}
                return bool;
            })();
            window.__APP = APP;
        })();
    </script>
    <script type="text/javascript">
        function loaded(){
            $("#loading").fadeOut(3000);
            $("#main_content").fadeIn(1500);
        }
    </script>
    <style>
        #video-bg {
            position: fixed;
            top: 0; right: 0; bottom: 0; left: 0;
            overflow: hidden;
        }
        #video-bg > video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        /* 1. No object-fit support: */
        @media (min-aspect-ratio: 16/9) {
            #video-bg > video { height: 300%; top: -100%; }
        }
        @media (max-aspect-ratio: 16/9) {
            #video-bg > video { width: 300%; left: -100%; }
        }
        /* 2. If supporting object-fit, overriding (1): */
        @supports (object-fit: cover) {
            #video-bg > video {
                top: 0; left: 0;
                width: 100%; height: 100%;
                object-fit: cover;
            }
        }
        body{
            overflow: hidden;
        }
        html{
            overflow-y:hidden;
        }
        *{
            font-family:'KoPubDotumLight';
        }
    </style>
</head>
<body class="page-template-home" onLoad="loaded()">
<div id="main_content" style="display:none;">
    <div id="trihead">
        <div class="inner"></div>
        <div class="burger-mini"></div>
        <a href="#">
            <img src="assets/images/mobile_top.png" style="width: 75px; height: auto;"/>
            <img class="monogram-png" src="assets/images/mobile_top.png" style="width: 75px; height: auto;" width="78" height="35" data-preload>
        </a>
    </div>
    <div class="burger ic-font">
        <span class="ic-normal icon-burger-hover"></span>
        <span class="ic-hover icon-burger"></span>
        <span class="text">MENU</span>
    </div>
    <footer>
        <div class="footer_info" id="float" align="justify">
            <p>ⓒCopyright 2016 KDMHS OAS.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.</p>
        </div>
        <div class="footer_logo" align="center">
            <a href="http://www.dimigo.hs.kr"><img src="assets/images/dimigo.png"/></a>
        </div>
    </footer>
    <header id="masterhead" class="site-header" role="banner">
        <div class="shape"></div>

        <a class="home-link" href="./test.php" title="Mighty Nice" rel="home">
            <img src="assets/images/mobile_top.png" style="width: 100px; height: auto;" data-preload/>
        </a>

        <div class="closemenu">
            <span class="icon-x"></span>
        </div>

        <div id="navbar" class="navbar">
            <nav id="site-navigation" class="navigation main-navigation" role="navigation">
                <ul id="menu-mightymenu" class="menu"><li id="menu-item-246" class="menu-home menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-4 current_page_item menu-item-246"><a title="icon-menu-home" href="#">처음으로</a></li>
                    <li id="menu-item-456" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-456"><a title="icon-menu-work" href="#">신청조회</a></li>
                    <li id="menu-item-455" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-455"><a title="icon-menu-work" href="#">외출신청</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div id="main">
        <a href="#" class="main-monogram">
            <img class="logo" src="assets/images/mobile_top.png" width="78" height="35" data-preload>
        </a>

        <div class="main-inner banner">
            <div id="video-bg">
                <video muted autoplay poster="./assets/images/background.jpg" id="bgvid" />
                    <source src="./assets/main_bgvideo.mp4" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>
<div id="loading" style="background-color:transparent;">
    <div class="cssload-dots">
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
    </div>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="12" ></feGaussianBlur>
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0	0 1 0 0 0	0 0 1 0 0	0 0 0 18 -7" result="goo" ></feColorMatrix>
                <!--<feBlend in2="goo" in="SourceGraphic" result="mix" ></feBlend>-->
            </filter>
        </defs>
    </svg>
</div>
</body>
</html>