const imageLoad = 64;
let imageID = 0;
var offset = 0;
var files = new Array();
var favMode = false;
var drawOn;
imageHeight = "400px";
var thresholdImages = 100;
var scrollingOn =false;
var isPhone=0;

if (localStorage.getItem("favorites") == null)
    localStorage.setItem("favorites", "");
if (localStorage.getItem("dislikes") == null)
    localStorage.setItem("dislikes", "");
if (localStorage.getItem("GRPD") == null)
    localStorage.setItem("GRPD", 0);
if (localStorage.getItem("theme") == null)
    localStorage.setItem("theme", "dark");

function getImageFileList(){
xmlhttp2 = new XMLHttpRequest();
xmlhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if(!useDB)
            files = shuffle(this.responseText.replace("\r\n", "").split(";"));
        else
            files = shuffle(JSON.parse(this.responseText));
        document.getElementById("nbPictures").innerText = files.length;
        document.getElementById("progressBar").setAttribute("max", files.length);
    }
};
if (!useDB)
    xmlhttp2.open("GET", "getFIleList.php?cached=yes&folder=XXX&apcukey=imgdir",true);
else
    xmlhttp2.open("GET", "getFIleList.php?cached=no&apcukey=imgdir&usedb=yes",true);
xmlhttp2.send();
}

function getVideoFileList(){
    const xmlhttp3 = new XMLHttpRequest();
    xmlhttp3.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            const videos = this.responseText.split(";");
            const movieSelect = document.getElementById("movie");
    
            addOption(movieSelect, "Select a movie...", "BLANK");
            addOption(movieSelect, "Close Video Player", "CLOSE_NOW");
    
            videos.forEach(video => {
                addOption(movieSelect, video, encodeURI(video));
            });
        }
    };
    xmlhttp3.open("GET", "getFIleList.php?cached=no&folder=videos&apcukey=viddir",true);
    xmlhttp3.send();
}
function setRecord(like, fileName){
    xmlhttp4 = new XMLHttpRequest();
    xmlhttp4.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            return;
        }
    };
    xmlhttp4.open("POST", "setRecord.php",true);
    xmlhttp4.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp4.send(`like=${like}&filename=${fileName}`);
}
function toggleTheme(){
    if (localStorage.getItem("theme")=="dark"){

        document.body.style.backgroundColor = "white";
        localStorage.setItem("theme", "bright");
    }
    else if (localStorage.getItem("theme")=="bright"){
        document.body.style.backgroundColor = "black";
        localStorage.setItem("theme", "dark");
    }
}
function addOption(oSelect, sText, sValue){
    var oOption = document.createElement("option");
    oOption.text = sText;
    oOption.value = sValue;
    oSelect.add(oOption);
}

function clickGRPD() {
    localStorage.setItem("GRPD", 1);
    document.getElementById("GRPD").style.display = "none";
}

function shuffle(anArray) {
    for (var i = anArray.length - 1; i >= 0; i--) {
        const j = Math.floor(Math.random() * i);
        var temp = anArray[i];
        anArray[i] = anArray[j];
        anArray[j] = temp;
    }
    return (anArray);
}

function addFavorite(image) {
    pathArray = image.src.split("/");
    fileName = pathArray.pop();
    if (localStorage.getItem("favorites") != null)
        localStorage.setItem("favorites", localStorage.getItem("favorites") + fileName + ";");
    else
        localStorage.setItem("favorites", fileName + ";");
    setRecord("yes",fileName);
    image.style.borderColor="green";
    image.parentElement.children[2].style.display ='none';
    image.parentElement.children[1].style.display ='none';

}
function addDislike(imageFileName) {

    if (localStorage.getItem("dislikes") != null)
        localStorage.setItem("dislikes", `${localStorage.getItem("dislikes") + imageFileName};`);
    else
        localStorage.setItem("dislikes", `${imageFileName};`);
    setRecord("no",imageFileName);
}
function hide(element){
    element.style.display = "none";
    element.style.visibility = "hidden";
}
function cleanAll() {
    var lengthChildren = document.getElementById("container").children.length;
    for (var i = 0; i < lengthChildren; i++) {
        document.getElementById("container").children[0].remove();
    }
}
function showDialogBox(sID, sText){

    oDiv = document.createElement("DIV");
    oDiv.setAttribute("class", "dialogBox");
    oDiv.setAttribute("id", sID);
    oDiv.setAttribute("onmouseover", "this.remove()");
    oDiv.innerText = sText;
    document.body.appendChild(oDiv);
}
function showAll() {
    document.getElementById('fav').style.display = 'block';
    document.getElementById('sun').style.display = 'block';
    document.getElementById('btnUpload').style.display = 'block';
    if(!isPhone)
        document.getElementById("videolink").style.display = "block";
	if (document.getElementById('Loading') != undefined)
    document.getElementById('Loading').style.visibility = 'visible';
	if (document.getElementById('tools') != undefined)
    document.getElementById('tools').style.visibility = 'visible';

    if (document.getElementById('counter') != undefined)	
    document.getElementById('counter').style.display='block';

    if (isPhone)
        document.getElementById('GRPD').style.height = "160px";
    if (localStorage.getItem("GRPD") == 0)
        document.getElementById('GRPD').style.display = "block";
    else
        document.getElementById('GRPD').style.display = "none";
}
function displayVideos()
{
	if (document.getElementById("theater").style.display=="none" || !document.getElementById("theater").style.display){
        document.getElementById('player').play();
        document.getElementById("theater").style.display="block";
    }
	else
    {
        document.getElementById('player').pause();
		document.getElementById("theater").style.display="none";
    }
}
function showFavorites(oFavDiv) {
    cleanAll();
    if (favMode == false) {
        offset = window.pageYOffset;
        var favorites = localStorage.getItem("favorites").split(";");
        
        for (var j = 0; j < favorites.length - 1; j++) {
            var oDiv = document.createElement("DIV");
            var oImg = document.createElement("IMG");
            oImg.setAttribute("height","400px");
            oImg.setAttribute("onclick","overlayOn(this);");
            oImg.setAttribute("src",`XXX/${favorites[j]}`);
            oDiv.appendChild(oImg);
            document.getElementById("container").appendChild(oDiv);
        }

        document.getElementById("clear").style.display = 'block';
        oFavDiv.innerHTML = 'Back';
        oFavDiv.title ="Click here to go back to all photos.";
        favMode = true;
        clearInterval(drawOn);
    } else {
        imageID = 0;
        document.getElementById("clear").style.display = 'none';
        oFavDiv.innerHTML = '<i class="material-icons">&#xe87e;</i>';
        oFavDiv.title ="Click here to display your favorite photos";
        
        
        drawOn = setInterval(scrolling, 100);
        window.scrollTo(0, offset);
        favMode = false;
    }
}
function  deleteFile(filename){
    xmlhttp5 = new XMLHttpRequest();
    xmlhttp5.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showDialogBox("1","File deleted successfully");
            return;
        }
        else if (this.readyState == 4 && this.status == 500){
            showDialogBox("2","File not deleted.");
        }
    };
    xmlhttp5.open("POST", "deleteFile.php",true);
    xmlhttp5.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp5.send(`filename=${filename}&pwd=${localStorage.getItem("password")}`);
}

function putImages() {

    $('.toast').toast({ delay: 1500 });
    $('.toast').toast('show');
    document.getElementById("firstPix").innerText = imageID;
    document.getElementById("lastPix").innerText = imageID + imageLoad;
    document.getElementById("progressBar").value = imageID;
    for (var i = 0; i < imageLoad; i++) {
        if (imageID >= thresholdImages) {
            _paq.push(['trackEvent', 'View', '100Photos', imageID / 100, 1]);
            thresholdImages += 100;
        }
        if (files[imageID] != undefined && files[imageID] != "" && imageID < files.length) {
            if(!localStorage.getItem("dislikes").split(";").includes(files[imageID])){
                oDiv = document.createElement("div");
                oDivX = document.createElement("div");
                oDivHeart = document.createElement("div");
                
                oDivX.setAttribute("onclick", `document.getElementById('ID${imageID}').firstChild.style.borderColor='red';setTimeout(hidePix,1000,${imageID});addDislike('${files[imageID]}');`);
                oDivX.setAttribute("class","closeX");
                oDivX.setAttribute("title","Click on X to definitely hide this photo.");
                oDivX.innerHTML = "X";
                oDivHeart.setAttribute("class","heart");
                oDivHeart.setAttribute("title","Click to keep this photo as favorite.");
                oDivHeart.setAttribute("onclick", "addFavorite(document.getElementById('ID"+imageID+"').firstChild);");
                oDivHeart.innerHTML = "&#9825;";

                oImg = document.createElement("img");
                oDiv.setAttribute("id" , "ID" + imageID);
                oDiv.setAttribute("class" , "image");
                oDiv.setAttribute("onmouseover","whereIs = 'ID" +imageID+"';")
                oImg.setAttribute("alt" , "Image Number " + imageID);
                oImg.setAttribute("height" , imageHeight);
                //oImg.setAttribute("data-toggle", "tooltip");
                oImg.setAttribute("title" , "Click on photo to enlarge.");
                if (!useDB)
                    oImg.setAttribute("src", "XXX/" + files[imageID]);
                else
                    oImg.setAttribute("src", "image/w=0,h=600,q=100/" + files[imageID]);
                oImg.setAttribute("onclick", "overlayOn(this);");
                if (localStorage.getItem("favorites").split(";").includes(files[imageID]))
                    oImg.style.borderColor="green";
                oDiv.appendChild(oImg);
                if(!localStorage.getItem("favorites").split(";").includes(files[imageID])){
                    oDiv.appendChild(oDivX);
                    oDiv.appendChild(oDivHeart);
                }
                if(localStorage.getItem("password") != "" && localStorage.getItem("password")!=null)
                {
                    oDivDelete = document.createElement("div");
                    oDivDelete.setAttribute("class","flagDelete");
                    oDivDelete.setAttribute("title","Click to delete on disk.");
                    oDivDelete.setAttribute("onclick", `document.getElementById('ID${imageID}').firstChild.style.borderColor='red';setTimeout(hidePix,1000,${imageID});deleteFile(document.getElementById('ID${imageID}').firstChild.src.split('/').pop());`);
                    oDivDelete.innerHTML = "&#128681";
                    oDiv.appendChild(oDivDelete);
                }
                document.getElementById("container").appendChild(oDiv);
                if (localStorage.getItem("favorites").split(";").includes(files[imageID])){
                    document.getElementById(`ID${imageID}`).firstChild.style.borderColor="green";
                }
            }
            imageID++;
        }
     }
    /* if (whereIs !=""){
        document.getElementById(whereIs).scrollIntoView();
        whereIs="";
     }*/
}
function hidePix(id){
    document.getElementById("ID"+id).style.display = 'none';
}
function scrolling() {
	if (scrollingOn ==true)
		return;
	scrollingOn =true;

    if ((document.body.clientHeight - document.documentElement.clientHeight - window.pageYOffset) < 2000) {
        offset = window.pageYOffset;
        if (files != undefined && files.length > 0 && imageID < files.length)
            putImages();
    }
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
	scrollingOn=false;
}

function overlayOn(image) {
    var pixHeight = document.documentElement.clientHeight - 20;
    var oImg = document.createElement("IMG");
    oImg.setAttribute("width","auto");
    oImg.setAttribute("height",pixHeight);
    oImg.setAttribute("src",image.src)
    document.getElementById("overlay").removeChild(document.getElementById("overlay").firstChild);
    document.getElementById("overlay").appendChild(oImg);
    document.getElementById("overlay").style.display = "block";
}

function overlayOff() {
    document.getElementById("overlay").style.display = "none";
}

var fileobj;

function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
}

function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        fileobj = document.getElementById('selectfile').files[0];
        ajax_file_upload(fileobj);
    };
}

function ajax_file_upload(file_obj) {
    if (file_obj != undefined) {
        var form_data = new FormData();
        form_data.append('file', file_obj);
        $.ajax({
            type: 'POST',
            url: 'upload.php',
            contentType: false,
            processData: false,
            data: form_data,
            success: function(response) {
				_paq.push(['trackEvent', 'Upload', 'Photo', 1, 1]);
                showDialogBox("3", "File uploaded for moderation...");
                document.getElementById("drop_file_zone").style.display = 'none';
                $('#selectfile').val('');
            },
            error: function(response){
                showDialogBox("3", "Wrong file type.");
                document.getElementById("drop_file_zone").style.display = 'none';               
            }
        });
    }
}


