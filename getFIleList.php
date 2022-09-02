<?php
require("config.inc.php");
$isCached =false;
$folder = __FOLDERS_ROOT__;
$apcukey = "";

if(isset($_REQUEST["cached"]))
    $isCached = ($_REQUEST["cached"] == "yes");
if(isset($_REQUEST["apcukey"]))
    $apcuKey = $_REQUEST["apcukey"];
if(isset($_REQUEST["folder"]))
    $folder .= $_REQUEST["folder"];

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
?>