<?php
    session_start();
    if(!isset($_SESSION['User']) || empty($_POST['a_procedure']) || empty($_POST['startTime']) || empty($_POST['endTime']) || empty($_POST['day']) || empty($_POST['reason_type']) )
        header('Location: ../../403.html');
    else{

        include "../../include/auth.php";

        if(isset($_POST['no_hrt'])){
            $_POST['no_hrt']='off';
        }else $_POST['no_hrt']='on';

        list($DAY, $START_TIME, $END_TIME, $A_PROCEDURE, $REASON[0], $REASON[1], $NO_HRT) = array($_POST['day'], $_POST['startTime'], $_POST['endTime'], $_POST['a_procedure'], $_POST['reason_type'], $_POST['etc_reason'], $_POST['no_hrt']);
        list($year, $month, $mday) = explode("-", $DAY);

        $query="SELECT MAX(o.id) AS No FROM out_apply o WHERE o.id LIKE '".substr($year,-2).$month.$mday."%';";
        $rs=mysqli_query($link, $query)  or die(mysqli_error($link));

        if($rs===false) header('Location: ../../error.php?errno=3&errmsg=Unknown');

        $rs_val = mysqli_fetch_array($rs, MYSQL_ASSOC)['No'];
        if($rs_val === null) $no=(substr($year,-2).$month.$mday."0000")+1;
        else $no = $rs_val + 1;

        mysqli_free_result($rs);

        if(isset($_GET['t_direct']) && $_GET['t_direct']=== true) $user = $_POST['stu'];
        else $user = $_SESSION['REQ_ID_INFO'];

        if($_POST['etc_reason']==='') $NOTE = $REASON[0];
        else $NOTE = $REASON[1];

        //CREATE APPLY
        $query="INSERT INTO out_apply(`id`, `username`, `begin_time`, `end_time`, `apply_at`,`note`) VALUES ('$no', '$user','".$_POST['day']." $START_TIME', '".$_POST['day']." $END_TIME', '".date('Y-m-d H:i:s', strtotime('8 hours'))."', '$NOTE');";
        $rs=mysqli_query($link, $query) or die(mysqli_error($link));
        if($rs===false) header('Location: ../../error.php?errno=3&errmsg=Unknown');
        $rows=mysqli_num_rows($rs);
        if($rows !== 0) header('Location: ../../inquiry.php');
        else header('Location: ../../error.php?errno=3&errmsg=Unknown');

        mysqli_free_result($rs);

        //CREATE APPROVE_info
        $query="INSERT INTO out_approve(`out_apply_id`, `approve_no`, `approve_username`, `is_approved`, `approved_at`) VALUES ('$no', '1','fasdlove', 'N', '');";
        $rs=mysqli_query($link, $query) or die(mysqli_error($link));
        if($rs===false){
            header('Location: ../../error.php?errno=3&errmsg=Unknown');
        }

        $rows=mysqli_num_rows($rs);
        if($rows !== 0){
            $_SESSION['MODE'] = 'COMPLETELY_APPLIED';
            header('Location: ../../inquiry.php');
        }else header('Location: ../../error.php?errno=3&errmsg=Unknown');

        mysqli_free_result($rs);
        mysqli_close($link);
    }

?>