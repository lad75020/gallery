<?php
$iFiles = new DirectoryIterator("XXX2");
$mysqli = new mysqli("localhost", "laurent", "1124Da", "gallery");
while ($file = $iFiles->getFileName()) {

    if (!is_dir($file))
    echo("INSERT INTO records values('".$file."',0,0);");
        $mysqli->query("INSERT INTO records values('".$file."',0,0);");
    $iFiles->next();
}
$mysqli->close();
?>