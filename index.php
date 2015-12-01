<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>KDMHS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
</head>
<body>
    <video muted autoplay poster="./assets/background.jpg" id="bgvid">
        <source src="./assets/main_bgvideo.mp4" type="video/mp4">
    </video>
    <?php
    session_start();
    if(!isset($_SESSION['User'])){
        die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = './auth.php?act=login';</script>\n");
    }

    if($_SESSION['Type']==='T') die("<script>location.href='./inquiry.php';</script>\n");
    ?><div id="logo">
        <a href="."><img src="./assets/logo.png"/></a>
    </div>
    <div id="mNav">
        <a href="./"><img id="mLogo" src="./assets/logo_device.png"/></a>
        <button class="mobile" style="visibility: collapse;"></button>
        <nav id="lnb_d">
            <button class="button" onclick="scrollToTop()">↑</button>
            <a href="./auth.php?act=logout"><button class="button">로그아웃</button></a>
            <a href="./inquiry.php"><button class="button">신청조회</button></a>
        <?php if($_SESSION['Type']==='S') echo("<a href=\"./apply.php\"><button class=\"button special\">외출신청</button></a>"); ?><?php if($_SESSION['Type']==='T') echo("<a href=\"./create.php\"><button class=\"button\">외출증즉시생성</button></a>\n"); ?></nav>
    </div>
    <div id="welcome">
        <?php echo("환영합니다, "./*!!!!!!!!!!!*/$_SESSION['REQ_ID_INFO']."님.\n");?>
    </div>
    <nav id="lnb">
        <a href="./auth.php?act=logout"><button class="button">로그아웃</button></a>
        <a href="./inquiry.php"><button class="button">신청조회</button></a>&nbsp;<?php if($_SESSION['Type']==='S') echo("<a href=\"./apply.php\"><button class=\"button special\">외출신청</button></a>\n"); ?><?php if($_SESSION['Type']==='T') echo("<a href=\"./create.php\"><button class=\"button special\">외출증즉시생성</button></a>\n"); ?>

    </nav>
    <div class="large_title">
        <h1 class="header">외출신청,<br/>이제 인터넷으로 편하게 신청하세요</h1><br/>
        <h2 class="sub_title">
            <strong>외출하지말고 그냥 공부해! 공부 안하면 수능 망하는거야~</strong>&nbsp;<del>어짜피 해도 망하지만</del><br/><br/>
            <a href="./apply.php">
                <button class="button special">
                    <strong>지금 바로 외출신청하러가기</strong>
                </button>
            </a>
        </h2>
    </div>
<footer>
    <div id="footer_logo">
        <img src="./assets/dimigo.png"/>
    </div>
    <br/>ⓒCopyright 2016 Korea Digital Media High School.<br/>All rights reserved.<br /><br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.<br/><br />
    <address>15255 경기도 안산시 단원구 사세충열로 94<br/>(와동, 한국디지털미디어고등학교)</address>학교대표번호 : <a href="tel:/031-363-7800">031-363-7800</a>
</footer>
</body>
</html>