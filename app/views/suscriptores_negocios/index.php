<div class="row">
	<div class="col-md-12">
		<h2>
		    <span class="fa fa-money"></span>Administrar Negocios
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-7">
		<div class="btn btn-primary" onClick="window.location.reload()"><span class="fa fa-plus"></span> Nuevo Negocio</div><br><br>
		<?
			include(VIEWS.DS."suscriptores_negocios/Listar.php");	   			
		?>			
	</div>
	<div class="col-md-5" id="main_form_negocios">
		<?
			if ($id > 0) {
				global $con;
				global $f;
				global $c;
				
				$object = new MSuscriptores_negocios;
				$object->CreateSuscriptores_negocios("id", $id);			
				include_once(VIEWS.DS.'suscriptores_negocios/FormUpdateSuscriptores_negocios.php');		
			}else{
				include(VIEWS.DS."suscriptores_negocios/FormInsertSuscriptores_negocios.php");	   			
			}
		?>			
	</div>
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

</script>