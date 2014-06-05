$(document).ready(function loginBox() {
	function loginBoxPop() {
		console.log("boxpop hey");
		if($("#bg_login").css("display") != "block") {

			$("#bg_login").fadeIn();
			
		}
		else {
			$("#bg_login").css({
				"display": "none",
				"opacity": "0"
			});
		}
	}

	$("#alogin").on("click", loginBoxPop);
});