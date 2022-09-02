<?php
require("config.inc.php");
$path = isset($_REQUEST["path"])?$_REQUEST["path"]:"";
$pwd = urldecode(isset($_REQUEST["pwd"])?$_REQUEST["pwd"]:"");

$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg', 'image/webp'];
if ($path != "" && $pwd == __ADMIN_PASSWORD__){
	$extension = strrchr($path,".");
	$mysqli = new mysqli("localhost", __DB_USER__, __DB_PASSWORD__, __DB_NAME__);
	try{
	switch($extension){
		case ".gif":
		case ".GIF":
		case ".jpg":
		case ".JPG":
		case ".jpeg":
		case ".JPEG":
		case ".png":
		case ".PNG":
			shell_exec("cwebp -q 100 -z 9 -resize 0 400 -lossless ".__UPLOADS_FULL_PATH__.$path." -o ".__SMALL_PIX_FULL_PATH__.$path.".webp");
			unlink(__UPLOADS_FULL_PATH__.$path);
			$mysqli->query("INSERT INTO records VALUES('{$path}.webp',0,0);");
			break;
		case ".webp":
		case ".WEBP":
			shell_exec('mv '.__UPLOADS_FULL_PATH__.$path.' '.__SMALL_PIX_FULL_PATH__.$path);
			$mysqli->query("INSERT INTO records VALUES('{$path}',0,0);");
			break;
		}
	$mysqli->close();
	}
	catch(Exception $e){
		return ("Processsing Error : ".$e);
	}
	finally{
		return "File ".$path." uploaded to site";
	}
}
?>