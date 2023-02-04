var draggedElement = null;
function drawPix(){
	xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			files = this.responseText.replace("\r\n", "").split(";");
			for (var i=0;i<files.length;i++){
				if (files[i]!=""){
					var oImg = document.createElement("IMG");
					oImg.setAttribute("class","thumbnails");
					oImg.setAttribute("id","drag"+i);
					oImg.setAttribute("height","100px");
					oImg.setAttribute("draggable","true");
					oImg.setAttribute("ondrag","draggedElement=this.parentElement")
					oImg.setAttribute("onclick","moveFile(this.parentElement,'"+files[i]+"');");
                    oImg.setAttribute("onmouseover","showImg(this)");
					oImg.setAttribute("src","/uploads/"+files[i]);
					var oDiv = document.createElement("DIV");
					oDiv.setAttribute("class" , "smallimage");
					oDiv.setAttribute("id" , "span"+i);
					var oX = document.createElement("DIV");
					oX.setAttribute("class","flagDelete");
					oX.setAttribute("onclick","deleteFile('"+ oImg.src.split('/').pop() + "',this.parentElement);");
					oX.setAttribute("style","z-index:200");
					oX.setAttribute("title", "click to delete");
					oX.innerHTML = "&#128681;";
					oDiv.appendChild(oX);
					oDiv.appendChild(oImg);
					document.getElementById("divSource").appendChild(oDiv);
				}
			}
		}
	};
	xmlhttp2.open("GET", "getFIleList.php?cached=no&folder=uploads&apcukey=uploaddir",true);
	xmlhttp2.send();
}

function  deleteFile(filename, oDiv){
    xmlhttp5 = new XMLHttpRequest();
    xmlhttp5.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
			
            oDiv.remove();
        } 
    };
    xmlhttp5.open("POST", "deleteFile.php",true);
    xmlhttp5.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp5.send("filename="+filename+"&folder=uploads");
}
function move(ev) {
	ev.preventDefault();
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			draggedElement.remove();
			//location.href = "sort.html";
		}
		else if(this.readyState == 4 && this.status == 403){
			alert( "Not Allowed " + this.responseText);
		}
		else if(this.readyState == 4 && this.status == 500){
			alert( "System Error: " + this.responseText);
		}	
	}
	xmlhttp.open("POST", "move.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("path="+ev.dataTransfer.getData("text").split("/").pop());
}
function showImg(eImg){
    let oImg = document.createElement("IMG");
    oImg.setAttribute("src", eImg.src);
    
    if(document.getElementById("viewer")){
        document.getElementById("viewer").replaceChild(oImg, document.getElementById("viewer").firstChild);
        document.getElementById("viewer").style.display='block';
    }
    else{
        let oDiv = document.createElement("DIV");
        oDiv.setAttribute("style", "z-index:500;position:fixed;display:block;top:10px;left:640px;cursor:pointer");
        oDiv.setAttribute("onclick","this.style.display='none'");
        oDiv.setAttribute("id","viewer");
        oDiv.appendChild(oImg);
        document.body.appendChild(oDiv);
    }       
}
function moveFile(obj,filename) {

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
            obj.remove();
		}
		else if(this.readyState == 4 && this.status == 403){
			alert( "Not Allowed " + this.responseText);
		}
		else if(this.readyState == 4 && this.status == 500){
			alert( "System Error: " + this.responseText);
		}	
	}
	xmlhttp.open("POST", "move.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("path="+encodeURI(filename));
}

function erase(ev) {
	ev.preventDefault();
	var xmlhttp2 = new XMLHttpRequest();
	//alert(ev.dataTransfer.getData("text"));
	xmlhttp2.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			draggedElement.remove();
		}
		else if(this.readyState == 4 && this.status == 403){
			alert( "Not allowed " + this.responseText);
		}
		else if(this.readyState == 4 && this.status == 500){
			alert( "System Error: " + this.responseText);
		}		
	}
		
	xmlhttp2.open("POST", "delete.php", true);
	xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp2.send("path="+ev.dataTransfer.getData("text").split("/").pop());
}
