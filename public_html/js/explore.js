$(document).ready(function() {
	$("*[data-activates]").on("change", function() {
		if($(this)[0].checked) {
			$("*[name=" + $(this).attr("data-activates") +"]").removeAttr("disabled");
		}
		else {
			$("*[name=" + $(this).attr("data-activates") +"]").attr("disabled", "");
		}
	});
});