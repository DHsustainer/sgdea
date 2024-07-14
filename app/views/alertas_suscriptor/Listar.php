<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'alertas_suscriptor/listar/' ?>' >Listar alertas_suscriptor</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'alertas_suscriptor/nuevo/' ?>' >Crear alertas_suscriptor</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'alertas_suscriptor'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='alertas_suscriptor' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Suscriptor_id <input type='radio' id='cn' name='cn' value='suscriptor_id'/>,Alerta <input type='radio' id='cn' name='cn' value='alerta'/>,Id_gestion <input type='radio' id='cn' name='cn' value='id_gestion'/>,Fechahora <input type='radio' id='cn' name='cn' value='fechahora'/>,Estado <input type='radio' id='cn' name='cn' value='estado'/>,Type <input type='radio' id='cn' name='cn' value='type'/>,   <input type='submit' value='Buscar alertas_suscriptor'>              
	</form>	
</div>-->


	<div class='title right'>Listado de alertas_suscriptor </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaalertas_suscriptor'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Suscriptor_id</th>
					<th class='th_act'>Alerta</th>
					<th class='th_act'>Id_gestion</th>
					<th class='th_act'>Fechahora</th>
					<th class='th_act'>Estado</th>
					<th class='th_act'>Type</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MAlertas_suscriptor;
			$l->Createalertas_suscriptor('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetSuscriptor_id(); ?></td> 
				<td><?php echo $l -> GetAlerta(); ?></td> 
				<td><?php echo $l -> GetId_gestion(); ?></td> 
				<td><?php echo $l -> GetFechahora(); ?></td> 
				<td><?php echo $l -> GetEstado(); ?></td> 
				<td><?php echo $l -> GetType(); ?></td> 
				<td>
	                <div onclick='EditarAlertas_suscriptor(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarAlertas_suscriptor(<?= $l->GetId() ?>)'>
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
		$('#Tablaalertas_suscriptor').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarAlertas_suscriptor(id){
	if(confirm('Esta seguro desea eliminar este alertas_suscriptor')){
		var URL = '<?= HOMEDIR ?>alertas_suscriptor/eliminar/'+id+'/';
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

function EditarAlertas_suscriptor(id){
	var URL = '<?= HOMEDIR ?>alertas_suscriptor/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
