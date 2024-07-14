<?
	$area = $_SESSION['area_principal'];

	$a = new MAreas;
	$a->CreateAreas("id", $area);

echo '	
<div class="panel panel-default block1 m-t-30">
    <div class="panel-wrapper collapse in">
        <div class="panel-body">
		
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumb default">
					  	<li><a href="/gestion/getareas/'.$a->GetId().'/">AREA: '.$a->GetNombre().'</a></li>
					  	<li><a href="/dependencias/childs/'.$draiz->GetId().'/'.$a->GetId().'/">SERIE: '.$draiz->GetNombre().'</a></li>
					  	<li class="active">SUBSERIE: '.$dep->GetNombre().'</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">		
					<h3>Listado de Suscriptores en "'.$dep->GetNombre().'"</h3>';

		echo '		<div class="newblock_suscriptor2" style="display:none">
						<input type="text" class="form-control" id="filter" name="filter" placeholder="Escriba el nombre de un suscriptor para Filtrar el listado">
					</div>';

					while ($ro2 = $con->FetchAssoc($qn)) {

						$s = new MSuscriptores_contactos;
						$s->CreateSuscriptores_contactos("id", $ro2['suscriptor_id']);

						$qnx = $g->ListarGestion(" where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and id_dependencia_raiz = '".$draiz->GetId()."' and tipo_documento = '".$id."' and nombre_destino = '".$uaid."' $pathfiltro and version = '".$_SESSION['active_vista']." and suscriptor_id = '".$s->GetId()."' and estado_archivo = '".$_SESSION['typefolder']."' ");
						
						$nombre = strtoupper($s->GetNombre());
						$cantidad = $f->Zerofill($c->Getcounter_v2("gestion", "suscriptor_id = '".$ro2['suscriptor_id']."'  and tipo_documento = '".$id."' ", $draiz->GetId()), 3);
						$enlace = "/dependencias/verradicaciones/".$id."/".$s->GetId()."/";		
						#$id, $nombre, $enlace, $cantidad
						echo $f->DoFolder($nombre, $enlace, $cantidad);
					}
echo '
				</div>
			</div>		
	    </div>
    </div>
</div>
';


?>

<script type="text/javascript">
$(document).ready(function(){
	$('#filter').keyup(function () { 
		$('.media').each(function() {
		    var filter = $("#filter").val();
		    //alert( $( this ).text() );
		    filter = filter.toUpperCase();
	        $(this).find("a.nombre:not(:contains('" + filter + "'))").parent().parent().parent().hide();
	        $(this).find("a.nombre:contains('" + filter + "')").parent().parent().parent().show();
		});
	});
});	
</script>