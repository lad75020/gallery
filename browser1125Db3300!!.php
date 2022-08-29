<?php

foreach (get_browser($_SERVER['HTTP_USER_AGENT']) as $key => $value)
{
	echo($key." = ".$value."<br/>");
}

$kb=16384;
echo "streaming $kb Kb...<!-";
flush();
$time = explode(" ",microtime());
$start = $time[0] + $time[1];
for($x=0;$x<$kb;$x++){
    echo str_pad('', 1024, '.');
    flush();
}
$time = explode(" ",microtime());
$finish = $time[0] + $time[1];
$deltat = $finish - $start;
echo "-> Test finished in $deltat seconds. Your speed is ". round($kb / $deltat, 3)."Kb/s";
?>

<script>
    var oDiv = document.createElement("DIV");
    xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        txtInfo = this.responseText.split("<body>").pop();
        oDiv.innerHTML = txtInfo.split("</body>")[0];
        document.body.appendChild(oDiv);
    }
};
xmlhttp2.open("GET", "http://raspberrypi.dubertrand.corp/etat-serveur",true);
xmlhttp2.send();
      
    document.write("<br/> Width = " + screen.availWidth + "<br/> Height = " + screen.availHeight+"<br/>");
</script>
<?php phpinfo(); ?>