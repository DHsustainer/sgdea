<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'plantillas_email/listar/' ?>' >Listar plantillas_email</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'plantillas_email/nuevo/' ?>' >Crear plantillas_email</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'plantillas_email'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='plantillas_email' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Tipo <input type='radio' id='cn' name='cn' value='tipo'/>,Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,Contenido <input type='radio' id='cn' name='cn' value='contenido'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,   <input type='submit' value='Buscar plantillas_email'>              
	</form>	
</div>-->


	<div class='title right'>Listado de plantillas_email </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaplantillas_email'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Tipo</th>
					<th class='th_act'>Nombre</th>
					<th class='th_act'>Contenido</th>
					<th class='th_act'>Fecha</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MPlantillas_email;
			$l->Createplantillas_email('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetTipo(); ?></td> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td><?php echo $l -> GetContenido(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td>
	                <div onclick='EditarPlantillas_email(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarPlantillas_email(<?= $l->GetId() ?>)'>
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
		$('#Tablaplantillas_email').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarPlantillas_email(id){
	if(confirm('Esta seguro desea eliminar este plantillas_email')){
		var URL = '<?= HOMEDIR ?>plantillas_email/eliminar/'+id+'/';
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

function EditarPlantillas_email(id){
	var URL = '<?= HOMEDIR ?>plantillas_email/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
