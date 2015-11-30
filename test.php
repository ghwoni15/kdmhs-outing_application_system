<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>TEST PAGE :: KDMHS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#login_submit").click(function(){
                jQuery.ajax({
                   type:"POST",
                    url:"http://api.dimigo.hs.kr/v1/user-gcn-nows"
                    data:$('form').serialize(),
                    success:function(result){
                        alert(result.username);
                    }
                });
            });
        });
    </script>
</head>
<body class="body_img">
<div id="logo"><a href="."><img src="./assets/logo.png"/></a></div>
<h1 class="title">테스트 페이지</h1><hr/><br />
<form id="login" align="center" class="form-horizontal">
    <h1>api.dimigo.hs.kr/v1/user-gcn-nows</h1><br/>
    <fieldset id="login_inf">
        <legend>로그인</legend>
        <div id="auth_info" class="control-group">
            <label class="control-label" for="user">ID</label>
            <div class="controls">
                <input type="text" id="username" name="username" placeholder="인트라넷 계정 아이디" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input type="password" id="password" name="password" placeholder="인트라넷 계정 패스워드" required>
            </div>
        </div>

    </fieldset>
</form>
<div class="control-group">
    <div class="controls">
        <button id="login_submit" type="submit" class="button special btn_auth">로그인</button>
        <span id="rs_msg" class="help-inline">정보가 잘못되었습니다. 다시 한 번 확인바랍니다.</span>
    </div>
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
