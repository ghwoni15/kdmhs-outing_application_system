<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/menu.css"/>
    <title>DIMIGO OAS :: 외출신청</title>
    <script type="text/javascript" src="assets/js/lib/jquery.js"></script>
    <script type="text/javascript" src="assets/js/outing.js"></script>
    <script type="text/javascript" src="assets/js/menu.js"></script>
    <style>
        .aarticle{
            width: 500px;
            float: left;
        }
        .aarticle_1{
            width: 500px;
            float: left;
            margin-right: 20px;
        }
        .container{
            width: 1024px;
            margin: 0 auto;
        }
        @media (max-width:1024px){
            .aarticle_1{
                width: 95%;
                float: none;
                margin-bottom: 20px;
            }
            .aarticle{
                width: 95%;
                float: none;
                /*margin: 0 auto;*/
            }
            .container{
                text-align: center;
            }
            .ttext{
                font-size: 20pt;
            }
            .ttext2{
                font-size: 10pt;
            }
            #btn_apply{
                width: 100%;
            }
        }
        @media (max-width:412px) {
            .aarticle_1{
                width: 95%;
                margin-left: 0;
                margin-right: 0;
            }
            .aarticle{
                width: 95%;
                margin-left: 0;
                margin-right: 0;
            }
        }
    </style>
</head>
<body class="body_img" style="overflow-x: hidden;">
<?php
session_start();
if(!isset($_SESSION['MODE'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = './account/auth.php';</script>\n");
if($_SESSION['Type']==='T') die("<script>alert('학생 전용 페이지입니다.'); location.href='./index.php';</script>\n");
?>
<div id="logo"><a href="."><img src="assets/images/logo.png"/></a></div>
<div id="mNav">
    <i class="fa fa-bars" onclick="pop()"></i>
    <i class="fa fa-times" onclick="unpop()"></i>
    <div class="mobile_menu">
        <div class="t1">
            <div class="t2">
                <ul>
                    <li><a href="inquiry.php">신청조회</a></li><hr noshade color="white" width="250rem">
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
    <a href="./inquiry.php"><button class="button">신청조회</button></a>
</nav><br/>
<h1 class="title">외출신청</h1><hr/>
<div class="container">
    <div class="aarticle_1">
        <article style="padding-left:20px;">
            <header><h2 class="small_notice">신청 전 유의사항!!!</h2></header><br/>
            <section class="ttext2">1. 신청일자를 반드시 확인하십시오.<br/>2. 시간을 정확히 기입하십시오.<br/>3. 외출증 크기가 부족하므로 가급적으로 사유는 간단히 <br id="optimization"> 작성해주십시오.<br/>4. 승인완료시 교무실의 Receipt Printer로 발급받으십시오.<hr/>만약 오랜 시간 승인이 이루어지지 않을 시 담당 선생님께 <br id="optimization">요청하십시오.<br id="optimization"><br id="optimization"></section>
        </article>
    </div>
    <div class="aarticle">
        <form method="POST" action="./make_permit/permission/send_permission.php">
            <fieldset>
                <legend>외출신청</legend>
                <div class="control-group">
                    <h5>결제라인 선택</h5>&nbsp;&nbsp;
                    <input type="radio" id="weekday" name="a_procedure" value="weekday" checked required><label for="weekday"> 평일 외출</label>&nbsp;&nbsp;
                    <input type="radio" id="weekend" name="a_procedure" value="weekend" required><label for="weekend"> 주말 긴급 외출</label><br/>
                    (<input type="checkbox" id="no_hrt" name="no_hrt"><label for="no_hrt"> 담임선생님 부재시 클릭)</label><br/><br />
                    <span id="apply_notice" class="help-inline-visible"><strong class="ttext2">학년부장선생님/담임선생님 허가하에 외출이 가능합니다.</strong></span><br/><br/>
                    <p><h2 class="small_notice"><span class="ttext">** 결제라인(행정 절차) 안내</span></h2><br/><span class="ttext2">외출증 허가를 위해 상황에 따른 행정 절차가 필요합니다.<br />해당되는 외출 유형을 올바르게 선택해주십시오.</span></p>
                </div>
                <div class="control-group">
                    <br /><h5>신청일자 선택</h5>&nbsp;&nbsp;<input type="date" id="date" name="day"/>&nbsp;&nbsp;<br/>
                </div>
                <div class="control-group">
                    <br/><h5>외출예정시간 : </h5><input type="time" name="startTime" required value="17:10"/><h5> 부터 <br id="optimization"/><br id="optimization"/></h5>
                    <input type="time" name="endTime" required value="18:30"/>&nbsp;<h5>&nbsp;까지&nbsp;</h5>
                </div>
                <div class="control-group">
                    <br/><h5>외출사유 : </h5>
                    <select id="select_reason" name="reason_type" required onchange="getReason();">
                        <option value="">선택하세요</option>
                        <option value="병원">병원</option>
                        <option value="물품구매">물품구매</option>
                        <option value="학원">학원</option>
                        <option value="외부활동">외부활동</option>
                        <option value="(부모님)면회">부모님 면회</option>
                        <option value="기타">기타</option>
                    </select>
                    <input type="text" id="reason" name="etc_reason" required size="40" maxlength="20" placeholder="20자 제한, 간단명료히 작성"/>&nbsp;&nbsp;
                </div>
                <div class="control-group">
                    <br/><input id="btn_apply" class="button special" type="submit" value="신청"/>
                </div><hr/>
            </fieldset>
        </form>
    </div>
</div>
<hr style="clear:both;"/>
<footer id="footer_relative">
    <div class="footer_info" id="float" align="justify">
        <p>ⓒCopyright 2016 KDMHS OAS.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.</p>
    </div>
</footer>
</body>
</html>