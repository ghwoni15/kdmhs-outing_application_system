<?php
    session_start();
    if(!isset($_GET['perm_no']) || !isset($_GET['status']))  header('Location: ../../403.html');
    else{
        $link = mysqli_connect("localhost","outing","outing00","outing") or die("Connecting to Database Failed. Please make sure what's the error in this problem.\n");
        mysqli_set_charset($link, "utf8");

        if($_GET['status']==='approve'){
            $query="UPDATE `outing_apply` SET `Approved`='T' WHERE No=".$_GET['perm_no'].";";
            $rs=mysqli_query($link, $query);

            if($rs===false){
                header('Location: ../../error.html');
            }

            mysqli_free_result($rs);
            mysqli_close($link);
            if($rows !== 0){
                header("Location: ../../inquiry.php?req_no=".$_GET['perm_no']."&approved=approved");
            }else header('Location: ../../error.html');
        }else if($_GET['status']==='cancel'){
            $query="UPDATE `outing_apply` SET `Approved`='F' WHERE No=".$_GET['perm_no'].";";
            $rs=mysqli_query($link, $query);

            if($rs===false){
                header('Location: ../../error.html');
            }

            mysqli_free_result($rs);
            mysqli_close($link);
            if($rows !== 0){
                header("Location: ../../inquiry.php?req_no=".$_GET['perm_no']."&approved=cancelled");
            }else header('Location: ../../error.html');
        }else;
    }
?>