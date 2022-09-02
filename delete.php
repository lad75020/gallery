<?php
require("config.inc.php");
$path = isset($_REQUEST["path"])?$_REQUEST["path"]:"";
$pwd = isset($_REQUEST["pwd"])?$_REQUEST["pwd"]:"";

if ($pwd == "1124D@1125#" && $path != ""){
	shell_exec("rm ".__UPLOADS_FULL_PATH__.$path);

}
?>