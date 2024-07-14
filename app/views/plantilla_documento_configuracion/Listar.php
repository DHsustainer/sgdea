<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'plantilla_documento_configuracion/listar/' ?>' >Listar plantilla_documento_configuracion</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'plantilla_documento_configuracion/nuevo/' ?>' >Crear plantilla_documento_configuracion</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'plantilla_documento_configuracion'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='plantilla_documento_configuracion' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Ultima_modificacion <input type='radio' id='cn' name='cn' value='ultima_modificacion'/>,Tipo <input type='radio' id='cn' name='cn' value='tipo'/>,M_t <input type='radio' id='cn' name='cn' value='m_t'/>,M_r <input type='radio' id='cn' name='cn' value='m_r'/>,M_b <input type='radio' id='cn' name='cn' value='m_b'/>,M_l <input type='radio' id='cn' name='cn' value='m_l'/>,M_e_t <input type='radio' id='cn' name='cn' value='m_e_t'/>,M_e_b <input type='radio' id='cn' name='cn' value='m_e_b'/>,M_p_t <input type='radio' id='cn' name='cn' value='m_p_t'/>,M_p_b <input type='radio' id='cn' name='cn' value='m_p_b'/>,Fuente <input type='radio' id='cn' name='cn' value='fuente'/>,Tamano <input type='radio' id='cn' name='cn' value='tamano'/>,   <input type='submit' value='Buscar plantilla_documento_configuracion'>              
	</form>	
</div>-->


	<div class='title right'>Listado de plantilla_documento_configuracion </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaplantilla_documento_configuracion'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Ultima_modificacion</th>
					<th class='th_act'>Tipo</th>
					<th class='th_act'>M_t</th>
					<th class='th_act'>M_r</th>
					<th class='th_act'>M_b</th>
					<th class='th_act'>M_l</th>
					<th class='th_act'>M_e_t</th>
					<th class='th_act'>M_e_b</th>
					<th class='th_act'>M_p_t</th>
					<th class='th_act'>M_p_b</th>
					<th class='th_act'>Fuente</th>
					<th class='th_act'>Tamano</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MPlantilla_documento_configuracion;
			$l->Createplantilla_documento_configuracion('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUltima_modificacion(); ?></td> 
				<td><?php echo $l -> GetTipo(); ?></td> 
				<td><?php echo $l -> GetM_t(); ?></td> 
				<td><?php echo $l -> GetM_r(); ?></td> 
				<td><?php echo $l -> GetM_b(); ?></td> 
				<td><?php echo $l -> GetM_l(); ?></td> 
				<td><?php echo $l -> GetM_e_t(); ?></td> 
				<td><?php echo $l -> GetM_e_b(); ?></td> 
				<td><?php echo $l -> GetM_p_t(); ?></td> 
				<td><?php echo $l -> GetM_p_b(); ?></td> 
				<td><?php echo $l -> GetFuente(); ?></td> 
				<td><?php echo $l -> GetTamano(); ?></td> 
				<td>
	                <div onclick='EditarPlantilla_documento_configuracion(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarPlantilla_documento_configuracion(<?= $l->GetId() ?>)'>
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
		$('#Tablaplantilla_documento_configuracion').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarPlantilla_documento_configuracion(id){
	if(confirm('Esta seguro desea eliminar este plantilla_documento_configuracion')){
		var URL = '<?= HOMEDIR ?>plantilla_documento_configuracion/eliminar/'+id+'/';
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

function EditarPlantilla_documento_configuracion(id){
	var URL = '<?= HOMEDIR ?>plantilla_documento_configuracion/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
