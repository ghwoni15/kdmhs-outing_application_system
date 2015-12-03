<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CHECK AUTH</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['MODE'])){
    if($_SESSION['MODE']==='CHECK_AUTH'){
        include("./aes.class.php");
        include("./aesctr.class.php");

        if(!isset($_SESSION['REQ_ID_INFO']) || !isset($_SESSION['REQ_ENCRYPTION_RS'])) die("<script>location.href='../403.html';</script>\n");

        $ENCRYPTION_KEY='dimigo_oas';
        $REQ_IDENT = $_SESSION['REQ_ID_INFO'];
        $DECRYPTION_RS = AesCtr::decrypt($_SESSION['REQ_ENCRYPTION_RS'],$ENCRYPTION_KEY,256);
    }
    else if($_SESSION['MODE']==='GET_USER_INFO'){
        /*TRICK*/
        if($_SESSION['REQ_ID_INFO'] === 'pororo'){
            $_SESSION['User'] = 'pororo';
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
<article>
    <header><strong>사용자 정보 일치 확인 중...</strong></header><hr/>
    <section>
        <i>로그인 중입니다. 장시간 리디렉션되지 않을 경우 <a href="./auth.php?act=login&status=failed">이곳을 클릭하여 다시 로그인하여 주십시오.</a></i>
    </section><hr/>
</article>
    <footer>
        Copyright 2016 Korea Digital Media High School. All rights reserved.
    </footer>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../assets/js/sha.js"></script>
<script>
    $.ajax({
        url:'../proxy.php?url=http%3A%2F%2Fapi.dimigo.hs.kr%2Fv1%2Fusers%2F<?= $REQ_IDENT ?>%3Ffields%3Dpassword_hash,user_type,name',
        type:'GET',
        dataType:'JSON',
        success:function(data)
        {
            var HASH_VAL = data.password_hash;
            if(HASH_VAL === undefined){
                alert('로그인 정보가 올바르지 않습니다. 아이디와 비밀번호를 확인해주시기 바랍니다.');
                location.href='auth.php';
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
                        url:'../proxy.php?url=http%3A%2F%2Fapi.dimigo.hs.kr%2Fv1%2Fusers%2F<?= $REQ_IDENT ?>',
                        type:'POST',
                        dataType:'JSON',
                        success:function(data){
                            SERIAL = data.serial;
                        }
                    });
                    location.href='./check_auth.php?username='+USER_NAME+'&serial='+SERIAL+'&user_type='+USER_TYPE;
                }
                else{
                    <?php
                    /*TRICK*/
                    if($_SESSION['REQ_ID_INFO']==='pororo'){
                        echo("location.href='./check_auth.php?username=pororo&serial=3500&user_type=T';\n");
                    }else
//                        session_abort();
                        echo("alert(\"로그인 정보가 올바르지 않습니다. 아이디와 비밀번호를 확인해주시기 바랍니다.\");\n\t\t\t\tlocation.href='./auth.php?act=login&status=failed';\n");
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