<?php
    session_start();
    if(!isset($_SESSION['TEMP_AP_NO']) || !isset($_GET['status']))  header('Location: ../../403.html');
    else{
        include "../../include/auth.php";

        if($_GET['status']==='approve'){
            /*승인날짜 수정 必*/
            if($_SESSION['Type']==='T') $query="UPDATE `out_approve` SET `is_approved`='Y', `approve_username`='".$_SESSION['REQ_ID_INFO']."' WHERE out_apply_id=".$_SESSION['TEMP_AP_NO'].";";
            else if($_SESSION['Type']==='S') $query="UPDATE `out_approve` SET `is_approved`='N', `approve_username`='".$_SESSION['REQ_ID_INFO']."' WHERE out_apply_id=".$_SESSION['TEMP_AP_NO'].";";
            $rs=mysqli_query($link, $query);

            if($rs===false){
                header('Location: ../../error.php');
            }

            mysqli_free_result($rs);
            mysqli_close($link);
            if($rows !== 0){
                header("Location: ../../inquiry.php?req_no=".$_SESSION['TEMP_AP_NO']."&approved=approved");
            }else header('Location: ../../error.php?errno=3&errmsg=Unknown');
        }else if($_GET['status']==='cancel'){
            $query="UPDATE `out_approve` SET `is_approved`='N', `approve_username`='' WHERE out_apply_id=".$_SESSION['TEMP_OP_NO'].";";
            $rs=mysqli_query($link, $query);

            if($rs===false){
                header('Location: ../../error.php?errno=3&errmsg=Unknown');
            }

            mysqli_free_result($rs);
            mysqli_close($link);
            if($rows !== 0){
                header("Location: ../../inquiry.php?req_no=".$_SESSION['TEMP_OP_NO']."&approved=cancelled");
            }else header('Location: ../../error.php?errno=3&errmsg=Unknown');
        }else;
    }
?>