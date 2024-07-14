<h2>Otros usuarios con acceso al expediente</h2>
<div class="row">
	<div class="col-md-12">
		<div class="list-group">
			

<?
	global $c;
	global $f;
	while($row = $con->FetchAssoc($query)){
		$l = new MGestion_compartir;
		$l->Creategestion_compartir('id', $row[id]);

		$us = new MUsuarios;
		$us->CreateUsuarios("user_id", $l->GetUsuario_nuevo());

		$u = new MUsuarios;
		$u->CreateUsuarios("user_id", $l->GetUsuario_comparte());
?>						

		<div id='ror<?= $l->GetId() ?>' class="looksuscriptor list-group-item" >
			<div class="row">
				<div class="col-md-11 col-sm-11">
					<h4><?php echo $us->GetP_nombre()." ".$us->GetP_apellido() ?></h4>
				</div>
				<div class="col-md-1 col-sm-1">
					<?
						if ($_SESSION['mayedit'] == "1") {
					?>
							<?php if($_SESSION['eliminar'] == 1){ ?>
							<span onclick='EliminarGestion_compartir(<?= $l->GetId() ?>)'>
				                <span class='mdi mdi-delete btn btn-danger btn-circle' title='eliminar'></span>
				            </span>
				            <?php } ?>
		            <?
		        		}
		            ?>
				</div>
			</div>

			<div class="row m-t-20">
				<div class="col-md-4">
					<label class="col-md-12">
						Compartido por: 
					</label>
					<div class="col-md-12">
						<?php echo $u->GetP_nombre()." ".$u->GetP_apellido() ?>
					</div>
				</div>
				<div class="col-md-4">
					<label class="col-md-12">
						Fecha de Activación:
					</label>
					<div class="col-md-12">
						<?= $f->ObtenerFecha4($l -> GetFecha()); ?>
					</div>
				</div>
				<div class="col-md-4">
					<label class="col-md-12">
						Tipo de Cuenta:
					</label>
					<div class="col-md-12">
						<?= ($l->GetType() == "1")?"El usuario puede interactuar":"El usuario solo puede consultar"; ?>
					</div>
				</div>
			</div>
			<div class="row m-t-10">
				<div class="col-md-6">
					<label class="col-md-12">
						Fecha de Caducidad: 
					</label>
					<div class="col-md-12">
						<?= ($l -> Getfecha_caducidad() == '0000-00-00')?"∞":"".$f->ObtenerFecha4($l->Getfecha_caducidad()); ?>
					</div>
				</div>
				<div class="col-md-6">
					<label class="col-md-12">
						Estado del permiso:
					</label>
					<div class="col-md-12">
						<?= ($l -> Getfecha_caducidad() >= date('Y-m-d') || $l -> Getfecha_caducidad() == '0000-00-00')?"Activo":"Inactivo"; ?>
					</div>
				</div>
			</div>
			<div class="row m-t-10">
				<div class="col-md-6">
					<label class="col-md-12">
						Observación:
					</label>
					<div class="col-md-12">
						<?= $l -> GetObservacion() ; ?>
					</div>
				</div>
			</div>
		</div>
<?
	}
?>
		</div>
	</div>
</div>
<style type="text/css">
	.looksuscriptor:hover{ background-color: #f5f5f5; }
	.looksuscriptor{ padding: 20px; }
</style>
<script>

function EliminarGestion_compartir(id){
	if(confirm('Esta seguro desea eliminar este gestion_compartir')){
		var URL = '/gestion_compartir/eliminar/'+id+'/';
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
</script>		
