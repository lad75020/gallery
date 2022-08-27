<!doctype html>
<html lang="en-US">

<head>
    <script>
        function showImg(oTD){
            let oImg = document.createElement("IMG");
            oImg.setAttribute("src", "XXX2/"+oTD.innerText);
            
            if(document.getElementById("viewer")){
                document.getElementById("viewer").replaceChild(oImg, document.getElementById("viewer").firstChild);
                document.getElementById("viewer").style.display='block';
            }
            else{
                let oDiv = document.createElement("DIV");
                oDiv.setAttribute("style", "z-index:500;position:fixed;display:block;top:10px;left:200px;cursor:pointer");
                oDiv.setAttribute("onclick","this.style.display='none'");
                oDiv.setAttribute("id","viewer");
                oDiv.appendChild(oImg);
                document.body.appendChild(oDiv);
            }       
        }
<?php
$mysqli = new mysqli("localhost", "laurent", "1124Da", "gallery");
$result = $mysqli->query("SELECT filename, likes, dislikes FROM records WHERE likes >0 OR dislikes >0 ORDER BY likes DESC, dislikes DESC;");
$jsarray = json_encode($result->fetch_all());
echo("var recordArray = JSON.parse('".$jsarray."');\n");

$mysqli->close();
?>
    var oTable = document.createElement("TABLE");
    oTable.style.border="thick solid #00FF00";
    for (let i=0; i<recordArray.length;i++){
        let sRow = recordArray[i];
        let oTR = document.createElement("TR");
        let ofilenameTD = document.createElement("TD");
        let olikesTD = document.createElement("TD");
        let odislikesTD = document.createElement("TD");
        ofilenameTD.innerText = sRow[0];
        ofilenameTD.style.border="thin solid #0000FF";
        ofilenameTD.setAttribute("onmouseover", "showImg(this);");
        ofilenameTD.setAttribute("onmouseout", "document.getElementById('viewer').style.display='none';");
        olikesTD.style.border="thin solid #0000FF";
        odislikesTD.style.border="thin solid #0000FF";
        olikesTD.innerText = sRow[1];
        odislikesTD.innerText = sRow[2];
        oTR.appendChild(ofilenameTD);
        oTR.appendChild(olikesTD);
        oTR.appendChild(odislikesTD);
        oTR.style.border = "thin solid #FF0000";
        oTable.appendChild(oTR);
    }
    
    </script>
</head>
<body onload="document.getElementById('main').appendChild( oTable);">
    <div id="main"></div>
</body>
</html>