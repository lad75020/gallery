<?php
require("config.inc.php");
$isCached =false;
$folder = __FOLDERS_ROOT__;
$apcukey = "";
$useDB = false;

if(isset($_REQUEST["cached"]))
    $isCached = ($_REQUEST["cached"] == "yes");
if(isset($_REQUEST["apcukey"]))
    $apcuKey = $_REQUEST["apcukey"];
if(isset($_REQUEST["folder"]))
    $folder .= $_REQUEST["folder"];
if(isset($_REQUEST["usedb"]))
    $useDB = ($_REQUEST["usedb"] == "yes");

if ($useDB){
    $mysqli = new mysqli("localhost", __DB_USER__, __DB_PASSWORD__, __DB_NAME__);
    if ($isCached){
        if (!apcu_exists($apcuKey)){
            $result = $mysqli->query("SELECT imageid FROM images;");
            apcu_add($apcuKey,json_encode($result->fetch_all()),86400);
        }
        echo (apcu_fetch($apcuKey));
    }
    else{
        $result = $mysqli->query("SELECT imageid FROM images;");
        echo(json_encode($result->fetch_all()));
    }
    $mysqli->close();
}
else{
    if ($isCached){
        if (!apcu_exists($apcuKey)){
            $iFiles = new DirectoryIterator("$folder");
            $response = "";
            while ($file = $iFiles->getFileName()) {
                if (!is_dir($file))
                    $response .= $file.";";
                $iFiles->next();
            }
            apcu_add($apcuKey,$response,86400);
        }
        echo (apcu_fetch($apcuKey));
    }
    else{
        $iFiles = new DirectoryIterator($folder);
        $response = "";
        while ($file = $iFiles->getFileName()) {
            if ($file!="." && $file!="..")
                $response .= $file.";";
            $iFiles->next();
        }
        echo($response);
    }
}

?>