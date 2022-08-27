<?php
	$files = scandir("uploads");
?>
<!doctype html>
<html>
<head> 
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/main5.css" rel="stylesheet" type="text/css">
    <script src="js/sort2.js"></script>
	<title>Sort New Files</title>
</head>

<body >
	<span style="position:fixed;top:10px;left:640px;border: grey 5px solid;width:80px" id="password" contenteditable="true">Password</span>
	<div id="divSource" style="border: grey 5px dashed;min-height:400px;width:590px">
	<?php
		$i = 0;
		foreach ($files as $file){
			if ($file != "." && $file != ".." && !strpos($file,"Thumb"))
				echo( '<img id="drag'.$i++.'" height="100px" class="thumbnails" draggable="true" src="uploads/'.$file.'"/>');
		}
	?>
	</div>
	<div style="display:flex;flex-direction: row">
		<div style="border: green 5px dashed;width: 290px;height:200px;" id="move" ondrop="move(event)" ondragover="return false;">&nbsp;</div>
		<div style="border: red 5px dashed;width: 290px;height: 200px;" id="remove" ondrop="erase(event)" ondragover="return false;">&nbsp;</div>	
	</div>
</body>
</html>