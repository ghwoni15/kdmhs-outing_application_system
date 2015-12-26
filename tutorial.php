<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/media.css"/>
    <title>OAS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script type="text/javascript" src="assets/js/lib/jquery.js"></script>
    <script type="text/javascript" src="assets/js/outing.js"></script>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lt IE 7]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->
    <style>
        html{overflow-y:hidden;}
    </style>
</head>
<body>
<iframe width="100%" height="100%" src="https://www.youtube.com/embed/6RxivxQIuZM" frameborder="0" allowfullscreen></iframe>
<?php
session_start();
if(!isset($_SESSION['MODE']) || !isset($_SESSION['User']) || !isset($_SESSION['Type'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = 'account/auth.php?act=login';</script>\n");
?>
<div id="mNav">
    <a href="./"><img id="mLogo" src="assets/images/logo_device.png"/></a>
    <nav id="lnb_d">
        <button class="button" onclick="scrollToTop()">↑</button>
        <a href="account/auth.php?act=logout"><button class="button">로그아웃</button></a>
        <a href="inquiry.php"><button class="button">신청조회</button></a>
        <?php if($_SESSION['Type']==='S') echo("<a href=\"apply.php\"><button class=\"button special\">외출신청</button></a>"); ?><?php if($_SESSION['Type']==='T') echo("<a href=\"create.php\"><button class=\"button\">외출증즉시생성</button></a>\n"); ?></nav>
</div>
<div id="welcome">
    <?php echo("<div style='background-color:black;'>환영합니다, ".$_SESSION['User']."님.</div>\n");?>
</div>
<nav id="lnb">
    <a href="index.php"><button class="button special">처음으로</button></a>
</nav>
<div id="loading">
    <div class="cssload-dots">
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
    </div>

    <svg>
        <defs>
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="12" ></feGaussianBlur>
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0	0 1 0 0 0	0 0 1 0 0	0 0 0 18 -7" result="goo" ></feColorMatrix>
                <!--<feBlend in2="goo" in="SourceGraphic" result="mix" ></feBlend>-->
            </filter>
        </defs>
    </svg>
</div>
<footer>
    <div class="footer_info" id="float" align="justify">
        <p>ⓒCopyright 2016 KDMHS OAS.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.</p>
    </div>
</footer>
</body>
</html>