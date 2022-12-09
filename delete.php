<?php
require("config.inc.php");
$path = isset($_REQUEST["path"])?$_REQUEST["path"]:"";

if($_SERVER["HTTP_HOST"] == __ADMIN_HOST__){
	if ($path != ""){
		if(!unlink(__UPLOADS_FULL_PATH__.$path))
		{
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		}
	}
	else {
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Missing Path', true, 403);
	}
}
else
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Not allowed', true, 403);
?>