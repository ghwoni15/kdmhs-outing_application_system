<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>KDMHS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap.js"></script>
</head>
<body>
    <video muted autoplay poster="./assets/background.jpg" id="bgvid">
        <source src="./assets/main_bgvideo.mp4" type="video/mp4">
    </video>
    <?php
    session_start();
    if(!isset($_SESSION['User']))
        die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = './auth.php?act=login';</script>\n");

    if($_SESSION['Type']==='T') die("<script>location.href='./inquiry.php';</script>\n")
    ?>
    <div id="logo"><a href="."><img src="./assets/logo.png"/></a></div>
    <div id="mNav">
        <a href="./"><img id="mLogo" src="./assets/logo_device.png"/></a>
        <nav id="lnb_d">
            <button class="button" onclick="scrollToTop()">상단으로</button>
            <a href="./auth.php?act=logout"><button class="button">로그아웃</button></a>
            <a href="./inquiry.php"><button class="button">신청조회</button></a>
            <?php if($_SESSION['Type']==='S') echo("<a href=\"./apply.php\"><button class=\"button special\">외출신청</button></a>"); ?>
            <?php if($_SESSION['Type']==='T') echo("<a href=\"./create.php\"><button class=\"button\">외출증즉시생성</button></a>"); ?>
        </nav>
    </div>
    <div id="welcome">
        <?php
        if($_SESSION['User']){
            $link = mysqli_connect("localhost", "outing", "outing00", "outing") or die("Connection Failed. Check what is wrong.");
            mysqli_set_charset($link, "utf8");

            $query = "SELECT Name FROM `member` WHERE User='".$_SESSION['User']."' LIMIT 1;";
            $rs = mysqli_query($link, $query) or die("Wrong Query.");

            if($rs === false) {
                $errno = mysqli_errno($link);
                $errmsg = mysqli_error($link);
                die("<script>location.href='./error.php?errno=$errono&errmsg=$errmsg';</script>\n");
            }

            echo("환영합니다, ".mysqli_fetch_array($rs,MYSQL_ASSOC)['Name']."님.");
        }
        ?>
    </div>
    <nav id="lnb">
        <a href="./auth.php?act=logout"><button class="button">로그아웃</button></a>
        <a href="./inquiry.php"><button class="button">신청조회</button></a>
        <?php if($_SESSION['Type']==='S') echo("<a href=\"./apply.php\"><button class=\"button special\">외출신청</button></a>"); ?>
        <?php if($_SESSION['Type']==='T') echo("<a href=\"./create.php\"><button class=\"button special\">외출증즉시생성</button></a>"); ?>
    </nav>
    <div class="large_title">
        <h1 class="header">
            <span>외출신청,<br/>이제 인터넷으로 편하게 신청하세요</span>
        </h1><br/>
        <h2 class="sub_title">
            <span><strong>외출하지말고 그냥 공부해! 공부 안하면 수능 망하는 거에요~</strong>&nbsp;&nbsp;&nbsp;<del>어짜피 해도 망함<br/></del></span>
            <br/><a href="./apply.php"><button class="button special big"><strong>지금 바로 외출신청하러가기</strong></button></a>
        </h2>
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