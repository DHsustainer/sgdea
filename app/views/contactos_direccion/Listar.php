
<span style='cursor:pointer'><a href='<?= HOMEDIR.'contactos_direccion/listar/' ?>' >Listar contactos_direccion</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'contactos_direccion/nuevo/' ?>' >Crear contactos_direccion</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'contactos_direccion'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='contactos_direccion' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Id_contacto <input type='radio' id='cn' name='cn' value='id_contacto'/>,Direccion <input type='radio' id='cn' name='cn' value='direccion'/>,Telefono <input type='radio' id='cn' name='cn' value='telefono'/>,   <input type='submit' value='Buscar contactos_direccion'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablacontactos_direccion'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Id_contacto</th>
				<th>Direccion</th>
				<th>Telefono</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MContactos_direccion;
			$l->Createcontactos_direccion('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetId_contacto(); ?></td> 
				<td><?php echo $l -> GetDireccion(); ?></td> 
				<td><?php echo $l -> GetTelefono(); ?></td> 
				<td><a href='<?= HOMEDIR.'contactos_direccion/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarContactos_direccion(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablacontactos_direccion').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarContactos_direccion(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>contactos_direccion/eliminar/'+id+'/';
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
