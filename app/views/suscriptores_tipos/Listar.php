<div class='title right'>Listado de Tipos de <?= SUSCRIPTORCAMPONOMBRE ?> </div>
<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla table' id='Tablasuscriptores_tipos'>
   	<thead>
		<tr class='encabezado'>
			<th class='th_act'>Nombre</th>
			<th class='th_act'>Susc. Web</th>
			<th class='th_act'>Correspondencia</th>
			<th class='th_act' width="100px"></th>
		</tr>
	</thead>

	<tbody>

<?
	$arr = array("1" => "SI", "0" => "NO");
	$arx = array("1" => "Remitente", "0" => "N/A", "2" => "Destinatario");
	while($row = $con->FetchAssoc($query)){
		$l = new MSuscriptores_tipos;
		$l->Createsuscriptores_tipos('id', $row[id]);
?>						
		<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
			<td><?php echo $l -> GetNombre(); ?></td> 
			<td><?php echo $arr[$l -> GetEs_web()]; ?></td> 
			<td><?php echo $arx[$l -> GetCorrespondencia()]; ?></td> 
			<td>
				<div class="pull-right m-l-5" onclick='EliminarSuscriptores_tipos(<?= $l->GetId() ?>)'>
                    <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
                </div>
                <div  class="pull-right"onclick='EditarSuscriptores_tipos(<?= $l->GetId() ?>)'>
					<div class='btn btn-info btn-circle  mdi mdi-pencil' title='editar'></div>
				</div>

	        </td>	       
		</tr>
<?
	}
?>			
	</tbody>
</table>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		


function EliminarSuscriptores_tipos(id){
	if(confirm('Esta seguro desea eliminar este tipo de <?= SUSCRIPTORCAMPONOMBRE ?>')){
		var URL = '<?= HOMEDIR ?>suscriptores_tipos/eliminar/'+id+'/';
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

function EditarSuscriptores_tipos(id){
	var URL = '<?= HOMEDIR ?>suscriptores_tipos/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
