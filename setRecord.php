<?php
$filename = "";
$like = "";
if(isset($_REQUEST["filename"]))
    $filename = $_REQUEST["filename"];
if(isset($_REQUEST["like"]))
    $like = $_REQUEST["like"];
$mysqli = new mysqli("localhost", "laurent", "1124Da", "gallery");
$result = $mysqli->query("SELECT likes, dislikes FROM records WHERE filename = '".$filename."';");
$result->data_seek(0);
$row = $result->fetch_assoc();
$likes = $row["likes"];
$dislikes = $row["dislikes"];
if ($like == "yes")
    $likes++;
if ($like == "no")
    $dislikes++;

$mysqli->query("UPDATE records SET likes = ".$likes." , dislikes = ".$dislikes." WHERE filename = '".$filename."';");
$mysqli->close();
?>