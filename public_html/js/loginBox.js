$(document).ready(function loginBox() {
	function loginBoxPop() {
		if($("#login_box").css("display") != "block") {
			$("#login_box").css({
				"display": "block",
				"opacity": "1"
			});
		}
		else {
			$("#login_box").css({
				"display": "none",
				"opacity": "0"
			});
		}
	}
	$(".login_link").on("click", loginBoxPop);
	loginBoxPop();
});