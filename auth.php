<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>로그인 - KDMHS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
    <script type="text/javascript" src="./assets/js/scroll.js" media="(min-width:1025px;)"></script>
</head>
<body class="body_img">
<?php
if(!isset($_GET['act']))
    die("<script>location.href='403.html';</script>\n");
else{
    session_start();
    if($_GET['act']==='login'){

        if(isset($_SESSION['SIGNED']) && $_SESSION['SIGNED'] === true)
            die("<script>location.href='index.php';</script>\n");

        if(isset($_GET['status']) && $_GET['status']==='failed') $_SESSION = array();
        else;
    }
    else if($_GET['act']==='logout')
    {
        if(!isset($_SESSION['User'])) die("<script>location.href='./index.php';</script>\n");
        else{
            session_destroy();
            die("<script>alert('정상적으로 로그아웃 되었습니다.');\nlocation.href='./index.php';\n</script>\n");
            exit;
        }
    }else if($_GET['act']==='login_check_auth'){
        include("./account/aes.class.php");
        include("./account/aesctr.class.php");

        $ENCRYPTION_KEY='dimigo_oas';
        $IDENTI_PW = $_POST['password'];
        $ENCRYPTION_RS = AesCtr::encrypt($IDENTI_PW,$ENCRYPTION_KEY,256);

        $_SESSION['REQ_ID_INFO'] = $_POST['username'];
        $_SESSION['REQ_ENCRYPTION_RS'] = $ENCRYPTION_RS;
        echo("<script>location.href='./account/check_auth.php';</script>\n");
    }
}
?>
<div id="logo"><a href="."><img src="./assets/logo.png"/></a></div>
<div id="mNav">
    <a href="./"><img id="mLogo" src="./assets/logo_device.png"/></a>
    <nav id="lnb_d">
        <button class="button" onclick="scrollToTop()">↑</button>
    </nav>
</div>
<h1 class="title">로그인</h1><hr/><br />
<div class="container auth">
    <form method="POST" action="auth.php?act=login_check_auth" align="center">
        <fieldset id="login_inf">
            <legend>로그인</legend>
                <div id="left">
                    <div id="left">
                        <input type="text" id="user" name="username" maxlength="20" placeholder="인트라넷 계정 아이디" required>
                    </div>
                    <div id="right">
                        <input type="password" id="password" name="password" maxlength="20" placeholder="인트라넷 계정 패스워드" required>
                    </div>
                </div>
                <div id="right">
                    <div>
                        <div>
                            <button type="submit" class="button special">로그인</button>
                            <span class="help-inline">정보가 잘못되었습니다. 다시 한 번 확인바랍니다.</span>
                        </div>
                    </div>
                </div>
        </fieldset>
        <hr/>
        <aside>
            현재 시스템 개발 중입니다. 인트라넷 로그인이 시범적으로 운영되고 있으며, 로그인 후 시스템의 전반적 테스트가 정상적으로 실행되지 않습니다.
            <br/>
            시스템 테스트를 위해서 다음 페이지를 통해 로그인하십시오. <a class="button special" href="./temp.php?act=login">시스템 테스트 로그인</a>
            <br/>
            위의 경우 로그아웃을 위해 브라우저를 종료하거나 수동으로 URL에 접속하여 로그아웃하셔야합니다.: <strong>temp.php?act=logout</strong>
        </aside>
        <hr />
    </form>
</div>
<footer>
    <div id="footer_logo">
        <img src="./assets/dimigo.png"/>
    </div><br/>
    ⓒCopyright 2016 Korea Digital Media High School.<br/> All rights reserved.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.<br/><br />
    <address>15255 경기도 안산시 단원구 사세충열로 94<br/>(와동, 한국디지털미디어고등학교)</address>학교대표번호 : <a href="tel:/031-363-7800">031-363-7800</a>
</footer>
</body>
</html>
