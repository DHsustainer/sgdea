<?
	global $c;
  	$sadmin = new MSuper_admin;
    $sadmin->CreateSuper_admin("id", "6");
    $uri = "";
    if ($sadmin->GetFoto_perfil() == "") {
      	$uri = HOMEDIR.DS."app/views/assets/images/logo_expedientes2.png";
    }else{
    	$uri = HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil();
    }

    $MPlantillas_email = new MPlantillas_email;
	$MPlantillas_email->CreatePlantillas_email('id', '25');
	$contenido_email = $MPlantillas_email->GetContenido();

	$typess = $c->GetDataFromTable("suscriptores_tipos", "es_web", "1", "id", "");
?>
<div class="row m-t-20">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
	 		<div class="row p-30">
	 			<div class="col-md-12">
	 				<header>
	          			<h2>RECURSOS DE CONSULTA PUBLICA SGDEA</h2>
	        		</header>
		    		<div class="list-group">
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Inicio de Sesion:
					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>" target="_blank"><?= HOMEDIR.DS ?></a></code>
					 			</div>
		    				</div>	
		    			</div>
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Registro de Suscriptores:
					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>consultapublica/registro/" target="_blank"><?= HOMEDIR.DS ?>consultapublica/registro/</a></code>
					 			</div>
		    				</div>	
		    			</div>
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Registro de Usuarios:
					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>consultapublica/registro_usuarios/" target="_blank"><?= HOMEDIR.DS ?>consultapublica/registro_usuarios/</a></code>
					 			</div>
		    				</div>	
		    			</div>
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Consulta por Numero de Radicado:
					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>consultapublica/radicado/" target="_blank"><?= HOMEDIR.DS ?>consultapublica/radicado/</a></code>
					 			</div>
		    				</div>	
		    			</div>
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Consulta por Identificacion:
					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>consultapublica/identificacion/" target="_blank"><?= HOMEDIR.DS ?>consultapublica/identificacion/</a></code>
					 			</div>
		    				</div>	
		    			</div>
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Consultar TRD: 
					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>consultapublica/trd/" target="_blank"><?= HOMEDIR.DS ?>consultapublica/trd/</a></code>
					 			</div>
		    				</div>	
		    			</div>
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Consulta de Estados:
					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>consultapublica/estados/" target="_blank"><?= HOMEDIR.DS ?>consultapublica/estados/</a></code>
					 			</div>
		    				</div>	
		    			</div>
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Consulta del Archivo Historico: 

					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>consultapublica/consultahistorica/" target="_blank"><?= HOMEDIR.DS ?>consultapublica/consultahistorica/</a></code>
					 			</div>
		    				</div>	
		    			</div>
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Terminos y Condiciones:
					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>consultapublica/terminos_y_condiciones/" target="_blank"><?= HOMEDIR.DS ?>consultapublica/terminos_y_condiciones/</a></code>
					 			</div>
		    				</div>	
		    			</div>
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Privacidad de Datos:
					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>consultapublica/privacidad_de_datos/" target="_blank"><?= HOMEDIR.DS ?>consultapublica/privacidad_de_datos/</a></code>
					 			</div>
		    				</div>	
		    			</div>
		    			<div class="list-group-item">
		    				<div class="row ">
					 			<div class="col-md-3">
					 				<strong>
					 				Licencia de Uso:
					 				</strong>
					 			</div>
					 			<div class="col-md-9">
					 				<code><a href="<?= HOMEDIR.DS ?>consultapublica/licencia_de_uso/" target="_blank"><?= HOMEDIR.DS ?>consultapublica/licencia_de_uso/</a></code>
					 			</div>
		    				</div>	
		    			</div>
		    		</div>
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
<style type="text/css">
	p{
		text-align: justify;
	}
</style>