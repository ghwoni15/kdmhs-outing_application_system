<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>KDMHS :: 한국디지털미디어고등학교 외출신청시스템 로그인</title>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap.js"></script>
</head>
<body class="body_img">
<?php
if(!isset($_GET['act'])) die("<script>location.href='403.html';</script>\n");
else if($_GET['act']==='logout')
{
    session_start();
    if(!isset($_SESSION['User'])) die("<script>location.href='./403.html';</script>\n");
    else{
        session_destroy();
        die("<script>location.href='./index.php';</script>\n");
        exit;
    }
}
else if($_GET['act']==='login'){

    include "./include/auth.php";

    if(!isset($_POST['username'])) $user='';
    else $user = mysqli_real_escape_string($link, $_POST['username']);

    if(!isset($_POST['password'])) $pass='';
    else $pass = mysqli_real_escape_string($link, $_POST['password']);

    $query = "SELECT Type, Grade, Class FROM member WHERE User='".$user."' AND Pass = Password('".$pass."');";
    $rs = mysqli_query($link, $query) or die("<script>location.href='./error.php?errno=0&errmsg=Wrong_Query';</script>\n");

    if($rs === false) {
        $errno = mysqli_errno($link);
        $errmsg = mysqli_error($link);
        die("<script>location.href='./error.php?errno=$errono&errmsg=$errmsg';</script>\n");
    }

    $rn = mysqli_num_rows($rs);
    if($rn >= 1){
        session_start();
        $_SESSION['User'] = $user;
        $user_data  = mysqli_fetch_array($rs, MYSQLI_ASSOC);
        list($_SESSION['Type'],$_SESSION['Grade'],$_SESSION['Class']) = array($user_data['Type'], $user_data['Grade'], $user_data['Class']);

        if($_SESSION['Type']==='T') die("<script>location.href='./inquiry.php';</script>\n");
        else if($_SESSION['Type']==='S') die("<script>location.href='./index.php';</script>\n");
    }else;
}else;
?>
<div id="logo"><a href="."><img src="./assets/logo.png"/></a></div>
<div id="mNav">
    <a id="mLogo" href="./"><img src="./assets/logo_device.png"/></a>
    <nav id="lnb_d">
        <button class="button" onclick="scrollToTop()">상단으로</button>
    </nav>
</div>
<h1 class="title">로그인</h1><hr/><br />
<form class="form-horizontal" method="POST" action="auth.php?act=login" align="center">
    <fieldset id="login_inf">
        <legend>로그인</legend>
        <div class="container">
            <div id="left">
                <div class="control-group">
                    <label class="control-label" for="username">ID&nbsp;&nbsp;</label>
                    <div class="controls">
                        <input type="text" id="user" name="username" placeholder="인트라넷 계정 아이디" required>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password">Password&nbsp;&nbsp;</label>
                    <div class="controls">
                        <input type="password" id="password" name="password" placeholder="인트라넷 계정 패스워드" required>
                    </div>
                </div>
            </div>
        </div>
        <div id="right">
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="button special big icon">로그인</button>
                    <span class="help-inline">정보가 잘못되었습니다. 다시 한 번 확인바랍니다.</span>
                </div>
            </div>
        </div>
    </fieldset>
    <hr/><p>현재 시스템 개발 중입니다. 인트라넷 계정 연동 전까지 임시로 계정을 생성해 테스트할 수 있습니다.<br/>학생 계정 접속법 : 아이디는 stu[학번4자리]로, 비밀번호는 test<br/>교원 계정 접속법 : 아이디는 tea[담당학년][담당학급, 부장교사는 0]로, 비밀번호는 test</p><hr />
</form>
<footer>
    <div id="footer_logo">
        <img src="./assets/dimigo.png"/>
    </div><br/>
    ⓒCopyright 2016 Korea Digital Media High School.<br/> All rights reserved.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.<br/><br />
    <address>15255 경기도 안산시 단원구 사세충열로 94<br/>(와동, 한국디지털미디어고등학교)</address>학교대표번호 : <a href="tel:/031-363-7800">031-363-7800</a>
</footer>
</body>
</html>
