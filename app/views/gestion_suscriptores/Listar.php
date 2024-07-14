<h2>Listado de Suscriptores Agregados</h2>
<div class="list-group list-group-hover list-group-striped">
<?
	global $c;
	global $f;
	while($row = $con->FetchAssoc($query)){
		$l = new MGestion_suscriptores;
		$l->Creategestion_suscriptores('id', $row[id]);

		$sus = new MSuscriptores_contactos;
		$sus->CreateSuscriptores_contactos("id", $l -> GetId_suscriptor());

		$susd = new MSuscriptores_contactos_direccion;
		$susd->CreateSuscriptores_contactos_direccion("id_contacto", $sus->GetId());

		$u = new MUsuarios;
		$u->CreateUsuarios("user_id", $l -> GetUsuario_id());

		$date = $con->Result($con->Query("Select fecha from logins where username = '".$l->GetId_suscriptor()."'"), 0, "fecha");

		if ($date != "") {
			$date = $f->ObtenerFecha4($date);
		}else{
			$date = "El suscriptor aún no ha iniciado sesión";
		}

		$lx = new MSuscriptores_tipos;
		$lx->CreateSuscriptores_tipos("id", $sus->GetType());
?>		
		<div id='ror<?= $l->GetId() ?>' class="list-group-item p-t-20 p-b-20" >
			<div class="row">
				<div class="col-md-10"><h4 style="text-transform: uppercase"><b><?php echo $sus->GetNombre() ?></b> <br><?= $lx->GetNombre(); ?></h4></div>
			<?
				if ($_SESSION['mayedit'] == "1") {
			?>
					<div class="col-md-2">
					<?php if($_SESSION['eliminar'] == 1){ ?>
						<span onclick='EliminarGestion_suscriptores(<?= $l->GetId() ?>)'>
			                <span class='mdi mdi-delete btn btn-danger btn-circle' title='eliminar'></span>
			            </span>
		            <?php } ?>
		            <?php if($_SESSION['editar'] == 1){ ?>
				        <span onclick='EditarGestion_suscriptores(<?= $l->GetId() ?>)'>
							<span class='mdi mdi-pencil btn btn-info btn-circle' title='editar'></span>
						</span>
					<?php } ?>
					</div>
			<?
				}
			?>
			</div>
			<div class="row m-b-10">
				<div class="col-md-1">
					<span  id="option<?= $row[id]; ?>" data-role="<?= ($row[estado]== '1')?'0':'1' ?>" onclick='EditarSuscriptores_funcionalidades(<?= $row[id]; ?>)' title="Activar/Desactivar Permiso" class="mdi mdi-toggle-switch<?= ($row[estado]== '1')?' text-success':'-off text-muted' ?> icon"></span>
				</div>
				<div class="col-md-11" style="padding-top:7px; padding-left:0px;"> 
					<b>
						Notificar al Suscriptor las actuaciones publicas que se realicen en este expediente
					</b>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"><b>E-mail: </b></div>
				<div class="col-md-10"> <?= $susd->GetEmail() ?></div>
			</div>
			<div class="row m-t-10">
				<div class="col-md-2"><b>Dirección: </b></div>
				<div class="col-md-6"> <?= $susd->GetDireccion()." - ".$susd->GetCiudad(); ?></div>
				<div class="col-md-2"><b>Teléfono: </b></div>
				<div class="col-md-2"> <?= $susd->GetTelefonos(); ?></div>
			</div>
			<div class="row m-t-10">
				<div class="col-md-4">
					<b>Registrado por</b><br>
					<?php echo $u->GetP_nombre()." ".$u->GetP_apellido() ?>
				</div>
				<div class="col-md-3">
					<b>Registado el</b><br>
					<?= str_replace("00:00:00 ", "", $f->ObtenerFecha($l -> GetFecha())); ?>
				</div>
				<div class="col-md-5">
					<b>Tipo de Cuenta</b><br>
					<?= ($l->GetType() == "1")?"El suscriptor puede interactuar":"El suscriptor solo puede consultar"; ?>
				</div>
				<div class="col-md-6 dn">
					<b>Último inicio de sesión:</b><br>
					<?= $date ; ?>
				</div>
			</div>
		<?  if ($_SESSION['MODULES']['acceso_suscriptores'] == "1") { ?>
			<div class="row m-t-10">
				<div class="col-md-4">
					<b>Codigo de Ingreso:</b><br>
					<?= $sus->GetCod_ingreso(); ?>		
				</div>
				<div class="col-md-4">
					<b>Clave:</b><br>
					********
				</div>
				<div class="col-md-4">
					<input type='button' class="btn btn-warning " value='Enviar Datos de Acceso' onClick="SendDataCliente('<?= $sus->GetId() ?>', '<?= $id_gestion ?>')"/>
				</div>
			</div>
		<? } ?>
		</div>				
<?
	}
?>
</div>
<script>
function EliminarGestion_suscriptores(id){
	if(confirm('Esta seguro desea eliminar este suscriptor del expediente')){
		var URL = '/gestion_suscriptores/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				if(msg == 'OK!')
					$('#ror'+id).remove();
			}
		});
	}
	
}	

function EditarGestion_suscriptores(id){
	var URL = '/gestion_suscriptores/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#ror'+id).html(msg);
		}
	});
}

function EditarSuscriptores_funcionalidades(id){

 	valor = $("#option"+id).attr("data-role");	
 	var URL = '/gestion_suscriptores/actualizarestado/'+id+'/'+valor+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			if (valor == "1") {
				$("#option"+id).removeClass("text-muted");
				$("#option"+id).addClass("text-success");
				$("#option"+id).removeClass("mdi-toggle-switch-off");
				$("#option"+id).addClass("mdi-toggle-switch");
				$("#option"+id).attr("data-role", "0");
			}else{
				$("#option"+id).removeClass("text-success");
				$("#option"+id).removeClass("mdi-toggle-switch");
				$("#option"+id).addClass("mdi-toggle-switch-off");
				$("#option"+id).addClass("text-muted");
				$("#option"+id).attr("data-role", "1");
			}
			mensaje = "El estado a sido actualizado: "+msg;

			$.toast({
                heading: '',
                text: mensaje,
                position: 'top-right',
                loaderBg:'#ff6849',
                icon: 'info',
                hideAfter: 3000, 
                stack: 6
            });
		}
	});
}

</script>			
<style>
	div.list-group.list-group-striped > div:nth-of-type(odd){
	    background: #FFFFFF;
	}
	div.list-group.list-group-striped > div:nth-of-type(even){
	    background: #F6F6F6;
	}
	div.list-group.list-group-hover > div:hover{
	  /*  background: red; */
	}
</style>