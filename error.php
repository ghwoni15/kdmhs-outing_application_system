<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>DIMIGO OAS :: ERROR</title>
    <script type="text/javascript" src="assets/js/lib/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
</head>
<body class="body_img">
<div id="logo"><a href="."><img src="assets/images/logo.png"/></a></div>
    <div id="mNav">
        <a href="."><img src="assets/images/logo_device.png"/></a>
        <nav id="lnb_d">
            <button class="button" onclick="window.history.back()">뒤로</button>
        </nav>
    </div>

    <!--ERR CODE
    *SQL 관련
    0 : Connection Failed
    1 : Wrong_Query
    2 : No Data
    3 : Unknown
    1064 : SYNTAX ERROR

    *로그인 관련
    1000 : API 연결 실패
    -->
    <div class="container">
        <h1 class="large_title error">ERROR</h1>
        <h5 class="small_notice">시스템 에러입니다. 관리자에게 요청해주십시오.</h5><br/>
        <?php
        if(isset($_GET['errno']) && isset($_GET['errmsg']))
            echo("<hr/><h1 class='small_notice'>에러 정보</h1><br/>에러번호 : ".$_GET['errno']."<br/>에러메시지 : ".$_GET['errmsg']."<br/>\n"); ?>
    </div>
    <hr/>
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