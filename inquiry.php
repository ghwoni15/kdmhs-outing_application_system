<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <title>DIMIGO OAS :: 조회</title>
    <script type="text/javascript" src="./assets/js/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
</head>
<body class="body_img">
<?php
session_start();
if(!isset($_SESSION['MODE']))
    die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = './account/auth.php';</script>\n");

if($_SESSION['MODE'] === 'COMPLETELY_APPLIED')
    die("<script>alert('외출 신청이 완료되었습니다.');</script>\n");

if($_SESSION['Type']==='T' && isset($_GET['approved']) && $_GET['approved']==='approved')
    echo("<script>alert('해당 학생의 외출 승인이 완료되었습니다.'); </script>\n");

if($_SESSION['Type']==='T' && isset($_GET['approved']) && $_GET['approved']==='cancelled')
    echo("<script>alert('해당 학생의 외출 승인 취소가 완료되었습니다.'); </script>\n");

if($_SESSION['Type']==='T' && isset($_GET['modified']) && $_GET['modified']==='complete')
    echo("<script>alert('해당 학생의 외출 상세 내역 변경이 완료되었습니다. 또한 변경된 내용을 자동으로 승인합니다.'); </script>\n");
else if($_SESSION['Type']==='S' && isset($_GET['modified']) && $_GET['modified']==='complete')
    echo("<script>alert('외출 상세 내역 변경이 완료되었습니다.'); </script>\n");

?>
<div id="logo"><a href="."><img src="assets/images/logo.png"/></a></div>
<div id="mNav">
    <a href="./"><img id="mLogo" src="assets/images/logo_device.png"/></a>
    <nav id="lnb_d">
        <button class="button" onclick="scrollToTop()">↑</button>
        <?php if($_SESSION['Type']==='S') echo("<a href=\"./apply.php\"><button class=\"button\">외출신청</button></a>\n");?>
        <?php if($_SESSION['Type']==='T') echo("<a href=\"./create.php\"><button class=\"button special\">외출증즉시생성</button></a>"); ?>
    </nav>
</div>
<div id="welcome"><?php echo("환영합니다, ".$_SESSION['User']."님.");?>
</div>
<nav id="lnb">
    <a href="account/auth.php?act=logout"><button class="button">로그아웃</button></a>
    <?php if($_SESSION['Type']==='S') echo("<a href=\"./apply.php\"><button class=\"button\">외출신청</button></a>\n");?>
    <?php if($_SESSION['Type']==='T') echo("<a href=\"./create.php\"><button class=\"button special\">외출증즉시생성</button></a>"); ?>
</nav>
<br/>
<h1 class="title">조회</h1>
<?php
    include "./include/auth.php";
//    if($_SESSION['Type']==='T'){
//        echo("<div id='status' align='center'><hr/><h1 id=\"status_title\">금일 외출 신청 학생 현황표</h1><hr/>");
//        echo("<table class='table table-hover table-responsive'>\n");
//        echo("<thead>\n\t<td colspan='2'>1학년</td><td colspan='2'>2학년</td><td colspan='2'>3학년</td>\n</thead>\n");
//        echo("<tbody>\n");
//        $temp = 0;
//        for($i = 1; $i < 7; $i++)
//        {
//            echo("\t<tr>\n");
//            for($j = 1; $j < 4; $j++)
//               {
//                    $query = "SELECT No FROM outing_apply o JOIN member m ON o.User=m.User WHERE Grade=$j AND Class=$i;";
//                    $rs = mysqli_query($link, $query) or die("wrong query");
//                    $rn = mysqli_num_rows($rs);
//                    echo("\t\t".'<td>'."$i".'반</td>'."\t".'<td>'."$rn".'명</td>'."\n");
//                    $temp += $rn;
//                }
//        }
//        echo("\t</tr>\n");
//        echo("</tbody>\n");
//        echo("<tfoot>\n<tr>\n\t<td colspan='3'>총 신청인원</td>\n\t<td colspan='3'>".$temp."명</td>\n</tr>\n</tfoot>\n</table>\n");
//        mysqli_free_result($rs);
//    }
//?>
<hr/>
<div id="search">
    <h3 id="status_title">
    <?php
        if($_SESSION['Type']==='T')
            echo("학생 외출 신청 현황 상세");
        else if($_SESSION['Type']==='S')
            echo("외출 신청 현황");
    ?>
    </h3>
    <hr/>
    <div class="container search" align="center" style="border:1px solid white;">
            <form method="GET">&nbsp;&nbsp;<h5>특정날짜선택</h5>&nbsp;&nbsp;
                <input type="date" id="inquiry_date" name="day" />&nbsp;&nbsp;
                <input class="button" type="submit" id="inquiry" value="조회"/>
            </form><br id='optimization' />
            <?php
            if(isset($_GET['no']))
                $no=$_GET['no'];
            else $no='';

            if($_SESSION['Type']==='T')
                echo("<form method='GET'>&nbsp;&nbsp;<h5>일련번호조회</h5>&nbsp;&nbsp;\n<input type='text' id='no' name='no' size='23' required placeholder='ex)1511230001' value=$no >\n&nbsp;&nbsp;<input class=\"button\" type=\"submit\" id=\"inquiry\" value=\"조회\"/></form>\n<a href='./inquiry.php'>&nbsp;&nbsp;<input id=\"refresh\" class=\"button\" type=\"button\" value=\"새로고침\"/></a>\n"); ?>
    </div>
    <hr/>
    <div id="content">
        <div class="inquiry">
            <?php
                if(empty($_GET['day'])){
                    $DATE='';
                    $if_cond_exists=false;
                }else{
                    $DATE=$_GET['day'];
                    $if_cond_exists=true;
                }

                if(isset($_GET['no'])) {
                    $if_cond_exists = true;
                }

                unset($table);
                if($if_cond_exists===false){
                    if($_SESSION['Type']==='T') $query ="SELECT o.id AS 일련번호, CONCAT(m.grade, m.class, m.num, ' ', m.name) AS 학생정보, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 외출사유, a.is_approved AS 승인여부 FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id;";
                    else if($_SESSION['Type']==='S')
                        $query = "SELECT o.id AS 일련번호, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 외출사유, a.is_approved AS 승인여부 FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id WHERE o.username = '" . $_SESSION['REQ_ID_INFO'] . "' ORDER BY o.apply_at DESC;";
                }
                else{
                    if($_SESSION['Type']==='T'){
                        if(isset($_GET['no'])) $query = "SELECT o.id AS 일련번호, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 외출사유, CONCAT(m.grade, m.class, m.num, ' ',m.name) AS 신청학생정보, a.is_approved AS 승인여부 FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id WHERE o.id = ".$_GET['no'].";";
                        else $query = "SELECT o.id AS 일련번호, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 외출사유, CONCAT(m.grade, m.class, m.num, ' ',m.name) AS 신청학생정보, a.is_approved AS 승인여부 FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id  WHERE DATE_FORMAT(o.begin_time,'%Y-%m-%d')='".$_GET['day']."';";
                    }
                    else if($_SESSION['Type']==='S') $query = "SELECT o.id AS 일련번호, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 외출사유, a.is_approved AS 승인여부 FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id  WHERE DATE_FORMAT(o.begin_time,'%Y-%m-%d')='".$_GET['day']."';";
                }
                ECHO("<script> alert($query); </script>");
                $rs=mysqli_query($link, $query);
                if($rs===false){
                    $errno=mysqli_errno($link);
                    $errmsg = mysqli_error($link);
                    die("</div>\n<script>location.href='./error.php?errno=$errno&errmsg=$errmsg';</script>\n");
                }
                $rows=mysqli_num_rows($rs);
                if($rows !== 0) {
                    $n = 0;
                    while ($row = mysqli_fetch_array($rs, MYSQL_ASSOC)) {
                        if ($n === 0) {
                            foreach ($row as $key => $val)
                                $table['fields'][$n++] = $key;
                        }

                        foreach ($row as $key => $val) {
                            if($key === '일련번호')
                                $temp = $val;
                            if ($key === '승인여부')
                                if ($val === 'N') {
                                    if ($_SESSION['Type'] === 'T'){
                                        $_SESSION['TEMP_AP_NO'] = $temp;
                                        $row[$key] = "<a href=./make_permit/permission/toggle_permission.php?status=approve><button class='button special'>승인</button></a>\n";
                                    }
                                    else if ($_SESSION['Type'] === 'S'){
                                        $_SESSION['TEMP_MF_NO'] = $temp;
                                        $row[$key] = "대기중&nbsp;&nbsp;<a href=./modify.php><button class='button special'>수정</button></a>\n";
                                    }
                                }
                                else if($val === 'Y'){
                                    $_SESSION['TEMP_OP_NO'] = $temp;
                                    if($_SESSION['Type']==='T'){
                                        $row[$key] = "<a href=./make_permit/permission/toggle_permission.php?perm_no=$temp&status=cancel><button class='button special'>승인 취소</button></a>\n
                                                      <a href=./modify.php><button class='button special'>변경</button></a>\n
                                                      <a href=./make_permit/permission/outing_permission.php><button id='print_permit' class='button special'>외출증 출력</button></a>\n";
                                    }
                                    else if($_SESSION['Type']==='S') $row[$key] = "승인됨&nbsp;&nbsp;<a href=./make_permit/permission/outing_permission.php><button class='button special'>외출증 출력</button></a>\n";
                                }

                        }
                        $table['records'][$n++] = $row;

                    }

                mysqli_free_result($rs);
                mysqli_close($link);

                echo("<div id='table' align='center'>\n");
                echo("\t\t<table id=\"outing_detail\" class='table table-hover table-responsive'>\n");
                echo("\t\t\t<thead>\n\t\t\t\t<tr>\n");

                foreach($table['fields'] as $fname)
                    echo("\t\t\t\t\t<td><strong>{$fname}</strong></td>\n");

                echo("\t\t\t\t</tr>\n\t\t\t</thead>\n\t\t\t<tbody>\n");

                if(count($table['records']) > 0) {
                    foreach($table['records'] as $row) {
                        echo("\t\t\t\t<tr>\n");
                        foreach($row as $field)
                            echo("\t\t\t\t\t<td>{$field}</td>\n");
                        echo("\t\t\t\t</tr>\n");
                    }
                }

                echo("\t\t\t</tbody>\n\t\t</table>\n");
                echo("\t\t</div>\n");
            }else echo("<h2><p style='text-align:center;'><strong id='no_data'>데이터가 존재하지 않습니다.</strong></p></h2>\n");
            echo("<hr/></div>\n");
            ?>
    </div>
</div>
<footer>
    <div id="footer_logo">
        <img src="assets/images/dimigo.png"/>
    </div><br/>
    ⓒCopyright 2016 Korea Digital Media High School.<br/> All rights reserved.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.<br/><br />
    <address>15255 경기도 안산시 단원구 사세충열로 94<br/>(와동, 한국디지털미디어고등학교)</address>학교대표번호 : <a href="tel:/031-363-7800">031-363-7800</a>
</footer>
</body>
</html>