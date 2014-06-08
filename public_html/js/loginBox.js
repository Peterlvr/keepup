$(document).ready(function loginBox() {
	function loginBoxPop() {
		console.log("boxpop hey");
		if($("#area_logar").css("display") != "block") {

			$("#area_logar").fadeIn();
			
		}
		else {
			$("#area_login").css({
				"display": "none",
				"opacity": "0"
			});
		}
	}

	$("#alogin").on("click", loginBoxPop);
});