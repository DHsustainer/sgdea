<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios_configurar_firma_digital/listar/' ?>' >Listar usuarios_configurar_firma_digital</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios_configurar_firma_digital/nuevo/' ?>' >Crear usuarios_configurar_firma_digital</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'usuarios_configurar_firma_digital'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='usuarios_configurar_firma_digital' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Campo1 <input type='radio' id='cn' name='cn' value='campo1'/>,Campo2 <input type='radio' id='cn' name='cn' value='campo2'/>,Campo3 <input type='radio' id='cn' name='cn' value='campo3'/>,Campo4 <input type='radio' id='cn' name='cn' value='campo4'/>,Campo5 <input type='radio' id='cn' name='cn' value='campo5'/>,Campo6 <input type='radio' id='cn' name='cn' value='campo6'/>,Campo7 <input type='radio' id='cn' name='cn' value='campo7'/>,   <input type='submit' value='Buscar usuarios_configurar_firma_digital'>              
	</form>	
</div>-->


	<div class='title right'>Listado de usuarios_configurar_firma_digital </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablausuarios_configurar_firma_digital'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>User_id</th>
					<th class='th_act'>Campo1</th>
					<th class='th_act'>Campo2</th>
					<th class='th_act'>Campo3</th>
					<th class='th_act'>Campo4</th>
					<th class='th_act'>Campo5</th>
					<th class='th_act'>Campo6</th>
					<th class='th_act'>Campo7</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MUsuarios_configurar_firma_digital;
			$l->Createusuarios_configurar_firma_digital('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetCampo1(); ?></td> 
				<td><?php echo $l -> GetCampo2(); ?></td> 
				<td><?php echo $l -> GetCampo3(); ?></td> 
				<td><?php echo $l -> GetCampo4(); ?></td> 
				<td><?php echo $l -> GetCampo5(); ?></td> 
				<td><?php echo $l -> GetCampo6(); ?></td> 
				<td><?php echo $l -> GetCampo7(); ?></td> 
				<td>
	                <div onclick='EditarUsuarios_configurar_firma_digital(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarUsuarios_configurar_firma_digital(<?= $l->GetId() ?>)'>
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
		$('#Tablausuarios_configurar_firma_digital').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarUsuarios_configurar_firma_digital(id){
	if(confirm('Esta seguro desea eliminar este usuarios_configurar_firma_digital')){
		var URL = '<?= HOMEDIR ?>usuarios_configurar_firma_digital/eliminar/'+id+'/';
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

function EditarUsuarios_configurar_firma_digital(id){
	var URL = '<?= HOMEDIR ?>usuarios_configurar_firma_digital/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
