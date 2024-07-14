<div class="row m-t-30">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
	 		<div class="row p-30">
	 			<div class="col-md-12">

				  	<h2><span class="fa fa-cogs"></span> Resultados de Consulta</h2>
				  	<p class="m-t-30">Resultados de la consulta realizado por número de radicado en el <?= PROJECTNAME ?></p>
					<p class="m-b-30">Identificación del Expediente: <?= $radicado ?></p>
					<div class="bloque_radicado_detalle">
						<?php
							if ($id >= 1) {
								if ($radicado != "") {
									echo $c->GetVistaPublicaExpediente($id);
								}else{
									echo "<br><br><br><div class='alert alert-warning' role='alert'>El numero consultado no se encuentra registrado</diV><br><br>";
								}
							}else{
								echo "<br><br><br><div class='alert alert-warning' role='alert'>El numero consultado no se encuentra registrado</diV><br><br>";
							}
						?>
					</div>
					<br>
					<form action="<?= HOMEDIR.DS ?>consultapublica/radicado/">
						<button type="submit" class="btn btn-primary btn-lg fullwidth">Volver a Consultar</button>
					</form>


	 			</div>
			</div>
		</div>
	</div>
</div>




<style type="text/css">
	#wrapper {
	    background-color: #FFF;
	}

	#header {
	    border-bottom: 1px solid #FFF;
	 
	}
	.bodycontainer {
	    padding-bottom: 0px !important;
	}
	@media screen and (min-width: 768px){
		
		.jumbotron {
		    padding-top: 10px;
		}
	}

</style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>