<div class="list-group" id="listadoelementos">
	
<?
	$tipos = array("1" => "Formularios de Subserie", "2" => "Metadatos de Documento", "3" => "Metadatos del Suscriptor");
		$i = 0;
		while($row = $con->FetchAssoc($query)){
			$i++;
			$l = new MMeta_referencias_titulos;
			$l->Createmeta_referencias_titulos('id', $row[id]);
?>						
		  	<a href="#" class="list-group-item" id="r<?= $l->GetId() ?>" onclick="GetQuery('/meta_referencias_titulos/editar/<?= $l->GetId() ?>/', 'r<?= $l->GetId() ?>', 'inner-metadatosjs')">
		    	<h4 class="list-group-item-heading"><?php echo utf8_decode($l -> GetTitulo()); ?></h4>
		    	<small><?= $tipos[$l->GetTipo()] ?></small>
		  	</a>
<?
		}
		if ($i == "0") {
			echo '<br><br><div class="alert alert-info" role="alert">No hay formularios de metadatos creados</div><br>';
		}
?>		
</div>