<!--ERROR NO 0 : Wrong Query 1 : Unknown 2 : Connection Failed-->
<?php
        $link = mysqli_connect("localhost", "outing", "outing00", "outing") or die("<script>location.href='./error.php?errno=2&errmsg=Connection_Failed';</script>\n");
        mysqli_set_charset($link, "utf8");
?>