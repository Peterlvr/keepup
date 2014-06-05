$(document).ready(function(e) {

				
                $("#pesquisa_menu").click(function(e) {
                    $("#pesquisa_aberto").slideToggle();
					$("#configuracoes_aberto").fadeOut();
					$("#txtPesquisa").focus();
                });
				
				$("#configuracoes_menu").click(function(e) {
                    $("#configuracoes_aberto").fadeToggle("fast")
                });	
				

					
					
					/* jqueryui */
					$(function() {
    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( "#accordion" ).accordion({
      icons: icons
    });
    $( "#toggle" ).button().click(function() {
      if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
        $( "#accordion" ).accordion( "option", "icons", null );
      } else {
        $( "#accordion" ).accordion( "option", "icons", icons );
      }
    });
  });
					
					
					$("#pes1").click(function(e) {
						$("#pes1_abrir").css("left","0");
					});	
					
					$("#voltar").click(function(e) {
                        $("#pes1_abrir").css("left","-100%");
                    });
					
					$("#voltar3").click(function(e) {
                        $("#pes3_abrir").css("left","-100%");
                    });
					
					
					/* Pesquisa por cidade */
					$("#pes2").click(function(e) {
                       $("#pes2_abrir").css("left","0");
                    });
					
					
					$("#voltar2").click(function(e) {
						$("#pes2_abrir").css("left","-100%");
					});
					
					/* Pesquisa por autor */
					$("#pes3").click(function(e) {
                       $("#pes3_abrir").css("left","0");
					   $("#txtAutor").focus(); 
                    });
					
					
					/* Pesquisa por instituição */
					$("#pes4").click(function(e) {
                       $("#pes4_abrir").css("left","0");
                    });
					
					$("#voltar4").click(function(e) {
                        $("#pes4_abrir").css("left","-100%");
                    });
					
					
					/* Pesquisa por data */
					$("#pes5").click(function(e) {
                       $("#pes5_abrir").css("left","0");
                    });
					
					$("#voltar5").click(function(e) {
                        $("#pes5_abrir").css("left","-100%");
                    });
					
					/* Alterar foto de perfil */
					$("#foto_perfil_usuario").mouseover(function(e) {
                        $("#alterar_foto").css("background-color","#2c87af");
                    });
					
					$("#foto_perfil_usuario").mouseleave(function(e) {
                        $("#alterar_foto").css("background-color","");
                    });
					
					/*personalização do input file*/
					$("#arquivo").change(function() {
						$(this).prev().html($(this).val()); 
					});
					
				
					
			
				$("#menu").click(function(e) {
					$("aside").css("left","-20%");
					$("article").css("width","100%");
				});

            });
			
		
			
						
