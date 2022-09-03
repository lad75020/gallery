<?php
require("config.inc.php");
$path = isset($_REQUEST["filename"])?$_REQUEST["filename"]:"";
$pwd = isset($_REQUEST["pwd"])?$_REQUEST["pwd"]:"";

if ($pwd == __ADMIN_PASSWORD__ && $path != ""){
	//shell_exec("rm ".__SMALL_PIX_FULL_PATH__.$path);
	if (!unlink(__SMALL_PIX_FULL_PATH__.$path))
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	else{
		$mysqli = new mysqli("localhost", __DB_USER__, __DB_PASSWORD__, __DB_NAME__);
		$mysqli->query("DELETE FROM records WHERE filename  = '".$path."';");
		$mysqli->close();
	}
}
?>