<table border='0' cellspacing='0' cellpadding='3' width='100%' class='table table-striped' id='Tablaestados_gestion'>
   	<thead>
		<tr class='encabezadot'>
			<th class="th_act">Nombre</th>
			<th width="100px" class="th_act">OP</th>
		</tr>
	</thead>
	<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MEstados_gestion;
			$l->Createestados_gestion('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td width="100px">
	                <span class="btn btn-info btn-circle" onclick='EditarEstados_gestion(<?= $l->GetId() ?>)'>
						<span class='mdi mdi-pencil'  <?= $c->Ayuda('206', 'tog') ?>></span>
					</span>

					<span class='btn btn-warning btn-circle' onclick='EliminarEstados_gestion(<?= $l->GetId() ?>)'>
	                    <span class='mdi mdi-delete'  <?= $c->Ayuda('207', 'tog') ?>></span>
	                </span>
		        </td>	       
			</tr>
<?
		}
?>			</tbody>
		</table>
<script>
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 /*
 	$(function() {		
		$('#Tablaestados_gestion').tablesorter({sortList:[[0,0]]});
	});	*/
	

function EliminarEstados_gestion(id){
	if(confirm('Esta seguro desea eliminar este estados_gestion')){
		var URL = '/estados_gestion/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
					$('#r'+id).slideUp();
			}
		});
	}
	
}	

function EditarEstados_gestion(id){
	var URL = '/estados_gestion/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#insertdependenciafirst').html(msg);
		}
	});
}	
</script>		
