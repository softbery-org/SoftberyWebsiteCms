/*
* @Author: Softbery Group
* @Date:   2020-10-29 15:50:22
* @Last Modified by:   Softbery Group
* @Last Modified time: 2020-10-29 18:57:09
*/
// document.getElementById("css-style").onclick = function() {changeStyle()};

// function change() {
// 	// if (style == 'light'){
// 		// document.querySelector("link[href='style-dark.css']").href = "style.css";
// 	// }
// 	// if (style) {
// 		// document.querySelector("link[href='css/style.css']").href = "css/style-dark.css";
// 		$("link[id='style']").attr('href', 'css/style-dark.css');
// 	// }
// 	var elem = document.getElementById("myButton1");
//     if (elem.value=="Close Curtain") elem.value = "Open Curtain";
//     else elem.value = "Close Curtain";
// }
// 
function change() // no ';' here
{
	alert(document.getElementById('style').href);
	//if () {} else {}
    document.getElementById('style').href = "style.css";
}