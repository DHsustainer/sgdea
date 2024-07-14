<h3>Resultados de la busqueda <em>"<?= $termino ?>"</em></h3>
<div class="text-muted m-b-10 text-right" id="cant_resultados"></div>
<ul class="list-group" id="listadoresultados">
	
<?
	$query2 = $con->Query("select id_elemento as id from ayuda_etiquetas_elementos as aee inner join ayuda_etiquetas as ae on ae.id = aee.id_etiqueta where match (nombre) against ('$termino' in boolean mode) and aee.id_elemento not in (select id from ayuda_elementos where match (titulo, texto, detalle) against ('$termino' IN BOOLEAN MODE) and estado = '1')");

	$i = 0;
	while ($row = $con->FetchAssoc($query2)) {
		$i++;
		$l = new MAyuda_elementos;
		$l->Createayuda_elementos('id', $row[id]);

		$mdetalle = substr($l -> GetDetalle(), 0, 100)."...";
?>						
	<li class="list-group-item">
		<h3>
			<a href="#" onclick="LoadModal('', '<?php echo $l -> GetTitulo(); ?>', '/ayuda/ver/<?php echo $l -> GetId(); ?>/')"><?php echo $l -> GetTitulo(); ?></a>
		</h3>
		<code><?php echo $l -> GetTexto(); ?></code>
		<p class="font-12 p-l-20 p-r-20 p-t-20"><?php echo $mdetalle; ?></p>
		<footer>
<?
		$al = new Mayuda_etiquetas_elementos;
		$tags = $al->ListarAyuda_etiquetas_elementos("WHERE id_elemento = '".$l->GetId()."'");
		while ($r = $con->FetchAssoc($tags)) {
			$tag = new MAyuda_etiquetas;
			$tag->CreateAyuda_etiquetas("id", $r['id_etiqueta']);

			echo '<span class="label label-info m-l-5">'.$tag->GetNombre().'</span>';
		}
?>
		</footer>
	</li>
<?
	}

	$query = $con->Query("select * from ayuda_elementos 
							where match (titulo, texto, detalle) against ('$termino' IN BOOLEAN MODE) 
									and estado = '1'");

	while($row = $con->FetchAssoc($query)){
		$i++;
		$l = new MAyuda_elementos;
		$l->Createayuda_elementos('id', $row[id]);

		$mdetalle = substr($l -> GetDetalle(), 0, 100)."...";
?>						
	<li class="list-group-item">
		<h3>
			<a href="#" onclick="LoadModal('', '<?php echo $l -> GetTitulo(); ?>', '/ayuda/ver/<?php echo $l -> GetId(); ?>/')"><?php echo $l -> GetTitulo(); ?></a>
		</h3>
		<code><?php echo $l -> GetTexto(); ?></code>
		<p class="font-12 p-l-20 p-r-20 p-t-20"><?php echo $mdetalle; ?></p>
		<footer>
<?
		$al = new Mayuda_etiquetas_elementos;
		$tags = $al->ListarAyuda_etiquetas_elementos("WHERE id_elemento = '".$l->GetId()."'");
		while ($r = $con->FetchAssoc($tags)) {
			$tag = new MAyuda_etiquetas;
			$tag->CreateAyuda_etiquetas("id", $r['id_etiqueta']);

			echo '<span class="label label-info m-l-5">'.$tag->GetNombre().'</span>';
		}
?>
		</footer>
	</li>
<?
	}

	if ($i == "0") {
		echo "<div class='alert alert-info'>No se encontraron resultados<div>";
	}
?>			
</ul>          
<script type="text/javascript">
	$("#cant_resultados").html("<em>"+$("#listadoresultados li").size()+" Resultados Encontrados</em>");
</script>