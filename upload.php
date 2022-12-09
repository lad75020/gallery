<?php
$arr_file_exts = ['png', 'gif', 'jpg', 'jpeg', 'webp'];
$ext = strtolower(array_pop(explode('.',$_FILES['file']['name'])));

if (!(in_array($ext, $arr_file_exts)))
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Wrong file type', true, 403);
else{
    $newFileName = time() . '_' . trim($_FILES['file']['name']);
        
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $newFileName);

    return("File uploaded for moderation...".$newFileName);
}
?>