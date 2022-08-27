<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gay Bear Pictures">
    <meta name="keywords" content="gay, porn, bear, hairy, sex, pictures">
    <meta name="author" content="Bearlover">
    <title>Gay Bear Pictures</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" async></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" async></script>
	<link rel="stylesheet" type="text/css" href="css/flags32.css">
    <link rel="stylesheet" href="css/main.css" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<script>
		var isPhone = false;
		var imageHeight = "";
	</script>
<?php 
    $is18= isset($_GET["is18"])? true:false;
	$browser = get_browser($_SERVER['HTTP_USER_AGENT'],true);
	$isMobile = $browser["ismobiledevice"] == 1;
	if( $isMobile) {?>
	<script>
		imageHeight = "300px";isPhone = true;
	</script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css" async>
	<script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js" async></script>
<?php } else { ?>
	<script>
		isPhone = false;
		imageHeight = "400px";
	</script>
<?php } ?>
	 <script src="js/infinite.js" defer></script>   

<!-- Matomo -->
		<script type="text/javascript">
		  var _paq = window._paq = window._paq || [];
	  _paq.push(['trackPageView']);
	  _paq.push(['enableLinkTracking']);
	    (function() {
		        var u="//raspberrypi.dubertrand.corp/matomo/";
			    _paq.push(['setTrackerUrl', u+'matomo.php']);
			    _paq.push(['setSiteId', '1']);
				  })();
	  </script>
<!-- End Matomo Code -->
</head>

<body onload="getImageFileList();getVideoFileList();drawOn = setInterval(scrolling, 250);if(localStorage.getItem('is18')!='1') document.getElementById('btnOpen').click(); else {showAll();document.getElementById('container').style.visibility='visible';}">
    <div id="bmb" data-toggle="tooltip" title="Click here to upvote this site!" style="visibility:hidden">
    </div>
	<div id="videolink" title="Watch videos" style="text-align:center;color:red;font-size:36pt;font-weight:bold;display:none">
		<a href="#" onclick="displayVideos();"> New ! Videos</a>
	</div>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">&nbsp;&nbsp;18 YEARS+ ONLY!</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    You must be over 18 to enter this site. By clicking OK, you reckon you are.
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnOK" class="btn btn-danger" data-dismiss="modal" onclick="localStorage.setItem('is18', 1); _paq.push(['trackEvent', '18', 'OK', '', 1]);showAll();document.getElementById('container').style.visibility='visible';">OK</button>
                </div>
            </div>
        </div>
    </div>
    <button type="button" id="btnOpen" class="btn btn-primary" style="display:none" data-toggle="modal" data-target="#myModal" ></button>
	<div style="position:fixed;left:10px;bottom: 10px;z-index:100;" class="toast">
	  <div class="toast-header">
		Please wait!
	  </div>
	  <div class="toast-body" style="visibility:hidden" id="Loading">
		Loading pictures <span id="firstPix">&nbsp;</span> to <span id="lastPix">&nbsp;</span> of <span id="nbPictures">&nbsp;</span> Total...
				<progress id="progressBar" value="0" max="20000"></progress>
	  </div>
	</div>
	<div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
		<div id="drag_upload_file">
			<p>Drop file here&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span onmouseover="this.style.cursor='pointer'" onclick="document.getElementById('drop_file_zone').style.display='none'" class="glyphicon glyphicon-remove">X</span></p><br/>
			<p>or</p><br/>
			<p><input type="button" value="Select File" onclick="file_explorer();"></p>
			<input type="file" id="selectfile">
		</div>
		<div id="uploadMessage">&nbsp;</div>
	</div>
    <div id="overlay" onclick="overlayOff();"><span id ="temp"></span></div>
	<div id="theater">
		<div style="z-index:500">
            <select name="Movie" id ="movie" onchange="if(this.options[0].value == 'BLANK') this.remove(0);_paq.push(['trackEvent', 'View', 'Video', this.options[this.selectedIndex].text] );if (this.options[this.selectedIndex].value=='CLOSE_NOW') {displayVideos();document.getElementById('player').pause();} else if (this.options[this.selectedIndex].value=='BLANK') {return;} else document.getElementById('player').src='videos/' + this.options[this.selectedIndex].value;">
            </select>
        </div>
        <div style="z-index:500">
            <video id="player"  controls autoplay></video>
        </div>
	</div>

	<div id="tools" style="visibility:hidden">
		<div id="btnUpload" onmouseover="this.style.cursor='pointer'" onclick="_paq.push(['trackEvent', 'Click', 'Use', 'UploadPhoto', 1]);document.getElementById('drop_file_zone').style.display = 'block';" data-toggle="tooltip" title="Send me photos!"><i class="material-icons">&#xe8fc;</i></div>
		<div id="fav" onmouseover="this.style.cursor='pointer'" onclick="showFavorites(this); _paq.push(['trackEvent', 'Click', 'Use', 'Favorites', 1]);" title="Click here to display your favorite photos"><span class="material-icons">&#xe87d;</span></div>
		<div id="clear" onmouseover="this.style.cursor='pointer'" onclick="localStorage.setItem('favorites', ''); showFavorites(document.getElementById('fav'));_paq.push(['trackEvent', 'Click', 'Use', 'ClearFavorites', 1]);" data-toggle="tooltip" title="Click here to clear your favorites">&#10060;</div>
	</div>
	<div id="GRPD">
		This site uses cookies to track traffic and site usage but does not store personal information. By clicking <span style="font-size:24pt"><a href="#" onclick="clickGRPD();">&#128077;</a></span>, you agree to these terms.
	</div>
	<script>
		if (isPhone){
			document.getElementById("GRPD").style.width="100%";
			document.getElementById("GRPD").style.height="160px";
		}
		else
		{
			document.getElementById("GRPD").style.width="100%";
			document.getElementById("GRPD").style.height="60px";
		}
	</script>
    <div id="container" style="z-index:100;visibility:hidden">
	</div>
</body>

</html>
