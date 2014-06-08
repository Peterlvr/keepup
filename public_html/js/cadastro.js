$(document).ready(function() {
	var mudaTipoForm = function() {
		var tipo = $("input[name=rbTipo]:checked").val() || false;
		if(tipo == "A") {
			$("#painelAluno").css("display", "block");
			$("#painelEscola").css("display", "none");
			$("#painelAluno").removeAttr("disabled");
			$("#painelEscola").attr("disabled", "true");
			$("#curso").css("visibility", "visible");
			$("#envia").removeAttr("disabled");
			$("#perguntaCurso").html("Em que áreas você estudou, ou pretende estudar?");
		}
		else if(tipo == "E") {
			$("#perguntaCurso").html("Que cursos a instituição oferece?");
			$("#painelAluno").css("display", "none");
			$("#painelEscola").css("display", "block");
			$("#painelAluno").attr("disabled", "true");
			$("#curso").css("visibility", "visible");
			$("#painelEscola").removeAttr("disabled");
			$("#envia").removeAttr("disabled");
		}
		else {
			$("#painelAluno").css("display", "none");
			$("#painelEscola").css("display", "none");
			$("#painelAluno").attr("disabled", "true");
			$("#painelEscola").attr("disabled", "true");
			$("#curso").css("visibility", "hidden");
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

	$("#adicionarCurso, .adicionarCurso").on("click", function adicionarCurso() {
		var select = document.createElement("select");
		select.setAttribute("class", "cdCurso");
		select.setAttribute("id", "cdCurso" + ($(".cdCurso").length + 1));
		select.setAttribute("name", "cdCurso" + ($(".cdCurso").length + 1));
		$("#cdCurso").append("<br>").append(select);
		var options = $(".cdCurso:first-child option").each(function() {
			$(this).clone().appendTo("#cdCurso" + ($(".cdCurso").length));
		});
	});

	$("#adicionarEscola").on("click", function adicionarAutor() {
		var select = document.createElement("select");
		select.setAttribute("class", "cdEscola");
		select.setAttribute("id", "cdEscola" + ($(".cdEscola").length + 1));
		select.setAttribute("name", "cdEscola" + ($(".cdEscola").length + 1));
		$("#cdEscola").append("<br>").append(select);
		var options = $(".cdEscola:first-child option").each(function() {
			$(this).clone().appendTo("#cdEscola" + ($(".cdEscola").length));
		});
	});
});