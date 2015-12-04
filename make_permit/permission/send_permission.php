<?php
    session_start();
    if(!isset($_SESSION['User']) || empty($_POST['a_procedure']) || empty($_POST['day']) || empty($_POST['reason_type']) || empty($_POST['startTime']) || empty($_POST['endTime']) || empty($_POST['no_hrt']))
        header('Location: ../../403.html');
    else{
        list($DAY, $START_TIME, $END_TIME, $A_PROCEDURE, $REASON[0], $REASON[1], $NO_HRT) = array($_POST['day'], $_POST['startTime'], $_POST['endTime'], $_POST['a_procedure'], $_POST['reason_type'], $_POST['etc_reason'], $_POST['no_hrt']);

        $link = mysqli_connect("localhost","outing","outing00","outing") or die("<script>location.href='../../error.php?errno=1&errmsg=Wrong_Query';</script>\n");
        mysqli_set_charset($link, "utf8");

        list($year, $month, $mday) = explode("-", $DAY);

        $query="SELECT MAX(o.id) AS No FROM out_apply o WHERE o.id LIKE '".substr($year,-2).$month.$mday."%';";
        $rs=mysqli_query($link, $query);

        if($rs===false){
            header('Location: ../../error.php?errno=3&errmsg=Unknown');
        }

        $rs_val = mysqli_fetch_array($rs, MYSQL_ASSOC)['No'];
        if($rs_val === null) $no=(substr($year,-2).$month.$mday."0000")+1;
        else $no = $rs_val + 1;

        mysqli_free_result($rs);

        if(isset($_GET['t_direct']) && $_GET['t_direct']=== true) $user = $_POST['stu'];
        else $user = $_SESSION['User'];

        //CREATE APPLY
        $query="INSERT INTO out_apply(`id`, `Date`, `username`, `begin_time`, `end_time`, `note`, `Approved`) VALUES ('$no', '$day', '$user','$START_TIME', '$END_TIME', '$REASON', 'F');";
        $rs=mysqli_query($link, $query);
        if($rs===false){
            header('Location: ../../error.php?errno=3&errmsg=Unknown');
        }

        $rows=mysqli_num_rows($rs);
        if($rows !== 0){
            $_SESSION['MODE'] = 'COMPLETELY_APPLIED';
            header('Location: ../../inquiry.php');
        }else header('Location: ../../error.php?errno=3&errmsg=Unknown');

        mysqli_free_result($rs);

        //CREATE APPROVE_info

        mysqli_close($link);
    }

?>