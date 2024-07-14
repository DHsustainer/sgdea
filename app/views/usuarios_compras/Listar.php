<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios_compras/listar/' ?>' >Listar usuarios_compras</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'usuarios_compras/nuevo/' ?>' >Crear usuarios_compras</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'usuarios_compras'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='usuarios_compras' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Username <input type='radio' id='cn' name='cn' value='username'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Descripcion <input type='radio' id='cn' name='cn' value='descripcion'/>,Total <input type='radio' id='cn' name='cn' value='total'/>,Registro_saldo <input type='radio' id='cn' name='cn' value='registro_saldo'/>,Fecha_pago <input type='radio' id='cn' name='cn' value='fecha_pago'/>,Medio_pago <input type='radio' id='cn' name='cn' value='medio_pago'/>,Medio_pago_comprobante <input type='radio' id='cn' name='cn' value='medio_pago_comprobante'/>,Medio_pago_imagen <input type='radio' id='cn' name='cn' value='medio_pago_imagen'/>,CodigoAutorizacion <input type='radio' id='cn' name='cn' value='codigoAutorizacion'/>,NumeroTransaccion <input type='radio' id='cn' name='cn' value='numeroTransaccion'/>,FechaActualizacion <input type='radio' id='cn' name='cn' value='FechaActualizacion'/>,Referente_pago <input type='radio' id='cn' name='cn' value='referente_pago'/>,   <input type='submit' value='Buscar usuarios_compras'>              
	</form>	
</div>-->


	<div class='title right'>Listado de usuarios_compras </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablausuarios_compras'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Username</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Descripcion</th>
					<th class='th_act'>Total</th>
					<th class='th_act'>Registro_saldo</th>
					<th class='th_act'>Fecha_pago</th>
					<th class='th_act'>Medio_pago</th>
					<th class='th_act'>Medio_pago_comprobante</th>
					<th class='th_act'>Medio_pago_imagen</th>
					<th class='th_act'>CodigoAutorizacion</th>
					<th class='th_act'>NumeroTransaccion</th>
					<th class='th_act'>FechaActualizacion</th>
					<th class='th_act'>Referente_pago</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MUsuarios_compras;
			$l->Createusuarios_compras('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUsername(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetDescripcion(); ?></td> 
				<td><?php echo $l -> GetTotal(); ?></td> 
				<td><?php echo $l -> GetRegistro_saldo(); ?></td> 
				<td><?php echo $l -> GetFecha_pago(); ?></td> 
				<td><?php echo $l -> GetMedio_pago(); ?></td> 
				<td><?php echo $l -> GetMedio_pago_comprobante(); ?></td> 
				<td><?php echo $l -> GetMedio_pago_imagen(); ?></td> 
				<td><?php echo $l -> GetCodigoAutorizacion(); ?></td> 
				<td><?php echo $l -> GetNumeroTransaccion(); ?></td> 
				<td><?php echo $l -> GetFechaActualizacion(); ?></td> 
				<td><?php echo $l -> GetReferente_pago(); ?></td> 
				<td>
	                <div style='float:left; margin-right:5px;' onclick='EditarUsuarios_compras(<?= $l->GetId() ?>)'>
						<div class='mini-ico green-editar' title='editar'></div>
					</div>

					<div style='float:left; margin-right:5px;'  onclick='EliminarUsuarios_compras(<?= $l->GetId() ?>)'>
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
		$('#Tablausuarios_compras').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarUsuarios_compras(id){
	if(confirm('Esta seguro desea eliminar este usuarios_compras')){
		var URL = '<?= HOMEDIR ?>usuarios_compras/eliminar/'+id+'/';
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

function EditarUsuarios_compras(id){
	var URL = '<?= HOMEDIR ?>usuarios_compras/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
