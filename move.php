<?php
require("config.inc.php");
$path = isset($_REQUEST["path"])?$_REQUEST["path"]:"";
if($_SERVER["HTTP_HOST"] == __ADMIN_HOST__){
	
	if ($path != ""){
		$extension = strrchr($path,".");
		
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
				
				break;
			case ".webp":
			case ".WEBP":
				shell_exec("cp ".__UPLOADS_FULL_PATH__.$path." ".__ORIGINAL_PIX_FULL_PATH__);
				shell_exec("cp ".__UPLOADS_FULL_PATH__.$path." ".__SMALL_PIX_FULL_PATH__);
				shell_exec("rm ".__UPLOADS_FULL_PATH__.$path);
				
				break;
		}

	}
	else
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 No Path', true, 500);
}
else
	header($_SERVER['SERVER_PROTOCOL'] . ' 403 Not allowed', true, 403);
?>