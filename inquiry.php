<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css"/>
    <title>DIMIGO OAS :: 조회</title>
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
if (!isset($_SESSION['MODE']) || !isset($_SESSION['User']) || !isset($_SESSION['Type'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = 'account/auth.php?act=login';</script>\n");

if ($_SESSION['MODE'] === 'COMPLETELY_APPLIED') {
    $_SESSION['MODE'] = 'SIGNED_UP';
    echo("<script>alert('외출 신청이 완료되었습니다.');</script>\n");
}

if ($_SESSION['Type'] === 'T' && isset($_SESSION['APPROVE']) && $_SESSION['APPROVE'] === 'APPROVED') {
    $_SESSION['APPROVE'] = array();
    echo("<script>alert('해당 학생의 외출 승인이 완료되었습니다.'); </script>\n");
}

if ($_SESSION['Type'] === 'T' && isset($_SESSION['APPROVE']) && $_SESSION['APPROVE'] === 'CANCELLED') {
    $_SESSION['APPROVE'] = array();
    echo("<script>alert('해당 학생의 외출 승인 취소가 완료되었습니다.'); </script>\n");
}

if ($_SESSION['MODE'] === 'COMPLETELY_MODIFIED') {
    $_SESSION['MODE'] = 'SIGNED_UP';
    echo("<script>alert('변경되었습니다.');</script>\n");
}

?>
<div id="logo"><a href="index.php"><img src="assets/images/logo.png"/></a></div>
<div id="mNav">
    <i class="fa fa-bars" onclick="pop()"></i>
    <i class="fa fa-times" onclick="unpop()"></i>

    <div class="mobile_menu">
        <div class="t1">
            <div class="t2">
                <ul>
                    <li><?php if ($_SESSION['Type'] === 'S') echo("<a href=\"apply.php\">외출신청</a>\n"); else if ($_SESSION['Type'] === 'T') echo("<a href=\"create.php\">외출증즉시생성</a>"); ?></li>
                    <hr noshade color="white" width="250rem">
                    <li><a href="account/auth.php?act=logout">로그아웃</a></li>
                </ul>
            </div>
        </div>
    </div>
    <a href="index.php"><img id="mLogo" src="assets/images/logo_device.png"/></a>
</div>
<div id="welcome"><?php echo("환영합니다, " . $_SESSION['User'] . "님."); ?>
</div>
<nav id="lnb">
    <a href="account/auth.php?act=logout">
        <button class="button">로그아웃</button>
    </a>
    <?php if ($_SESSION['Type'] === 'S') echo("<a href=\"apply.php\"><button class=\"button special\">외출신청</button></a>\n"); ?>
    <?php if ($_SESSION['Type'] === 'T') echo("<a href=\"create.php\"><button class=\"button special\">외출증즉시생성</button></a>"); ?>
</nav>
<br/>

<h1 class="title">조회</h1>
<?php
include "include/auth.php";
if ($_SESSION['Type'] === 'T') {
    echo("<div id='status' align='center'><hr/><h1 id=\"status_title\">외출 신청 학생 전체현황표</h1><hr/>");
    echo("<table class='table table-hover table-responsive'>\n");
    echo("<thead>\n\t<td colspan='2'>1학년</td><td colspan='2'>2학년</td><td colspan='2'>3학년</td>\n</thead>\n");
    echo("<tbody>\n");
    $temp = 0;
    for ($i = 1; $i < 7; $i++) {
        echo("\t<tr>\n");
        for ($j = 1; $j < 4; $j++) {
            $query = "SELECT DISTINCT (o.username) FROM out_apply o JOIN member m ON o.username=m.User WHERE m.Grade=$j AND m.Class=$i;";
            $rs = mysqli_query($link, $query) or die("wrong query");
            $rn = mysqli_num_rows($rs);
            echo("\t\t" . '<td>' . "$i" . '반</td>' . "\t" . '<td>' . "$rn" . '명</td>' . "\n");
            $temp += $rn;
        }
    }
    echo("\t</tr>\n");
    echo("</tbody>\n");
    echo("<tfoot>\n<tr>\n\t<td colspan='3'>총 신청인원</td>\n\t<td colspan='3'>" . $temp . "명</td>\n</tr>\n</tfoot>\n</table>\n");
    mysqli_free_result($rs);
}
//?>
<hr/>
<div id="search">
    <h3 id="status_title">
        <?php
        if ($_SESSION['Type'] === 'T')
            echo("학생 외출 신청 현황 상세");
        else if ($_SESSION['Type'] === 'S')
            echo("외출 신청 현황");
        ?>
    </h3>
    <hr/>
    <div class="container search" align="center">
        <form method="GET">&nbsp;&nbsp;<h5>특정날짜선택</h5>&nbsp;&nbsp;
            <input type="date" class="search_field" id="inquiry_date" name="day"/>&nbsp;&nbsp;
            <button class="button" type="submit" id="inquiry"/>
            조회</button>
        </form>
        <br id='optimization'/>
        <?php
        if (isset($_GET['no']))
            $no = $_GET['no'];
        else $no = '';

        if ($_SESSION['Type'] === 'T')
            echo("<form method='GET'>&nbsp;&nbsp;<h5>일련번호조회</h5>&nbsp;&nbsp;\n<input type='text' id='no' name='no' size='23' required placeholder='ex)1511230001' value=$no >\n&nbsp;&nbsp;<input class=\"button\" type=\"submit\" id=\"inquiry\" value=\"조회\"/></form>\n<a href='./inquiry.php'>&nbsp;&nbsp;<input id=\"refresh\" class=\"button\" type=\"button\" value=\"새로고침\"/></a>\n"); ?>
    </div>
    <div id="content">
        <div class="inquiry">
            <?php
            if (empty($_GET['day'])) {
                $DATE = '';
                $if_cond_exists = false;
            } else {
                $DATE = $_GET['day'];
                $if_cond_exists = true;
            }

            if (isset($_GET['no'])) {
                $if_cond_exists = true;
            }

            unset($table);
            //처음 접속

            $t_level = 0;
            $t_grade = 0;
            $t_class = 0;
            if(substr($_SESSION['Serial'],-3) === '000')
            {
                $t_level = 2;
                $t_grade = substr($_SESSION['Serial'],0);
            }
            else if(substr($_SESSION['Serial'],-2) === '00')
            {
                $t_level = 1;
                $t_grade = substr($_SESSION['Serial'],0);
                $t_class = substr($_SESSION['Serial'],1,1);
            }
            if ($if_cond_exists === false) {
                if ($_SESSION['Type'] === 'T')
                {
                    if($t_level = 2)
                        $query = "SELECT o.id AS 일련번호, CONCAT(m.grade, m.class, LPAD(m.num,2,'0'), ' ', m.name) AS 학생정보, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 사유, a.is_approved AS 승인여부, a.approve_no FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id WHERE a.approve_no = ".$t_level.";";
                    else
                        $query = "SELECT o.id AS 일련번호, CONCAT(m.grade, m.class, LPAD(m.num,2,'0'), ' ', m.name) AS 학생정보, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 사유, a.is_approved AS 승인여부, a.approve_no FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id WHERE a.approve_no = ".$t_level.";";

                }else if ($_SESSION['Type'] === 'S')
                    $query = "SELECT o.id AS 일련번호, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 사유, a.is_approved AS 승인여부, a.approve_no FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id WHERE o.username = '" . $_SESSION['REQ_ID_INFO'] . "' ORDER BY o.apply_at DESC;";
            } //일련번호 혹은 날짜 제약조건 검색시
            else {
                if ($_SESSION['Type'] === 'T') {
                    if (isset($_GET['no'])) $query = "SELECT o.id AS 일련번호, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 사유, CONCAT(m.grade, m.class, m.num, ' ',m.name) AS 신청학생정보, a.is_approved AS 승인여부, a.approve_no FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id WHERE o.id = " . $_GET['no'] . "AND a.approve_no = \".$t_level.\";";
                    else $query = "SELECT o.id AS 일련번호, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 사유, CONCAT(m.grade, m.class, m.num, ' ',m.name) AS 신청학생정보, a.is_approved AS 승인여부, a.approve_no FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id  WHERE DATE_FORMAT(o.begin_time,'%Y-%m-%d')='" . $_GET['day'] . "' AND a.approve_no = \".$t_level.\";";
                } else if ($_SESSION['Type'] === 'S') $query = "SELECT o.id AS 일련번호, CONCAT(DATE_FORMAT(o.begin_time,'%m/%d %H:%i'),' ~ ', DATE_FORMAT(o.end_time, '%H:%i')) AS 외출예정일, o.note AS 사유, a.is_approved AS 승인여부, a.approve_no FROM out_apply o left join member m on o.username = m.user right join out_approve a on o.id = a.out_apply_id  WHERE DATE_FORMAT(o.begin_time,'%Y-%m-%d')='" . $_GET['day'] . "';";
            }
            $rs = mysqli_query($link, $query);
            if ($rs === false) {
                $errno = mysqli_errno($link);
                $errmsg = mysqli_error($link);
                die("</div>\n<script>location.href='error.php?errno=$errno&errmsg=$errmsg';</script>\n");
            }
            $rows = mysqli_num_rows($rs);
            if ($rows !== 0) {
                $n = 0;
                while ($row = mysqli_fetch_array($rs, MYSQL_ASSOC)) {
                    if ($n === 0) {
                        foreach ($row as $key => $val)
                            if ($key !== 'approve_no')
                                $table['fields'][$n++] = $key;
                    }

                    foreach ($row as $key => $val) {
                        if ($key === '일련번호')
                            $no_temp = $val; //일련번호
                        if ($key === '승인여부')
                            if ($val === 'N') {
                                if ($_SESSION['Type'] === 'T') {
                                    $_SESSION['APPROVE'] = true;
                                    $row[$key] = "<a href=make_permit/permission/toggle_permission.php?id=$no_temp&status=approve><button class='button special'>승인</button></a>\n";
                                } else if ($_SESSION['Type'] === 'S') {
                                    $_SESSION['MODIFY'] = true;
                                    $row[$key] = "대기중&nbsp;&nbsp;<a href=modify.php?id=$no_temp><button class='button special'>수정</button></a>\n";
                                }
                            } else if ($val === 'Y') {
                                if ($_SESSION['Type'] === 'T') {
                                    $_SESSION['APPROVE'] = true;
                                    $_SESSION['MODIFY'] = true;
                                    $_SESSION['GET_PERMIT'] = true;
                                    $row[$key] = "<a href=make_permit/permission/toggle_permission.php?id=$no_temp&status=cancel><button class='button special'>승인 취소</button></a>\n
                                                      <br id='optimization'/><br id='optimization'/><a href=modify.php?id=$no_temp><button class='button special'>변경</button></a>\n
                                                      <br id='optimization'/><br id='optimization'/><a href=make_permit/permission/outing_permission.php?no=$no_temp><button id='print_permit' class='button special'>외출증 출력</button></a>\n";
                                } else if ($_SESSION['Type'] === 'S') {
                                    $_SESSION['GET_PERMIT'] = true;
                                    $row[$key] = "<a href=make_permit/permission/outing_permission.php?no=$no_temp><button class='button special'>외출증 출력</button></a>\n";
                                }
                            }


                    }
                    $table['records'][$n++] = $row;

                }

                mysqli_free_result($rs);
                mysqli_close($link);

                echo("<div id='table' align='center'>\n");
                echo("\t\t<table id=\"outing_detail\" class='table table-hover table-responsive'>\n");
                echo("\t\t\t<thead>\n\t\t\t\t<tr>\n");

                foreach ($table['fields'] as $fname)
                    echo("\t\t\t\t\t<td><strong>{$fname}</strong></td>\n");

                echo("\t\t\t\t</tr>\n\t\t\t</thead>\n\t\t\t<tbody>\n");

                if (count($table['records']) > 0) {
                    foreach ($table['records'] as $row) {
                        if ($_SESSION['Type'] === 'S') {
                            if ($row['approve_no'] >= 2) {
                                echo("\t\t\t\t<tr>\n");
                                foreach ($row as $field)
                                    if ($row['approve_no'] !== $field)
                                        echo("\t\t\t\t\t<td>{$field}</td>\n");
                                echo("\t\t\t\t</tr>\n");
                            }
                        } else {
                            echo("\t\t\t\t<tr>\n");
                            foreach ($row as $field)
                                if ($row['approve_no'] !== $field)
                                    echo("\t\t\t\t\t<td>{$field}</td>\n");
                            echo("\t\t\t\t</tr>\n");
                        }


                    }
                }

                echo("\t\t\t</tbody>\n\t\t</table>\n");
                echo("\t\t</div>\n");
            } else echo("<h2><p style='text-align:center;'><strong id='no_data'>데이터가 존재하지 않습니다.</strong></p></h2>\n");
            if ($_SESSION['Type'] === 'T') echo("<p id='psetup_notice' style='text-align: center;'>외출증 인쇄 전 반드시 프린터 설정을 올바르게 맞추어 주십시오. <a href=\"tutorial_printer.php\"><button class=\"button\">설정방법 보기</button></a>&nbsp;에서 확인하실 수 있습니다.</p>\n");
            echo("</div>\n");

            ?>
        </div>
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
                    <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="12"></feGaussianBlur>
                    <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0	0 1 0 0 0	0 0 1 0 0	0 0 0 18 -7"
                                   result="goo"></feColorMatrix>
                    <!--<feBlend in2="goo" in="SourceGraphic" result="mix" ></feBlend>-->
                </filter>
            </defs>
        </svg>
    </div>
    <footer id="footer_relative">
        <div class="footer_info" id="float" align="justify">
            <p>ⓒCopyright 2016 KDMHS OAS.<br/>System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.</p>
        </div>
    </footer>
</body>
</html>