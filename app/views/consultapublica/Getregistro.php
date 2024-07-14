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
?>
<div class="row bg-title">
    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">FORMATO DE REGISTRO DEL <?= PROJECTNAME ?></h4> </div>
</div>
<div class="row">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
	 		<div class="row p-30">
	 			<div class="col-md-12">
	 				<header>
	          			<h2>CREAR CUENTA DE USUARIO</h2>
	        		</header>
	    		</div>
	 			<div class="col-md-6">
	 				<div class="jumbotron">
						<?php echo $contenido_email ?>
					</div>
	 			</div>
	 			<div class="col-md-6">
	 				<form id='formsuscriptores_contactos' method='POST' action="/consultapublica/registrosuscriptor/"> 
						
						<div class="form-group">
                            <label for="">Número de Identificación / NIT De la Empresa (Sin DV) :</label>
                            <div class="input-group"> 
								<span class="input-group-btn">
							    	<button type="button" class="btn waves-effect waves-light btn-info">
							    		<i class="fa fa-asterisk"></i>
							    	</button>
								</span>
                            	<input type='text' class="form-control" name='identificacion' placeholder="<?= SUSCRIPTORCAMPOIDENTIFICACION; ?>" id='identificacion' maxlength='15' />
							</div>
                        </div>
                        <div class="form-group">
                            <label for="">Nombre o Razón Social de la Empresa :</label>
                            <div class="input-group"> 
								<span class="input-group-btn">
							    	<button type="button" class="btn waves-effect waves-light btn-info">
							    		<i class="fa fa-user"></i>
							    	</button>
								</span>
                            	<input type='text' class="form-control" name='nombre' placeholder="Nombre o Razón Social" id='nombre' maxlength='200' />
							</div>
                        </div>
                        <div class="form-group">
                            <label for="">Dirección de Correo Electrónico :</label>
                            <div class="input-group"> 
								<span class="input-group-btn">
							    	<button type="button" class="btn waves-effect waves-light btn-info">
							    		<i class="fa fa-at"></i>
							    	</button>
								</span>
                            	<input type='text' class="form-control" name='email' placeholder="Direccion de Correo Electrónico" id='email' maxlength='200' />
							</div>
                        </div>
                        <div class="form-group">
                            <label for="">Ciudad de Residencia :</label>
                            <div class="input-group"> 
								<span class="input-group-btn">
							    	<button type="button" class="btn waves-effect waves-light btn-info">
							    		<i class="fa fa-globe"></i>
							    	</button>
								</span>
                            	<input type='text' class="form-control" name='ciudad' placeholder="Ciudad de Residencia" id='ciudad' maxlength='200' />
							</div>
                        </div>
                        <div class="form-group">
                            <label for="">Dirección de Residencia :</label>
                            <div class="input-group"> 
								<span class="input-group-btn">
							    	<button type="button" class="btn waves-effect waves-light btn-info">
							    		<i class="fa fa-location-arrow"></i>
							    	</button>
								</span>
                            	<input type='text' class="form-control" name='direccion' placeholder="Dirección de Residencia" id='direccion' maxlength='200' />
							</div>
                        </div>
                        <div class="form-group">
                            <label for="">Número de Telefono :</label>
                            <div class="input-group"> 
								<span class="input-group-btn">
							    	<button type="button" class="btn waves-effect waves-light btn-info">
							    		<i class="fa fa-phone"></i>
							    	</button>
								</span>
                            	<input type='text' class="form-control" name='telefonos' placeholder="Número de Teléfono" id='telefonos' maxlength='200' />
							</div>
                        </div>
                        <div class="form-group">
                            <label for="">Seleccione Que Tipo de Relación Tiene con la Entidad:</label>
                            <div class="input-group"> 
								<span class="input-group-btn">
							    	<button type="button" class="btn waves-effect waves-light btn-info">
							    		<i class="fa fa-handshake-o"></i>
							    	</button>
								</span>
								<select name='type' value="<?= $typess ?>" id='type' class="form-control">
								<?
									$typess = $con->Query("select * from suscriptores_tipos where es_web = '1' ");
									while ($row = $con->FetchAssoc($typess)) {
										echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
									}
								?>
								</select>
							</div>
                        </div>
                        
									

						<div class="row">
							<div class="col-md-3 col-md-offset-3">
								<button type="submit" class="btn btn-primary btn-lg" onClick="SendForm('formsuscriptores_contactos')">Registrar</button>
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
<style type="text/css">
	p{
		text-align: justify;
	}
</style>