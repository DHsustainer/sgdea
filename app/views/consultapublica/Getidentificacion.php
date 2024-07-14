<div class="container bodycontainer">
	<div class="row">
		<div class="col-md-12">
			<h2>
				
			</h2>
		</div>
	</div>

	<div class="jumbotron">
	  	<h1><span class="fa fa-cogs"></span>Consulta Publica por Identificación</h1>
		<p>Desde el <?= PROJECTNAME ?> le permite realizar consultas publicas a partir el número de identificación del Suscriptor</p>
		<form class="form-inline" action='<?= HOMEDIR.DS.'consultapublica'.DS.'resultados_identificacion'.DS ?>' method='POST'>
		    <div class="row">
		        <div class="col-md-12">
		            <div class="form-group form-group-lg">
		              <div class="input-group">
		                <div class="input-group-addon fa fa-search iconbox"></div>
		                <input type="text" class="form-control input-lg" id="id_consulta"  name="id_consulta" placeholder="Escriba el Número de Radicado a Consultar">
		              </div>
		            </div>
		        </div>
		    </div>
		    <br>
		    <div class="row">
		      	<div class="col-md-12" >
		        	<button type="submit" id="btn_login" class="btn btn-success btn-lg fullwidth">Buscar Expedientes</button>
		      	</div>
		    </div>
		</form>
	</div>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>