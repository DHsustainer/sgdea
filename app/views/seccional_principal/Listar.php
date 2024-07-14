	<table class='table table-striped' id='Tablaseccional_principal'>
       	<thead>
			<tr class='encabezadot'>
				<th class="th_act">Nombre</th>
				<th class="th_act">Cod. Ciudad</th>
				<th class="th_act">OP</th>
			</tr>
		</thead>
		<tbody>
<?
	while($row = $con->FetchAssoc($query)){
		$l = new MSeccional_principal;
		$l->Createseccional_principal('id', $row[id]);
?>						
		<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
			<td><?php echo $l -> GetNombre(); ?></td> 

			<td><?php echo $l -> GetCiudad_origen(); ?></td> 
			<td>
				<span onclick='EditarSeccional_principal(<?= $l->GetId() ?>)'  <?= $c->Ayuda('129', 'tog') ?> >
						<div class="mdi mdi-pencil btn btn-circle btn-info" title="editar"></div>
				</span>
				
				<span onclick="select_gestOficinas('juz-per',this, '<?= $l->GetId() ?>')"  <?= $c->Ayuda('130', 'tog') ?> >
					<div class="mdi mdi-home-modern btn btn-circle btn-warning" title="Ver Oficinas"></div>
				</span>

				<span onclick='EliminarSeccional_principal(<?= $l->GetId() ?>)'  <?= $c->Ayuda('131', 'tog') ?> >
                    <div class="mdi mdi-delete btn btn-circle btn-danger" title="eliminar"></div>
                </span>
            </td>	       
		</tr>
<?
	}
?>			</tbody>
	</table>
<script>
	function EliminarSeccional_principal(id){
		if(confirm('Esta seguro desea eliminar esta Ciudad')){
			var URL = '/seccional_principal/eliminar/'+id+'/';
			$.ajax({
				type: 'POST',
				url: URL,
				success: function(msg){
					alert(msg);
					window.location.reload();
				}
			});
		}
	}	

	function EditarSeccional_principal(id){
		var URL = '/seccional_principal/editar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				$("#crear-nota").html(msg);
			}
		});
	}	
</script>