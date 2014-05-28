$( ).ready(function() { 
	$("#estado").on("change", function carregaCidades() {
		var codEstado = $(this).val();
		if(codEstado){
			$.ajax('php/carrega_cidades.php?codEstado=' + codEstado)
				.done(function(response) {
					$("#cidade").html(response);
				});
		}
	});
});