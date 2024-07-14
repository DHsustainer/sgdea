<div class="row">
	<div class="col-md-12">
		<h2>
		    <span class="fa fa-line-chart"></span>Paquetes de Negocios
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-7">
		<?
			include(VIEWS.DS."suscriptores_paquetes_negocios/Listar.php");	   			
		?>			
	</div>
	<div class="col-md-5" id="main_form_suscriptores_modulosx">
		<?
			include(VIEWS.DS."suscriptores_paquetes_negocios/FormInsertSuscriptores_paquetes_negocios.php");
		?>			
	</div>
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

	function ChangeProyecto(vd){
		window.location.href = '/suscriptores_modulos/listar/'+vd.value+'/';
	}
</script>