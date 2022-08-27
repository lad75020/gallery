		var mdp = "";
		function allowDrop(ev) {
		  ev.preventDefault();
		}
		function drag(ev) {
		  ev.dataTransfer.setData("text", ev.target.id);
		}
		function loadPix(){
			for (var i=0;i<document.getElementsByClassName("thumbnails").length;i++){
				document.getElementById(drag+$i).setAttribute("ondragstart",drag('event'));
			}
		}
		function move(ev) {
			ev.preventDefault();
		    var xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {
    			if (this.readyState == 4 && this.status == 200){
					alert("Move success! " + this.responseText);
					location.href = "sort.php";
				}	
			}
			xmlhttp.open("GET", "move.php?pwd="+ document.getElementById("password").innerText +"&path="+ev.dataTransfer.getData("text").split("/").pop(), true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    		xmlhttp.send();
		}
		function erase(ev) {
			ev.preventDefault();
		    var xmlhttp2 = new XMLHttpRequest();

			xmlhttp2.onreadystatechange = function() {
    			if (this.readyState == 4 && this.status == 200){
					alert( "Delete : " + this.responseText);
					location.href = "sort.php";}
				}
			xmlhttp2.open("GET", "delete.php?pwd="+ document.getElementById("password").innerText +"&path="+ev.dataTransfer.getData("text").split("/").pop(), true);
			xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp2.send();
		}
