<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'dian_facturacion/listar/' ?>' >Listar dian_facturacion</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'dian_facturacion/nuevo/' ?>' >Crear dian_facturacion</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'dian_facturacion'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='dian_facturacion' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Nombre <input type='radio' id='cn' name='cn' value='nombre'/>,Nit <input type='radio' id='cn' name='cn' value='nit'/>,Num_resolucion <input type='radio' id='cn' name='cn' value='num_resolucion'/>,Fecha_resolucion <input type='radio' id='cn' name='cn' value='fecha_resolucion'/>,Prefijo <input type='radio' id='cn' name='cn' value='prefijo'/>,Rango_desde <input type='radio' id='cn' name='cn' value='rango_desde'/>,Rango_hasta <input type='radio' id='cn' name='cn' value='rango_hasta'/>,Clave_tecnica <input type='radio' id='cn' name='cn' value='clave_tecnica'/>,Fecha_vigencia_desde <input type='radio' id='cn' name='cn' value='fecha_vigencia_desde'/>,Fecha_vigencia_hasta <input type='radio' id='cn' name='cn' value='fecha_vigencia_hasta'/>,Software_id <input type='radio' id='cn' name='cn' value='software_id'/>,Pin <input type='radio' id='cn' name='cn' value='pin'/>,Nombre_software <input type='radio' id='cn' name='cn' value='nombre_software'/>,Fecha_registro <input type='radio' id='cn' name='cn' value='fecha_registro'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Url <input type='radio' id='cn' name='cn' value='url'/>,Usuario <input type='radio' id='cn' name='cn' value='usuario'/>,Clave <input type='radio' id='cn' name='cn' value='clave'/>,   <input type='submit' value='Buscar dian_facturacion'>              
	</form>	
</div>-->


	<div class='title right'>Listado de dian_facturacion </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tabladian_facturacion'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Nombre</th>
					<th class='th_act'>Nit</th>
					<th class='th_act'>Num_resolucion</th>
					<th class='th_act'>Fecha_resolucion</th>
					<th class='th_act'>Prefijo</th>
					<th class='th_act'>Rango_desde</th>
					<th class='th_act'>Rango_hasta</th>
					<th class='th_act'>Clave_tecnica</th>
					<th class='th_act'>Fecha_vigencia_desde</th>
					<th class='th_act'>Fecha_vigencia_hasta</th>
					<th class='th_act'>Software_id</th>
					<th class='th_act'>Pin</th>
					<th class='th_act'>Nombre_software</th>
					<th class='th_act'>Fecha_registro</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Url</th>
					<th class='th_act'>Usuario</th>
					<th class='th_act'>Clave</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MDian_facturacion;
			$l->Createdian_facturacion('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetNombre(); ?></td> 
				<td><?php echo $l -> GetNit(); ?></td> 
				<td><?php echo $l -> GetNum_resolucion(); ?></td> 
				<td><?php echo $l -> GetFecha_resolucion(); ?></td> 
				<td><?php echo $l -> GetPrefijo(); ?></td> 
				<td><?php echo $l -> GetRango_desde(); ?></td> 
				<td><?php echo $l -> GetRango_hasta(); ?></td> 
				<td><?php echo $l -> GetClave_tecnica(); ?></td> 
				<td><?php echo $l -> GetFecha_vigencia_desde(); ?></td> 
				<td><?php echo $l -> GetFecha_vigencia_hasta(); ?></td> 
				<td><?php echo $l -> GetSoftware_id(); ?></td> 
				<td><?php echo $l -> GetPin(); ?></td> 
				<td><?php echo $l -> GetNombre_software(); ?></td> 
				<td><?php echo $l -> GetFecha_registro(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetUrl(); ?></td> 
				<td><?php echo $l -> GetUsuario(); ?></td> 
				<td><?php echo $l -> GetClave(); ?></td> 
				<td>
	                <div onclick='EditarDian_facturacion(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarDian_facturacion(<?= $l->GetId() ?>)'>
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
		$('#Tabladian_facturacion').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarDian_facturacion(id){
	if(confirm('Esta seguro desea eliminar este dian_facturacion')){
		var URL = '<?= HOMEDIR ?>dian_facturacion/eliminar/'+id+'/';
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

function EditarDian_facturacion(id){
	var URL = '<?= HOMEDIR ?>dian_facturacion/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
