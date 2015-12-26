<?php
//var_dump($_POST['etc_reason']);
//exit;
    session_start();
    if(!isset($_SESSION['REQ_ID_INFO']) || empty($_POST['a_procedure']) || empty($_POST['day']) || empty($_POST['reason_type']) || empty($_POST['startTime']) || empty($_POST['endTime']))
        header('Location: ../../403.html');
    else{
        list($DAY, $START_TIME, $END_TIME, $A_PROCEDURE, $REASON[0], $REASON[1], $NO_HRT) = array($_POST['day'], $_POST['startTime'], $_POST['endTime'], $_POST['a_procedure'], $_POST['reason_type'], $_POST['etc_reason'], $_POST['no_hrt']);

        include "../../include/auth.php";

        list($year, $month, $mday) = explode("-", $DAY);

        $query="SELECT MAX(id) AS No FROM out_apply WHERE id LIKE '".substr($year,-2).$month.$mday."%';";

        $rs=mysqli_query($link, $query);
        if($rs===false){
            header('Location: ../../error.html');
        }

        $rs_val = mysqli_fetch_array($rs, MYSQL_ASSOC)['No'];
        if($rs_val === null) $no=(substr($year,-2).$month.$mday."0000")+1;
        else $no = $rs_val + 1;

        mysqli_free_result($rs);


        //permission
        if($REASON[0] !== '기타')
            $FINAL_REASON = $REASON[0];
        else
            $FINAL_REASON = $REASON[1];

        //선생님 username 가져와서 insert 하기 - 보류중
        if($A_PROCEDURE === 'weekend')
        {
            $PROCEDURE = 3;
            $query_approve="INSERT INTO out_approve(`out_apply_id`,`approve_no`, `approve_username`, `is_approved`) VALUES ('$no', '$PROCEDURE','pororo','N');";

        }
        else
        {
            if($NO_HRT === null)
            {
                $PROCEDURE = 1;
                $query_approve2="INSERT INTO out_approve(`out_apply_id`,`approve_no`, `approve_username`, `is_approved`) VALUES ('$no', '$PROCEDURE','pororo','N');";
            }
            $PROCEDURE = 2;
            $query_approve .= "INSERT INTO out_approve(`out_apply_id`,`approve_no`, `approve_username`, `is_approved`) VALUES ('$no', '$PROCEDURE','pororo','N');";
        }
        $user_id = '';
        if($_GET['t_direct'] === "true")
            $user_id = $_POST['username'];
        else
            $user_id = $_SESSION['REQ_ID_INFO'];

        $query_apply="INSERT INTO out_apply(`id`, `username`, `begin_time`, `end_time`, `apply_at`, `note`) VALUES ('$no', '$user_id' , '".$_POST['day']." $START_TIME:00', '".$_POST['day']." $END_TIME:00','".date('Y-m-d H:i:s')."', '$FINAL_REASON');";
//        $query = $query_apply.$query_approve;
//        echo("<script>alert($query);</script>");
        $rs=mysqli_query($link, $query_apply);

        if($rs===false){
            header('Location: ../../error.html');
        }

        if(isset($query_approve2))
        {
            $rs=mysqli_query($link, $query_approve2);

            if($rs===false){
                header('Location: ../../error.html');
            }
        }

        $rs=mysqli_query($link, $query_approve);

        if($rs===false){
            header('Location: ../../error.html');
        }

        $rows=@mysqli_num_rows($rs);
        @mysqli_free_result($rs);
        mysqli_close($link);
        if($rows !== 0){
            $_SESSION['MODE'] = 'COMPLETELY_APPLIED';
//            header('Location: ../../inquiry.php');
            if($_GET['t_direct'] === "true")
                echo "./inquiry.php";
            else
                header('Location: ../../inquiry.php');

        }else echo('../../error.php');
    }

?>