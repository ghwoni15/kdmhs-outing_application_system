<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/css/media.css"/>
    <title>로그인 - OAS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script type="text/javascript" src="../assets/js/lib/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/outing.js"></script>
    <style>
        /*html{overflow-y:hidden;}*/
        .box{
            width: 200px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="body_img">
<?php

if(!isset($_GET['act']))
    die("<script>location.href='../403.html';</script>\n");
else{
    session_start();
    if($_GET['act']==='login'){
        if(isset($_SESSION['SIGNED']) && $_SESSION['SIGNED'] === true)
            die("<script>location.href='../index.php';</script>\n");

        if(isset($_GET['status']) && $_GET['status']==='failed') $_SESSION = array();
        else;
    }
    else if($_GET['act']==='logout')
    {
        if(!isset($_SESSION['User'])) die("<script>location.href='../index.php';</script>\n");
        else{
            session_destroy();
            die("<script>alert('정상적으로 로그아웃 되었습니다.');\nlocation.href='../index.php';\n</script>\n");
            exit;
        }
    }else if($_GET['act']==='login_check_auth'){
        include("aes.class.php");
        include("aesctr.class.php");

        $ENCRYPTION_KEY='dimigo_oas';
        $IDENTI_PW = $_POST['password'];
        $ENCRYPTION_RS = AesCtr::encrypt($IDENTI_PW,$ENCRYPTION_KEY,256);

        $_SESSION['REQ_ID_INFO'] = $_POST['username'];
        $_SESSION['REQ_ENCRYPTION_RS'] = $ENCRYPTION_RS;
        $_SESSION['MODE']='CHECK_AUTH';
        echo("<script>location.href='check_auth.php';</script>\n");
    }else if(isset($_GET['reload'])){
        session_destroy();
        die("<script>location.href='auth.php';</script>\n");
    }
}
?>
<div id="logo"><a href="../"><img src="../assets/images/logo.png"/></a></div>
<div id="mNav">
    <a href="../"><img id="mLogo" src="../assets/images/logo_device.png"/></a>
    <nav id="lnb_d">
        <button class="button" onclick="scrollToTop()">↑</button>
    </nav>
</div>
<h1 class="title">로그인</h1><br />
<div class="container auth">

                    <form method="POST" action="auth.php?act=login_check_auth">
                        <legend>로그인</legend>
                        <input type="text" id="user" name="username" maxlength="20" placeholder="  인트라넷 계정 아이디" style="width: 100%; margin-bottom: 10px; padding: 0;" required>
                        <input type="password" id="password" name="password" maxlength="20" placeholder="  인트라넷 계정 패스워드" style="width: 100%; margin-bottom: 10px; padding: 0;" required>
                        <button type="submit" class="button special" style="width: 100%;">로그인</button>
                        <br><br>
                    </form>
</div>
<br>
    <aside style="border-top: solid #808080 1px;border-bottom: solid #808080 1px; text-align: center; width: 100%;">
        <br/>현재 인트라넷 로그인이 시범적으로 운영되고 있습니다.
        <br/>교사 계정으로 로그인 시 API 연동 문제로 정상적인 작업이 되고 있지 않습니다.
        <br/>
        교사용 페이지 테스트를 하기 위해서는 <strong>ID : pororo를 입력해주시면 됩니다.</strong>
        <br /><br>
    </aside>

<footer id="footer_relative">
    <div class="footer_info" id="float" align="justify">
        <p>ⓒCopyright 2016 KDMHS OAS.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.</p>
    </div>
</footer>
</body>
</html>
