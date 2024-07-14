<?
	if ($_SESSION['p_suscriptores'] == "0") {
		header("LOCATION: ".HOMEDIR.trim(" /dashboard/"));
	}
	global $c;
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>

<div class="row">
	<div class="col-md-12">
	    <ul class="nav nav-pills m-b-30 ">
	        <li  <?= $c->Ayuda('189', 'tog') ?> class="active"> <a href="#navpills-1" data-toggle="tab" aria-expanded="false"><?= SUSCRIPTORCAMPONOMBRE ?></a> </li>
	        <li  <?= $c->Ayuda('190', 'tog') ?> class=""> <a href="#navpills-2" data-toggle="tab" aria-expanded="false">Carga Masiva</a> </li>
	        <li  <?= $c->Ayuda('191', 'tog') ?>> <a href="#navpills-3" data-toggle="tab" aria-expanded="true">Unificar <?= SUSCRIPTORCAMPONOMBRE ?></a> </li>
	        <li  <?= $c->Ayuda('192', 'tog') ?>> <a href="#navpills-4" data-toggle="tab" aria-expanded="true">Tipos de <?= SUSCRIPTORCAMPONOMBRE ?></a> </li>
	    </ul>
	    <div class="tab-content br-n pn">
	        <div id="navpills-1" class="tab-pane active">
	            <div class="row">
	                <div class="col-md-6">
	                	<div id="gestion-actuaciones">
						    <div id="editararea" class="left table">
						        <h3>Crear <?= SUSCRIPTORCAMPONOMBRE ?></h3>
								<div id="menu_tab">
									<div id="cargador_box_upfiles_menu"></div>
								</div>
								<?
									include(VIEWS.DS."suscriptores_contactos".DS."FormInsertSuscriptores_contactos.php");
								?>
								<hr>
								<h3>Listado de <?= SUSCRIPTORCAMPONOMBRE ?></h3>
								<div class="row">
									<div class="col-md-4">
										<label><?= SUSCRIPTORCAMPONOMBRE ?></label>
										<input type='text'  <?= $c->Ayuda('196', 'tog') ?> class="form-control" placeholder="Buscar <?= SUSCRIPTORCAMPONOMBRE ?>" id='BusarSuscriptor' />
									</div>
									<div class="col-md-4">
										<label>Tipo</label>
										<select class="input1_0  form-control important"  <?= $c->Ayuda('197', 'tog') ?> placeholder="Tipo de <?= SUSCRIPTORCAMPONOMBRE ?>" id='BusarSuscriptorType' maxlength='200'>
										<option value="">Tipo de <?= SUSCRIPTORCAMPONOMBRE ?></option>
										<?
											$lx = new MSuscriptores_tipos;
											$query_eg = $lx->ListarSuscriptores_tipos(); 
											while($row_type = $con->FetchAssoc($query_eg)){
												echo "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
											}
										?>
										<option value="OTRO">OTRO</option>
									</select>
									</div>
									<div class="col-md-4">
										<label>Estado</label>
										<select class="form-control"  <?= $c->Ayuda('198', 'tog') ?> id="BusarSuscriptorEstado" >
											<option value="">Todos los Estado</option>
											<option value="1">Activo</option>
											<option value="0">Inactivo</option>		
										</select>
									</div>
								</div>
									<div id="cargaranexospreview">
									</div>
								</div>
							</div>
	                </div>
	                <div class="col-md-6">
	                	<div id="gestion-actuaciones">
						   	<h3>Detalle <?= SUSCRIPTORCAMPONOMBRE ?></h3>
						    <br>
					        <div class="table" id="formeditsuscriptores">
								<div class="alert alert-info">Seleccione <?= SUSCRIPTORCAMPONOMBRE ?></div>
							</div>
						</div>							
	                </div>
	            </div>
	        </div>
	        <div id="navpills-2" class="tab-pane">
	            <div class="row">
	                <div class="col-md-12">
	                	<h3>Carga Masiva de <?= SUSCRIPTORCAMPONOMBRE ?></h3>
	                	<div class="jumbotron">
	                		<p>
	                			
							Diligencie el archivo con los datos requeridos para crear suscriptores masivamente y posterior subir el archivo por el botón "Procesar archivo".

	                		</p>
							<input type='button' class="btn btn-info btn-lg" <?= $c->Ayuda('201', 'tog') ?> value='Descargar archivo' onclick="descargar_archivo();"  />
							<input type='button' class="btn btn-info btn-lg" <?= $c->Ayuda('202', 'tog') ?> id="upload_button2"  value='Procesar archivo' />
	                		
	                	</div>
			        	
	                </div>
	            </div>
	        </div>
	        <div id="navpills-3" class="tab-pane">
	        	<?php
					$listado_suscriptores = '<option value=""></option>';
					$query=$con->Query("SELECT id,(select count(*) from gestion where suscriptor_id = suscriptores_contactos.id) as exped, nombre, `type` FROM suscriptores_contactos order by nombre");
					while ($row = $con->FetchAssoc($query)) {
						$listado_suscriptores .= '<option value="'.$row['id'].'">'.$row['nombre'].' ('.$row['type'].') (id:'.$row['id'].') (Exp:'.$row['exped'].')</option>';
					}
				?>
	            <div class="row">
	                <div class="col-md-12">
	                	
						<h3>Unificar <?= SUSCRIPTORCAMPONOMBRE ?></h3>
							
						<div class="row" >
							<div class="col-md-6">
								<label><?= SUSCRIPTORCAMPONOMBRE ?> a Cargar Expedientes <?= $c->Ayuda('203') ?> </label>
								<select class="form-control" id="suscriptor_carga">
									<?php echo $listado_suscriptores; ?>
								</select>
							</div>
							<div class="col-md-6">
								<label><?= SUSCRIPTORCAMPONOMBRE ?> a Eliminar <?= $c->Ayuda('204') ?> </label>
								<select class="form-control" id="suscriptor_eliminar">
									<?php echo $listado_suscriptores; ?>		
								</select>
							</div>
						</div>

						<br>

						<input type="button"  class="btn btn-info"  value="Unificar <?= SUSCRIPTORCAMPONOMBRE ?>" onclick="fnSuscriptoresUnificar()">
							  
	                </div>
	            </div>
	        </div>
	        <div id="navpills-4" class="tab-pane">
	            <div class="row">
	                <div class="col-md-6">
						<?	
							include(VIEWS.DS."suscriptores_tipos/FormInsertSuscriptores_tipos.php");
						?>
					</div>
					<div class="col-md-6" id="listadosuscriptorestipos">
						<?	
						$object = new MSuscriptores_tipos;
						// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
						$query = $object->ListarSuscriptores_tipos();	    
							include(VIEWS.DS."suscriptores_tipos/Listar.php");
						?>
					</div>
	            </div>
	        </div>
	    </div>
		
	</div>
</div>




<style type="text/css">
	.title{
	    line-height: 36px;
	    font-size: 24px;
	    color: #313131;
	    background: #FFF;
	    margin: 10px 0;
	    font-weight: 300;
	}
</style>

<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/AjaxUpload.2.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var button = $('#upload_button2'), interval;
	new AjaxUpload('#upload_button2', {
        action: '/suscriptores_contactos/importar/',
		onSubmit : function(file , ext){
			if (! (ext && /^(xlsx)$/.test(ext))){
				// extensiones permitidas
				alert('Error: Solo se permiten archivos csv');
				// cancela upload
				return false;
			} else {
				this.disable();
			}
		},
		onComplete: function(file, response){
			//$("#listadosus").html("->"+response);
			alert('Archivo procesado');

			//document.location.reload(true);
		}
	});
});


function descargar_archivo(){
	document.location.href = "<?php echo HOMEDIR.'/app/plugins/CARGA_SUSCRIPTORES.xlsx'; ?>";
}

</script>
<script type="text/javascript">


	$(document).ready(function(){
		showqanexos('/suscriptores_contactos/GetListado/1/');
		$('#BusarSuscriptor').keyup(function () { 
			if ($('#BusarSuscriptor').val() == "" && $('#BusarSuscriptorType').val() == "" && $('#BusarSuscriptorEstado').val() == "") {
				showqanexos('/suscriptores_contactos/GetListado/1/');
			}else{
				showqanexos('/suscriptores_contactos/BuscarXSuscriptor2/'+$('#BusarSuscriptor').val()+'|'+$('#BusarSuscriptorType').val()+'|'+$('#BusarSuscriptorEstado').val()+'/1/');		
			}
		});
		$('#BusarSuscriptorType').change(function () { 
			if ($('#BusarSuscriptor').val() == "" && $('#BusarSuscriptorType').val() == "" && $('#BusarSuscriptorEstado').val() == "") {
				showqanexos('/suscriptores_contactos/GetListado/1/');
			}else{
				showqanexos('/suscriptores_contactos/BuscarXSuscriptor2/'+$('#BusarSuscriptor').val()+'|'+$('#BusarSuscriptorType').val()+'|'+$('#BusarSuscriptorEstado').val()+'/1/');	
			}
		});
		$('#BusarSuscriptorEstado').change(function () { 
			if ($('#BusarSuscriptor').val() == "" && $('#BusarSuscriptorType').val() == "" && $('#BusarSuscriptorEstado').val() == "") {
				showqanexos('/suscriptores_contactos/GetListado/1/');
			}else{
				showqanexos('/suscriptores_contactos/BuscarXSuscriptor2/'+$('#BusarSuscriptor').val()+'|'+$('#BusarSuscriptorType').val()+'|'+$('#BusarSuscriptorEstado').val()+'/1/');	
			}
		});
	});
</script>