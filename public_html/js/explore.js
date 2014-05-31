// Funções para a página explore
function pesquisaAjax(p) {
	$.ajax("php/pesquisa.php?" + p)
		.done(function(data) {
			$("#resultados").html(data);
		});
}
$(document).ready(function() {

	// Checkboxes com data-activates="nome_entrada"
	// desativam ou ativam determinadas entradas do formulário
	$("input[data-activates]").on("change", function() {
		if($(this)[0].checked) {
			$("*[name=" + $(this).attr("data-activates") +"]")
				.removeAttr("disabled");
		}
		else {
			$("*[name=" + $(this).attr("data-activates") +"]")
				.attr("disabled", "");
		}
	});

	// Entradas de texto com data-changes="nome_select"
	// alteram a opção selecionada de um select determinado
	$("input[data-changes]").on("change", function() {
		var val = $(this).attr("value");
		console.log(val);
		var select = $(this).attr("data-changes");
		$("select[name=" + select + "]:first-child option")
			.each(function() {
				if($(this).val().indexOf(val) != -1) {
					$(this).select();
				}
			})
	});

	// Sender das pesquisas
	$.ajaxSetup({
		cache: false
	});
	$("#pesquisaForm").on("submit", function(e) {
		e.preventDefault();
		pesquisaAjax($(this).serialize());
	});
});