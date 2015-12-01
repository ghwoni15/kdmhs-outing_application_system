<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CHECK AUTH</title>
</head>
<body>
<article>
    <header><strong>사용자 정보 일치 확인 중...</strong></header><hr/>
    <section>
        <i>로그인 중입니다. 장시간 리디렉션되지 않을 경우 <a href="../auth.php?act=login&status=failed">이곳을 클릭하여 다시 로그인하여 주십시오.</a></i>
    </section><hr/>
    <footer>
        Copyright 2016 Korea Digital Media High School. All rights reserved.
    </footer>
</article>
<?php
    session_start();

    include("./aes.class.php");
    include("./aesctr.class.php");

    if(!isset($_SESSION['REQ_ID_INFO']) || !isset($_SESSION['REQ_ENCRYPTION_RS'])) die("<script>location.href='../403.html';</script>\n");
    if(isset($_SESSION['SIGNED']) && $_SESSION['SIGNED'] === true) die("<script>location.href='../index.php';</script>\n");

    $ENCRYPTION_KEY='dimigo_oas';
    $REQ_IDENT = $_SESSION['REQ_ID_INFO'];
    $DECRYPTION_RS = AesCtr::decrypt($_SESSION['REQ_ENCRYPTION_RS'],$ENCRYPTION_KEY,256);


//    echo("<script>location.href='../index.php';</script>\n");
?>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../assets/js/sha.js"></script>
<script>
    $.ajax({
        url:'../proxy.php?url=http%3A%2F%2Fapi.dimigo.hs.kr%2Fv1%2Fusers%2F<?= $REQ_IDENT ?>%3Ffields%3Dpassword_hash',
        type:'GET',
        dataType:'JSON',
        success:function(data)
        {
            var HASH_VAL = data.password_hash;
            if(HASH_VAL === undefined){
                alert('로그인 정보가 올바르지 않습니다. 아이디와 비밀번호를 확인해주시기 바랍니다.');
                location.href='../auth.php?act=login&status=failed';
            }else{
                var CHECK_STR = HASH_VAL.split("|");
                var DECRYPTION_RS = '<?= $DECRYPTION_RS ?>';
                var RS = DECRYPTION_RS + CHECK_STR[1];
                var hashObject = new jsSHA('SHA-256', 'TEXT', 1);
                hashObject.update(RS);
                var CHECK_RS = (CHECK_STR[0] == hashObject.getHash('HEX')) ? true:false;
                if(CHECK_RS) {
                    <?php
                    $_SESSION['REQ_ENCRYPTION_RS']=''; //DESTROY USER PASSWORD
                    $_SESSION['SIGNED'] = true;
                    $_SESSION['User']='tea35';
                    ?>
                    location.href='../index.php';
                }else{
                    <?php
                        echo("alert(\"로그인 정보가 올바르지 않습니다. 아이디와 비밀번호를 확인해주시기 바랍니다.\");\n\t\t\t\tlocation.href='../auth.php?act=login&status=failed';\n");
                    ?>

                }
            }
        },
        error:function(){
            location.href='../error.php?errno=4&errmsg=Unknown';
        }
    });
</script>
</body>
</html>