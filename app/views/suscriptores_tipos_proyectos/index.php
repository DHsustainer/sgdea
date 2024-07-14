<div class="row">
	<div class="col-md-12">
		<h2>
		    <span class="fa fa-list"></span>Configuración de Proyectos
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-7">
		<?
			include(VIEWS.DS."suscriptores_tipos_proyectos/Listar.php");	   			
		?>			
	</div>
	<div class="col-md-5" id="main_form_suscriptores_modulos">
		<?
			include(VIEWS.DS."suscriptores_tipos_proyectos/FormInsertSuscriptores_tipos_proyectos.php");
		?>			
	</div>
</div>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>