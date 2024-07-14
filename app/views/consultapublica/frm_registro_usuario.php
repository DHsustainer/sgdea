<?
	global $f;
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
  //Declaramos la función que recibe el tiempo
  function refrescar(tiempo){
    //Cuando pase el tiempo elegido la página se refrescará 
    setTimeout("location.reload(true);", tiempo);
  }
  //Podemos ejecutar la función de este modo
  //La página se actualizará dentro de 10 segundos
  refrescar(900000);
</script>
<div class="col-md-12">
		<header>
			<h2>CREAR CUENTA DE USUARIO</h2>
	</header>
</div>
	<div class="col-md-12">
	<form id="formurusuario" method='POST' action="/consultapublica/registarusuario/" class="p-20 validation-wizard">
		<div class="form-group">
            <label for="identificacion">Número de Identificación: <span class="text-danger">*</span></label>
            <div class="input-group"> 
				<span class="input-group-btn">
			    	<button type="button" class="btn waves-effect waves-light btn-info">
			    		<i class="fa fa-hashtag"></i>
			    	</button>
				</span>
            	<input type='number' class="form-control required" name='identificacion' placeholder="<?= SUSCRIPTORCAMPOIDENTIFICACION; ?>" id='identificacion' maxlength='15' onblur="CheckForError('identificacion', this.id)" />
			</div>
            <div id="error_identificacion"></div>
        </div>

		<div class="dn">
			<input type="hidden" id="spadre" name="spadre" class="form-control">
			<input type="hidden" id="seccional" name="seccional" class="form-control">
			<input type="hidden" id="area" name="area" class="form-control">
	      	
		</div>

		<div class="form-group">
            <label for="pnombre">Nombre Completo: <span class="text-danger">*</span></label>
            <div class="input-group"> 
				<span class="input-group-btn">
			    	<button type="button" class="btn waves-effect waves-light btn-info">
			    		<i class="fa fa-user"></i>
			    	</button>
				</span>
            	<input type='text' class="form-control required" name='pnombre'  placeholder="Nombre"  id='pnombre' maxlength='20' />
			</div>
        </div>


		<div class="form-group">
            <label for="papellido">Nombre del Comercio: <span class="text-danger">*</span></label>
            <div class="input-group"> 
				<span class="input-group-btn">
			    	<button type="button" class="btn waves-effect waves-light btn-info">
			    		<i class="fa fa-user"></i>
			    	</button>
				</span>
            	<input type='text' class="form-control required" placeholder="Apellido" name="papellido" id="papellido" maxlength='20' />
			</div>
        </div>

        <div class="form-group">
            <label for="universidad">Tipo de Comercio:</label>
            <div class="input-group"> 
				<span class="input-group-btn">
			    	<button type="button" class="btn waves-effect waves-light btn-info">
			    		<i class="fa fa-hashtag"></i>
			    	</button>
				</span>
				<select name="universidad" id="universidad" class="form-control required" >
					<option value="Seleccione una Ooción">Seleccione una Ooción</option>
					<option value="Tienda">Tienda</option>
					<option value="Plaza de Mercado">Plaza de Mercado</option>
					<option value="Restaurantes y Comidas Rapidas">Restaurantes y Comidas Rapidas</option>
					<option value="Supermercados">Supermercados</option>
					<option value="Calzado y Hogar">Calzado y Hogar</option>
				</select>
			</div>
        </div>

		<div class="form-group <?= HABILITARSECCIONALES ?>">
            <label for="celular">Departamento </label>
            <!--<label for="celular">¿Desde que ciudad envías tus notificaciones?</label>-->
            <div class="input-group"> 
				<span class="input-group-btn">
			    	<button type="button" class="btn waves-effect waves-light btn-info">
			    		<i class="fa fa-location-arrow"></i>
			    	</button>
				</span>
				<select class="form-control required" name="seccional_siamm" id="seccional_siamm" maxlength="14">
					<?
						$seccional = SECCIONALSIAMM;
						$get = $c->sql_quote($_REQUEST['id']);
						if ($get != '' ) {
							
							$q = $con->Query("select * from seccional where direccion = '$get'");
							$roc = $con->FetchAssoc($q);
							if ($roc['id'] != "") {
								$seccional = $get;
							}else{
								$seccional = SECCIONALSIAMM;
							}

						}
					?>
					<option value="<?= $seccional  ?>">SELECCIONE UNA OPCION</option>
					<?
						$q = $con->Query("select * from seccional order by nombre");
						while ($roc = $con->FetchAssoc($q)) {
							echo '<option value="'.$roc['direccion'].'">'.$roc['nombre'].'</option>';
						}
					?>
               </select>
			</div>
        </div>

		<div class="form-group">
            <label for="ciudad">Ciudad:</label>
            <div class="input-group"> 
				<span class="input-group-btn">
			    	<button type="button" class="btn waves-effect waves-light btn-info">
			    		<i class="fa fa-location-arrow"></i>
			    	</button>
				</span>
            	<input type='text' class="form-control" placeholder="ciudad" name="ciudad" id="ciudad" maxlength="30" />
			</div>
        </div>       
        
		<div class="form-group">
            <label for="email">E-mail: <span class="text-danger">*</span></label>
            <div class="input-group"> 
				<span class="input-group-btn">
			    	<button type="button" class="btn waves-effect waves-light btn-info">
			    		<i class="fa fa-envelope"></i>
			    	</button>
				</span>
            	<input type='email' class="form-control required"  onblur="CheckForError('email', this.id)"  placeholder="Direccion de Correo" name="email" id="email" />
			</div>
			<div id="error_email"></div>
        </div>
		<div class="form-group">
            <label for="direccion">Dirección:</label>
            <div class="input-group"> 
				<span class="input-group-btn">
			    	<button type="button" class="btn waves-effect waves-light btn-info">
			    		<i class="fa fa-home"></i>
			    	</button>
				</span>
            	<input type='text' class="form-control " placeholder="direccion" name="direccion" id="direccion" maxlength="50" />
			</div>
        </div>


		<div class="form-group">
            <label for="celular">Celular:</label>
            <div class="input-group"> 
				<span class="input-group-btn">
			    	<button type="button" class="btn waves-effect waves-light btn-info">
			    		<i class="fa fa-mobile"></i>
			    	</button>
				</span>
            	<input type='number' class="form-control required" placeholder="celular" name="celular" id="celular" maxlength="14" />
			</div>
        </div>
    	<div class="row">
			<div class="col-md-12">
				<div class="form-group" align="center">
		            <div class="g-recaptcha" data-sitekey="6LeuotIZAAAAAOTQSoPvFhzRrQIeAQcXPqlAcd2x"></div>
		        </div>
		        <div class="form-group">
		            <div class="col-md-12">
		                <div id="msg_field" class="text-danger p-l-10"><b><?= $error ?></b></div>
		            </div>
		        </div>
			</div>
		</div>
		<div class="row m-t-20">
			<div class="col-md-12">
				<input type="submit" class="btn btn-info" value="Registrar Usuario">	
			</div>
		</div>
	</form>
	</div>

<script type="text/javascript">
	function CheckForError(campo, valor){
		var val = $("#"+valor).val();
		var URL = '/s/checkerror/'+campo+"/"+val+"/";
	    $.ajax({
	        type: 'POST',
	        dataType: "json",
	        url: URL,
	        success:function(msg){
	    		$("#error_"+campo).html(msg["msg"]);
	    		if(msg["stat"] == "0"){
	    			$("#"+campo).val("");
	    		}
	        }
	    });
		
	}
</script>	 			