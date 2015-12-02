<?php
session_start();
if(empty($_POST['day']) || empty($_POST['reason']) || empty($_POST['startTime']) || empty($_POST['endTime']))
    header('Location: ../../403.html');
else{
    $day = $_POST['day'];
    $REASON = $_POST['reason'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    $link = mysqli_connect("localhost","dbman","1234","dbman") or die("Connecting to Database Failed. Please make sure what's the error in this problem.\n");
    mysqli_set_charset($link, "utf8");

    list($year, $month, $mday) = explode("-", $_POST['day']);

    $query="SELECT MAX(No) AS No FROM outing_apply WHERE No LIKE '".substr($year,-2).$month.$mday."%';";
    $rs=mysqli_query($link, $query);

    if($rs===false){
        header('Location: ../../error.html');
    }

    if(mysqli_num_rows($rs) === 0) $no=(substr($year,-2).$month.$mday."0000")+1;
    else $no = mysqli_fetch_array($rs, MYSQL_ASSOC)['No']+1;

    $query="INSERT INTO outing_apply(`No`, `Date`, `User`, `startTime`, `endTime`, `Reason`, `Approved`) VALUES (".$no.", '".$day."', '".$_SESSION['User']."','".$startTime."', '".$endTime."', '".$REASON."', 'F');";
    $rs=mysqli_query($link, $query);
    if($rs===false){
        header('Location: ../../error.html');
    }

    $rows=mysqli_num_rows($rs);
    mysqli_free_result($rs);
    mysqli_close($link);
    if($rows !== 0){
        header('Location: ../../inquiry.php?req_no='.$no.'&applied=complete');
    }else header('Location: ../../error.html');
}

?>