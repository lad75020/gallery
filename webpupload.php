<?php
require("config.inc.php");
$iFiles = new DirectoryIterator("/var/www/XXX");
$mysqli = new mysqli("localhost", __DB_USER__, __DB_PASSWORD__, __DB_NAME__);

while ($file = $iFiles->getFileName()) {
    if (!is_dir($file)){

            echo("\nuploading ".$file."\n");
            $image = shell_exec("curl -H 'Token: 456e920f-3e07-47ad-a8c2-1deb3494b38e' -X POST -F 'image_file=@/var/www/XXX/".$file."' http://127.0.0.1:8562/upload/");
            $aImg = explode("\"", $image);
            echo("\nID ".$aImg[3]."\n");
            $mysqli->query("INSERT INTO images VALUES ('".$file."','".$aImg[3]."');");
    }

    $iFiles->next();
}
$mysqli->close();
?>