<div class="da-message success">En este panel puede crear los formularios genericos relacionados con cada Sub-serie</div>
<div id="gestion-actuaciones2">
    <div id="form-oficinas2" class="left table">
    	<? 
    		include(VIEWS.DS."ref_tables".DS."FormInsertRef_tables.php");
    	?>
    </div>

	<div class="title right">Listado de Formularios en <?= $dep->GetNombre() ?></div>
	<div class="table">
		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla' id='Tablaref'>
           	<thead>
				<tr class='encabezadot'>
					<th class="th_act">Title</th>
					<th class="th_act">Fecha</th>
					<th class="th_act"></th>
				</tr>
			</thead>

			<tbody>

<?
		while($row = $con->FetchAssoc($query)){
			$l = new MRef_tables;
			$l->Createref_tables('id', $row[id]);
?>						
			<tr id='r<?= $l->GetId() ?>' class='tblresult'> 
				<td><?php echo $l -> GetTitle(); ?></td> 
				<td><?php echo $l -> GetFecha(); ?></td> 
				<td>
				  	<div style="float:left; margin-right:5px;" onclick="EditarRef_tables('<?= $l->GetId() ?>')">
						<div class="btn btn-info btn-circle" title="editar"></div>
					</div>

					<div style="float:left; margin-right:5px;"  onclick='EliminarRef_tables(<?= $l->GetId() ?>)'>
	                    <div class="btn btn-warning btn-circle mdi mdi-delete" title="eliminar"></div>
	                </div>
                </td>	       
			</tr>
<?
		}
?>			</tbody>
		</table>
	</div>
</div>
<div id="gestion-actuaciones">
	<div id="loadpathform" style="margin:10px;">
		<div class="alert alert-info">Seleccione un formulario</div>
	</div>
</div>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 
 	$(function() {		
		$('#Tablaref').tablesorter({sortList:[[0,0]]});
	});	
	


</script>		
