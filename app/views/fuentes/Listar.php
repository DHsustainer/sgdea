<div class="row">
<?
	global $con;
	while($row = $con->FetchAssoc($query)){
		$l = new MFuentes;
		$l->Createfuentes('id', $row[id]);
?>	
		<div class="col-md-6">
		<style type="text/css">
		@font-face{
		   font-family: "<?= $l -> GetNombre() ?>";
		   src: url(<?= HOMEDIR ?>/app/views/assets/fonts/<?= $l -> GetUrl() ?>);
		}

		.show_font_<?= $l->GetId() ?>{
			font-family: "<?= $l -> GetNombre() ?>";
			font-size: 25px;
		}

		</style>	
			<div class="jumbotron" id='r<?= $l->GetId() ?>'>
				<div class="pull-right"  onclick='EliminarFuentes(<?= $l->GetId() ?>)'>
			        <div class='btn btn-warning btn-circle mdi mdi-delete' title='Eliminar Fuente'></div>
			    </div>
				<div class="pull-left show_font_<?= $l->GetId() ?>">
					Sonreír es gratis
				</div>
			</div>
		</div>
<?
	}
?>			
</div>
<script>

function EliminarFuentes(id){
	if(confirm('Esta seguro desea eliminar este fuentes')){
		var URL = '/fuentes/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				$('#r'+id).remove();
			}
		});
	}
	
}	

function EditarFuentes(id){
	var URL = '/fuentes/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
