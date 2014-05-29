// Funções para a página explore
$(document).ready(function() {

	// Checkboxes com data-activates="nome_entrada"
	// desativam ou ativam determinadas entradas do formulário
	$("*[data-activates]").on("change", function() {
		if($(this)[0].checked) {
			$("*[name=" + $(this).attr("data-activates") +"]").removeAttr("disabled");
		}
		else {
			$("*[name=" + $(this).attr("data-activates") +"]").attr("disabled", "");
		}
	});

	// Sender das pesquisas
	$.ajaxSetup({
		cache: false
	});
	$("#pesquisaForm").on("submit", function(e) {
		e.preventDefault();
		console.log($(this).serialize());
		$.ajax("php/pesquisa.php?"+$("#pesquisaForm").serialize())
			.done(function(data) {
				$("#resultados").html(data);
			});
	});
});