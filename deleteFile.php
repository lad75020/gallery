<?php
$path = isset($_REQUEST["filename"])?$_REQUEST["filename"]:"";
$pwd = isset($_REQUEST["pwd"])?$_REQUEST["pwd"]:"";

if ($pwd == "" && $path != ""){
	shell_exec("rm /var/www/XXX/".$path);
		$mysqli = new mysqli("localhost", "laurent", "1124Da", "gallery");
		$mysqli->query("DELETE FROM records WHERE filename  = '".$path."';");
		$mysqli->close();

	

}
?>