<?
	$cap = new MAyuda_libros;
	$cap->Createayuda_libros("id", $x);
?>
<h3>Listado de Elementos de <?= $cap->GetTitulo() ?></h3>
<a href="#" onClick="LoadModal('medium', 'Crear Articulo', '/ayuda_elementos/nuevo/<?= $cap->GetId() ?>/')" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Crear Elemento</a>
<table border='0' cellspacing='0' cellpadding='3' width='100%' class='table' id='Tablaayuda_elementos'>
   	<thead>
		<tr>
			<th>Id</th>
			<th>Titulo</th>
			<th>Texto</th>
			<th>Mostrar</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?
while($row = $con->FetchAssoc($query)){
$l = new MAyuda_elementos;
$l->Createayuda_elementos('id', $row[id]);
?>						
		<tr id='r<?= $l->GetId() ?>'> 
			<td><?php echo $l -> GetId(); ?></td> 
			<td><?php echo $l -> GetTitulo(); ?></td> 
			<td><?php echo $l -> GetTexto(); ?></td> 
			<td><?php echo $l -> GetPosicion(); ?></td> 
			<td>
				<a href="#" type="button" class="btn btn-info btn-circle" onClick="LoadModal('medium', 'Editar Articulo', '/ayuda_elementos/editar/<?= $l->GetId() ?>/')"  data-toggle="modal" data-target="#myModal">
					<i class="mdi mdi-border-color"></i>
				</a>
				<button type="button" class="btn btn-warning btn-circle" onClick='EliminarAyuda_elementos(<?= $l->GetId() ?>)'>
					<i class="mdi mdi-delete"></i> 
				</button>
	        </td>	       
		</tr>
<?
}
?>			
	</tbody>
</table>
                


<script>
function EliminarAyuda_elementos(id){
	if(confirm('Esta seguro desea eliminar este ayuda_elementos')){
		var URL = '<?= HOMEDIR ?>ayuda_elementos/eliminar/'+id+'/';
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

</script>		
