<?
	global $c;
	$totalc = $c->GetTotalFromTable("seccional_principal", "");
	$totalof = $c->GetTotalFromTable("seccional", "");

	$object = new MSuscriptores_contactos;
	$object->CreateSuscriptores_contactos("id", $_SESSION["suscriptor_id"]);
	$objectd = new MSuscriptores_contactos_direccion;
	$objectd->CreateSuscriptores_contactos_direccion("id_contacto", $_SESSION["suscriptor_id"]);

	if (!isset($_SESSION['smallid']) || $_SESSION['smallid'] == '') {
		$smallid = $f->GenerarSmallId();
		$_SESSION['smallid'] = $smallid;
	}

	$tipo_d = $con->Query("select * from dependencias where es_publico = 1 limit 0, 1");
	$tipo_dq = $con->FetchAssoc($tipo_d);
	$tipo_documento = $tipo_dq['id'];	

	$MPlantillas_email = new MPlantillas_email;
	$MPlantillas_email->CreatePlantillas_email('id', '14');
	$contenido_email = $MPlantillas_email->GetContenido();

	$SegundoMensaje = new MPlantillas_email;
	$SegundoMensaje->CreatePlantillas_email('id', '15');	
	$ContenidoSMensaje = $SegundoMensaje->GetContenido();

	$TercerMensaje = new MPlantillas_email;
	$TercerMensaje->CreatePlantillas_email('id', '24');	
	$ContenidoSMensajeCarga = $TercerMensaje->GetContenido();
?>

<div class="row m-t-20">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
            <!-- Validation wizard -->
            <div class="card-body wizard-content">
                <h4 class="card-title">Ventanilla de Radicación Individual del <?= PROJECTNAME ?></h4>
                <h6 class="card-subtitle text-muted">El sistema le guiará paso a paso durante el proceso de radicación</h6>
                <form id='formgestion' action='/gestion/registro_publico/' method='POST' class="validation-wizard wizard-circle m-t-40">
                    <!-- Step 1 -->
                    <h6>Seleeccionar Tipo de Formulario</h6>
                    <section>
                        <div class="row m-t-20">
                            <div class="col-md-6">
                                <div class="jumbotron">
									<?php echo $contenido_email ?>
								</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                	<label for="suscriptor_id"> Seleccione un Usuario: *</label><br>
                                    <select name="suscriptor_id" id="suscriptor_id" style="width:100%; height:50px; margin-left:10px;" class="form-control m-b-30 required">
										<option value="">SELECCIONE UNA OPCION</option>
									<?
										/*if ($object->GetType() != "1") {
											echo '<option value="N">NUEVO EMPLEADO</option>';
										}*/
										echo '<option value="'.$object->GetId().'">'.$object->GetNombre().'</option>';
										
										$tipo_d = $con->Query("select * from suscriptores_contactos where dependencia = '".$object->GetId()."'");
										
										while ($row = $con->FetchAssoc($tipo_d)) {
											echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
										}
									?>
										
									</select>
                                    <label for="tipo_documento"> Seleccione un Tipo de Formulario : *</label><br>
                                    <select style="width:100%; height:50px; margin-left:10px;" class="form-control required" name="tipo_documento" id="tipo_documento">
									<?
										echo '<option value="">SELECCIONE UNA OPCION</option>';
                                    	
										$tipo_d = $con->Query("select meta_referencias_titulos.id_s from meta_titulos_suscriptores inner join meta_referencias_titulos on meta_referencias_titulos.id = meta_titulos_suscriptores.id_referencia  where tipo_suscriptor = '".$object->GetType()."'");
										
										while ($row = $con->FetchAssoc($tipo_d)) {
											$d = new MDependencias;
											$d->CreateDependencias("id", $row['id_s']);
											echo "<option value='".$d->GetId()."'>".$d->GetTitulo_publico()."</option>";
										}
									?>
										
									</select>
									<textarea class="form-control important" type='text' name='observacion' id='observacion' placeholder="Título del Expediente" style="height:50px; display:none"></textarea>
									<script type="text/javascript">
										$("#tipo_documento").change(function(){
											$("#observacion").val($("#tipo_documento option:selected").text());
											$("#titleform").html("Diligencie el Formulario: "+$("#tipo_documento option:selected").text()+" de "+$("#suscriptor_id option:selected").text());

											$("#titledocsx").html("Cargue los Documentos de: "+$("#tipo_documento option:selected").text()+" de "+$("#suscriptor_id option:selected").text());

											$("#titleend").html("Finalizar Proceso de: "+$("#tipo_documento option:selected").text()+" de "+$("#suscriptor_id option:selected").text());

											
											
											$.ajax({
										        type: "POST",
										        url: "/meta_big_data/doform/"+$("#tipo_documento").val()+"/"+$("#suscriptor_id").val()+"/",
										        success:function(msg){
										            result = msg;
										            $("#loadMetaform").html(result);
												    
												    var URL = '/gestion_anexos/getcargapublica/'+$("#tipo_documento").val()+"/";
											        $.ajax({
											            type: 'POST',
											            url: URL,
											            success:function(msg){
											                if (msg != "") {
											                	$("#modecarga").css("display","none");
											                	$("#listadocumentostipos").css("display","block");
											                	$("#listadocumentostipos").html(msg);
											                }else{
											                	$("#modecarga").css("display","block");
											                	$("#listadocumentostipos").css("display","none");
											                }
											                //window.location.reload();
											            }

											        }); 
											        
										        }
										    });

								        	return false;
										})
										$("#suscriptor_id").change(function(){
											$("#titleform").html("Diligencie el Formulario: "+$("#tipo_documento option:selected").text()+" de "+$("#suscriptor_id option:selected").text());

											$("#titledocsx").html("Cargue los Documentos de: "+$("#tipo_documento option:selected").text()+" de "+$("#suscriptor_id option:selected").text());

											$("#titleend").html("Finalizar Proceso de: "+$("#tipo_documento option:selected").text()+" de "+$("#suscriptor_id option:selected").text());

											$.ajax({
												type: "POST",
												dataType: "json",
										        url: "/suscriptores_contactos/buscarJsuscriptor/"+$("#suscriptor_id").val()+"/",
										        success:function(msg){
										            result = msg;

										            $("#Identificacion_suscriptor").val(msg["Identificacion_suscriptor"]);
													$("#Type_suscriptor").val(msg["Type_suscriptor"]);
													$("#Direccion_suscriptor").val(msg["Direccion_suscriptor"]);
													$("#Ciudad_suscriptor").val(msg["Ciudad_suscriptor"]);
													$("#Telefonos_suscriptor").val(msg["Telefonos_suscriptor"]);
													$("#Email_suscriptor").val(msg["Email_suscriptor"]);
													$("#nombresuscriptor").val($("#suscriptor_id option:selected").text());
													$("#dtform").val($("#suscriptor_id").val());

										        }
										    });
										})
									</script>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h6>Verificar Información de Contacto</h6>
                    <section>
                        <div class="row  m-t-20 m-b-20" >
                        	<div class="col-md-12" >
                        		<h2>Verifique la información del Contacto</h4>
                        	</div>
                            <div class="col-md-12" style="display:none">
                                <div class="form-group">
                                    <label for="Type_suscriptor">Tipo de Suscriptor :</label>
                                    <input class="form-control required disabled" type="text" id="Type_suscriptor" name="Type_suscriptor" value="<?= $object->GetType() ?>" disabled="disabled" readonly="readonly">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombresuscriptor">Nombre Completo :</label>
                                    <input class="form-control required" type='text' name='nombresuscriptor' id='nombresuscriptor' placeholder="Escriba su nombre completo" maxlength='100' value="<?= $object->GetNombre() ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Identificacion_suscriptor">Número de Identificación :</label>
                                    <input class="form-control required" type="text" placeholder="<?= SUSCRIPTORCAMPOIDENTIFICACION; ?>" id="Identificacion_suscriptor" name="Identificacion_suscriptor" value="<?= $object->GetIdentificacion() ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="Ciudad_suscriptor">Ciudad de Residencia :</label>
                                    <input class="form-control required" type="text" placeholder="Ciudad" id="Ciudad_suscriptor" name="Ciudad_suscriptor" value="<?= $objectd->GetCiudad() ?>" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Direccion_suscriptor">Dirección de Residencia :</label>
                                    <input class="form-control required" type="text" placeholder="<?= SUSCRIPTORCAMPODIRECCION; ?>" id="Direccion_suscriptor" name="Direccion_suscriptor" value="<?= $objectd->GetDireccion() ?>" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="Telefonos_suscriptor">Numero de Telefono :</label>
                                    <input class="form-control required" type="text" placeholder="Telefonos" id="Telefonos_suscriptor" name="Telefonos_suscriptor" value="<?= $objectd->GetTelefonos() ?>" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Email_suscriptor">Dirección de Correo :</label>
                                    <input class="form-control required" type="text" placeholder="E-mail" id="Email_suscriptor" name="Email_suscriptor" value="<?= $objectd->GetEmail() ?>" >
                                </div>
                            </div>
                        </div>

                    	
						<div class="row" style="margin:10px;">
							<input type="hidden" id="dtform" name="dtform"  class='input1_0 form-control important' value="<?= $_SESSION['suscriptor_id'] ?>">

							<input type="hidden"  name="documento_salida" id="documento_salida" value="N">
							<input type="hidden"  name="es_externo" id="es_externo" value="NO">
						</div>
                    </section>
                    <!-- Step 3 -->
                    <h6>Diligenciar Formulario</h6>
                    <section>
                    	<div class="3u 12u(narrower)" style="height:35px; display: none">
							<select style="height:35px; display: none" name="autorad" id="autorad" class='input1_0 form-control'><option value="SI">SI</option></select>
							<input style="height:35px;" class="form-control" type='hidden' name='folio' id='folio' placeholder="Numero de Folios:" maxlength='3' />
							<input style="height:35px;" class="form-control" type='hidden' name='num_oficio_respuesta' id='num_oficio_respuesta' placeholder="Número de Radicado Interno" maxlength='100' />
							<input style="height:35px;" class="form-control" type='hidden' name='num_oficio_respuesta_hid' id='num_oficio_respuesta_hid' maxlength='100' />
							<input style="height:35px;" class="form-control" type='hidden' name='anho_rad' id='anho_rad' value="<?= date('Y-') ?>" maxlength='100' />							
							<input style="height:35px;" class="form-control" type='text' name='radicado' id='radicado' placeholder="Ingresar Numero de Radicado (si aplica)" maxlength='100' />
							<input style="height:35px; display:none" class="form-control datepicker" type='text' name='f_recibido' id='f_recibido' placeholder="Fecha de Recibido:" maxlength='' value="<?= date('Y-m-d') ?>" />
							<input style="height:35px; display:none" class="form-control datepicker" type='text' name='fecha_vencimiento' id='fecha_vencimiento' placeholder="Fecha de Vencimiento Respuesta:" maxlength='' />
							<input style="height:35px; display:none" class="form-control datepicker" type='text' name='prioridad' id='prioridad' placeholder="Fecha de Vencimiento Respuesta:" maxlength='' value="1" />
							<input style="height:35px; display:none" class="form-control" type='text' name='estado_solicitud' id='estado_solicitud' placeholder="estado de la solicitud" maxlength='' value="1" />

							<input style="height:35px;" class="form-control" type='hidden' name='nombre_radica' id='nombre_radica' placeholder="Nombre de quien radica:" maxlength='90' />
							<select style="height:35px; display:none" name="estado_respuesta" id="estado_respuesta" class='input1_0 form-control'><option value="Abierto">Se respondió la solicitúd</option><option value="Abierto">NO</option><option value="Cerrado">SI</option></select>
							<input class="form-control datepicker" type='hidden' name='fecha_respuesta' id='fecha_respuesta' placeholder="Fecha_respuesta:" maxlength='' />
							<input class="form-control" type='hidden' name='usuario_registra' id='usuario_registra' placeholder="Usuario_registra:" maxlength='50' value="<?= $_SESSION['usuario'] ?>" />
							<input class="form-control" type='hidden' name='estado_archivo' id='estado_archivo' placeholder="Estado_archivo:" maxlength='1' value="1" />
							<textarea class="form-control" type='text' name='observacion2' id='observacion2' placeholder="Observación del Expediente" style="height:100px; display:none"></textarea>
							<br><?$cy = new MCity;$cy->CreateCity("code", $_SESSION['ciudad']);?>
							<input type='hidden' id='mydpto' value="<?= $cy->GetProvince() ?>" />
							<input type='hidden' id='mycity' value="<?= $cy->GetCode() ?>" />

									
						</div>
						<div class="row  m-t-20 m-b-20" >
                        	<div class="col-md-12" >
                        		<h2 id="titleform">Diligencie el Formulario</h4>
                        	</div>
                        </div>
                        <div class="row">
                        	<div class="col-md-12" id="loadMetaform"></div>
                        </div>
                    </section>
                    <!-- Step 4 -->
                    <h6>Cargar Documentos</h6>
                    <section>
                    	<div class="row  m-t-20 m-b-20" >
                        	<div class="col-md-12" >
                        		<h2 id="titledocsx"></h4>
                        	</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="jumbotron">
									<?php echo $ContenidoSMensajeCarga ?>
								</div>
                            </div>
                            <div class="col-md-6">
                            	<div id='cargadocumentos'>			
									<div style="margin-top:50px" id="modecarga">
									</div>
									<div class="list-group" id="listadocumentostipos"></div>
								</div>
                            </div>
                        </div>
                    </section>

                    <!-- nueva seccion -->
                    <h6>Registrar</h6>
                    <section>
                        <div class="row">
                        	<div class="row  m-t-20 m-b-20" >
	                        	<div class="col-md-12" >
	                        		<h2 id="titleend"></h4>
	                        	</div>
	                        </div>
                            <div class="col-md-6">
                                <div class="jumbotron">
									<?php echo $ContenidoSMensaje ?>
								</div>
                            </div>
                            <div class="col-md-6">
                                <div align="center">
									<input type='button' class="btn btn-primary btn-lg" style="height:60px;line-height:40px;padding-left:50px; margin-top:50px; padding-right:50px;font-size: 22px" value='Registrar' onClick="ChecSuscriptoresExistsGestionRegistrar()"/>
								</div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>     
		</div>
	</div>
</div>

<link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery-wizard-master/steps.css" rel="stylesheet">

<!-- Form Wizard JavaScript -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/moment/moment.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery.steps-1.1.0/jquery.steps.min.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery-wizard-master/jquery.validate.js"></script>
<link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/select2/css/select2.min.css'/>
<script language='javascript' type='text/javascript' src='<?= HOMEDIR.DS ?>app/plugins/select2/js/select2.min.js'></script>
<script type="text/javascript">
	(function($) {
		if ($('.select2').length){
			$(".select2").select2();
		}
	})(jQuery);
</script>
<script>
    //Custom design form example
    $(".tab-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit",
            previous: "Anterior"
            
        },
        onFinished: function (event, currentIndex) {
            swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");

        }
    });


    var form = $(".validation-wizard").show();

    $(".validation-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit",
            previous: "Anterior"
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
        },
        onFinishing: function (event, currentIndex) {
            return form.validate().settings.ignore = ":disabled", form.valid()
        },
        onFinished: function (event, currentIndex) {
            swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        }
    }), $(".validation-wizard").validate({
    	errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "']" )
						.append( error );
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "']" )
						.addClass( 'text-danger' );
		},
		errorElement: "span",
		messages: {
			user: {
				required: " (*)",
				minlength: " (must be at least 3 characters)"
			}
		},
        ignore: "input[type=hidden]",
        errorClass: "text-danger",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).addClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
            //$(element).parent().removeClass(errorClass)
        },
        /*errorPlacement: function (error, element) {
            error.insertAfter(element)
        },*/
        rules: {
            email: {
                email: !0
            }
        }
    })
</script>
<style type="text/css">
	.text-danger{
		    border-color: #f44336;
	}
</style>
<script type="text/javascript">
	function updateession(){
		var URL = '/login/updateession/';
	    $.ajax({
	        type: 'POST',
	        url: URL,
	        success:function(msg){
	            
	        }
	    });
	}
	updateession();
	setInterval("updateession();",420000);
</script>