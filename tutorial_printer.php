<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="한국디지털미디어고등학교 외출신청시스템" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/media.css"/>
    <title>로그인 - 0AS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <script type="text/javascript" src="assets/js/lib/jquery.js"></script>
    <script type="text/javascript" src="assets/js/outing.js"></script>
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
        /*html{overflow-y:hidden;}*/
        .box{
            width: 200px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="body_img">
<div id="logo"><a href="./"><img src="assets/images/logo.png"/></a></div>
<div id="mNav">
    <a href="./"><img id="mLogo" src="assets/images/logo_device.png"/></a>
    <nav id="lnb_d">
        <button class="button" onclick="scrollToTop()">↑</button>
    </nav>
</div>
<h1 class="title">프린터&nbsp;<br id="optimization"/>설정안내</h1><hr />
<div class="container">
<article>
    <header><h1>본 시스템의 프린터는 EPSON Receipt Printer TM-T88III ReceiptE4 모델을 사용합니다.</h1></header>
    <section>
        1. 장치 및 프린터에 들어갑니다. <strong>(CLI COMMAND : control printers)</strong><br/>
        2. EPSON 프린터 모델의 인쇄 기본 설정에 진입합니다.<br/>
        3. Layout 탭의 Paper size 선택 영역에서 <strong>User Defined Paper Size</strong>를 클릭하고,<br/>
        새로운 프린터 사이즈인 <strong>Width: 60mm, Height:70mm</strong>을 입력해 Save Paper Size를 눌러 저장 후<br/>
        4. 외출증 인쇄 시 종이 사이즈를 저장한 크기를 선택 후 인쇄하시기 바랍니다.
    </section>
</article>
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
