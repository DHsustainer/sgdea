
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios/listar/' ?>' >Listar usuarios</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios/nuevo/' ?>' >Crear usuarios</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'usuarios'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='usuarios' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Username <input type='radio' id='cn' name='cn' value='username'/>,Password <input type='radio' id='cn' name='cn' value='password'/>,Nombre_completo <input type='radio' id='cn' name='cn' value='nombre_completo'/>,Identificacion <input type='radio' id='cn' name='cn' value='identificacion'/>,Email <input type='radio' id='cn' name='cn' value='email'/>,Direccion <input type='radio' id='cn' name='cn' value='direccion'/>,Telefono <input type='radio' id='cn' name='cn' value='telefono'/>,Ciudad <input type='radio' id='cn' name='cn' value='ciudad'/>,Foto_perfil <input type='radio' id='cn' name='cn' value='foto_perfil'/>,Seccional <input type='radio' id='cn' name='cn' value='seccional'/>,Fecha_registro <input type='radio' id='cn' name='cn' value='fecha_registro'/>,Fecha_caducidad <input type='radio' id='cn' name='cn' value='fecha_caducidad'/>,Estado_cuenta <input type='radio' id='cn' name='cn' value='estado_cuenta'/>,Universidad <input type='radio' id='cn' name='cn' value='universidad'/>,Usuarioscol <input type='radio' id='cn' name='cn' value='usuarioscol'/>,Ex_identificacion <input type='radio' id='cn' name='cn' value='ex_identificacion'/>,   <input type='submit' value='Buscar usuarios'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablausuarios'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>Username</th>
				<th>Password</th>
				<th>Nombre_completo</th>
				<th>Identificacion</th>
				<th>Email</th>
				<th>Direccion</th>
				<th>Telefono</th>
				<th>Ciudad</th>
				<th>Foto_perfil</th>
				<th>Seccional</th>
				<th>Fecha_registro</th>
				<th>Fecha_caducidad</th>
				<th>Estado_cuenta</th>
				<th>Universidad</th>
				<th>Usuarioscol</th>
				<th>Ex_identificacion</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MUsuarios;
			$l->Createusuarios('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUsername(); ?></td> 
				<td><?php echo $l -> GetPassword(); ?></td> 
				<td><?php echo $l -> GetNombre_completo(); ?></td> 
				<td><?php echo $l -> GetIdentificacion(); ?></td> 
				<td><?php echo $l -> GetEmail(); ?></td> 
				<td><?php echo $l -> GetDireccion(); ?></td> 
				<td><?php echo $l -> GetTelefono(); ?></td> 
				<td><?php echo $l -> GetCiudad(); ?></td> 
				<td><?php echo $l -> GetFoto_perfil(); ?></td> 
				<td><?php echo $l -> GetSeccional(); ?></td> 
				<td><?php echo $l -> GetFecha_registro(); ?></td> 
				<td><?php echo $l -> GetFecha_caducidad(); ?></td> 
				<td><?php echo $l -> GetEstado_cuenta(); ?></td> 
				<td><?php echo $l -> GetUniversidad(); ?></td> 
				<td><?php echo $l -> GetUsuarioscol(); ?></td> 
				<td><?php echo $l -> GetEx_identificacion(); ?></td> 
				<td><a href='<?= HOMEDIR.'usuarios/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarUsuarios(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablausuarios').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarUsuarios(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>usuarios/eliminar/'+id+'/';
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
