<?php
    define("__PROTOCOL__", "http"); //http or https
    define("__DOMAIN__", "my.domain.com"); //FQDN du site
    define("__ROOT_URL__", __PROTOCOL__."://".__DOMAIN__."/");
    define("__FOLDERS_ROOT__", "/var/www/"); //Root of all folders for the site
    define("__VIDEOS_FOLDER__","videos"); //Folder for your videos
    define("__SMALL_PIX_FOLDER__","PIX"); //Folder for your photos
    define("__ORIGINAL_PIX_FOLDER__","PIX"); //Leave equals to __SMALL_PIX_FOLDER__ used for 
    define("__UPLOADS_FOLDER__", "uploads");
    define("__VIDEOS_FULL_PATH__",__FOLDERS_ROOT__.__VIDEOS_FOLDER__."/");
    define("__SMALL_PIX_FULL_PATH__", __FOLDERS_ROOT__.__SMALL_PIX_FOLDER__."/");
    define("__ORIGINAL_PIX_FULL_PATH__", __FOLDERS_ROOT__.__ORIGINAL_PIX_FOLDER__."/");
    define("__UPLOADS_FULL_PATH__", __FOLDERS_ROOT__.__UPLOADS_FOLDER__."/");
    define("__DB_USER__", "dbuser");
    define("__DB_NAME__", "dbname");
    define("__DB_PASSWORD__", "dbpassword");
    define("__ADMIN_PASSWORD__","adminpassword");
?>