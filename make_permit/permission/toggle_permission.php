<?php
    session_start();
    if(!isset($_GET['id']) || !isset($_GET['status']))  header('Location: ../../403.html');
    else{
        include "../../include/auth.php";

            if($_GET['status']==='approve'){
                /*승인날짜 수정 必*/
                if($_SESSION['Type']==='T' && $_SESSION['APPROVE'] === true){
                    $query="UPDATE `out_approve` SET `is_approved`='Y', `approve_username`='".$_SESSION['REQ_ID_INFO']."' WHERE out_apply_id=".$_GET['id'].";";
                    $_SESSION['APPROVE']='APPROVED';
                }
                $rs=mysqli_query($link, $query);

            if($rs===false){
                header('Location: ../../error.php');
            }

            mysqli_free_result($rs);

            if($rows !== 0){
                header("Location: ../../inquiry.php");
            }else header('Location: ../../error.php?errno=3&errmsg=Unknown');
        }else if($_GET['status']==='cancel'){
                if($_SESSION['Type']==='T' && $_SESSION['APPROVE'] === true) {
                    $query = "UPDATE `out_approve` SET `is_approved`='N', `approve_username`='' WHERE out_apply_id=" . $_GET['id'] . ";";
                    $_SESSION['APPROVE']='CANCELLED';
                }
                $rs=mysqli_query($link, $query);

            if($rs===false){
                header('Location: ../../error.php?errno=3&errmsg=Unknown');
            }

            mysqli_close($link);
            if($rows !== 0){
                header("Location: ../../inquiry.php");
            }else header('Location: ../../error.php?errno=3&errmsg=Unknown');
        }else;
    }
?>