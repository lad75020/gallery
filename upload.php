<?php
$arr_file_exts = ['png', 'gif', 'jpg', 'jpeg', 'webp'];
$ext = strtolower(array_pop(explode('.',$_FILES['file']['name'])));

if (!(in_array($ext, $arr_file_exts)))
    die("Not a valid file format : ".$_FILES['file']['type']);

$newFileName = time() . '_' . trim($_FILES['file']['name']);
	
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $newFileName);

return("File uploaded for moderation...".$newFileName);

?>