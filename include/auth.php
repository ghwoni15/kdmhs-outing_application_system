<?php
        $link = mysqli_connect("localhost", "outing", "outing00", "outing") or die("<script>location.href='./error.php?errno=2&errmsg=Connection_Failed';</script>\n");
        mysqli_set_charset($link, "utf8");
?>