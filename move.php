<?php
require("config.inc.php");
$path = isset($_REQUEST["path"])?$_REQUEST["path"]:"";
if($_SERVER["HTTP_HOST"] == __ADMIN_HOST__){
	$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg', 'image/webp'];
	if ($path != ""){
		$extension = strrchr($path,".");
		$mysqli = new mysqli("localhost", __DB_USER__, __DB_PASSWORD__, __DB_NAME__);

		switch($extension){
			case ".gif":
			case ".GIF":
			case ".jpg":
			case ".JPG":
			case ".jpeg":
			case ".JPEG":
			case ".png":
			case ".PNG":
				$message += shell_exec("cwebp -q 100 -z 9 -lossless ".__UPLOADS_FULL_PATH__.$path." -o ".__SMALL_PIX_FULL_PATH__.$path.".webp");
				shell_exec("cp ".__SMALL_PIX_FULL_PATH__.$path.".webp ".__ORIGINAL_PIX_FULL_PATH__);
				shell_exec('rm '.__UPLOADS_FULL_PATH__.$path);
				$mysqli->query("INSERT INTO records VALUES('{$path}.webp',0,0);");
				break;
			case ".webp":
			case ".WEBP":
				shell_exec("cp ".__UPLOADS_FULL_PATH__.$path." ".__ORIGINAL_PIX_FULL_PATH__);
				shell_exec("cp ".__UPLOADS_FULL_PATH__.$path." ".__SMALL_PIX_FULL_PATH__);
				shell_exec("rm ".__UPLOADS_FULL_PATH__.$path);
				$mysqli->query("INSERT INTO records VALUES('{$path}',0,0);");
				break;
		}
		$mysqli->close();
	}
}
else
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Not allowed', true, 403);
?>