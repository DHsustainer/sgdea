<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'ayuda_libros/listar/' ?>' >Listar ayuda_libros</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'ayuda_libros/nuevo/' ?>' >Crear ayuda_libros</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'ayuda_libros'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='ayuda_libros' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Titulo <input type='radio' id='cn' name='cn' value='titulo'/>,Descripcion <input type='radio' id='cn' name='cn' value='descripcion'/>,Usuario_registra <input type='radio' id='cn' name='cn' value='usuario_registra'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Fecha_registro <input type='radio' id='cn' name='cn' value='fecha_registro'/>,Fecha_actualizacion <input type='radio' id='cn' name='cn' value='fecha_actualizacion'/>,Video <input type='radio' id='cn' name='cn' value='video'/>,Tipo <input type='radio' id='cn' name='cn' value='tipo'/>,Dependencia <input type='radio' id='cn' name='cn' value='dependencia'/>,   <input type='submit' value='Buscar ayuda_libros'>              
	</form>	
</div>-->


	<div class='title right'>Listado de ayuda_libros </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaayuda_libros'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Titulo</th>
					<th class='th_act'>Descripcion</th>
					<th class='th_act'>Usuario_registra</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Fecha_registro</th>
					<th class='th_act'>Fecha_actualizacion</th>
					<th class='th_act'>Video</th>
					<th class='th_act'>Tipo</th>
					<th class='th_act'>Dependencia</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MAyuda_libros;
			$l->Createayuda_libros('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetTitulo(); ?></td> 
				<td><?php echo $l -> GetDescripcion(); ?></td> 
				<td><?php echo $l -> GetUsuario_registra(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetFecha_registro(); ?></td> 
				<td><?php echo $l -> GetFecha_actualizacion(); ?></td> 
				<td><?php echo $l -> GetVideo(); ?></td> 
				<td><?php echo $l -> GetTipo(); ?></td> 
				<td><?php echo $l -> GetDependencia(); ?></td> 
				<td>
	                <div onclick='EditarAyuda_libros(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarAyuda_libros(<?= $l->GetId() ?>)'>
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
		$('#Tablaayuda_libros').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarAyuda_libros(id){
	if(confirm('Esta seguro desea eliminar este ayuda_libros')){
		var URL = '<?= HOMEDIR ?>ayuda_libros/eliminar/'+id+'/';
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

function EditarAyuda_libros(id){
	var URL = '<?= HOMEDIR ?>ayuda_libros/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
