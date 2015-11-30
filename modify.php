<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>수정 - KDMHS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap.js"></script>
</head>
<body class="body_img">
<?php
    session_start();
    if(!isset($_SESSION['User'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = './auth.php';</script>\n");
    if(!isset($_GET['perm_no'])) die("<script>location.href='403.html';</script>\n");
?>
<div id="logo"><a href="."><img src="./assets/logo.png"/></a></div>
<div id="mNav">
    <a id="mLogo" href="./"><img src="./assets/logo_device.png"/></a>
</div>
<div id="welcome">
    <?php
    if($_SESSION['User']){
        include "./include/auth.php";

        $query = "SELECT Name FROM `member` WHERE User='".$_SESSION['User']."' LIMIT 1;";
        $rs = mysqli_query($link, $query) or die("Wrong Query.");

        if($rs === false) {
            $errno = mysqli_errno($link);
            $errmsg = mysqli_error($link);
            die($errno.": ".$errmsg."<br />\n");
        }

        echo("환영합니다, ".mysqli_fetch_array($rs,MYSQL_ASSOC)['Name']."님.");

        mysqli_free_result($rs);
    }
    ?>
</div>
<nav id="lnb">
    <a href="./auth.php?act=logout"><button class="button">로그아웃</button></a>
    <a href="./inquiry.php"><button class="button">신청조회</button></a>
</nav><br/>
<h1 class="title">수정</h1><hr/>
<div class="container">
        <?php echo("<form method='POST'>\n");?>
        <fieldset>
            <legend>외출신청</legend>
            <?php
            if(isset($_SESSION['perm_no']) && isset($_POST['date']) && isset($_POST['startTime']) && isset($_POST['endTime']) && isset($_POST['reason'])){
                if($_SESSION['Type'] === 'T') $query = "UPDATE `outing_apply` SET `Date`='".$_POST['date']."',`startTime`='".$_POST['startTime']."',`endTime`='".$_POST['endTime']."',`Reason`='".$_POST['reason']."',`Approved`='T' WHERE `No`=".$_SESSION['perm_no'].";";
                else if($_SESSION['Type'] === 'S') $query = "UPDATE `outing_apply` SET `Date`='".$_POST['date']."',`startTime`='".$_POST['startTime']."',`endTime`='".$_POST['endTime']."',`Reason`='".$_POST['reason']."' WHERE `No`=".$_SESSION['perm_no'].";";
                $rs = mysqli_query($link, $query) or die("<script>location.href='./error.php?errno=0&errmsg=Wrong_Query';</script>\n");
                if($rs === false) {
                    $errno = mysqli_errno($link);
                    $errmsg = mysqli_error($link);
                    die("<script>location.href='./error.php?errno=$errono&errmsg=$errmsg';</script>\n");
                }else die("<script> location.href = './inquiry.php?perm_no=".$_GET['perm_no']."&modified=complete'; </script>\n");
            }
            else{
                $query = "SELECT Date, startTime, endTime, Reason FROM outing_apply WHERE No='".$_GET['perm_no']."';";
                $rs = mysqli_query($link, $query) or die("<script>location.href='./error.php?errno=0&errmsg=Wrong_Query';</script>\n");

                if($rs === false) {
                    $errno = mysqli_errno($link);
                    $errmsg = mysqli_error($link);
                    die("<script>location.href='./error.php?errno=$errono&errmsg=$errmsg';</script>\n");
                }

                $rn = mysqli_num_rows($rs);
                $data = mysqli_fetch_array($rs, MYSQLI_ASSOC);
                $date = $data['Date'];
                $startTime = $data['startTime'];
                $endTime = $data['endTime'];
                $reason = $data['Reason'];
                $_SESSION['perm_no']=$_GET['perm_no'];

                if($rn >= 1){
                    echo("<div class=\"control-group\">\n\t\t<h1>해당 학생의 외출정보입니다. No.".$_GET['perm_no']."</h1>\n\t</div>\n\t\t<br/><br/>\n");
                    echo ("<div class=\"control-group\">\n\t\t<h5>신청일자 선택</h5>&nbsp;&nbsp;<input type=date id=date name=date value=$date/>&nbsp;&nbsp;\n\t</div>\n<br/>\n");
                    echo("<div class=\"control-group\">\n\t\t<h5>외출예정시간 : </h5><input type=time name=startTime required value='$startTime'/><h5> 부터 </h5>\n");
                    echo("<input type=time name=endTime required value='$endTime'/>&nbsp;<h5>&nbsp;까지&nbsp;</h5>\n</div>\n");
                    echo("<br/><div class=\"control-group\">\n\t\t<h5>외출사유 : </h5><input type=text name=reason required placeholder='간단하고 명료하게 작성' value=$reason />&nbsp;&nbsp;\n</div>");
                }else die("<script>location.href='./error.php?errno=1&errmsg=No_Data';</script>\n");
            }

            mysqli_free_result($rs);
            mysqli_close($link);
            ?>
            <br/><input class="button special" type="submit" value="변경"/>
        </fieldset>
    </div>
    </form>
</div><hr />
<footer>
    <div id="footer_logo">
        <img src="./assets/dimigo.png"/>
    </div><br/>
    ⓒCopyright 2016 Korea Digital Media High School.<br/> All rights reserved.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.<br/><br />
    <address>15255 경기도 안산시 단원구 사세충열로 94<br/>(와동, 한국디지털미디어고등학교)</address>학교대표번호 : <a href="tel:/031-363-7800">031-363-7800</a>
</footer>
</body>
</html>