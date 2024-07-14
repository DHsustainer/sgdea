<?
	$cap = new MAyuda_libros;
	$cap->Createayuda_libros("id", $x);
?>
<h3>Ayuda del Menú <?= $cap->GetTitulo() ?></h3>
<div class="list-group">
	
<?
	while($row = $con->FetchAssoc($query)){
	$l = new MAyuda_elementos;
	$l->Createayuda_elementos('id', $row[id]);

	$mdetalle = substr($l -> GetDetalle(), 0, 100)."...";
?>						
	<div class="list-group-item">
		<h3><?php echo $l -> GetTitulo(); ?></h3>
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
	</div>
<?
	}
?>			
</div>          


