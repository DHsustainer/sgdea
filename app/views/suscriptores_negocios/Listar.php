<div class="list-group">
<?
	$i = 0;	
	while($row = $con->FetchAssoc($query)){
		$i++;
		$l = new MSuscriptores_negocios;
		$l->Createsuscriptores_negocios('id', $row[id]);

		$s = new MSuscriptores_contactos;
		$s->CreateSuscriptores_contactos("id", $l->GetId_suscriptor());

		$n = new MSuscriptores_paquetes_negocios;
		$n->CreateSuscriptores_paquetes_negocios("id", $l->GetId_negocio());

		$p = new MSuscriptores_tipos_proyectos;
		$p->CreateSuscriptores_tipos_proyectos("id", $n->GetProyecto_id());


?>						
	<a href="#" class="list-group-item" onClick="OpenAjax('/suscriptores_negocios/editar/<?= $l->GetId() ?>/', 'main_form_negocios')">
			<div><?php echo $s->GetNombre(); ?></div>
			<small>
			<?php echo "Proyecto: ".$p->GetNombre(); ?> - ( <?php echo $n->GetNombre(); ?> - <?php echo $n->GetValor_base(); ?> )
				<br>
			Fecha de registro: <?= $f->ObtenerFecha4($l -> GetFecha_registro()); ?> - Código: <?php echo $l -> GetCodigo(); ?>
			</small>
				
			
			

        <!--<div onclick='EditarSuscriptores_negocios(<?= $l->GetId() ?>)'>
			<div class='btn btn-info btn-circle' title='editar'></div>
		</div>

		<div onclick='EliminarSuscriptores_negocios(<?= $l->GetId() ?>)'>
            <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
        </div>-->

	</a>
<?
	}

	if ($i === 0) {
		echo "<div class='alert alert-info' role='alert'>No hay negocios registrados</div>";
	}
?>	
</div>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');		

 
 	$(function() {		
		$('#Tablasuscriptores_negocios').tablesorter({sortList:[[0,0]]});
	});	
	

function EliminarSuscriptores_negocios(id){
	if(confirm('Esta seguro desea eliminar este suscriptores_negocios')){
		var URL = '<?= HOMEDIR ?>suscriptores_negocios/eliminar/'+id+'/';
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

function EditarSuscriptores_negocios(id){
	var URL = '<?= HOMEDIR ?>suscriptores_negocios/editar/'+id+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			$('#divtoshow').html(msg);
		}
	});
}	
</script>		
