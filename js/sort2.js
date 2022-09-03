		var mdp = "";
		function drawPix(){
			xmlhttp2 = new XMLHttpRequest();
			xmlhttp2.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					files = this.responseText.replace("\r\n", "").split(";");
					for (var i=0;i<files.length;i++){
						if (files[i]!=""){
							var oImg=document.createElement("IMG");
							oImg.setAttribute("class","thumbnails");
							oImg.setAttribute("id","drag"+i);
							oImg.setAttribute("height","100px");
							oImg.setAttribute("draggable","true");
							oImg.setAttribute("src","/uploads/"+files[i]);
							//oImg.setAttribute("ondragstart","drag('event')");
							document.getElementById("divSource").appendChild(oImg);
						}
					}
				}
			};
			xmlhttp2.open("GET", "getFIleList.php?cached=no&folder=uploads&apcukey=uploaddir",true);
			xmlhttp2.send();
		}
		function allowDrop(ev) {
		  ev.preventDefault();
		}
		function drag(ev) {
		  ev.dataTransfer.setData("text", ev.target.id);
		}

		function move(ev) {
			ev.preventDefault();
		    var xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {
    			if (this.readyState == 4 && this.status == 200){
					alert("Move success! " + this.responseText);
					location.href = "sort.html";
				}	
			}
			xmlhttp.open("POST", "move.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    		xmlhttp.send("pwd="+ encodeURI(document.getElementById("password").innerText) +"&path="+ev.dataTransfer.getData("text").split("/").pop());
		}
		function erase(ev) {
			ev.preventDefault();
		    var xmlhttp2 = new XMLHttpRequest();

			xmlhttp2.onreadystatechange = function() {
    			if (this.readyState == 4 && this.status == 200){
					alert( "Delete success: " + this.responseText);
					location.href = "sort.html";}
				}
			xmlhttp2.open("POST", "delete.php", true);
			xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp2.send("pwd="+ encodeURI( document.getElementById("password").innerText) +"&path="+ev.dataTransfer.getData("text").split("/").pop());
		}
