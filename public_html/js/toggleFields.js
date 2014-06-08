// Checkboxes com data-activates="nome_entrada"
// desativam ou ativam determinadas entradas do formulário
$().ready(function() {
	$("input[data-activates]").on("change", function() {
		if($(this)[0].checked) {
			console.log("hey ya");
			$("*[name=" + $(this).attr("data-activates") +"]")
				.removeAttr("disabled");
		}
		else {
			$("*[name=" + $(this).attr("data-activates") +"]")
				.attr("disabled", "");
		}
	});
});