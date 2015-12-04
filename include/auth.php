<?php
        $link = mysqli_connect("localhost", "outing", "outing00", "outing_new") or die("<script>location.href='./error.php?errno=0&errmsg=Connection_Failed';</script>\n");
        mysqli_set_charset($link, "utf8");
?>