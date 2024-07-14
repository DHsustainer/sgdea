<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_tipologias_big_data/listar/' ?>' >Listar gestion_tipologias_big_data</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'gestion_tipologias_big_data/nuevo/' ?>' >Crear gestion_tipologias_big_data</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'gestion_tipologias_big_data'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='gestion_tipologias_big_data' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Username <input type='radio' id='cn' name='cn' value='username'/>,Proceso_id <input type='radio' id='cn' name='cn' value='proceso_id'/>,Tipologia_referencia_id <input type='radio' id='cn' name='cn' value='tipologia_referencia_id'/>,Col_1 <input type='radio' id='cn' name='cn' value='col_1'/>,Col_2 <input type='radio' id='cn' name='cn' value='col_2'/>,Col_3 <input type='radio' id='cn' name='cn' value='col_3'/>,Col_4 <input type='radio' id='cn' name='cn' value='col_4'/>,Col_5 <input type='radio' id='cn' name='cn' value='col_5'/>,Col_6 <input type='radio' id='cn' name='cn' value='col_6'/>,Col_7 <input type='radio' id='cn' name='cn' value='col_7'/>,Col_8 <input type='radio' id='cn' name='cn' value='col_8'/>,Col_9 <input type='radio' id='cn' name='cn' value='col_9'/>,Col_10 <input type='radio' id='cn' name='cn' value='col_10'/>,Col_11 <input type='radio' id='cn' name='cn' value='col_11'/>,Col_12 <input type='radio' id='cn' name='cn' value='col_12'/>,Col_13 <input type='radio' id='cn' name='cn' value='col_13'/>,Col_14 <input type='radio' id='cn' name='cn' value='col_14'/>,Col_15 <input type='radio' id='cn' name='cn' value='col_15'/>,   <input type='submit' value='Buscar gestion_tipologias_big_data'>              
	</form>	
</div>-->


	<div class='title right'>Listado de gestion_tipologias_big_data </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablagestion_tipologias_big_data'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Username</th>
					<th class='th_act'>Proceso_id</th>
					<th class='th_act'>Tipologia_referencia_id</th>
					<th class='th_act'>Col_1</th>
					<th class='th_act'>Col_2</th>
					<th class='th_act'>Col_3</th>
					<th class='th_act'>Col_4</th>
					<th class='th_act'>Col_5</th>
					<th class='th_act'>Col_6</th>
					<th class='th_act'>Col_7</th>
					<th class='th_act'>Col_8</th>
					<th class='th_act'>Col_9</th>
					<th class='th_act'>Col_10</th>
					<th class='th_act'>Col_11</th>
					<th class='th_act'>Col_12</th>
					<th class='th_act'>Col_13</th>
					<th class='th_act'>Col_14</th>
					<th class='th_act'>Col_15</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MGestion_tipologias_big_data;
			$l->Creategestion_tipologias_big_data('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUsername(); ?></td> 
				<td><?php echo $l -> GetProceso_id(); ?></td> 
				<td><?php echo $l -> GetTipologia_referencia_id(); ?></td> 
				<td><?php echo $l -> GetCol_1(); ?></td> 
				<td><?php echo $l -> GetCol_2(); ?></td> 
				<td><?php echo $l -> GetCol_3(); ?></td> 
				<td><?php echo $l -> GetCol_4(); ?></td> 
				<td><?php echo $l -> GetCol_5(); ?></td> 
				<td><?php echo $l -> GetCol_6(); ?></td> 
				<td><?php echo $l -> GetCol_7(); ?></td> 
				<td><?php echo $l -> GetCol_8(); ?></td> 
				<td><?php echo $l -> GetCol_9(); ?></td> 
				<td><?php echo $l -> GetCol_10(); ?></td> 
				<td><?php echo $l -> GetCol_11(); ?></td> 
				<td><?php echo $l -> GetCol_12(); ?></td> 
				<td><?php echo $l -> GetCol_13(); ?></td> 
				<td><?php echo $l -> GetCol_14(); ?></td> 
				<td><?php echo $l -> GetCol_15(); ?></td> 
				<td>
	                <div onclick='EditarGestion_tipologias_big_data(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarGestion_tipologias_big_data(<?= $l->GetId() ?>)'>
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
		$('#Tablagestion_tipologias_big_data').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarGestion_tipologias_big_data(id){
	if(confirm('Esta seguro desea eliminar este gestion_tipologias_big_data')){
		var URL = '<?= HOMEDIR ?>gestion_tipologias_big_data/eliminar/'+id+'/';
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

function EditarGestion_tipologias_big_data(id){
	var URL = '<?= HOMEDIR ?>gestion_tipologias_big_data/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
