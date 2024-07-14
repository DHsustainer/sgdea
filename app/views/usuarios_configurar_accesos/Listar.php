<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios_configurar_accesos/listar/' ?>' >Listar usuarios_configurar_accesos</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios_configurar_accesos/nuevo/' ?>' >Crear usuarios_configurar_accesos</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'usuarios_configurar_accesos'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='usuarios_configurar_accesos' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Tabla <input type='radio' id='cn' name='cn' value='tabla'/>,Id_tabla <input type='radio' id='cn' name='cn' value='id_tabla'/>,   <input type='submit' value='Buscar usuarios_configurar_accesos'>              
	</form>	
</div>-->


	<div class='title right'>Listado de usuarios_configurar_accesos </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablausuarios_configurar_accesos'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>User_id</th>
					<th class='th_act'>Tabla</th>
					<th class='th_act'>Id_tabla</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MUsuarios_configurar_accesos;
			$l->Createusuarios_configurar_accesos('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetTabla(); ?></td> 
				<td><?php echo $l -> GetId_tabla(); ?></td> 
				<td>
	                <div onclick='EditarUsuarios_configurar_accesos(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarUsuarios_configurar_accesos(<?= $l->GetId() ?>)'>
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
		$('#Tablausuarios_configurar_accesos').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarUsuarios_configurar_accesos(id){
	if(confirm('Esta seguro desea eliminar este usuarios_configurar_accesos')){
		var URL = '<?= HOMEDIR ?>usuarios_configurar_accesos/eliminar/'+id+'/';
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

function EditarUsuarios_configurar_accesos(id){
	var URL = '<?= HOMEDIR ?>usuarios_configurar_accesos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
