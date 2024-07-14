// JAVASCRIPT GLOBALS
$(document).ready(function(){

	$( "#cerrar_precarga" ).click(function() {
		$("#mascara_precarga").fadeOut("fast");
	  	$(document).ajaxStop();
	});


	$( "#cerrar_alertbox" ).click(function() {
		$("#alertbox").slideUp("fast");
	});	


	$(".main_listas").live("click",function(){
		var myid = $(this).attr("id");
		var arr  = myid.split("_");
		var id = arr[1];

		$("ul.submenu_listas").css("display", "block");

		$(".submenu_listas").html("<li align='center'><img src='http://assets.audiosjuridicos.com/images/ajax-loader.gif' width='16' /></li>");
		Seturl = "http://audiosjuridicos.com/listas_reproduccion/listar/"+id+"/";
		$.ajax({
			type: "POST",
			url: Seturl,
			success:function(msg){
				result = msg;
				$(".submenu_listas").html(result);

			}
		});	    	
	
	})
	$("#InsertLista").live("click", function(){
		if($("#titulo").val() == ""){
			alert("Debes escribir un título");
			return false;
		}else{
			var str = $("#formlistas_reproduccion").serialize();
			ShowLoader("show");
			$.ajax({
				type: "POST",
				url: "http://audiosjuridicos.com/listas_reproduccion/registrar/",
				data: str,
				success:function(msg){
					result = msg;
					ShowLoader("hide");
					Myalert(result);
					Data_Loader('listas_reproduccion/mis_listas/', 'mylists');
				}
			});			
		}
	}); 

	$("#UpdateLista").live("click", function(){
		if($("#titulo").val() == ""){
			alert("Debes escribir un título");
			return false;
		}else{
			var str = $("#FormUpdatelistas_reproduccion").serialize();
			ShowLoader("show");
			$.ajax({
				type: "POST",
				url: "http://audiosjuridicos.com/listas_reproduccion/actualizar/",
				data: str,
				success:function(msg){
					result = msg;
					ShowLoader("hide");
					Myalert(result);
					Data_Loader('listas_reproduccion/mis_listas/', 'mylists');
				}
			});			
		}
	}); 

	$("#InsertNota").live("click", function(){
		if($("#titulo").val() == ""){
			alert("Debes escribir un título");
			return false;
		}
		if($("#descripcion").val() == ""){
			alert("Debes escribir contenido en la nota");
			return false;
		}else{
			var str = $("#formnotas").serialize();
			ShowLoader("show");
			$.ajax({
				type: "POST",
				url: "http://audiosjuridicos.com/notas/registrar/",
				data: str,
				success:function(msg){
					result = msg;
					ShowLoader("hide");
					Myalert(result);
					Data_Loader('notas/mis_anotaciones/', 'mis_anotaciones');
				}
			});			
		}
	});

	$("#UpdateNota").live("click", function(){
		if($("#titulo").val() == ""){
			alert("Debes escribir un título");
			return false;
		}if($("#descripcion").val() == ""){
			alert("Debes escribir contenido en la nota");
			return false;
		}else{
			var str = $("#FormUpdatenotas").serialize();
			ShowLoader("show");
			$.ajax({
				type: "POST",
				url: "http://audiosjuridicos.com/notas/actualizar/",
				data: str,
				success:function(msg){
					result = msg;
					ShowLoader("hide");
					Myalert(result);
					Data_Loader('notas/mis_anotaciones/', 'mis_anotaciones');
				}
			});			
		}
	}); 

	$("#InsertMensaje").live("click", function(){
		if($("#titulo").val() == ""){
			alert("Debes escribir un título");
			return false;
		}
		if($("#descripcion").val() == ""){
			alert("Debes escribir contenido en la nota");
			return false;
		}else{
			var str = $("#formpms").serialize();
			ShowLoader("show");
			$.ajax({
				type: "POST",
				url: "http://audiosjuridicos.com/pms/enviar/",
				data: str,
				success:function(msg){
					result = msg;
					ShowLoader("hide");
					if(result == "1"){
						Data_Loader('pms/my_inbox/', 'my_inbox');
						Myalert("Tu mensaje ha sido enviado");
					}else{
						Myalert(result);
					}
				}
			});			
		}
	});	

	$("#insertPublicacion").live("click", function(){
		if($("#titulo").val() == ""){
			alert("Debes escribir un título");
			return false;
		}
		if($("#descripcion").val() == ""){
			alert("Debes escribir contenido en la nota");
			return false;
		}else{
			var str = $("#formforo_preguntas").serialize();
			ShowLoader("show");
			$.ajax({
				type: "POST",
				url: "http://audiosjuridicos.com/foro_preguntas/registrar/",
				data: str,
				success:function(msg){
					result = msg;
					ShowLoader("hide");
					Myalert(result);
					Data_Loader('foro_preguntas/listar/', 'listar');
				}
			});			
		}
	});

	$("#UpdatePublicacion").live("click", function(){
		if($("#titulo").val() == ""){
			alert("Debes escribir un título");
			return false;
		}if($("#descripcion").val() == ""){
			alert("Debes escribir contenido en la nota");
			return false;
		}else{
			var str = $("#FormUpdateforo_preguntas").serialize();
			ShowLoader("show");
			$.ajax({
				type: "POST",
				url: "http://audiosjuridicos.com/foro_preguntas/actualizar/",
				data: str,
				success:function(msg){
					result = msg;
					ShowLoader("hide");
					Myalert(result);
					Data_Loader('foro_preguntas/sent/', 'sent');
				}
			});			
		}
	}); 	


	$("#ResponderForo").live("click", function(){
		if($("#respuesta").val() == ""){
			alert("Debes escribir un comentario");
			return false;
		}else{
			var str = $("#formforos_respuestas").serialize();
			ShowLoader("show");
			var id_p = $("#pregunta_id").val();
			$.ajax({
				type: "POST",
				url: "http://audiosjuridicos.com/foros_respuestas/registrar/",
				data: str,
				success:function(msg){
					result = msg;
					ShowLoader("hide");
					Myalert(result);
					Data_Loader('foro_preguntas/buscar/'+id_p+'/id/', 'listar')
				}
			});			
		}
	});	


	$("#updateprofile").live("click", function(){

		var op = $("#password").val();
		var vp = $("#verifpassword").val()
		var np = $("#newpassword").val();
		var cp = $("#checkpassword").val();
		
		if(vp != ""){
			vp = sha256_digest($("#verifpassword").val());
			if(vp != op){
				Myalert("La clave ingresada no coincide con la original");
			}else{
				if(np != cp){
					Myalert("La nueva clave no coincide con la verificacion");
				}else{
					if(np.length < 4){
						Myalert("La nueva clave debe tener minimo 4 caracteres");
					}else{
						if($("#nombre_completo").val() == ""){
							Myalert("Debes escribir un nombre");
							return false;
						}if($("#usuarioscol").val() == ""){
							Myalert("Desbes escribir un nombre para mostrar, para poder ingresar a los conversatorios");
							return false;
						}
						if($("#email").val() == ""){
							Myalert("El campo E-Mail es obligatorio");
							return false;
						}if($("#ciudad").val() == ""){
							Myalert("Debes escribir la ciudad donde vives");
							return false;
						}else{
							var str = $("#FormUpdateusuarios").serialize();
							ShowLoader("show");
							var id_p = $("#pregunta_id").val();
							$.ajax({
								type: "POST",
								url: "http://audiosjuridicos.com/usuarios/actualizar/",
								data: str,
								success:function(msg){
									result = msg;
									ShowLoader("hide");
									Myalert(result);
									Data_Loader('dashboard/profile/', 'profile');
								}
							});
						}
					}
				}
			}
		}else{
			if($("#nombre_completo").val() == ""){
				Myalert("Debes escribir un nombre");
				return false;
			}if($("#usuarioscol").val() == ""){
				Myalert("Desbes escribir un nombre para mostrar, para poder ingresar a los conversatorios");
				return false;
			}
			if($("#email").val() == ""){
				Myalert("El campo E-Mail es obligatorio");
				return false;
			}if($("#ciudad").val() == ""){
				Myalert("Debes escribir la ciudad donde vives");
				return false;
			}else{
				var str = $("#FormUpdateusuarios").serialize();
				ShowLoader("show");
				var id_p = $("#pregunta_id").val();
				$.ajax({
					type: "POST",
					url: "http://audiosjuridicos.com/usuarios/actualizar/",
					data: str,
					success:function(msg){
						result = msg;
						ShowLoader("hide");
						Myalert(result);
						//Data_Loader('dashboard/profile/', 'profile');
					}
				});
			}
		}
	})


	
});

function num(e) {
    evt = e ? e : event;
    tcl = (window.Event) ? evt.which : evt.keyCode;
    if (tcl == 13 )
    {
        SubmitSearch();
    }
}


function LoadPage(id, selector){
	ShowLoader("show");
	$("#navigation_menu > li").removeClass('active');
	$("#"+selector).addClass('active');
	$("#web_container").fadeOut("fast");
	//$("#data-loader").fadeOut("fast");
    //document.title = $("#"+selector).attr("title");
	$("#web_container").html("");
	$("#data-loader").html("");
	var ur = "http://audiosjuridicos.com/"+id+"/";
	$.ajax({
		type: "POST",
		url: ur,
		success:function(msg){
			result = msg;
			ShowLoader("hide");
			$("#web_container").html(result);						
			$( "#web_container" ).toggle( "slide" );
		}
	});
}

function Data_Loader(id, element){
	ShowLoader("show");
	$("#sub_menu > li").removeClass('active');
	$("#"+element).addClass('active');
	$( "#data-loader" ).toggle( "slide" );
	$.ajax({
		type: "POST",
		url: "http://audiosjuridicos.com/"+id,
		success:function(msg){
			result = msg;
			ShowLoader("hide");
			$("#data-loader").html(result);						
			$( "#data-loader" ).toggle( "slide" );


		}
	});
}

function DeepView(url, main, subm){
	ShowLoader("show");
	$("#navigation_menu > li").removeClass('active');
	$("#"+main).addClass('active');
	$("#web_container").fadeOut("fast");
	$("#web_container").html("");
	$("#data-loader").html("");
	var ur = "http://audiosjuridicos.com/"+url+"/";
	$.ajax({
		type: "POST",
		url: ur,
		success:function(msg){
			result = msg;
			ShowLoader("hide");
			$("#web_container").html(result);						
			$( "#web_container" ).toggle( "slide" );

			$("#sub_menu > li").removeClass('active');
			$("#"+subm).addClass('active');			
		}
	});
}

function ShowLoader(show){
	if(show == "show"){

		$("#mascara_precarga").fadeIn("fast");

	}else if(show == "hide"){

		$("#mascara_precarga").fadeOut("fast");

	}
}



function PanelOSX(dir){
	$("#box-osx").fadeIn("fast");
	HidePlaylist()
	Seturl = "http://audiosjuridicos.com/"+dir+"/";
	$.ajax({
		type: "POST",
		url: Seturl,
		success:function(msg){
			result = msg;
			$("#container_osx").html(result);

		}
	});
}


function AddToList(idel, list){
	var mye = idel.parentNode.className
	el = mye.split(" ");
	newid = el[1].split("_");
	id = newid[1];
	ShowLoader("show");
	$.ajax({
		type: "POST",
		url: "http://audiosjuridicos.com/elementos_listas/registrar/"+id+"/"+list+"/",
		success:function(msg){
			result = msg;
			ShowLoader("hide");
			Myalert(result);
		}
	}); 
}

function Myalert(text){
	$("#container_alertbox").html(text);

	$("#alertbox").slideDown("fast");

	setInterval(
		function(){
			$("#alertbox").slideUp("fast");
		}
	,15000);	
}


function EliminarListas_reproduccion(id){
	if(confirm('Esta seguro desea eliminar esta lista')){
		var URL = 'http://audiosjuridicos.com/listas_reproduccion/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				result = msg;
				Myalert(result);
				Data_Loader('listas_reproduccion/mis_listas/', 'mylists');
			}
		});
	}
}	

function EliminarNota(id){
	if(confirm('Esta seguro desea eliminar esta nota')){
		var URL = 'http://audiosjuridicos.com/notas/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				result = msg;
				Myalert(result);
				Data_Loader('notas/mis_anotaciones/', 'mis_anotaciones');
			}
		});
	}
}	


function ChangeAvatar(img){
	var str = "img="+img;
	ShowLoader("show");
	$.ajax({
		type: "POST",
		url: "http://audiosjuridicos.com/usuarios/cambiarAvatar/",
		data: str,
		success:function(msg){
			result = msg;
			ShowLoader("hide");
			Myalert(result);
			$("#bloque_display").html('<div class="shadowbox"></div><img src="http://assets.audiosjuridicos.com/thumbnail/'+img+'" width="100%;">');
		}
	});
}

function ExpandCollapse(main_el, selector, textenabled, textdisabled){

	if(!$("#"+main_el).hasClass("active")){

        $("#"+main_el).slideDown("fast");
        $("#"+main_el).addClass("active")

        $("#"+selector).html(textdisabled);

    }else{

        $("#"+main_el).slideUp("fast");
        $("#"+main_el).removeClass("active")

        $("#"+selector).html(textenabled);

    }
}