$(document).ready(function() {
	$("#adicionarAutor").on("click", function adicionarAutor() {
		var select = document.createElement("select");
		select.setAttribute("class", "cdAluno");
		select.setAttribute("id", "cdAluno" + ($(".cdAluno").length + 1));
		select.setAttribute("name", "cdAluno" + ($(".cdAluno").length + 1));
		$("#cdAluno").append("<br>").append(select);
		var options = $(".cdAluno:first-child option").each(function() {
			$(this).clone().appendTo("#cdAluno" + ($(".cdAluno").length));
		});
	});
});