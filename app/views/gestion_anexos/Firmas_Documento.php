<script type="text/javascript">
	$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
	});
</script>
<?php
    echo "
	<div class='row'>
        <div class='col-md-12'>
        	<h2>Revisar Documento ".$c->Ayuda('120')."</h2>
            <div class='form-group'>
            	<div class='col-md-4'>
					<select id='diasmaxtoresponse_".$ga->GetId()."' name=diasmaxtoresponse class='form-control' ".$c->Ayuda('121', 'tog').">
		    			<option value='1'>Seleccione los días maximos para revisar el documento (1 por defecto)</option>
		    			<option value='1'>1 Días</option>
		    			<option value='2'>2 Días</option>
		    			<option value='3'>3 Días</option>
		    			<option value='7'>7 Días</option>
		    			<option value='15'>15 Días</option>
		    			<option value='30'>1 Mes</option>
		    		</select>
				</div>
				<div class='col-md-8'>
					<input type='text' alt='".$ga->GetId()."' id='searchbform' class='form-control form-control searchbform_".$ga->GetId()." activarbuscador important' placeholder='Solicitar Revisión a:' ".$c->Ayuda('122', 'tog')." >
					<div id='bloquebusqueda' class='bloquebusqueda_".$ga->GetId()." bloquebusqueda'></div>
				</div>
			</div>
		</div>
	</div>
	<div class='row'>
		<div class='col-md-12'>
            <div class='form-group'>";
            	$gap = new MGestion_anexos_permisos;
	        	$qgap = $gap->ListarGestion_anexos_permisos("where id_documento = '".$ga->GetId()."'");
	        	$yz = 0;
	        	$ct = 0;
	        	$cp = 0;
	        	while ($rogap = $con->FetchAssoc($qgap)) {
	        		$ct++;
	        		if ($rogap['estado'] == "2") {
	        			$yz++;
	        		}
	        		if ($rogap['estado'] == "1") {
	        			$cp++;
	        		}
		        	$objectgap = new MGestion_anexos_permisos;
		        	$objectgap->CreateGestion_anexos_permisos("id", $rogap['id']);
	        		include(VIEWS.DS.'gestion_anexos_permisos/Listar.php');
	        	}
    echo  "       	
            </div>
        </div>
    </div>
    <div class='row'>
		<div class='col-md-12'>
            <div class='form-group'>";
            	if ($yz >= '1') {
					echo '
					<form action="/gestion_anexos/updatephoto/'.$ga->GetId().'/" id="formpicture'.$ga->GetId().'"  name="formpicture'.$ga->GetId().'" method="post" enctype="multipart/form-data">
						        <b><i>Volver a Cargar el Documento</i></b>
						        <input name="archivo" id="selfile'.$ga->GetId().'" type="file" size="35"/>
				    </form>
			      	<script>
			      		$("#selfile'.$ga->GetId().'").change(function() {
			      			$("#formpicture'.$ga->GetId().'").submit();
			      		});
			      	</script>';
				}elseif ($cp == $ct  && $col['estado'] == 3) {
					echo "<input type='button' class='btn btn-info' value='Activar Documento' onClick='ChangeStatusDoc(\"".$ga->GetId()."\", \"1\")'>";
				}
    echo  "       	
            </div>
        </div>
    </div>
    <div class='row'>
		<div class='form-group'>";
			$gap = new MGestion_anexos_permisos;
	        $qgap = $gap->ListarGestion_anexos_permisos("where id_documento = '".$ga->GetId()."' and usuario_permiso = '".$_SESSION['usuario']."'");

        	while ($rogap = $con->FetchAssoc($qgap)) {
	        	$objectgap = new MGestion_anexos_permisos;
	        	$objectgap->CreateGestion_anexos_permisos("id", $rogap['id']);
	        	if ($objectgap->GetEstado() == '0') {
        			include_once(VIEWS.DS.'gestion_anexos_permisos/FormUpdateGestion_anexos_permisos.php');
	        	}else{
	        		include_once(VIEWS.DS.'gestion_anexos_permisos/Listar.php');
	        	}
        	}
	echo "
		</div>
	</div>
	<div class='row'>
		<div class='form-group'>
			<ul class='sharelistdoc list-group' id='listlookfor_".$ga->GetId()."'></ul>
		</div>
	</div>";

 ?>
 <script type="text/javascript">
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
		            	parent.LoadModal('','Firmas del Documento - <?php echo $ga->GetNombre(); ?>','/gestion_anexos/fnfirmasdocumento/<?php echo $ga->GetId(); ?>/');
		            	$("#myregularmodalbtn").click();

		            }
		        });
		}else{
			if ($("#diasmaxtoresponse_"+$("#id_documento").val()).val() == "0") {
				Alert2("Debe seleccionar de primero los días para revisar el expediente");
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
			            	parent.LoadModal('','Firmas del Documento - <?php echo $ga->GetNombre(); ?>','/gestion_anexos/fnfirmasdocumento/<?php echo $ga->GetId(); ?>/');
			            	$("#myregularmodalbtn").click();
			            	//showfiles('/gestion/GetAnexos/<?= $id ?>/<?= $folder ?>/1/', 'cargador_box_upfiles_menu');
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