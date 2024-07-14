
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='table' id='Tablameta_listas_valores'>
           	<thead>
				<tr class='encabezado'>
					<th width="140px;" class='th_act'>Titulo</th>
					<th width="140px;" class='th_act'>Valor</th>
					<th width="110px;" class='th_act'></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MMeta_listas_valores;
			$l->Createmeta_listas_valores('id', $row[id]);
?>						
			<tr id='relm<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetTitulo(); ?></td> 
				<td>
				<?php 
						echo $l -> GetValor();
						if ($object->GetDependencia() != "0") {
							$dv = $con->Result($con->Query("select titulo from meta_listas_valores where id_lista = '".$object->GetDependencia()."' and valor = '".$l->GetDependencia()."'"), 0, 'titulo');
							echo "<br><small><em>Dep de: $dv </em></small>";
						}
				?>
						
				</td> 
				<td>
	                <div onclick='EditarMeta_listas_valores(<?= $l->GetId() ?>)'>
						<div class='btn btn-info btn-circle btn-sm pull-left fa fa-pencil' title='editar'></div>
					</div>

					<div onclick='EliminarMeta_listas_valores(<?= $l->GetId() ?>)'>
	                    <div class='btn btn-warning btn-circle btn-sm pull-left fa fa-trash' title='eliminar'></div>
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

 
function EliminarMeta_listas_valores(id){
	if(confirm('Esta seguro desea eliminar este Elemento de la lista')){
		var URL = '/meta_listas_valores/eliminar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				alert("Elemento Eliminado");
					$('#relm'+id).remove();
			}
		});
	}
	
}	

function EditarMeta_listas_valores(id){
	var URL = '/meta_listas_valores/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#formelementoslistas').html(msg);
		}
	});
}	
</script>		