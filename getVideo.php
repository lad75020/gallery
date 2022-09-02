<?php
require("config.inc.php");
$path = __VIDEOS_FULL_PATH__;
$path .= urldecode((isset($_REQUEST["filename"]))? $_REQUEST["filename"]:"");
include "./videostream.php";
$stream = new VideoStream($path);
$stream->start();
exit;
?>