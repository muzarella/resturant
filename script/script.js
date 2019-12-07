/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function generate(){
	var textbox = document.getElementById("coupon_code");
	textbox.value = makeid();
}

var lag = ["Alimosho","Ajeromi-Ifelodun","Kosofe","Mushin","Oshodi-Isolo","Ojo","Ikorodu","Surulere","Agege","Ifako-Ijaye","Shomolu","Amuwo-Odofin","Lagos Mainland","Ikeja","Eti-Osa","Badagry","Apapa","Lagos Island","Epe","Ibeju-Lekki"];

var abj =["Asokoro District","Maitama District","Wuse I","Wuse II","Garki I District","Garki II","Gwarinpa","Durumi District","Kukwuaba","Gudu","Wuye"];

var no = ["Location Unavailable"];

function create_element() {
	var y = document.getElementById("area");
	var dar = document.createElement("option");
	dar.setAttribute("class", "areas");
	y.appendChild(dar);
}

function clear_Parent() {
	var k = document.getElementById("area");
	var z = document.getElementsByClassName("areas");
	
	for (var b = 0; b <= 10; b++) {
		for (var a = 0; a <= z.length - 1; a++){
		z[a].remove();
		}
	}
}

function validate() {
	var x = document.getElementById("location").value;
	
if (x == "Lagos") {
	clear_Parent();
	for(var i = 0; i <= lag.length - 1; i++){
		create_element();
		var tags = document.getElementsByClassName("areas");
		tags[i].innerHTML = lag[i];
	}

} else if (x == "Abuja") {
	clear_Parent();
		for(var i = 0; i <= abj.length - 1; i++){
		create_element();
		var tags = document.getElementsByClassName("areas");
		tags[i].innerHTML = abj[i];
	}

	
} else {
	clear_Parent();
		for(var i = 0; i <= no.length - 1; i++){
		create_element();
		var tags = document.getElementsByClassName("areas");
		tags[i].innerHTML = no[i];
	}
	alert("Service available in Lagos and Abuja Only");
}
};