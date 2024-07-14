<h2>Redactar Mensaje</h2>
<form id='formmailer_message' action='/mailer_message/nuevo/' method='POST'> 
	<div class="row">
		<div class="col-md-12">
			<label class="col-md-12">
				A quien va dirigido el mensaje
			</label>
			<input type='hidden' name='p_id' id='p_id' value="<?= $pid ?>" maxlength='10' /></td>
			<input type="text" name="to" id="to" class="form-control" placeholder="Direccion de Correo">
			<div id='bloquebusqueda'></div>
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-6">
			<label class="col-md-12">
				Título del Correo
			</label>
			<input type='text' name='subject' id='subject' maxlength='' class="form-control" placeholder="Asunto" />
		</div>
		<div class="col-md-6">
			<label class="col-md-12">
				Deseo que el mensaje de datos expire:
			</label>
			<select name="deadline" id="deadline" class="form-control">
                <option value="0">Hoy Mismo</option>
                <option value="1">1 Dia</option>
                <option value="2">2 Dia(s)</option>
                <option value="3">3 Dia(s)</option>
                <option value="4">4 Dia(s)</option>
                <option value="5">5 Dia(s)</option>
			</select>
		</div>
	</div>
	<div class="row m-t-10">
		<div class="col-md-12">
			<textarea class="form-control height-100" name='descripcion' id='descripcion' placeholder="Escribe un mensaje..." ></textarea>
		</div>
	</div>

	<div style="display: none">
		<button type="button" class="botone" id="atacchfiles"></button>
		<input type="text" name="folder_id_search" id="folder_id_search" value="<?= $gestion->GetId() ?>">
		<input type="text" id="anexos_listado" name="anexos_listado">
		<input type="text" id="archivos_anexos_listado" name="archivos_anexos_listado">
		<input type="text" id="titulos_anexos_listado" name="titulos_anexos_listado">
		<ul id="listado_anexos"></ul>                  
	</div>

	<div class="row m-t-10">
		<div class="col-md-12">
			<div id="listfiles"> 
				<div id="form" class="white">
		            <form id="anexosdescargas" style="width:100%">
		            	<ul id="list-anexos" class="list-group"></ul>
		            </form>
		        </div>
			</div>
		</div>
	</div>

	<div class="row m-t-10">
		<div class="col-md-12">
			<input type='button' id="EnviarCorreoElectronico" onClick="sentmail('<?= $gestion->GetId() ?>')" value='Enviar Mensaje' class="btn btn-info"/>
		</div>
	</div>
</form>

<script>
$(document).ready(function() {
	$("#atacchfiles").click(function(){
		var str = "dtf="+$("#folder_id_search").val();
		$.ajax({
			type: "POST",
			url: '/gestion_anexos/GetAnexosCarpeta/',
			data: str,
			success: function(msg){
				result = msg;
				$("#list-anexos").html(result);
			}
		});				
	})

	<?
		if ($_REQUEST['id'] != "") {
?>
			$("#atacchfiles").click();
<?
		};
	?>

});
</script>
<script>
	
	var lst = $("#anexos_listado").val();
	vector = lst.split(";");

	$("#f195").attr("checked", true)
	for (var i = 1 ; i < vector.length ; i++){
		$('#'+vector[i]).attr('checked', true);
	}
</script>
<script>
	$(document).ready(function(){

		$("#to").keyup(function(){
			$("#bloquebusqueda").html("<ul class='list-group'><li class='list-group-item'>Buscando coincidencias</li></ul>");
			$("#bloquebusqueda").fadeIn();				
			var str = "dtf="+$(this).val();
			//$("#truedata").val($(this).val());
			
			$.ajax({
				type: "POST",
				url: '/correo/autofillcontats/',
				data: str,
				success: function(msg){
					result = msg;
					$("#bloquebusqueda").html(result);
				}
			});				
			
		})	

		
	});	

	function onTecla(e){	
		var num = e?e.keyCode:event.keyCode;
		if (num == 9 || num == 27){
			$("#bloquebusqueda").fadeOut();	
			$("#to").blur();
		}
	}
	
	document.onkeydown = onTecla;
		if(document.all){
			document.captureEvents(Event.KEYDOWN);	
	}
	function AddContact(x){
		var c = ";"+$("#to").val();

		listado = c.split(";");
		var str = "";
  
		for (var i = 0; i < listado.length - 1; i++) {
			if (listado[i].trim() != "") {
				str += listado[i].trim()+" ; ";
			}
		}


		$("#to").val(str+""+x);
		$("#to").focus();
		$("#bloquebusqueda").fadeOut();	
	}

</script>
<script>
	jQuery.fn.multiselect = function() {
	    $(this).each(function() {
	        var checkboxes = $(this).find("input:checkbox");
	        checkboxes.each(function() {
	            var checkbox = $(this);
	            // Highlight pre-selected checkboxes
	            if (checkbox.prop("checked"))
	                checkbox.parent().addClass("multiselect-on");
	 
	            // Highlight checkboxes that the user selects
	            checkbox.click(function() {
	                if (checkbox.prop("checked"))
	                    checkbox.parent().addClass("multiselect-on");
	                else
	                    checkbox.parent().removeClass("multiselect-on");
	            });
	        });
	    });
	};
	$(function() {
	     $(".multiselect").multiselect();

	});
	


</script>
<style>
		
	#message{
		height: 300px;
	}
	.note-editable{
		height: 400px;
	}
	.main_elm 	{
		width: 90%;
		padding-left: 20px;
		clear: both;
		height: 30px;
	}
 	.check_elm 	{
 		float: left;
 		width: 20px;
 		height: 30px;
 		margin-top: 4px;

 	}
 	.title_elm 	{
		float: left;
		text-align: left;
		line-height: 30px;
 	}
 	.title_elm:hover{
 		cursor: pointer;
 		text-decoration: underline;
 	}
	#cargar_listas_demandas{
		height: 480px;
		overflow-x: auto;
	}

	.multiselect {
	    height:100px;
	    width: 97%;
	    line-height: 20px;
	    border:solid 1px #c0c0c0;
	    overflow:auto;
	    padding: 0px;
	    padding-top: 0px;
	    border-radius: 15px;

	}

	.multiselect .title_multi{
		font-weight: bold;
		font-size: 13px;
		margin: 10px;
	}
	 
	.multiselect label {
	    display:block;
	    padding-left: 15px;
	    padding-bottom: 10px;
	    margin:0px;
	    margin-top: 0px;
	    font-size: 11px;
	    width: 98%;

	}
	 
	.multiselect-on {
	    color:#000;
	    background-color:#F5F5F5;
	}

	.mailer_new_element{
		margin: 7px;
	}

    .album_inner_button{
        position: relative;
        z-index: 999;
    }
    
    #list-anexos{
        padding-left: 0px;
    }
    #list-anexos .TituloCarpeta{
    	background-color: #1579C4;
    	color: #FFF;
    	line-height: 30px;
    	font-weight: bold;
    	font-size: 16px;
    	padding-left: 20px;
    	margin-bottom: 7px;
    }
    #list-anexos .TituloCarpeta:hover{
    	cursor: pointer;
    	background-color: #1263A1;
    }
    #list-anexos .TituloCarpeta > ul{
    	background-color: #FFF;
    	color:#000;
    	padding: 0px;
    	margin-left:-20px;
    	display: none;;
    }

    #list-anexos .TituloCarpeta ul li input[type="checkbox"]{
    	margin-top: 17px;
    	margin-right: 10px;
    	margin-left: 5px;
    }

    #list-anexos li.anexos-li{
        height: 45px;
        line-height: 45px;
        border-top:1px solid #CCC;
        width: 100%;
        list-style: none;

    }
    #list-anexos li.anexos-li .album_inner_button{
        float: left;
        width: 20px;
        margin-top: 15px;
    }



    #list-anexos li.anexos-li .nom_anexo{
        float:left;
        line-height: 35px;

        font-size: 12px;
        overflow-y: hidden ; 
        overflow-x: hidden ; 
        padding: 5px;
        padding-right: 9px;
        cursor: normal;
    }
    #list-anexos li.anexos-li .nom_anexo:hover{
        text-decoration: underline;
        cursor: pointer;
    }

    #FormUpdategestion .no_editable{
        display: none;
    }
</style>
