<?php
    define("__PROTOCOL__", "http"); //http or https
    define("__DOMAIN__", "my.domain.com"); //FQDN du site
    define("__ROOT_URL__", __PROTOCOL__."://".__DOMAIN__."/");
    define("__FOLDERS_ROOT__", "/var/www/"); //Root of all folders for the site
    define("__VIDEOS_FOLDER__","videos"); //Folder for your videos
    define("__SMALL_PIX_FOLDER__","PIX"); //Folder for your photos
    define("__ORIGINAL_PIX_FOLDER__","PIX"); //Leave equals to __SMALL_PIX_FOLDER__ used for 
    define("__UPLOADS_FOLDER__", "uploads"); //folder with write permission for uploads
    define("__VIDEOS_FULL_PATH__",__FOLDERS_ROOT__.__VIDEOS_FOLDER__."/");
    define("__SMALL_PIX_FULL_PATH__", __FOLDERS_ROOT__.__SMALL_PIX_FOLDER__."/");
    define("__ORIGINAL_PIX_FULL_PATH__", __FOLDERS_ROOT__.__ORIGINAL_PIX_FOLDER__."/");
    define("__UPLOADS_FULL_PATH__", __FOLDERS_ROOT__.__UPLOADS_FOLDER__."/");
    define("__DB_USER__", "dbuser"); //Database user name
    define("__DB_NAME__", "dbname"); //Database name
    define("__DB_PASSWORD__", "dbpassword"); //Database paswword
    define("__ADMIN_PASSWORD__","adminpassword"); //Password used by sort.html and showRecords.php
    define("__TEMP_PASSWORD__","A4473D1610764155AEDFF4B72E1E0702"); //Password for https://my.domain.com/index.php?user=A4473D1610764155AEDFF4B72E1E0702
    define("__ADMIN_HOST__", "my.domain.com"); //Use to limit access to admin pages from a different domain
?>