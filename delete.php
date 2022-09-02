<?php
require("config.inc.php");
$path = isset($_REQUEST["path"])?$_REQUEST["path"]:"";
$pwd = urldecode( isset($_REQUEST["pwd"])?$_REQUEST["pwd"]:"");

if ($pwd == __ADMIN_PASSWORD__ && $path != ""){
	shell_exec("rm ".__UPLOADS_FULL_PATH__.$path);

}
?>