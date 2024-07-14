<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'control_versiones/listar/' ?>' >Listar control_versiones</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'control_versiones/nuevo/' ?>' >Crear control_versiones</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'control_versiones'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='control_versiones' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Tipo <input type='radio' id='cn' name='cn' value='tipo'/>,Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,Archivos <input type='radio' id='cn' name='cn' value='archivos'/>,Estructura_db <input type='radio' id='cn' name='cn' value='estructura_db'/>,Datos_db <input type='radio' id='cn' name='cn' value='datos_db'/>,   <input type='submit' value='Buscar control_versiones'>              
	</form>	
</div>-->


	<div class='title right'>Listado de control versiones </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablacontrol_versiones'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Tipo</th>
					<th class='th_act'>Nombre</th>
					<th class='th_act'>Archivos</th>
					<th class='th_act'>Estructura DB</th>
					<th class='th_act'>Datos DB</th>
					<!--<th></th>-->
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MControl_versiones;
			$l->Createcontrol_versiones('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetTipo(); ?></td> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td>...<?php echo substr($l -> GetArchivos(),-10); ?></td> 
				<td>...<?php echo substr($l -> GetEstructura_db(),-10); ?></td> 
				<td>...<?php echo substr($l -> GetDatos_db(),-10); ?></td> 
				<!--<td>
	                <div onclick='EditarControl_versiones(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarControl_versiones(<?= $l->GetId() ?>)'>
	                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
	                </div>
		        </td>	   -->    
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
		$('#Tablacontrol_versiones').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarControl_versiones(id){
	if(confirm('Esta seguro desea eliminar este control_versiones')){
		var URL = '<?= HOMEDIR ?>control_versiones/eliminar/'+id+'/';
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

function EditarControl_versiones(id){
	var URL = '<?= HOMEDIR ?>control_versiones/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
