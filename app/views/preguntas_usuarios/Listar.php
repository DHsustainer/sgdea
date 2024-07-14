<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'preguntas_usuarios/listar/' ?>' >Listar preguntas_usuarios</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'preguntas_usuarios/nuevo/' ?>' >Crear preguntas_usuarios</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'preguntas_usuarios'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='preguntas_usuarios' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_pregunta <input type='radio' id='cn' name='cn' value='id_pregunta'/>,Respuesta <input type='radio' id='cn' name='cn' value='respuesta'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Username <input type='radio' id='cn' name='cn' value='username'/>,   <input type='submit' value='Buscar preguntas_usuarios'>              
	</form>	
</div>-->


	<div class='title right'>Listado de preguntas_usuarios </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablapreguntas_usuarios'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Id_pregunta</th>
					<th class='th_act'>Respuesta</th>
					<th class='th_act'>Fecha</th>
					<th class='th_act'>Username</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MPreguntas_usuarios;
			$l->Createpreguntas_usuarios('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_pregunta(); ?></td> 
				<td><?php echo $l -> GetRespuesta(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetUsername(); ?></td> 
				<td>
	                <div onclick='EditarPreguntas_usuarios(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarPreguntas_usuarios(<?= $l->GetId() ?>)'>
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
		$('#Tablapreguntas_usuarios').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarPreguntas_usuarios(id){
	if(confirm('Esta seguro desea eliminar este preguntas_usuarios')){
		var URL = '<?= HOMEDIR ?>preguntas_usuarios/eliminar/'+id+'/';
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

function EditarPreguntas_usuarios(id){
	var URL = '<?= HOMEDIR ?>preguntas_usuarios/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
