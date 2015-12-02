<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>ERROR - KDMHS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
</head>
<body class="body_img">
<div id="logo"><a href="."><img src="./assets/logo.png"/></a></div>
    <div id="mNav">
        <a href="."><img src="./assets/logo_device.png"/></a>
        <nav id="lnb_d">
            <button class="button" onclick="window.history.back()">뒤로</button>
        </nav>
    </div>

    <div class="container">
        <h1 class="large_title error">ERROR</h1>
        <h5 class="small_notice">시스템 에러입니다. 관리자에게 요청해주십시오.</h5><br/>
        <?php
        if(isset($_GET['errno']) && isset($_GET['errmsg']))
            echo("<hr/><h1 class='small_notice'>에러 정보</h1><br/>에러번호 : ".$_GET['errno']."<br/>에러메시지 : ".$_GET['errmsg']."<br/>\n"); ?>
    </div>
    <hr/>
<footer>
    <div id="footer_logo">
        <img src="./assets/dimigo.png"/>
    </div><br/>
    ⓒCopyright 2016 Korea Digital Media High School.<br/> All rights reserved.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.<br/><br />
    <address>15255 경기도 안산시 단원구 사세충열로 94<br/>(와동, 한국디지털미디어고등학교)</address>학교대표번호 : <a href="tel:/031-363-7800">031-363-7800</a>
</footer>
</body>
</html>