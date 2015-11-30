<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>외출증 즉시 생성 - KDMHS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap.js"></script>
</head>
<body class="body_img">
<?php
    session_start();
    if(!isset($_SESSION['User'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = './auth.php';</script>\n");
    else if($_SESSION['Type']!=='T') die("<script>location.href = './403.html';</script>\n");
?>
<div id="logo"><a href="."><img src="./assets/logo.png"/></a></div>
<div id="mNav">
    <a id="mLogo" href="./"><img src="./assets/logo_device.png"/></a>
</div>
<div id="welcome">
    <?php
    if($_SESSION['User']){
        include "/include/auth.php";

        $query = "SELECT Name FROM `member` WHERE User='".$_SESSION['User']."' LIMIT 1;";
        $rs = mysqli_query($link, $query) or die("Wrong Query.");

        if($rs === false) {
            $errno = mysqli_errno($link);
            $errmsg = mysqli_error($link);
            die($errno.": ".$errmsg."<br />\n");
        }

        echo("환영합니다, ".mysqli_fetch_array($rs,MYSQL_ASSOC)['Name']."님.");
        mysqli_free_result($rs);
        mysqli_close($link);
    }
    ?>
</div>
<nav id="lnb">
    <a href="./auth.php?act=logout"><button class="button">로그아웃</button></a>
    <a href="./inquiry.php"><button class="button">신청조회</button></a>
</nav><br/>
<h1 class="title">생성</h1><hr/>
<div class="container">
    <div id="left">
        <article>
            <header><h2 class="small_notice">생성 시 확인사항</h2></header><br/>
            <section>1. 신청일자와 일시가 올바른지 확인하십시오.<br/>2. 외출증 크기가 부족하므로 가급적으로 사유는 간단히 작성해주십시오.<br/>3. 승인완료시 교무실의 Receipt Printer로 발급받으십시오.</section>
        </article>
    </div>
    <div id="right">
        <form method="POST" action="./make_permit/permission/send_permission.php?t_direct=true">
            <fieldset>
                <legend>생성</legend>
                <div class="control-group">
                    <h5>결제라인 선택</h5>&nbsp;&nbsp;
                    <input type="radio" id="weekday" name="a_procedure" checked required><label for="weekday"> 평일 외출</label>&nbsp;&nbsp;
                    <input type="radio" id="weekend" name="a_procedure" required><label for="weekend"> 주말 긴급 외출</label><br/><br />
                    <span class="help-inline-visible">해당되는 외출 유형을 올바르게 선택해주십시오.</span>
                </div><br />
                <div class="control-group">
                    <h5>대상학생 선택 : </h5>&nbsp;&nbsp;<select id="grade" onchange="document.location='?grade='+this.value"><option>1</option><option>2</option><option>3</option></select>학년&nbsp;&nbsp;<select id="class" onchange="document.location='class='+this.value"><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option></select>반
                    <?php
                    $link = mysqli_connect("localhost", "outing", "outing00", "outing") or die("Connection Failed. Check what is wrong.");
                    mysqli_set_charset($link, "utf8");

                    $query = "SELECT Name FROM `member` WHERE User='".$_SESSION['User']."' LIMIT 1;";
                    $rs = mysqli_query($link, $query) or die("Wrong Query.");

                    if($rs === false) {
                        $errno = mysqli_errno($link);
                        $errmsg = mysqli_error($link);
                        die($errno.": ".$errmsg."<br />\n");
                    }

                    echo("<select id='students'>\n");
                    while($row = mysqli_fetch_array($rs))
                        echo("<option>".$row['Name']."</option>\n");
                    echo("</select>\n");

                    mysqli_free_result($rs);
                    mysqli_close($link);

                    ?><br/>
                </div>
                <div class="control-group">
                    <h5>신청일자 선택 : </h5>&nbsp;&nbsp;<input type="date" id="date" name="day"/>&nbsp;&nbsp;<br/>
                    <h5>외출예정시간 : </h5><input type="time" name="startTime" required value="17:10"/><h5> 부터 </h5>
                    <input type="time" name="endTime" required value="18:30"/>&nbsp;<h5>&nbsp;까지&nbsp;</h5>
                </div>
                <div class="control-group">
                    <h5>외출사유 : </h5><input type="text" name="reason" required placeholder="간단하고 명료하게 작성"/>&nbsp;&nbsp;<br/>
                </div>
                <div class="control-group"><br/>
                    <input class="button special" type="submit" value="생성"/>
                    <span class="help-inline"></span>
                </div>
            </fieldset>
        </form><br/><hr/>
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