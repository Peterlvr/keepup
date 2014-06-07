$(document).ready(function() {
	var mudaTipoForm = function() {
		var tipo = $("input[name=rbTipo]:checked").val() || false;
		if(tipo == "A") {
			$("#painelAluno").css("display", "block");
			$("#painelEscola").css("display", "none");
			$("#envia").removeAttr("disabled");
		}
		else if(tipo == "E") {
			$("#painelAluno").css("display", "none");
			$("#painelEscola").css("display", "block");
			$("#envia").removeAttr("disabled");
		}
		else {
			$("#painelAluno").css("display", "none");
			$("#painelEscola").css("display", "none");
			$("#envia").attr("disabled", "true");
		}
	},
	showE = function(msg) {
		$("#erro_form").html(msg);
	},
	validaSenha = function() {
		var senha1 = $("#senha").val(),
			senha2 = $("#confirmaSenha").val();
		if(senha1 == senha2) {
			return true;
		}
		else {
			showE("As senhas não correspondem.");
			return false;
		}
	};
	mudaTipoForm();
	$("#jsAtivo").attr("value", "true");
	$("#tipoForm").on("click", mudaTipoForm);
	$("#cadastroForm").on("submit", validaSenha);

	$("#adicionarCurso").on("click", function adicionarAutor() {
		var select = document.createElement("select");
		select.setAttribute("class", "cdCurso");
		select.setAttribute("id", "cdCurso" + ($(".cdCurso").length + 1));
		select.setAttribute("name", "cdCurso" + ($(".cdCurso").length + 1));
		$("#cdCurso").append("<br>").append(select);
		var options = $(".cdCurso:first-child option").each(function() {
			$(this).clone().appendTo("#cdCurso" + ($(".cdCurso").length));
		});
	});
});