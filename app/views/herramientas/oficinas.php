<?
	global $c;
	if ($_SESSION['areas_trabajo'] == "0") {
		header("LOCATION: ".HOMEDIR.trim(" /dashboard/"));
	}
?>
<div class="row">
	<div class="col-md-12">
		<ul id="titles-gest" class="nav nav-pills nav-tabs" role="tablist">
			<li class="active" role="presentation" onclick="select_gest('natu-per',this)" <?= $c->Ayuda('110', 'tog') ?> >
				<a href="#" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="true">
				Configuracion de Ciudades
				</a>
			</li>
		</ul>
	</div>
</div>
<div class="row m-t-20">
	<div class="col-md-6">
		<?
			$seccional_padre = new MSeccional_principal;
			include(VIEWS.DS."seccional_principal".DS."FormInsertSeccional_principal.php");
		?>	
	</div>
	<div class="col-md-6">
	    <h4>Listado de Ciudades</h4>
		<?
			#echo VIEWS.DS."seccional_principal".DS."Listar.php";
			
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $seccional_padre->ListarSeccional_principal();	    
			include(VIEWS.DS."seccional_principal".DS."Listar.php");
		?>	
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-6">
		<div class="item-gest juz-per" style="display:none">
			<div id="list_nat" class="item-content-gest">
				<div id="form-oficinas"></div>
			</div>
		</div>
	</div>
</div>