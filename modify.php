<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/media.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css"/>
    <title>DIMIGO OAS :: 수정</title>
    <script type="text/javascript" src="assets/js/lib/jquery.js"></script>
    <script type="text/javascript" src="assets/js/outing.js"></script>
    <script type="text/javascript" src="assets/js/menu.js"></script>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lt IE 7]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->
</head>
<body class="body_img">
<?php
    session_start();
    if($_SESSION['MODIFY'] !== true) echo("<script>Fail</script>\n");
    if(!isset($_SESSION['MODE'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = 'account/auth.php?act=login';</script>\n");
    if(!isset($_SESSION['MODIFY']) || $_SESSION['MODIFY'] !== true) die("<script>location.href='403.html';</script>\n");
?>
<div id="logo"><a href="."><img src="assets/images/logo.png"/></a></div>
<div id="mNav">
    <i class="fa fa-bars" onclick="pop()"></i>
    <i class="fa fa-times" onclick="unpop()"></i>
    <div class="mobile_menu">
        <div class="t1">
            <div class="t2">
                <ul>
                    <li><a href="inquiry.php">외출조회</a></li><hr noshade color="white" width="250rem">
                    <?php if($_SESSION['Type'] === 'S') echo("<li><a href=\"apply.php\">외출신청</a></li><hr noshade color=\"white\" width=\"250rem\">\n");?>
                    <?php if($_SESSION['Type'] === 'T') echo("<li><a href=\"create.php\">외출증즉시생성</a></li><hr noshade color=\"white\" width=\"250rem\">\n");?>
                    <li><a href="account/auth.php?act=logout">로그아웃</a></li>
                </ul>
            </div>
        </div>
    </div>
    <a href="index.php"><img id="mLogo" src="assets/images/logo_device.png"/></a>
</div>
<div id="welcome"><?php echo("환영합니다, ".$_SESSION['User']."님.");?>
</div>
<nav id="lnb">
    <a href="account/auth.php?act=logout"><button class="button">로그아웃</button></a>
    <a href="inquiry.php"><button class="button">신청조회</button></a>
</nav><br/>
<h1 class="title">수정</h1><hr/>
<div class="container">
        <?php echo("<form method='POST'>\n");?>
        <fieldset>
            <legend>외출신청</legend>
            <?php
            /*UPDATE 수정 必*/
            include "include/auth.php";
            if(isset($_GET['id']) && isset($_POST['date']) && isset($_POST['startTime']) && isset($_POST['endTime']) && isset($_POST['reason'])){

                list($shour, $smin) = explode(':', $_POST['startTime']);
                list($ehour, $emin) = explode(':',$_POST['endTime']);
                $sTime = implode(':', array($shour, $smin, "00"));
                $eTime = implode(':', array($ehour, $emin, '00'));
                if($_SESSION['Type'] === 'T'){
                    $query = "UPDATE `out_apply` SET `begin_time`='".$_POST['date'].' '.$sTime."' ,`end_time`='".$_POST['date'].' '.$eTime."' ,`note`='".$_POST['reason']."' WHERE `id`=".$_GET['id'].";";
                }
                else if($_SESSION['Type'] === 'S'){
                    $query = "UPDATE `out_apply` SET `begin_time`='".$_POST['date'].' '.$sTime."' ,`end_time`='".$_POST['date'].' '.$eTime."' ,`note`='".$_POST['reason']."' WHERE `id`=".$_GET['id'].";";
                }
                $rs = mysqli_query($link, $query) or die("<script>location.href='error.php?errno=1&errmsg=Wrong_Query';</script>\n");
                if($rs === false) {
                    $errno = mysqli_errno($link);
                    $errmsg = mysqli_error($link);
                    die("<script>location.href='error.php?errno=$errono&errmsg=$errmsg';</script>\n");
                }else{
                    $_SESSION['MODE'] = 'COMPLETELY_MODIFIED';
                    die("<script>location.href='inquiry.php';</script>\n");
                }
            }
            else{
                $query = "SELECT DATE_FORMAT(o.begin_time, '%Y-%m-%d') AS Date, DATE_FORMAT(o.begin_time, '%H:%i') AS startTime, DATE_FORMAT(o.end_time, '%H:%i') AS endTime, o.note AS Reason FROM out_apply o WHERE o.id='".$_GET['id']."';";
                $rs = mysqli_query($link, $query) or die("<script>location.href='error.php?errno=1&errmsg=Wrong_Query';</script>\n");

                if($rs === false) {
                    $errno = mysqli_errno($link);
                    $errmsg = mysqli_error($link);
                    die("<script>location.href='error.php?errno=$errono&errmsg=$errmsg';</script>\n");
                }

                $rn = mysqli_num_rows($rs);
                $data = mysqli_fetch_array($rs, MYSQLI_ASSOC);
                $date = $data['Date'];
                $startTime = $data['startTime'];
                $endTime = $data['endTime'];
                $reason = $data['Reason'];

                if($rn >= 1){

                    echo("<div class=\"control-group\">\n\t\t<h1 id='modify_title'>해당 외출정보입니다.<br id=\"optimization\"/> (일련번호 : ".$_GET['id'].")</h1>\n\t</div>\n\t\t<br/><br/>\n");
                    echo ("<div class=\"control-group\">\n\t\t<h5>신청일자 선택</h5>&nbsp;&nbsp;<input type=date id=date name=date value=$date/>&nbsp;&nbsp;\n\t</div>\n<br/>\n");
                    echo("<div class=\"control-group\">\n\t\t<h5>외출예정시간 : </h5><input type=time name=startTime required value=\"$startTime\" /><h5> 부터 </h5>\n");
                    echo("<input type=time name=endTime required value=\"$endTime\"/>&nbsp;<h5>&nbsp;까지&nbsp;</h5>\n</div>\n");
                    echo("<br/><div class=\"control-group\">\n\t\t<h5>외출사유 : </h5><input type=text name=reason required placeholder='간단하고 명료하게 작성' value=$reason />&nbsp;&nbsp;\n</div>");
                }else die("<script>location.href='error.php?errno=2&errmsg=No_Data';</script>\n");
            }
            ?>
            <br/><input class="button special" type="submit" value="변경"/>
        </fieldset>
    </div>
    </form>
</div>
<div id="loading">
    <div class="cssload-dots">
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
    </div>

    <svg>
        <defs>
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="12" ></feGaussianBlur>
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0	0 1 0 0 0	0 0 1 0 0	0 0 0 18 -7" result="goo" ></feColorMatrix>
                <!--<feBlend in2="goo" in="SourceGraphic" result="mix" ></feBlend>-->
            </filter>
        </defs>
    </svg>
</div>
<footer id="footer_relative">
    <div class="footer_info" id="float" align="justify">
        <p>ⓒCopyright 2016 KDMHS OAS.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.</p>
    </div>
</footer>
</body>
</html>