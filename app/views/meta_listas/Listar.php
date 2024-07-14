	<div class="tmain">Listas de selección</div>
	<div class="align-right margin_bottom">
		<div class="btn-group">
			<a class="btn btn-success" onclick="GetQuery('/meta_listas/nuevo/','alistas', 'inner-metadatosjs')">
				<span class="fa fa-plus-circle"></span>
				<span>Nueva Lista</span>
			</a>
		</div>    
	</div>

	<div id="Listado">
		<div class="list-group" id="listadoelementos">
<?
		while($row = $con->FetchAssoc($query)){
			$l = new MMeta_listas;
			$l->Createmeta_listas('id', $row[id]);
?>						
		  	<a href="#" class="list-group-item" id="r<?= $l->GetId() ?>" onclick="GetQuery('/meta_listas/editar/<?= $l->GetId() ?>/', 'r<?= $l->GetId() ?>', 'inner-metadatosjs')">
		    	<h4 class="list-group-item-heading"><?php echo utf8_decode($l -> GetTitulo()); ?></h4>
		  	</a>

	                <!--<div onclick='EditarMeta_listas(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarMeta_listas(<?= $l->GetId() ?>)'>
	                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
	                </div>-->
<?
		}
?>		
		</div>
	</div>
<script>
function EliminarMeta_listas(id){
	if(confirm('Esta seguro desea eliminar este meta_listas')){
		var URL = '<?= HOMEDIR ?>meta_listas/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				if(msg == 'OK!')
					$('#r'+id).slideUp();
			}
		});
	}
	
}	

function EditarMeta_listas(id){
	var URL = '<?= HOMEDIR ?>meta_listas/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
