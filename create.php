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
    <title>DIMIGO OAS :: 외출증즉시생성</title>
    <script type="text/javascript" src="assets/js/lib/jquery.js"></script>
    <script type="text/javascript" src="./assets/js/outing.js"></script>
    <script type="text/javascript" src="./assets/js/menu.js"></script>
    <script type="text/javascript">
        var usernames = [''];
        $(window).load(function(){
            loadStudent();
            // 페이지가 로딩될 때 'Loading 이미지'를 숨긴다.
            $('#loading').css('display', 'none');
            // ajax 실행 및 완료시 'Loading 이미지'의 동작을 컨트롤하자.
            $('#loading').ajaxStart(function()
                {
                    $(this).fadeIn(500);
                })
                .ajaxStop(function()
                {
                    //$(this).hide();
                    $(this).fadeOut(500);
                });
        });

        function loadStudent(){
            var url = './proxy.php?url=http%3A%2F%2Fapi.dimigo.hs.kr%2Fv1%2Fuser-students%2Fsearch%3Fgrade%3D'+$("#grade").val()+'%26class%3D'+$("#class").val();
            $.ajax({
                url:url,
                type:'GET',
                dataType:'JSON',
                success:function(data){
                    var str='';
                    var n = 0;
                    for(var idx in data){
                        str+='<option>'+data[idx].name+'</option>';
                        usernames[n++] = data[idx].username;
                    }
                    $("#students").html(str);
                }
            });
        }

        function postInfo()
        {
            var url = './make_permit/permission/send_permission.php?t_direct=true';
            $.ajax({
                url:url,
                type:'POST',
                data:($('form').serialize()+("&username="+usernames[$('#students option:selected').index()])),

            }).done(function(data)
            {
                location.href=data;
            });
        }
    </script>
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
<body class="body_img">
<?php
    session_start();
    if(!isset($_SESSION['MODE'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = 'account/auth.php';</script>\n");
    else if($_SESSION['Type']!=='T') die("<script>location.href = './403.html';</script>\n");
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
<h1 class="title">생성</h1><hr/>
<div class="container">
    <div class="aarticle_1">
        <article style="padding-left:20px;">
            <header><h2 class="small_notice">생성 시 확인사항</h2></header><br/>
            <section class="ttext2">1. 신청일자와 일시가 올바른지 확인하십시오.<br/>2. 외출증 크기가 부족하므로 가급적으로 사유는 간단히 작성해주십시오.<br/>3. 승인완료시 교무실의 Receipt Printer로 발급받으십시오.</section>
        </article>
    </div>
    <div class="aarticle">
        <form method="POST" action="./make_permit/permission/send_permission.php?t_direct=true">
            <fieldset>
                <legend>생성</legend>
                <div class="control-group">
                    <h5>결제라인 선택</h5>&nbsp;&nbsp;
                    <input type="radio" id="weekday" name="a_procedure" checked required value="weekday"><label for="weekday"> 평일 외출</label>&nbsp;&nbsp;
                    <input type="radio" id="weekend" name="a_procedure" required value="weekend"><label for="weekend"> 주말 긴급 외출</label><br/><br />
                    <span id="apply_notice" class="help-inline-visible"><strong>학년부장선생님/담임선생님 허가하에 외출이 가능합니다.</strong></span>
                </div><br />
                <div class="control-group">
                    <h5>대상학생 선택 : </h5>&nbsp;&nbsp;<select name="grade" id="grade" onchange="loadStudent();"><option>1</option><option>2</option><option>3</option></select>학년&nbsp;&nbsp;<select name="class" id="class" onchange="loadStudent();"><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option></select>반
                    <select id="students"></select>
                    <br/>
                </div>
                <div class="control-group">
                    <h5>신청일자 선택 : </h5>&nbsp;&nbsp;<input type="date" id="date" name="day"/>&nbsp;&nbsp;<br/>
                </div>
                <div class="control-group">
                    <h5>외출예정시간 : </h5><input type="time" name="startTime" required value="17:10"/><h5> 부터 </h5>
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
                <div class="control-group"><br/>
                    <input id="btn_apply" class="button special" type="button" value="생성" onclick="postInfo();"/>
                    <span class="help-inline"></span>
                </div>
            </fieldset>
        </form><br/><hr/>
    </div>
</div>

<footer>
    <div class="footer_info" id="float" align="justify">
        <p>ⓒCopyright 2016 KDMHS OAS.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.</p>
    </div>
</footer>
<div id="loading">
    <div class="cssload-dots">
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
        <div class="cssload-dot"></div>
    </div>

    <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="12" ></feGaussianBlur>
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0	0 1 0 0 0	0 0 1 0 0	0 0 0 18 -7" result="goo" ></feColorMatrix>
                <!--<feBlend in2="goo" in="SourceGraphic" result="mix" ></feBlend>-->
            </filter>
        </defs>
    </svg>
</div>
</body>
</html>