<div class="da-message success">En este panel se pueden crear los documentos que deben ser diligenciados de forma obligatoria por cada radicación creada</div>
<div id="gestion-actuaciones2">
    <div id="form-oficinas2" class="left table">
    	<? 
    		include(VIEWS.DS."dependencias_documentos".DS."FormInsertDependencias_documentos.php");
    	?>
    </div>

	<div class='title right'>Listado de Documentos Obligatorios </div>
	<div class="table">
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tabladependencias_documentos'>
           	<thead>
				<tr class='encabezadot'>
					<th class='th_act'>Nombre</th>
					<th style="width:80px" class='th_act'>Fecha</th>
					<th style="width:80px" class='th_act'></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MDependencias_documentos;
			$l->Createdependencias_documentos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td id='col<?= $l->GetId() ?>' ><?php echo $l -> GetNombre(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td>
	                <div onclick='EditarDependencias_documentos(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarDependencias_documentos(<?= $l->GetId() ?>)'>
	                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
	                </div>
		        </td>	       
			</tr>
<?
		}
?>			</tbody>
		</table>
	</div>
</div>
<div id="gestion-actuaciones">
	<div id="loadpathformtipologias" style="margin:10px;">
		<div class="alert alert-info">Seleccione un Documento</div>
	</div>
</div>

<script>

 	$(function() {		
		$('#Tabladependencias_documentos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarDependencias_documentos(id){
	if(confirm('Esta seguro desea eliminar este dependencias_documentos')){
		var URL = '/dependencias_documentos/eliminar/'+id+'/';
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

function EditarDependencias_documentos(id){
	var URL = '/dependencias_documentos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#loadpathformtipologias').html(msg);
		}
	});
}	
</script>		
