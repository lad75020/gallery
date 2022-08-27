<?php
$path = isset($_REQUEST["path"])?$_REQUEST["path"]:"";
$pwd = isset($_REQUEST["pwd"])?$_REQUEST["pwd"]:"";

if ($pwd == "1124" && $path != ""){
	if(unlink("/var/www/gallery/uploads/".$path))
		return("Succès");
	else
		return("Echec");
}
?>