<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'mod_versiones/listar/' ?>' >Listar mod_versiones</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'mod_versiones/nuevo/' ?>' >Crear mod_versiones</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'mod_versiones'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='mod_versiones' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_modulo <input type='radio' id='cn' name='cn' value='id_modulo'/>,Titulo <input type='radio' id='cn' name='cn' value='titulo'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Autor <input type='radio' id='cn' name='cn' value='autor'/>,Url_instalacion <input type='radio' id='cn' name='cn' value='url_instalacion'/>,Url_actualizacion <input type='radio' id='cn' name='cn' value='url_actualizacion'/>,Url_sql <input type='radio' id='cn' name='cn' value='url_sql'/>,Notas <input type='radio' id='cn' name='cn' value='notas'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Requerimientos <input type='radio' id='cn' name='cn' value='requerimientos'/>,Tipo_version <input type='radio' id='cn' name='cn' value='tipo_version'/>,   <input type='submit' value='Buscar mod_versiones'>              
	</form>	
</div>-->


	<div class='title right'>Listado de mod_versiones </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablamod_versiones'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Id_modulo</th>
					<th class='th_act'>Titulo</th>
					<th class='th_act'>Fecha</th>
					<th class='th_act'>Autor</th>
					<th class='th_act'>Url_instalacion</th>
					<th class='th_act'>Url_actualizacion</th>
					<th class='th_act'>Url_sql</th>
					<th class='th_act'>Notas</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Requerimientos</th>
					<th class='th_act'>Tipo_version</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MMod_versiones;
			$l->Createmod_versiones('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_modulo(); ?></td> 
				<td><?php echo $l -> GetTitulo(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetAutor(); ?></td> 
				<td><?php echo $l -> GetUrl_instalacion(); ?></td> 
				<td><?php echo $l -> GetUrl_actualizacion(); ?></td> 
				<td><?php echo $l -> GetUrl_sql(); ?></td> 
				<td><?php echo $l -> GetNotas(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetRequerimientos(); ?></td> 
				<td><?php echo $l -> GetTipo_version(); ?></td> 
				<td>
	                <div onclick='EditarMod_versiones(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarMod_versiones(<?= $l->GetId() ?>)'>
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
		$('#Tablamod_versiones').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarMod_versiones(id){
	if(confirm('Esta seguro desea eliminar este mod_versiones')){
		var URL = '<?= HOMEDIR ?>mod_versiones/eliminar/'+id+'/';
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

function EditarMod_versiones(id){
	var URL = '<?= HOMEDIR ?>mod_versiones/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
