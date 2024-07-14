<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios_paquetes/listar/' ?>' >Listar usuarios_paquetes</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios_paquetes/nuevo/' ?>' >Crear usuarios_paquetes</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'usuarios_paquetes'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='usuarios_paquetes' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,Valor <input type='radio' id='cn' name='cn' value='valor'/>,Fecha <input type='radio' id='cn' name='cn' value='fecha'/>,Usuario <input type='radio' id='cn' name='cn' value='usuario'/>,Tipo <input type='radio' id='cn' name='cn' value='tipo'/>,   <input type='submit' value='Buscar usuarios_paquetes'>              
	</form>	
</div>-->


	<div class='title right'>Listado de usuarios_paquetes </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablausuarios_paquetes'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Nombre</th>
					<th class='th_act'>Valor</th>
					<th class='th_act'>Fecha</th>
					<th class='th_act'>Usuario</th>
					<th class='th_act'>Tipo</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MUsuarios_paquetes;
			$l->Createusuarios_paquetes('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td><?php echo $l -> GetValor(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td><?php echo $l -> GetUsuario(); ?></td> 
				<td><?php echo $l -> GetTipo(); ?></td> 
				<td>
	                <div style='float:left; margin-right:5px;' onclick='EditarUsuarios_paquetes(<?= $l->GetId() ?>)'>
						<div class='mini-ico green-editar' title='editar'></div>
					</div>

					<div style='float:left; margin-right:5px;'  onclick='EliminarUsuarios_paquetes(<?= $l->GetId() ?>)'>
	                    <div class='mini-ico green-eli' title='eliminar'></div>
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
		$('#Tablausuarios_paquetes').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarUsuarios_paquetes(id){
	if(confirm('Esta seguro desea eliminar este usuarios_paquetes')){
		var URL = '<?= HOMEDIR ?>usuarios_paquetes/eliminar/'+id+'/';
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

function EditarUsuarios_paquetes(id){
	var URL = '<?= HOMEDIR ?>usuarios_paquetes/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
