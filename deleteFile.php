<?php
require("config.inc.php");
$path = isset($_REQUEST["filename"])?$_REQUEST["filename"]:"";
$folder = isset($_REQUEST["folder"])?$_REQUEST["folder"]:__SMALL_PIX_FOLDER__;
if($_SERVER["HTTP_HOST"] == __ADMIN_HOST__){
	if ($path != ""){
		if(!unlink(__FOLDERS_ROOT__.$folder.'/'.$path))
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		else{
			if ($folder == __SMALL_PIX_FOLDER__){
				unlink(__ORIGINAL_PIX_FULL_PATH__.$path);
				$mysqli = new mysqli("localhost", __DB_USER__, __DB_PASSWORD__, __DB_NAME__);
				$mysqli->query("DELETE FROM records WHERE filename  = '".$mysqli->real_escape_string($path)."';");
				$mysqli->close();
				apcu_delete("imgdir");
			}
		}
	}
}
else
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Not Allowed', true, 403);
?>