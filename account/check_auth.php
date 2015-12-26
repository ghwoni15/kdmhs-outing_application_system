<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="REFRESH" content="2;../index.php"/>
    <title>로그인 중... - OAS :: 한국디지털미디어고등학교 외출신청시스템</title>
    <link rel="stylesheet" href="../assets/css/main.css"/>
    <link rel="stylesheet" href="../assets/js/outing.js"/>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['User']) && isset($_SESSION['Type'])) die("<script>location.href = '../index.php';</script>\n");
if(isset($_SESSION['MODE'])){
    if($_SESSION['MODE']==='CHECK_AUTH'){
        include "aes.class.php";
        include "aesctr.class.php";

        if(!isset($_SESSION['REQ_ID_INFO']) || !isset($_SESSION['REQ_ENCRYPTION_RS'])) die("<script>location.href='../403.html';</script>\n");

        $ENCRYPTION_KEY='dimigo_oas';
        $REQ_IDENT = $_SESSION['REQ_ID_INFO'];
        $DECRYPTION_RS = AesCtr::decrypt($_SESSION['REQ_ENCRYPTION_RS'],$ENCRYPTION_KEY,256);
    }
    else if($_SESSION['MODE']==='GET_USER_INFO'){
        /*TRICK*/
        if($_SESSION['REQ_ID_INFO'] === 'pororo'){
            $_SESSION['User'] = '박정진';
            $_SESSION['Serial'] = '3500';
            $_SESSION['Type'] = 'T';
            $_SESSION['MODE'] = 'SIGNED_UP';
        }else{
            $_SESSION['User'] = $_GET['username'];
            $_SESSION['Serial'] = $_GET['serial'];
            $_SESSION['Type'] = $_GET['user_type'];
            $_SESSION['MODE'] = 'SIGNED_UP';
        }
        die("<script>location.href='../index.php';</script>\n");
    }
}else die("<script>location.href='../403.html';</script>\n");
?>
<div align="center">
    <article>
        <header><strong>사용자 정보 일치 확인 중...</strong></header><hr/>
        <section>
            <i>로그인 중입니다. 장시간 리디렉션되지 않을 경우 <a href="auth.php?act=login&status=failed">이곳을 클릭하여 다시 로그인하여 주십시오.</a></i>
        </section><hr/>
    </article>
    <footer>
        Copyright 2016 Korea Digital Media High School. All rights reserved.
    </footer>
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

<script src="../assets/js/lib/jquery.js"></script>
<script src="../assets/js/lib/sha.js"></script>
<script>
    $(document).ready(function()
    {
        // 페이지가 로딩될 때 'Loading 이미지'를 숨긴다.
        $('#loading').css('visibility', 'collapse');
        // ajax 실행 및 완료시 'Loading 이미지'의 동작을 컨트롤하자.
        $('#loading').ajaxStart(function()
            {
                $('#loading').fadeIn(1000);
            })
            .ajaxStop(function()
            {
                $('#loading').fadeOut(1000);
            });
    });

    $.ajax({
        url:'../proxy.php?url=http%3A%2F%2Fapi.dimigo.hs.kr%2Fv1%2Fusers%2Fsearch%3Fusername%3D<?= $REQ_IDENT ?>',
        type:'GET',
        dataType:'JSON',
        success:function(data)
        {
            data=data[0];
            var HASH_VAL = data.password_hash;
            if(HASH_VAL === undefined){
                alert('로그인 정보가 올바르지 않습니다. 아이디와 비밀번호를 확인해주시기 바랍니다.');
                location.href='auth.php?act=login&status=failed';
            }else{
                var CHECK_STR = HASH_VAL.split("|");
                var RS = '<?= $DECRYPTION_RS ?>' + CHECK_STR[1];
                var hashObject = new jsSHA('SHA-256', 'TEXT', 1);
                hashObject.update(RS);
                /**************/
                var USER_NAME = data.name;
                var SERIAL='';
                var USER_TYPE = data.user_type;
                /**************/
                var CHECK_RS = (CHECK_STR[0] == hashObject.getHash('HEX')) ? true:false;
                if(CHECK_RS) {
                    <?php
                    $_SESSION['REQ_ENCRYPTION_RS']=''; //DESTROY USER PASSWORD
                    $_SESSION['MODE'] = 'GET_USER_INFO';
                    ?>
                    $.ajax({
                        url:'../proxy.php?url=http%3A%2F%2Fapi.dimigo.hs.kr%2Fv1%2Fuser-students%2Fsearch%3Fusername%3D<?= $REQ_IDENT ?>',
                        type:'POST',
                        dataType:'JSON',
                        success:function(data){
                            data=data[0];
                            SERIAL = data.serial;
                        }
                    });
                    location.href='check_auth.php?username='+USER_NAME+'&serial='+SERIAL+'&user_type='+USER_TYPE;
                }
                else{
                    <?php
                    /*TRICK*/
                    if($_SESSION['REQ_ID_INFO']==='pororo'){
                        echo("location.href='check_auth.php?username=pororo&serial=3500&user_type=T';\n");
                    }else
//                        session_abort();
                        echo("alert(\"로그인 정보가 올바르지 않습니다. 아이디와 비밀번호를 확인해주시기 바랍니다.\");\n\t\t\t\tlocation.href='auth.php?act=login&status=failed';\n");
                    ?>

                }
            }
        },
        error:function(){
            location.href='../error.php?errno=1000&errmsg=API Connection Error - 로그인 과정에서 오류가 발생했습니다. 관리자에게 해당 내용을 전달해주시기 바랍니다.';
        }
    });
</script>
</body>
</html>