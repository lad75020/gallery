<?php
$path = "/var/www/videos/";
$path .= urldecode((isset($_REQUEST["filename"]))? $_REQUEST["filename"]:"");
include "./videostream.php";
$stream = new VideoStream($path);
$stream->start();
exit;
?>