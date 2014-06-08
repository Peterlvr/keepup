// Funções para a página explore
function pesquisaAjax(p) {
	$.ajax("php/pesquisa.php?" + p)
		.done(function(data) {
			$("#resultados").html(data);
		});
}
$(document).ready(function() {
	// Sender das pesquisas
	$.ajaxSetup({
		cache: false
	});
	$("#pesquisaForm").on("submit", function(e) {
		e.preventDefault();
		pesquisaAjax($(this).serialize());
	});
});