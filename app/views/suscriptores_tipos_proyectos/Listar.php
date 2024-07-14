	<div class='title right'>Listado de Proyectos</div>
		<div class="list-group">
<?
		while($row = $con->FetchAssoc($query)){
			$l = new MSuscriptores_tipos_proyectos;
			$l->Createsuscriptores_tipos_proyectos('id', $row[id]);
?>					
			<div class="list-group-item" id='r<?= $l->GetId() ?>'>
					<?php echo $l -> GetNombre(); ?>
				<!--
				<a href="/suscriptores_modulos/<?= $l->GetId() ?>/">
				</a> 
				<small>
				Registrado el <?php echo $l -> GetFecha(); ?>
				<br>
				<?php # echo $l -> GetTipo_proyecto(); ?>
				</small>
				-->
			

				<div style="float:right"  id="option<?= $l->GetId() ?>" onclick='EditarSuscriptores_tipos_proyectos(<?= $l->GetId() ?>, <?= ($l->GetEstado()== '1')?'0':'1' ?>)' title="Activar/Desactivar Proyecto" class="on_off_icon <?= ($l->GetEstado()== '1')?'on':'off' ?>"></div>

				<a href="/suscriptores_modulos/listar/<?= $l->GetId() ?>/" class="icono fa fa-gears" title="Configuración de Modulos">
					
				</a>

			</div>		
<?
		}
?>
		</div>

<style>
	
	.icono {
		float:right;
		margin-right: 5px;
		font-size: 17px;
		cursor: pointer;
		color:#FFF;
		color:#337ab7;
		padding:5px;
		border-radius: 4px;
		margin-top:-3px;
	}
	.icono:hover{
		background-color: #DEDEDE;
		color:#337ab7;
	}
</style>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 
 	$(function() {		
		$('#Tablasuscriptores_tipos_proyectos').tablesorter({sortList:[[0,0]]});
	});	
	


function EditarSuscriptores_tipos_proyectos(id, estado){
	var URL = '/suscriptores_tipos_proyectos/actualizar/'+id+'/'+estado+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			window.location.reload();
		}
	});
}	
</script>		
