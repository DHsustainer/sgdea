<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios_funcionalidades/listar/' ?>' >Listar usuarios_funcionalidades</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios_funcionalidades/nuevo/' ?>' >Crear usuarios_funcionalidades</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'usuarios_funcionalidades'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='usuarios_funcionalidades' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Id_funcionalidad <input type='radio' id='cn' name='cn' value='id_funcionalidad'/>,Valor <input type='radio' id='cn' name='cn' value='valor'/>,   <input type='submit' value='Buscar usuarios_funcionalidades'>              
	</form>	
</div>-->


	<div class='title right'>Listado de usuarios_funcionalidades </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablausuarios_funcionalidades'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>User_id</th>
					<th class='th_act'>Id_funcionalidad</th>
					<th class='th_act'>Valor</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MUsuarios_funcionalidades;
			$l->Createusuarios_funcionalidades('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetId_funcionalidad(); ?></td> 
				<td><?php echo $l -> GetValor(); ?></td> 
				<td>
	                <div onclick='EditarUsuarios_funcionalidades(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarUsuarios_funcionalidades(<?= $l->GetId() ?>)'>
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
		$('#Tablausuarios_funcionalidades').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarUsuarios_funcionalidades(id){
	if(confirm('Esta seguro desea eliminar este usuarios_funcionalidades')){
		var URL = '<?= HOMEDIR ?>usuarios_funcionalidades/eliminar/'+id+'/';
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

function EditarUsuarios_funcionalidades(id){
	var URL = '<?= HOMEDIR ?>usuarios_funcionalidades/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
