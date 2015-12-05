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
<body class="body_img">
    <?php
    session_start();
    if(!isset($_SESSION['MODE']) || !isset($_SESSION['User']) || !isset($_SESSION['Type'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = 'account/auth.php?act=login';</script>\n");
    if($_SESSION['Type']==='T') die("<script>location.href='inquiry.php';</script>\n");
    ?><div id="logo">
        <a href="."><img src="assets/images/logo.png"/></a>
    </div>
    <div id="mNav">
        <a href="./"><img id="mLogo" src="assets/images/logo_device.png"/></a>
        <nav id="lnb_d">
            <button class="button" onclick="scrollToTop()">↑</button>
            <a href="account/auth.php?act=logout"><button class="button">로그아웃</button></a>
            <a href="inquiry.php"><button class="button">신청조회</button></a>
        <?php if($_SESSION['Type']==='S') echo("<a href=\"apply.php\"><button class=\"button special\">외출신청</button></a>"); ?><?php if($_SESSION['Type']==='T') echo("<a href=\"create.php\"><button class=\"button\">외출증즉시생성</button></a>\n"); ?></nav>
    </div>
    <div id="welcome">
        <?php echo("환영합니다, ".$_SESSION['User']."님.\n");?>
    </div>
    <nav id="lnb">
        <a href="account/auth.php?act=logout"><button class="button">로그아웃</button></a>
        <a href="inquiry.php"><button class="button">신청조회</button></a>&nbsp;<?php if($_SESSION['Type']==='S') echo("<a href=\"apply.php\"><button class=\"button special\">외출신청</button></a>\n"); ?><?php if($_SESSION['Type']==='T') echo("<a href=\"create.php\"><button class=\"button special\">외출증즉시생성</button></a>\n"); ?>
    </nav>
    <div class="large_title">
        <h1 class="header">외출신청,<br/>이제 인터넷으로 편하게 신청하세요</h1><br/>
        <h2 class="sub_title">
            <strong>외출하지말고 그냥 공부해! 공부 안하면 수능 망하는거야~</strong>&nbsp;<del>어짜피 해도 망하지만</del><br/><br/>
            <a href="apply.php">
                <button class="button special">
                    <strong>지금 바로 외출신청하러가기</strong>
                </button>
            </a>&nbsp;<a href="tutorial.php">
                <button class="button special">
                    <strong>시스템 이용방법 자세히</strong>
                </button>
            </a>
        </h2>
    </div>
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