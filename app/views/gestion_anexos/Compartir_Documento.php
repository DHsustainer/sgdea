<script type="text/javascript">
	$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
	});
</script>
<?php
echo '
<div class="form-body">';
    if ($_SESSION['mayedit'] == "1") {
    	echo "
		<div class='row'>
	        <div class='col-md-12'>
	        	<h4>Compartir Documento Con un Expediente ".$c->Ayuda('118')."</h4>
	            <div class='form-group'>
	            	<div class='row'>
		            	<div class='col-md-9'>
							<input type='text' id='whoishare_".$ga->GetId()."' placeholder='Escriba el numero de radicado rápido del expediente a compartir' class='form-control'>
						</div>
						<div class='col-md-3'>
							<input class='btn btn-info pull-right' type='button' value='Compartir' onClick='shareDocumento(".$ga->GetId().")'>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-md-12'>
				<h4>Compartir Documento Con un Usuario  ".$c->Ayuda('119')."</h4>
	            <div class='form-group'>
	            	<div class='row'>
		            	<div class='col-md-9'>
							<input type='text' alt='".$ga->GetId()."' id='whoishare2_".$ga->GetId()."' placeholder='Escriba el usuario para compartir el documento' class='form-control activarbuscador2'>
						</div>
						<div class='col-md-3'>
							<input class='btn btn-info pull-right' type='button'  value='Compartir' onClick='shareDocumentoUsuario(".$ga->GetId().")'>
							<div id='bloquebusqueda' class='bloquebusqueda2_".$ga->GetId()." bloquebusqueda2'></div>
							<input type='hidden' id='id_usuario_".$ga->GetId()."'>
						</div>
					</div>
	            </div>
	        </div>
	    </div>";
    }
    echo "
		<div class='row'>
	        <div class='col-md-12'>
	            <div class='form-group m-b-10'>
					<ul class='list-group' id='listshare".$ga->GetId()."'>";
						$queryxtt = $con->Query("select gestion_id from gestion_anexos where origen = '".$ga->GetId()."' group by gestion_id");
						$i = 0;
						while ($rxt = $con->FetchAssoc($queryxtt)) {
							$i++;
							$gx = new MGestion;
							$gx->CreateGestion("id", $rxt[gestion_id]);
							echo "<li class='list-group-item'>Documento Compartido con el expediente <b>".$gx->GetNum_oficio_respuesta()."</b></li>";
						}
						$queryxtt = $con->Query("SELECT * FROM gestion_anexos_permisos_documentos where id_documento = '".$ga->GetId()."' and estado = '1'");
						while ($rxt = $con->FetchAssoc($queryxtt)) {
							$i++;
							$MUsuarios = new MUsuarios;
							$MUsuarios->CreateUsuarios("user_id", $rxt[usuario_permiso]);
							echo "<li class='list-group-item'>Documento Compartido con el usuario <b>".$MUsuarios->GetP_nombre()." ".$MUsuarios->GetS_nombre()." ".$MUsuarios->GetP_apellido()." ".$MUsuarios->GetS_apellido()."</b></li>";
						}
						if ($i <= 0) {
							echo '<li id="da_message_warning'.$ga->GetId().'"  class="list-group-item"><div class="da-message warning">Este documento no se está compartiendo con ningún expediente o usuario</div></li>';
						}
	echo "
					</ul>
				</div>
			</div>
	    </div>";

echo "
</div>";
?>
<script type="text/javascript">

	$(".activarbuscador2").on("keyup", function(){

		var ide = $(this).attr('alt')

		$("#id_documento").val(ide);

		$(".bloquebusqueda2_"+ide).fadeIn();				

		$.ajax({

			type: "POST",

			url: '/usuarios/GestListadoUsuarios3/'+$(this).val()+"/",

			success: function(msg){

				result = msg;

				$(".bloquebusqueda2_"+ide).html(result);					

			}

		});				

	})

	$(".activarbuscador").on("keyup", function(){

		var ide = $(this).attr('alt')

		$("#id_documento").val(ide);

		$(".bloquebusqueda_"+ide).fadeIn();				

		$.ajax({

			type: "POST",

			url: '/usuarios/GestListadoUsuariosSuscriptores/'+$(this).val()+"/",

			success: function(msg){

				result = msg;

				$(".bloquebusqueda_"+ide).html(result);					

			}

		});				

	})

	function onTecla(e){	

		var num = e?e.keyCode:event.keyCode;

		if (num == 9 || num == 27){

			$(".bloquebusqueda_"+ide).fadeOut();		

		}

	}

	document.onkeydown = onTecla;

	if(document.all){

		document.captureEvents(Event.KEYDOWN);	

	}

	function AddUsuarioToListado3(nombre, email, id){

		$(".bloquebusqueda2").fadeOut();

		$("#whoishare2_"+$("#id_documento").val()).val(nombre);

		$("#id_usuario_"+$("#id_documento").val()).val(email);

	}

	function AddUsuarioToListado(nombre, email, id){

		if (email == "<?= $_SESSION['usuario'] ?>") {

				$(".activarbuscador").val("");

				$(".bloquebusqueda").fadeOut();		

				var URL = '/gestion_anexos_permisos/registrar/';

				var essuscriptor = '';

				if(email.indexOf("@") < 0){

					essuscriptor = 'S';

				}

		        var str = "id_documento="+$("#id_documento").val()+"&usuario_permiso="+id+"&observacion="+''+"&diasmaxtoresponse="+$("#diasmaxtoresponse_"+$("#id_documento").val()).val()+"&usuario_permiso_username="+email+"&essuscriptor="+essuscriptor;

		        $.ajax({

		            type: 'POST',

		            url: URL,

		            data: str,

		            success:function(msg){

		            	OpenWindow("/firmas_usuarios/firmar/"+msg+"/");
		            	showfiles('/gestion/GetAnexos/<?= $id ?>/<?= $folder ?>/1/', 'cargador_box_upfiles_menu');


		            }

		        });

		}else{

			if ($("#diasmaxtoresponse_"+$("#id_documento").val()).val() == "0") {

				alert("Debe seleccionar de primero los días para revisar el expediente");

				$(".activarbuscador").val("");

				$(".bloquebusqueda").fadeOut();		

				return false;

			}else{

				if (confirm("¿Está seguro que desea solicitar revisar este documento con el usuario "+nombre+"?")) {

					var observacion = prompt("¿Algúna observación para este documento?");

					$(".activarbuscador").val("");

					$(".bloquebusqueda").fadeOut();		

					var URL = '/gestion_anexos_permisos/registrar/';

					var essuscriptor = '';

					if(email.indexOf("@") < 0){

						essuscriptor = 'S';

					}

			        var str = "id_documento="+$("#id_documento").val()+"&usuario_permiso="+id+"&observacion="+observacion+"&diasmaxtoresponse="+$("#diasmaxtoresponse_"+$("#id_documento").val()).val()+"&usuario_permiso_username="+email+"&essuscriptor="+essuscriptor;

			        $.ajax({

			            type: 'POST',

			            url: URL,

			            data: str,

			            success:function(msg){

			            	Alert2(msg);

			            	if (email == "<?= $_SESSION['usuario'] ?>") {

			            		Alert2("Envio la alerta al mismo usuario");

			            	};

			            	showfiles('/gestion/GetAnexos/<?= $id ?>/<?= $folder ?>/1/', 'cargador_box_upfiles_menu');

			                //var string = "<li id='elm"+id+"_"+$("#id_documento").val()+"'><div class='t_listado' style='float:left'>"+nombre+"</div>"+'<div class="nom_anexo" style="float:right"><div class="mini-ico green-deact" style="float:left" title="El documento aún no ha sido revisado por el usuario '+email+'"></div></div>'+"</li>";

							//$("#listlookfor_"+$("#id_documento").val()).append(string);

			            }

			        });

				}else{

					$(".activarbuscador").val("");

					$(".bloquebusqueda").fadeOut();		

					return false;

				}

			}

		}

	}
</script>