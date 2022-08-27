<?php
$isCached =false;
$folder = "/var/www/";
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
        if (!is_dir($file))
            $response .= $file.";";
        $iFiles->next();
    }
    echo($response);
}
?>