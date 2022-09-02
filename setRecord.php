<?php
require("config.inc.php");
$filename = "";
$like = "";
if(isset($_REQUEST["filename"]))
    $filename = $_REQUEST["filename"];
if(isset($_REQUEST["like"]))
    $like = $_REQUEST["like"];
$mysqli = new mysqli("localhost", __DB_USER__, __DB_PASSWORD__, __DB_NAME__);
$result = $mysqli->query("SELECT likes, dislikes FROM records WHERE filename = '".$filename."';");
if($result->num_rows !=0){
    $row = $result->fetch_assoc();
    $likes = $row["likes"];
    $dislikes = $row["dislikes"];
    if ($like == "yes")
        $likes++;
    if ($like == "no")
        $dislikes++;
    
    $mysqli->query("UPDATE records SET likes = ".$likes." , dislikes = ".$dislikes." WHERE filename = '".$filename."';");
}
else{
    if($like=="yes")
        $mysqli->query("INSERT INTO records VALUES('".$filename."',1,0)");
    else if($like=="no")
        $mysqli->query("INSERT INTO records VALUES('".$filename."',0,1)");
}
$mysqli->close();
?>