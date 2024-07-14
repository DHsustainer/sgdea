
<span style='cursor:pointer'><a href='<?= HOMEDIR.'notificaciones/listar/' ?>' >Listar notificaciones</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'notificaciones/nuevo/' ?>' >Crear notificaciones</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'notificaciones'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='notificaciones' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />User_id <input type='radio' id='cn' name='cn' value='user_id'/>,Proceso_id <input type='radio' id='cn' name='cn' value='proceso_id'/>,Id_demandado <input type='radio' id='cn' name='cn' value='id_demandado'/>,Tipo_notificacion <input type='radio' id='cn' name='cn' value='tipo_notificacion'/>,Id_postal <input type='radio' id='cn' name='cn' value='id_postal'/>,F_citacion <input type='radio' id='cn' name='cn' value='f_citacion'/>,Todos <input type='radio' id='cn' name='cn' value='todos'/>,Nom_archivo <input type='radio' id='cn' name='cn' value='nom_archivo'/>,Direccion <input type='radio' id='cn' name='cn' value='direccion'/>,Num_dias <input type='radio' id='cn' name='cn' value='num_dias'/>,Is_certificada <input type='radio' id='cn' name='cn' value='is_certificada'/>,Guia_id <input type='radio' id='cn' name='cn' value='guia_id'/>,   <input type='submit' value='Buscar notificaciones'>              
	</form>	
</div>

<div class='t'><?php echo $titulo; ?></div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablanotificaciones'>
           	<thead>
				<tr class='encabezadot'>
				
				<th>User_id</th>
				<th>Proceso_id</th>
				<th>Id_demandado</th>
				<th>Tipo_notificacion</th>
				<th>Id_postal</th>
				<th>F_citacion</th>
				<th>Todos</th>
				<th>Nom_archivo</th>
				<th>Direccion</th>
				<th>Num_dias</th>
				<th>Is_certificada</th>
				<th>Guia_id</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MNotificaciones;
			$l->Createnotificaciones('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUser_id(); ?></td> 
				<td><?php echo $l -> GetProceso_id(); ?></td> 
				<td><?php echo $l -> GetId_demandado(); ?></td> 
				<td><?php echo $l -> GetTipo_notificacion(); ?></td> 
				<td><?php echo $l -> GetId_postal(); ?></td> 
				<td><?php echo $l -> GetF_citacion(); ?></td> 
				<td><?php echo $l -> GetTodos(); ?></td> 
				<td><?php echo $l -> GetNom_archivo(); ?></td> 
				<td><?php echo $l -> GetDireccion(); ?></td> 
				<td><?php echo $l -> GetNum_dias(); ?></td> 
				<td><?php echo $l -> GetIs_certificada(); ?></td> 
				<td><?php echo $l -> GetGuia_id(); ?></td> 
				<td><a href='<?= HOMEDIR.'notificaciones/editar/'.$l->GetId().'/' ?>'>Editar </a> | 
                        <a onclick='EliminarNotificaciones(<?= $l->GetId() ?>)'>Eliminar</a></td>	       
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
		$('#Tablanotificaciones').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarNotificaciones(id){
	if(confirm('Esta seguro desea eliminar este libro')){
		var URL = '<?= HOMEDIR ?>notificaciones/eliminar/'+id+'/';
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
