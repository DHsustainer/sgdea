	<div class='title right'>Listado de dependencias_tipologias_referencias </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tabladependencias_tipologias_referencias'>
           	<thead>
				<tr class='encabezado'>
					<th class='th_act'>Title</th>
					<th class='th_act'></th>
				</tr>
			</thead>

			<tbody>

<?
		
		$dp = new MDependencias_tipologias_referencias;
		$query = $dp->ListarDependencias_tipologias_referencias("WHERE id_dependencia = '".$x."'");

		while($row = $con->FetchAssoc($query)){
			$l = new MDependencias_tipologias_referencias;
			$l->Createdependencias_tipologias_referencias('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetTitle(); ?></td> 
				
				<td>
	                <div onclick='EditarDependencias_tipologias_referencias(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarDependencias_tipologias_referencias(<?= $l->GetId() ?>)'>
	                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
	                </div>
		        </td>	       
			</tr>
<?
		}
?>			</tbody>
		</table>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 
 	$(function() {		
		$('#Tabladependencias_tipologias_referencias').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarDependencias_tipologias_referencias(id){
	if(confirm('Esta seguro desea eliminar este dependencias_tipologias_referencias')){
		var URL = '<?= HOMEDIR ?>dependencias_tipologias_referencias/eliminar/'+id+'/';
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

function EditarDependencias_tipologias_referencias(id){
	var URL = '<?= HOMEDIR ?>dependencias_tipologias_referencias/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
