<div class="row m-t-30">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
	 		<div class="row p-30">
	 			<div class="col-md-12">
				  	<h2><span class="fa fa-search"></span> Consulta Publica por Radicación</h2>
					<p class="m-t-30 m-b-30">Desde el <?= PROJECTNAME ?> le permite realizar consultas publicas a partir el número de radicado que le es entregado al momento de realizar la radicación de sus documentos</p>
					<form  action='<?= HOMEDIR.DS.'consultapublica'.DS.'resultados_radicado'.DS ?>' method='POST'>
					    <div class="row">
					        <div class="col-md-12">

								<div class="input-group m-b-30">
                                  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-search"></span></span>
                                  <input type="text" class="form-control" id="id_consulta"  name="id_consulta" placeholder="Escriba el Número de Radicado a Consultar" aria-describedby="basic-addon1">
                                </div>

					        </div>
					    </div>
					    <div class="row">
					      	<div class="col-md-12" >
					        	<button type="submit" id="btn_login" class="btn btn-success btn-lg fullwidth">Buscar Expediente</button>
					      	</div>
					    </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>





<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>