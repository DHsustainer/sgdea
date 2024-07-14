    <div id="form-oficinas2" class="left table">
    	<? 
    		include(VIEWS.DS."dependencias_permisos_documento".DS."FormInsertDependencias_permisos_documento.php");
    	?>
    </div>

	
	<div class='title right'>Usuarios que deben firmar el Documento <?= $docto->GetNombre() ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tabladependencias_permisos_documento'>
           	<thead>
				<tr class='encabezadot'>
					<th class='th_act'>Nombre del Usuario</th>
					<th class="th_act" width="30px" class='th_act'></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MDependencias_permisos_documento;
			$l->Createdependencias_permisos_documento('id', $row[id]);

			$us = new MUsuarios;
			$us->CreateUsuarios("user_id", $l->GetUsuario_permiso());

			if ($us->GetP_nombre() != "") {
				$name = ucwords(strtolower($us->GetP_nombre()." ".$us->GetP_apellido()));
			}else{
				if ($l->GetUsuario_permiso() == "areaboss") {
					$name = "Jefe de ".CAMPOAREADETRABAJO;
				}
			}
?>						
			<tr id='row<?= $l->GetId() ?>' class='tblresult'> 
				<td><?= $name ?></td> 
				<td>
					<div onclick='EliminarDependencias_permisos_documento(<?= $l->GetId() ?>)'>
	                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
	                </div>
		        </td>	       
			</tr>
<?
		}
?>			</tbody>
		</table>
<script>
 	$(function() {		
		$('#Tabladependencias_permisos_documento').tablesorter({sortList:[[0,0]]});
	});	
	
function EliminarDependencias_permisos_documento(id){
	if(confirm('Esta seguro desea eliminar este dependencias_permisos_documento')){
		var URL = '/dependencias_permisos_documento/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert(msg);
				$('#row'+id).remove();
			}
		});
	}
	
}	
</script>		
