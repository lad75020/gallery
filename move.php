
<?php
$path = isset($_REQUEST["path"])?$_REQUEST["path"]:"";
$pwd = isset($_REQUEST["pwd"])?$_REQUEST["pwd"]:"";

$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg', 'image/webp'];
if ($path != "" && $pwd == "1124"){
	$extension = strrchr($path,".");
	$mysqli = new mysqli("localhost", "laurent", "1124Da", "gallery");
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
			shell_exec("cwebp -q 100 -z 9 -resize 0 400 -lossless /var/www/gallery/uploads/".$path." -o /var/www/XXX/".$path.".webp");
			unlink('/var/www/gallery/uploads/'.$path);
			$mysqli->query("INSERT INTO records VALUES('{$path}.webp',0,0);");
			break;
		case ".webp":
		case ".WEBP":
			shell_exec('mv /var/www/gallery/uploads/'.$path.' /var/www/XXX/'.$path);
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