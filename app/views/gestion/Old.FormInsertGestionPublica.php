    <link rel="stylesheet" href="<?= ASSETS ?>css/style.css" type="text/css" media="screen"/>

                <div id="steps">
                        <!-- PASO 1 -->
                        <fieldset class="step">
							<div class="row" style="margin:10px;">

								<div class="12u 12u(narrower)">
									<select style="max-width:100%; height:50px; margin-left:10px;" class="form-control" name="tipo_documento" id="tipo_documento">
										<option value='0'>Seleccione una Opción</option>
									<?
										$tipo_d = $con->Query("select * from dependencias where es_publico = 1");
										while ($row = $con->FetchAssoc($tipo_d)) {
											echo "<option value='".$row['id']."'>".$row['titulo_publico']."</option>";
										}
									?>
										
									</select>
									<textarea class="form-control important" type='text' name='observacion' id='observacion' placeholder="Título del Expediente" style="height:50px; display:none"></textarea>
									<div align="center">
										<input type='button' value="Ir al Paso 2..."  class="btn btn-primary btn-lg" style="margin-right: 25px; margin-top:20px; display:none;height:60px; line-height: 60px; padding-left: 50px; padding-right: 50px; font-size: 22px" id="goto2">
									</div>
									<script type="text/javascript">
										$("#tipo_documento").change(function(){
											$("#observacion").val($("#tipo_documento option:selected").text());
											$.ajax({
										        type: "POST",
										        url: "/meta_big_data/doform/"+$("#tipo_documento").val()+"/",
										        success:function(msg){
										            result = msg;
										            $("#loadMetaform").html(result);
										            $("#goto2").css("display", "block");
										        }
										    });
										})
									</script>
								</div>	
							</div>
                        </fieldset>
                        <!-- PASO 2 -->
                        <fieldset class="step">
                            <div class="row" style="margin:10px;">
								<div class="col-md-12">
									<h2>
										INFORMACIÓN DEL SUSCRIPTOR
									</h2>
								</div>
							</div>		
							
                        </fieldset>
                        <!-- PASO 3 -->
                        <fieldset class="step">
                            <div class="row" style="margin:10px; display:none">º
							<?
								if ($_SESSION['suscriptor_id'] == "") {
							?>		
									<div class="3u 12u(narrower)">
										<br><b>Identificación del Expediente</b>
									</div>
									<div class="3u 12u(narrower)">
										<select style="height:35px; display:none" name="autorad" id="autorad" class='input1_0 form-control'>
											<option value="SI">SI</option>
										</select>
										<input style="height:35px;" class="form-control" type='hidden' name='folio' id='folio' placeholder="Numero de Folios:" maxlength='3' />
										<input style="height:35px;" class="form-control" type='text' name='num_oficio_respuesta' id='num_oficio_respuesta' placeholder="Número de Radicado Interno" maxlength='100' value="<?= date("Y-") ?>" />
										<input style="height:35px;" class="form-control" type='hidden' name='num_oficio_respuesta_hid' id='num_oficio_respuesta_hid' maxlength='100' />							
									</div>
							<? 
								}else{
							?>
									
							<?
								}
							?>	

									

							
									




								<div class="row" style="margin:10px;">
									<div class="12u 12u(narrower)">
										<h2>
											DETALLES DEL FORMULARIO
										</h2>
									</div>
								</div>
								<div class="row" style="margin:10px;" id="loadMetaform">
					<?

						$conteo = $con->Query("select count(*) as t from meta_big_data where grupo_id= '".$_SESSION['smallid']."'");
						$tconteo = $con->FetchAssoc($conteo);

						if ($tconteo["t"] <= "0") {
							# code...

							$condocs = $con->Query("select id from meta_referencias_titulos where id_s = '$tipo_documento' and tipo = '1' and es_generico = '1'");
							$idref = $con->FetchAssoc($condocs);
							#echo $idref['id'];
							if ($idref > 0) {
								$checkInsert = $con->Query("select * from meta_referencias_campos where id_referencia = '".$idref['id']."'");
								while ($rrrx = $con->FetchAssoc($checkInsert)) {
									$con->Query("INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form) VALUES ('0', '".$idref['id']."', '".$rrrx['id']."', '', '".$_SESSION['smallid']."', '1')");
								}

								$grupo_id = $_SESSION['smallid'];

								$gid = $con->Query("select type_id from meta_big_data where grupo_id = '".$grupo_id."'");
								$bgestion  = $con->FetchAssoc($gid);

								$object = new Mgestion;
								$object->CreateGestion("id", $bgestion['type_id']);

								$mayeditform = true;

								include_once(VIEWS.DS."meta_big_data/FormUpdatePublicMeta_big_data.php");

							}else{
								echo "No hay formulario";
							}
						}else{

								$grupo_id = $_SESSION['smallid'];

								$gid = $con->Query("select type_id from meta_big_data where grupo_id = '".$grupo_id."'");
								$bgestion  = $con->FetchAssoc($gid);

								$object = new Mgestion;
								$object->CreateGestion("id", $bgestion['type_id']);

								$mayeditform = true;

								include_once(VIEWS.DS."meta_big_data/FormUpdatePublicMeta_big_data.php");

						}

					?>
								</div>
								<div align="center">
								<input type='button' value="Continuar..." class="btn btn-primary btn-lg" style="margin-right: 25px; margin-top:20px;height:60px; line-height: 60px; padding-left: 50px; padding-right: 50px; font-size: 22px" id="goto4">
								</div>
								
								<input style="height:35px;" class="form-control" type='hidden' name='nombre_radica' id='nombre_radica' placeholder="Nombre de quien radica:" maxlength='90' />
							<select style="height:35px; display:none" name="estado_respuesta" id="estado_respuesta" class='input1_0 form-control'>
								<option value="Abierto">Se respondió la solicitúd</option>
								<option value="Abierto">NO</option>
								<option value="Cerrado">SI</option>
							</select>
							<input class="form-control datepicker" type='hidden' name='fecha_respuesta' id='fecha_respuesta' placeholder="Fecha_respuesta:" maxlength='' />
							<input class="form-control" type='hidden' name='usuario_registra' id='usuario_registra' placeholder="Usuario_registra:" maxlength='50' value="<?= $_SESSION['usuario'] ?>" />
							<input class="form-control" type='hidden' name='estado_archivo' id='estado_archivo' placeholder="Estado_archivo:" maxlength='1' value="1" />
							<textarea class="form-control" type='text' name='observacion2' id='observacion2' placeholder="Observación del Expediente" style="height:100px; display:none"></textarea>
							<br>
								<?
										$cy = new MCity;
										$cy->CreateCity("code", $_SESSION['ciudad']);
								?>
								<input type='hidden' id='mydpto' value="<?= $cy->GetProvince() ?>" />
								<input type='hidden' id='mycity' value="<?= $cy->GetCode() ?>" />
							</form>
                        </fieldset>
                        <!-- PASO 4 -->
						<fieldset class="step">
                            <div class="row" style="margin:10px;">
								<div class="12u 12u(narrower)">
									
									<div class="row">
										<div class="col-md-6">
											
										</div>
										<div class="col-md-6">
											<div align="center">
												<input type='button' value="Continuar..." class="btn btn-primary btn-lg" style="margin-right: 25px; margin-top:20px;height:60px; line-height: 60px; padding-left: 50px; padding-right: 50px; font-size: 22px" id="goto5">
											</div>
										</div>
									</div>

								</div>
							</div>
                        </fieldset>
                        <!-- PASO 5 -->
						<fieldset class="step">
                            <div class="row" style="margin:10px;">
								<div class="12u 12u(narrower)">
									
									
								</div>
							</div>
                        </fieldset>
                </div>
                
            </div>
        </div>
	</div>
</div>

<script type="text/javascript">

    $(document).bind('dragover', function (e) {

        var pos = $("#crear-nota").offset().top - 130;

        var dropZone = $('#drop'),

            timeout = window.dropZoneTimeout;

        if (!timeout) {

            $('#folders-list-content').animate({ scrollTop : 0 }, 'fast');

            dropZone.addClass('in');

        } else {

            clearTimeout(timeout);

        }

        var found = false,

            node = e.target;

        do {

            if (node === dropZone[0]) {

                found = true;

                break;

            }

            node = node.parentNode;

        } while (node != null);

        if (found) {

            dropZone.addClass('hover');

        } else {

            dropZone.removeClass('hover');

        }

        window.dropZoneTimeout = setTimeout(function () {

            window.dropZoneTimeout = null;

            dropZone.removeClass('in hover');

            $('#folders-list-content').animate({ scrollTop : 0 }, 'fast');

        }, 100);

    });

</script>    
<script src="<?=ASSETS?>/js/jquery.knob.js"></script>
<!-- jQuery File Upload Dependencies -->
<script src="<?=ASSETS?>/js/jquery.ui.widget.js"></script>
<script src="<?=ASSETS?>/js/jquery.iframe-transport.js"></script>
<script src="<?=ASSETS?>/js/jquery.fileupload.js"></script>
<!-- Our main JS file -->
<script src="<?=ASSETS?>/js/script.js"></script>

<style>	
	.hideform{
		display:none;
	}
	.disabled{
		background-color: #CCC !important;
	}
	.jumbotron{
		padding-left:20px;
		padding-right:20px;
		text-align: justify;
	}
</style>
<script type="text/javascript">
	ancho = $("#col-md-content").width() - 20
	$(".step").css("width", ancho+"px");
</script>


<div style="display:none">
    <p><strong>Upload Files:</strong>
        <form method="post" id="sendfiles" enctype="multipart/form-data"> 
            <input type="file" name="pictures[]" id="pictures[]" class="selfile" multiple onChange="makeFileList();" />
        </form>
    </p>
    <ul id="fileList"><li>No Files Selected</li></ul>
    <div id="output1"></div>	
    <div id="fmid">id</div>
    <div class="progress">
        <div class="bar"></div>
        <div class="percent">0%</div>
    </div>
</div>
<script src="<?= HOMEDIR.DS ?>/app/plugins/malsup/jquery.form.js"></script> 
<script>
    $(document).ready(function() { 
        var options = { 
            target:        '#output1',      // target element(s) to be updated with server response 
            beforeSubmit:  showRequest,    // pre-submit callback 
            success:       showResponse,  // post-submit callback 
            // other available options: 
            url:       "/meta_big_data/upload/",   // override for form's 'action' attribute 
            type:      "POST",        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            clearForm: true,        // clear all form fields after successful submit 
            resetForm: true        // reset the form after successful submit 
             // $.ajax options can be used here too, for example: 
            //timeout:   3000 
        }; 
        // bind form using 'ajaxForm' 
        $('#sendfiles').ajaxForm(options); 

        $("#goto2").click(function(){
        	$("#menubtn2").click();
        	return false;
        })
        $("#goto3").click(function(){
        	$("#menubtn3").click();
        	return false;
        })
        $("#goto4").click(function(){
        	$("#menubtn5").click();
        	$('html, body').animate({scrollTop:0}, 'slow'); 
        	return false;
        })
        $("#goto5").click(function(){
        	$("#menubtn4").click();
        	return false;
        })

        $("#menubtn5").click(function(){
        	
        	var URL = '/gestion_anexos/getcargapublica/';
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
        	return false;
        })
    }); 
  
