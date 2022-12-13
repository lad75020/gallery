<?php
require("config.inc.php");
$path = isset($_REQUEST["filename"])?urldecode($_REQUEST["filename"]):"";
$pwd = isset($_REQUEST["pwd"])?urldecode($_REQUEST["pwd"]):"");

if ($pwd == __ADMIN_PASSWORD__ && $path != ""){
	if (!unlink(__SMALL_PIX_FULL_PATH__.$path))
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	else{
		$mysqli = new mysqli("localhost", __DB_USER__, __DB_PASSWORD__, __DB_NAME__);
		$mysqli->query( "DELETE FROM records WHERE filename  = '".$mysqli->real_escape_string($path)."';");
		$mysqli->close();
	}
}
?>