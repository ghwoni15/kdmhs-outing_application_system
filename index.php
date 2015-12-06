<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/media.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css"/>
    <title>OAS :: 한국디지털미디어고등학교 외출신청시스템</title>
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
    <style>
        html{overflow-y:hidden;}
    </style>
</head>
<body class="body_img">
    <?php
    session_start();
    if(!isset($_SESSION['MODE']) || !isset($_SESSION['User']) || !isset($_SESSION['Type'])) die("<script>alert('서비스 로그인 후 사용하실 수 있습니다.'); location.href = 'account/auth.php?act=login';</script>\n");
    if($_SESSION['Type']==='T') die("<script>location.href='inquiry.php';</script>\n");
    ?><div id="logo">
        <a href="."><img src="assets/images/logo.png"/></a>
    </div>
    <div id="mNav">
        <i class="fa fa-bars" onclick="pop()"></i>
        <i class="fa fa-times" onclick="unpop()"></i>
        <div class="mobile_menu">
            <div class="t1">
                <div class="t2">
                    <ul>
                        <li><a href="inquiry.php">외출조회</a></li><hr noshade color="white" width="250rem">
                        <li><a href="apply.php">외출신청</a></li><hr noshade color="white" width="250rem">
                        <li><a href="account/auth.php?act=logout">로그아웃</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="index.php"><img id="mLogo" src="assets/images/logo_device.png"/></a>
    </div>
    <div id="welcome">
        <?php echo("환영합니다, ".$_SESSION['User']."님.\n");?>
    </div>
    <nav id="lnb">
        <a href="account/auth.php?act=logout"><button class="button">로그아웃</button></a>
        <a href="inquiry.php"><button class="button">신청조회</button></a>&nbsp;<?php if($_SESSION['Type']==='S') echo("<a href=\"apply.php\"><button class=\"button special\">외출신청</button></a>\n"); ?><?php if($_SESSION['Type']==='T') echo("<a href=\"create.php\"><button class=\"button special\">외출증즉시생성</button></a>\n"); ?>
    </nav>
    <div class="large_title">
        <h1 class="header">외출신청,<br/>이제 인터넷으로 편하게 신청하세요</h1><br/>
        <h2 class="sub_title">
            <strong>외출하지말고 그냥 공부해! 공부 안하면 수능 망하는거야~</strong><br id="optimization"/><del>어짜피 해도 망하지만</del><br/><br/>
            <a href="apply.php">
                <button class="button special">
                    <strong>지금 바로 외출신청하러가기</strong>
                </button>
            </a>&nbsp;<br id="optimization"/><br id="optimization"/><a href="tutorial.php">
                <button class="button special">
                    <strong>시스템 이용방법 자세히</strong>
                </button>
            </a>
        </h2>
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
    <footer>
        <div class="footer_info" id="float" align="justify">
            <p>ⓒCopyright 2016 KDMHS OAS.<br />System created by J.W.Jeon/T.H.Kim/S.H.Kim HD12.</p>
        </div>
    </footer>
</body>
</html>