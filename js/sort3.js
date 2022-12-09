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
							oImg.setAttribute("onclick","moveFile(this,'"+files[i]+"');");
							oImg.setAttribute("onmouseover","showImg(this)");
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

		function move(ev) {
			ev.preventDefault();
			var xmlhttp = new XMLHttpRequest();
		
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					alert("Move success! " + this.responseText);
					location.href = "sort.html";
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
		function erase(ev) {
			ev.preventDefault();
			var xmlhttp2 = new XMLHttpRequest();
		
			xmlhttp2.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					alert( "Delete success: " + this.responseText);
					location.href = "sort.html";}
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
