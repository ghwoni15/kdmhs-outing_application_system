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
    <script type="text/javascript" src="assets/js/lib/modernizr-2.6.2.min.js"></script>
    <style>
        html{overflow-y:hidden;}
    </style>
</head>
<body>
<video muted autoplay controls poster="assets/background.jpg" id="bgvid">
    <source src="assets/main_bgvideo.mp4" type="video/mp4">
</video>
<?php
session_start();
if(!isset($_SESSION['MODE']) || !isset($_SESSION['User']) || !isset($_SESSION['Type'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = 'account/auth.php?act=login';</script>\n");
?>
<div id="mNav">
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
<footer>
    <div class="footer_info" id="float" align="justify">
        <p>ⓒCopyright 2016 KDMHS OAS.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.</p>
    </div>
    <div class="footer_logo" align="center">
        <a href="http://www.dimigo.hs.kr"><img src="assets/images/dimigo.png"/></a>
    </div>
</footer>
</body>
</html>