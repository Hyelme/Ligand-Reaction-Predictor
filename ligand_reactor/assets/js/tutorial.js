var tutorial = document.getElementsByClassName("tutorial");
var step1 = document.getElementById("tab1");
var auc = document.getElementById("tab3");
var x = document.getElementById("css-close");

step1.onclick = function() {
	tutorial[0].style.display = "block";
	tutorial[1].style.display = "block";
}

auc.onclick = function() {
	tutorial[2].style.display = "block";
}

x.onclick = function() {
	tutorial[2].style.display = "none";
}