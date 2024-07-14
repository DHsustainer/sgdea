<!--
<span style='cursor:pointer'><a href='<?= HOMEDIR.'suscriptores_big_data/listar/' ?>' >Listar suscriptores_big_data</a></span> |
<span style='cursor:pointer'><a href='<?= HOMEDIR.'suscriptores_big_data/nuevo/' ?>' >Crear suscriptores_big_data</a></span>    
<hr>
<div>
	<form id='formbdata' action='<?= HOMEDIR.'suscriptores_big_data'.DS.'buscar'.DS ?>' method='POST'> 
    	<input type='hidden' id='m' name='m' value='suscriptores_big_data' />    
    	<input type='hidden' id='action' name='action' value='buscar' />          
        <input type='text' style='height:25px; width:300px; margin:5px; font-size:19px; color:#5C5C5C' id='id' name='id' value='<?= $_REQUEST['id'] ?>'> <br />Username <input type='radio' id='cn' name='cn' value='username'/>,Suscriptor_id <input type='radio' id='cn' name='cn' value='suscriptor_id'/>,Suscriptores_referencias_id <input type='radio' id='cn' name='cn' value='suscriptores_referencias_id'/>,Col_1 <input type='radio' id='cn' name='cn' value='col_1'/>,Col_2 <input type='radio' id='cn' name='cn' value='col_2'/>,Col_3 <input type='radio' id='cn' name='cn' value='col_3'/>,Col_4 <input type='radio' id='cn' name='cn' value='col_4'/>,Col_5 <input type='radio' id='cn' name='cn' value='col_5'/>,Col_6 <input type='radio' id='cn' name='cn' value='col_6'/>,Col_7 <input type='radio' id='cn' name='cn' value='col_7'/>,Col_8 <input type='radio' id='cn' name='cn' value='col_8'/>,Col_9 <input type='radio' id='cn' name='cn' value='col_9'/>,Col_10 <input type='radio' id='cn' name='cn' value='col_10'/>,Col_11 <input type='radio' id='cn' name='cn' value='col_11'/>,Col_12 <input type='radio' id='cn' name='cn' value='col_12'/>,Col_13 <input type='radio' id='cn' name='cn' value='col_13'/>,Col_14 <input type='radio' id='cn' name='cn' value='col_14'/>,Col_15 <input type='radio' id='cn' name='cn' value='col_15'/>,Col_16 <input type='radio' id='cn' name='cn' value='col_16'/>,Col_17 <input type='radio' id='cn' name='cn' value='col_17'/>,Col_18 <input type='radio' id='cn' name='cn' value='col_18'/>,Col_19 <input type='radio' id='cn' name='cn' value='col_19'/>,Col_20 <input type='radio' id='cn' name='cn' value='col_20'/>,Col_21 <input type='radio' id='cn' name='cn' value='col_21'/>,Col_22 <input type='radio' id='cn' name='cn' value='col_22'/>,Col_23 <input type='radio' id='cn' name='cn' value='col_23'/>,Col_24 <input type='radio' id='cn' name='cn' value='col_24'/>,Col_25 <input type='radio' id='cn' name='cn' value='col_25'/>,Col_26 <input type='radio' id='cn' name='cn' value='col_26'/>,Col_27 <input type='radio' id='cn' name='cn' value='col_27'/>,Col_28 <input type='radio' id='cn' name='cn' value='col_28'/>,Col_29 <input type='radio' id='cn' name='cn' value='col_29'/>,Col_30 <input type='radio' id='cn' name='cn' value='col_30'/>,   <input type='submit' value='Buscar suscriptores_big_data'>              
	</form>	
</div>-->


	<div class='title right'>Listado de suscriptores_big_data </div>
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablasuscriptores_big_data'>
           	<thead>
				<tr class='encabezado'>
				
					<th class='th_act'>Username</th>
					<th class='th_act'>Suscriptor_id</th>
					<th class='th_act'>Suscriptores_referencias_id</th>
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
					<th class='th_act'>Col_16</th>
					<th class='th_act'>Col_17</th>
					<th class='th_act'>Col_18</th>
					<th class='th_act'>Col_19</th>
					<th class='th_act'>Col_20</th>
					<th class='th_act'>Col_21</th>
					<th class='th_act'>Col_22</th>
					<th class='th_act'>Col_23</th>
					<th class='th_act'>Col_24</th>
					<th class='th_act'>Col_25</th>
					<th class='th_act'>Col_26</th>
					<th class='th_act'>Col_27</th>
					<th class='th_act'>Col_28</th>
					<th class='th_act'>Col_29</th>
					<th class='th_act'>Col_30</th>
					<th></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MSuscriptores_big_data;
			$l->Createsuscriptores_big_data('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetUsername(); ?></td> 
				<td><?php echo $l -> GetSuscriptor_id(); ?></td> 
				<td><?php echo $l -> GetSuscriptores_referencias_id(); ?></td> 
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
				<td><?php echo $l -> GetCol_16(); ?></td> 
				<td><?php echo $l -> GetCol_17(); ?></td> 
				<td><?php echo $l -> GetCol_18(); ?></td> 
				<td><?php echo $l -> GetCol_19(); ?></td> 
				<td><?php echo $l -> GetCol_20(); ?></td> 
				<td><?php echo $l -> GetCol_21(); ?></td> 
				<td><?php echo $l -> GetCol_22(); ?></td> 
				<td><?php echo $l -> GetCol_23(); ?></td> 
				<td><?php echo $l -> GetCol_24(); ?></td> 
				<td><?php echo $l -> GetCol_25(); ?></td> 
				<td><?php echo $l -> GetCol_26(); ?></td> 
				<td><?php echo $l -> GetCol_27(); ?></td> 
				<td><?php echo $l -> GetCol_28(); ?></td> 
				<td><?php echo $l -> GetCol_29(); ?></td> 
				<td><?php echo $l -> GetCol_30(); ?></td> 
				<td>
	                <div onclick='EditarSuscriptores_big_data(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle' title='editar'></div>
					</div>

					<div onclick='EliminarSuscriptores_big_data(<?= $l->GetId() ?>)'>
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
		$('#Tablasuscriptores_big_data').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarSuscriptores_big_data(id){
	if(confirm('Esta seguro desea eliminar este suscriptores_big_data')){
		var URL = '<?= HOMEDIR ?>suscriptores_big_data/eliminar/'+id+'/';
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

function EditarSuscriptores_big_data(id){
	var URL = '<?= HOMEDIR ?>suscriptores_big_data/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
