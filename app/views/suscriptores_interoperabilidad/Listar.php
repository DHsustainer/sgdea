<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'suscriptores_interoperabilidad/listar/' ?>' >Listar suscriptores_interoperabilidad</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'suscriptores_interoperabilidad/nuevo/' ?>' >Crear suscriptores_interoperabilidad</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'suscriptores_interoperabilidad'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='suscriptores_interoperabilidad' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Suscriptor_origen <input type='radio' id='cn' name='cn' value='suscriptor_origen'/>,Suscriptor_destino <input type='radio' id='cn' name='cn' value='suscriptor_destino'/>,Key_set <input type='radio' id='cn' name='cn' value='key_set'/>,Key_get <input type='radio' id='cn' name='cn' value='key_get'/>,Key_add <input type='radio' id='cn' name='cn' value='key_add'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,FechaActualizacion <input type='radio' id='cn' name='cn' value='FechaActualizacion'/>,   <input type='submit' value='Buscar suscriptores_interoperabilidad'>              
	</form>	
</div>-->


	<div class='title right'>Interoperabilidad</div>
		<?php include(VIEWS.DS."suscriptores_interoperabilidad/FormInsertSuscriptores_interoperabilidad.php"); ?>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablasuscriptores_interoperabilidad'>
           	<thead>
				<tr class='encabezado'>
					<th class='th_act'>Suscriptor</th>
					<th class='th_act'>Set</th>
					<th class='th_act'>Get</th>
					<th class='th_act'>Add</th>
					<th class='th_act'>Estado</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MSuscriptores_interoperabilidad;
			$l->Createsuscriptores_interoperabilidad('id', $row[id]);

			$s_D = new MSuscriptores_contactos;
			$s_D->CreateSuscriptores_contactos("id", $l -> GetSuscriptor_destino());
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo$s_D->GetNombre(); ?></td> 
				<td><?php echo $l -> GetKey_set(); ?></td> 
				<td><?php echo $l -> GetKey_get(); ?></td> 
				<td><?php echo $l -> GetKey_add(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<!--<td>
	                <div onclick='EditarSuscriptores_interoperabilidad(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarSuscriptores_interoperabilidad(<?= $l->GetId() ?>)'>
	                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
	                </div>
		        </td>-->	       
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
		$('#Tablasuscriptores_interoperabilidad').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarSuscriptores_interoperabilidad(id){
	if(confirm('Esta seguro desea eliminar este suscriptores_interoperabilidad')){
		var URL = '<?= HOMEDIR ?>suscriptores_interoperabilidad/eliminar/'+id+'/';
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

function EditarSuscriptores_interoperabilidad(id){
	var URL = '<?= HOMEDIR ?>suscriptores_interoperabilidad/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
