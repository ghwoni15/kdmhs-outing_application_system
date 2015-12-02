<?php
if(!isset($_GET['url'])) die("<script>location.href='./403.html';</script>\n");
function curlGet($url) {
    $req = curl_init();
    curl_setopt($req, CURLOPT_URL, $url);
    curl_setopt($req, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36");
    curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($req, CURLOPT_SSLVERSION, 3);
    curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($req, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($req, CURLOPT_HEADER, false);
    $result = curl_exec($req);
    curl_close($req);
    return $result;
}

echo curlGet(urldecode($_GET["url"]));

?>