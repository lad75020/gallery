<?php
require("config.inc.php");
$path = __VIDEOS_FULL_PATH__;
$path .= isset($_REQUEST["filename"])? urldecode($_REQUEST["filename"]):"";
include "./videostream.php";
$stream = new VideoStream($path);
$stream->start();
exit;
?>