<div class="da-message success">En este panel puede configurar los permisos que se pueden asignar a cada documento generado</div>
<div id="gestion-actuaciones2">
	<div class='title right'>Listado de Documentos Genericos</div>
	<div class="table">
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaplantilla_dependencia'>
           	<thead>
				<tr class='encabezadot'>
					<th class='th_act'>Nombre</th>
					<th width="100px" class='th_act'>F_creacion</th>
					<th width="80px"class='th_act'></th>
				</tr>
			</thead>
			<tbody>
<?
		while($row = $con->FetchAssoc($query)){
			$l = new MPlantilla_dependencia;
			$l->Createplantilla_dependencia('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td><?php echo $l -> GetF_creacion(); ?></td> 
				<td>
	                <div onclick='VerPermisosElementos(<?= $l->GetId() ?>)'>
						<div class='mini-ico green-dep' title='editar'></div>
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
		<div class="alert alert-info">Seleccione una Tipología Documental</div>
	</div>
</div>


<script>

 
 	$(function() {		
		$('#Tablaplantilla_dependencia').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarPlantilla_dependencia(id){
	if(confirm('Esta seguro desea eliminar este plantilla_dependencia')){
		var URL = '/plantilla_dependencia/eliminar/'+id+'/';
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

function VerPermisosElementos(id){
	var URL = '/dependencias_permisos_documento/listar/'+id+'/<?= $id ?>/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#loadpathformtipologias').html(msg);
		}
	});
}	
</script>		
