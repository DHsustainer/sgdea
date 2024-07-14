
<span style='cursor:pointer'><a href='<?= HOMEDIR.'memoriales/listar/' ?>' >Listar memoriales</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'memoriales/nuevo/' ?>' >Crear memoriales</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'memoriales'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='memoriales' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Proceso_id <input type='radio' id='cn' name='cn' value='proceso_id'/>,Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,F_creacion <input type='radio' id='cn' name='cn' value='f_creacion'/>,F_actualizacion <input type='radio' id='cn' name='cn' value='f_actualizacion'/>,Contenido <input type='radio' id='cn' name='cn' value='contenido'/>,   <input type='submit' value='Buscar memoriales'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablamemoriales'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>User_id</th>
				<th>Proceso_id</th>
				<th>Nombre</th>
				<th>F_creacion</th>
				<th>F_actualizacion</th>
				<th>Contenido</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MMemoriales;
			$l->Creatememoriales('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetProceso_id(); ?></td> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td><?php echo $l -> GetF_creacion(); ?></td> 
				<td><?php echo $l -> GetF_actualizacion(); ?></td> 
				<td><?php echo $l -> GetContenido(); ?></td> 
				<td><a href='<?= HOMEDIR.'memoriales/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarMemoriales(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablamemoriales').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarMemoriales(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>memoriales/eliminar/'+id+'/';
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
</script>		
