<?
echo '	
	<div id="tools-content">
		<div class="opc-folder blue">
			<ol class="breadcrumb">
				<a href="/proceso/1/"><li class="breadcrumb-item fa fa-archive"></li></a>
				<li></li>
				<li class="breadcrumb-item"><a href="/dependencias/childs/'.$draiz->GetId().'/">'.$draiz->GetNombre().'</a></li>
				<li class="breadcrumb-item active">'.$dep->GetNombre().'</li>
			</ol>
		</div>
	</div>
	<div id="folders-content">
		<div id="folders-list-content">
		<div class="title">Listado de Suscriptores</div>
		<br>
		';
?>

<script type="text/javascript">
$(document).ready(function(){
	$('#filter').keyup(function () { 
		$('.newblock_suscriptor').each(function() {
		    var filter = $("#filter").val();
		    filter = filter.toUpperCase();
	        $(".newblock_suscriptor").find("div.nombre:not(:contains('" + filter + "'))").parent().hide();
	        $(".newblock_suscriptor").find("div.nombre:contains('" + filter + "')").parent().show();
		});
	});
});	
</script>
	
		<div class='newblock_suscriptor2'>
			<input type="text" class="form-control" id="filter" name="filter" placeholder="Escriba el nombre de un suscriptor para buscarlo	">
		</div>
<?
	while ($ro2 = $con->FetchAssoc($qn)) {
		$s = new MSuscriptores_contactos;
		$s->CreateSuscriptores_contactos("id", $ro2['suscriptor_id']);

		$nombre = $s->GetNombre();
		$cantidad = $f->Zerofill($c->GetNocounter("gestion", "suscriptor_id = '".$ro2['suscriptor_id']."' and tipo_documento = '".$id."'"), 3);
		$enlace = "/dependencias/verradicaciones2/".$id."/".$s->GetId()."/";		
		#$id, $nombre, $enlace, $cantidad
		echo $f->DoFolder($nombre, $enlace, $cantidad);
	}
	
echo '		
		</div>
	</div>';
