<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>DIMIGO OAS :: 수정</title>
    <script type="text/javascript" src="assets/js/lib/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
</head>
<body class="body_img">
<?php
    session_start();
    if($_SESSION['MODIFY'] !== true) echo("<script>Fail</script>\n");
    if(!isset($_SESSION['MODE'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = './account/auth.php?act=login';</script>\n");
    if(!isset($_SESSION['MODIFY']) || $_SESSION['MODIFY'] !== true) die("<script>location.href='403.html';</script>\n");
?>
<div id="logo"><a href="."><img src="assets/images/logo.png"/></a></div>
<div id="mNav">
    <a href="./"><img id="mLogo" src="assets/images/logo_device.png"/></a>
    <button class="mobile" style="visibility: collapse;"></button>
    <nav id="lnb_d">
        <button class="button" onclick="scrollToTop()">↑</button>
        <a href="account/auth.php?act=logout"><button class="button">로그아웃</button></a>
        <a href="inquiry.php"><button class="button">신청조회</button></a>
        <?php if($_SESSION['Type']==='S') echo("<a href=\"./apply.php\"><button class=\"button special\">외출신청</button></a>"); ?><?php if($_SESSION['Type']==='T') echo("<a href=\"./create.php\"><button class=\"button\">외출증즉시생성</button></a>\n"); ?></nav>
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
                    echo("<div class=\"control-group\">\n\t\t<h1>해당 외출정보입니다. (일련번호 : ".$_GET['id'].")</h1>\n\t</div>\n\t\t<br/><br/>\n");
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
</div><hr />
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