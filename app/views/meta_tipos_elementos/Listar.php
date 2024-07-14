	<div class="tmain">Listas de Elementos</div>
	<div class="align-right margin_bottom">
		<div class="btn-group">
			<a class="btn btn-success" onclick="GetQuery('/meta_tipos_elementos/nuevo/','telementos', 'inner-metadatosjs')">
				<span class="fa fa-plus-circle"></span>
				<span>Nuevo Elemento</span>
			</a>
		</div>    
	</div>

	<div id="Listado">
		<div class="list-group" id="listadoelementos">
<?
		while($row = $con->FetchAssoc($query)){
			$l = new MMeta_tipos_elementos;
			$l->Createmeta_tipos_elementos('id', $row[id]);
?>						
		  	<a href="#" class="list-group-item" id="r<?= $l->GetId() ?>">
		  		<!--<a href="#" class="list-group-item" id="r<?= $l->GetId() ?>" onclick="GetQuery('/meta_tipos_elementos/editar/<?= $l->GetId() ?>/', 'r<?= $l->GetId() ?>', 'inner-metadatosjs')">-->
		    	<h4 class="list-group-item-heading"><?php echo utf8_decode($l -> GetNombre()); ?></h4>
		  	</a>
<?
		}
?>		
		</div>
	</div>
