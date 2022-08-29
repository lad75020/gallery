<?php
$mysqli = new mysqli("localhost", "laurent", "1124Da", "gallery");
$result = $mysqli->query("SELECT filename, likes, dislikes FROM records WHERE likes >0 OR dislikes >0 ORDER BY likes DESC, dislikes DESC, filename ASC;");
echo(json_encode($result->fetch_all()));
$mysqli->close();
?>