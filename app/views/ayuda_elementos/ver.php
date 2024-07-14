<?
	$l = new MAyuda_elementos;
	$l->Createayuda_elementos('id', $id);

?>						
	<code><?php echo $l -> GetTexto(); ?></code>
	<p class="p-l-20 p-r-20 p-t-20"><?php echo $l->GetDetalle(); ?></p>
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