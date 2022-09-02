<?php
require("config.inc.php");
$mysqli = new mysqli("localhost", __DB_USER__, __DB_PASSWORD__, __DB_NAME__);
$result = $mysqli->query("SELECT filename, likes, dislikes FROM records WHERE likes >0 OR dislikes >0 ORDER BY likes DESC, dislikes DESC, filename ASC;");
echo(json_encode($result->fetch_all()));
$mysqli->close();
?>