<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'meta_big_data/listar/' ?>' >Listar meta_big_data</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'meta_big_data/nuevo/' ?>' >Crear meta_big_data</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'meta_big_data'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='meta_big_data' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Type_id <input type='radio' id='cn' name='cn' value='type_id'/>,Ref_id <input type='radio' id='cn' name='cn' value='ref_id'/>,Campo_id <input type='radio' id='cn' name='cn' value='campo_id'/>,Valor <input type='radio' id='cn' name='cn' value='valor'/>,   <input type='submit' value='Buscar meta_big_data'>              
	</form>	
</div>-->


	<div class='title right'>Listado de meta_big_data </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablameta_big_data'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Type_id</th>
					<th class='th_act'>Ref_id</th>
					<th class='th_act'>Campo_id</th>
					<th class='th_act'>Valor</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MMeta_big_data;
			$l->Createmeta_big_data('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetType_id(); ?></td> 
				<td><?php echo $l -> GetRef_id(); ?></td> 
				<td><?php echo $l -> GetCampo_id(); ?></td> 
				<td><?php echo $l -> GetValor(); ?></td> 
				<td>
	                <div onclick='EditarMeta_big_data(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarMeta_big_data(<?= $l->GetId() ?>)'>
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
		$('#Tablameta_big_data').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarMeta_big_data(id){
	if(confirm('Esta seguro desea eliminar este meta_big_data')){
		var URL = '<?= HOMEDIR ?>meta_big_data/eliminar/'+id+'/';
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

function EditarMeta_big_data(id){
	var URL = '<?= HOMEDIR ?>meta_big_data/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
