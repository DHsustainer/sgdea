<?
	global $c;

	if (!isset($_SESSION['smallid'])) {
		$smallid = $f->GenerarSmallId();
		$_SESSION['smallid'] = $smallid;
	}

	$MPlantillas_email = new MPlantillas_email;
	$MPlantillas_email->CreatePlantillas_email('id', '43');
	$contenido_email = $MPlantillas_email->GetContenido();

	$SegundoMensaje = new MPlantillas_email;
	$SegundoMensaje->CreatePlantillas_email('id', '44');	
	$ContenidoSMensaje = $SegundoMensaje->GetContenido();

	$DocsMensaje = new MPlantillas_email;
	$DocsMensaje->CreatePlantillas_email('id', '45');	
	$ContenidoDMensaje = $DocsMensaje->GetContenido();

?>
<div class="row bg-title">
    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Registro del Expediente</h4> 
    </div>
</div>
<div class="row">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
            <!-- Validation wizard -->
            <div class="card-body wizard-content">
                <h4 class="card-title">Ventanilla de Radicación Masiva del <?= PROJECTNAME ?></h4>
                <h6 class="card-subtitle text-muted">El sistema le guiará paso a paso durante el proceso de radicación</h6>
                <form id='formgestion' action='/gestion/cargamasivapublica/' method='POST' class="validation-wizard wizard-circle m-t-40">
                    <!-- Step 1 -->
                    <h6>Tipo de Registro</h6>
                    <section>
                        <div class="row m-t-20">
                            <div class="col-md-6">
                                <div class="jumbotron">
                                	<?= $contenido_email; ?>
								</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo_documento"> Seleccione un Tipo de Registro : *</label><br>
                                    <select  class="form-control required" name="tipo_documento" id="tipo_documento">
										<option value=''>Seleccione una Opción</option>
                                        <?php
                                        if ($_SESSION['MODULES']['correspondencia'] == '0') {
                                            $condocs = $con->Query("select id_s, titulo from meta_referencias_titulos where tipo = '1' and es_generico = '1'");
                                        }else{
                                            $condocs = $con->Query("select id_s, titulo from meta_referencias_titulos where tipo = '1' and es_generico = '0'");
                                        }
                                            
                                            while ($idref = $con->FetchAssoc($condocs)) {
                                                echo "<option value='".$idref['id_s']."'>".$idref['titulo']."</option>";
                                            }
                                        ?>										
									</select>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" class="" name="actualizar_base" id="actualizar_base">
                                    <label for="actualizar_base"> Actualizar Registros Usando la columna Cod_Interno como referencia</label><br>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" class="" name="enviarsms" id="enviarsms">
                                    <label for="enviarsms"> Notificar por Mensaje de Texto</label><br>
                                </div>

                                <div id="output1anexo"></div>
								<div id="showbtns" style="display:none">
							        <button style="display:none; float:left; line-height:25px; margin-right:5px" title="Documento Cargado" type="button" id="myanexosucdocto" class="btn btn-success btn-lg fa fa-check"></button>

							        <button style="float:left" type="button" id="myanexodocto" class="btn btn-info btn-lg">
							            <span class="fa fa-search"></span> Buscar Documento
							        </button>
							        <button style="display:none" type="button" id="enviarbotonanexodocto" class="btn btn-success btn-lg">
							            <span class="fa fa-upload"></span> Cargando y Validando Archivo...
							        </button>

							        <input type="hidden" id="mylistdocto" value="docto">
								</div>
						        <script type="text/javascript">
						            $("#myanexodocto").click(function() {
						                $(".selfileanexo").click();
						                $("#fmidanexo").html("docto")
						            });
						            $("#enviarbotonanexodocto").click(function(){
						                $("body").css("cursor", "wait");
						                $("#sendfilesanexo").submit();
						            })
						        </script>
                            </div>
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h6>Carga de Documentos</h6>
                    <section>
						<div class="row m-t-20 m-b-20" >
                        	<div class="col-md-6" >
                        		<h2>Carga de Excel</h4>

						        <button style="display:none; float:left; line-height:25px; margin-right:5px" title="Documento Cargado" type="button" id="myanexocheck" class="btn btn-success btn-lg fa fa-check"></button>

						        <button style="float:left" type="button" id="myanexo" class="btn btn-info btn-lg">
						            <span class="fa fa-search"></span> Buscar Documentos
						        </button>
						        <button style="display:none" type="button" id="enviaranexos" class="btn btn-success btn-lg">
						            <span class="fa fa-upload"></span> Cargando Archivos...
						        </button>
                                <button style="float:left" type="button" onclick="OpenGrid()" class="btn btn-warning btn-lg m-l-10 m-b-30">Abrir Excel</button>
                                <button style="float:left" type="button" onclick="leertablaexcel()" class="btn btn-info btn-lg m-l-10 m-b-30">Test Data</button>


						        <script type="text/javascript">
						            $("#myanexo").click(function() {
						                $(".selfile").click();
						            });
						            $("#enviaranexos").click(function(){
						                $("body").css("cursor", "wait");
						                $("#sendfiles").submit();
						            })
						        </script>

						        <div class="row">
						        	<div class="col-lg-12">
                                        <input type="hidden" name="filenameexcel" id="filenameexcel">
						        		<div id="output" class="m-t-20 m-b-20"></div>

									    <div id="grouplist" style="display:none">
										    <ul id="fileList"><li>No ha seleccionado ningún Archivo</li></ul>
										    <div class="progress">
										        <div class="bar"></div>
										        <div class="percent">0%</div>
										    </div>
									    </div>
						        	</div>
						        </div>	

                                <h2 class="dn">Carga de Anexos</h4>

                                <button style="display:none; float:left; line-height:25px; margin-right:5px" title="Documento Cargado" type="button" id="myanexocheck2" class="btn btn-success btn-lg fa fa-check"></button>

                                <button style="float:left" type="button" id="myanexo2" class="btn btn-info btn-lg dn">
                                    <span class="fa fa-search"></span> Buscar Anexos
                                </button>
                                <button style="display:none" type="button" id="enviaranexos2" class="btn btn-success btn-lg">
                                    <span class="fa fa-upload"></span> Cargando Anexos...
                                </button>

                                <script type="text/javascript">
                                    $("#myanexo2").click(function() {
                                        $(".selfile2").click();
                                    });
                                    $("#enviaranexos2").click(function(){
                                        $("body").css("cursor", "wait");
                                        $("#sendfiles2").submit();
                                    })
                                </script>			
                        	</div>
                            <div class="col-md-6">
                                <div class="jumbotron">
                                    <?= $ContenidoSMensaje; ?>  
                                    <div align="center">
                                        <input type='button' class="btn btn-info" value='Registrar Correspondencia' onClick="SendInnerExpedientes()"/>
                                    </div>
                                    <div id="list-anexos"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-20 m-b-20" >
                            <div class="col-md-12" id="viewtable"></div>
                            <div class="col-md-12" id="viewgrid"></div>
                        </div>
                    </section>
                </form>
            </div>     
		</div>
	</div>
</div>

<div style="display:none">
    <p><strong>Upload Files:</strong>
        <form method="POST" id="sendfilesanexo" enctype="multipart/form-data"> 
        	<input type='text' name='C_F_docto' id='elmdoctodato'>
            <input type="file" name="pictures[]" id="pictures[]" class="selfileanexo" onChange="makeFileListAnexo();" />
        </form>
    </p>
    <ul id="fileListAnexo"><li>No Files Selected</li></ul>
    
    <div id="fmidanexo">id</div>
    <div class="progress">
        <div class="bar"></div>
        <div class="percent">0%</div>
    </div>

     <form method="POST" id="sendfiles" enctype="multipart/form-data"> 
        <input type="file" name="pictures[]" id="pictures[]" class="selfile" multiple onChange="makeFileList();" />
    </form>

    <form method="POST" id="sendfiles2" enctype="multipart/form-data"> 
        <input type="file" name="pictures2[]" id="pictures2[]" class="selfile2" multiple onChange="makeFileList2();" />
    </form>
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

<script src="<?= HOMEDIR.DS ?>/app/plugins/malsup/jquery.form.js"></script> 
<script>
    $(document).ready(function() { 
        var options = { 
            target:        '#output1anexo',      // target element(s) to be updated with server response 
            beforeSubmit:  showRequest,    // pre-submit callback 
            success:       showResponse,  // post-submit callback 
            // other available options: 
            url:       "/gestion/carga_archivo_masivo/", // override for form's 'action' attribute 
            type:      "POST",        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            clearForm: true,        // clear all form fields after successful submit 
            resetForm: true        // reset the form after successful submit 
             // $.ajax options can be used here too, for example: 
            //timeout:   3000 
        }; 
        // bind form using 'ajaxForm' 
        $('#sendfilesanexo').ajaxForm(options); 
    }); 
    // pre-submit callback 
	function showRequest(formData, jqForm, options) { 
	        // formData is an array; here we use $.param to convert it to a string to display it 
	        // but the form plugin does this for you automatically when it submits the data 
	    var queryString = $.param(formData); 
	        // jqForm is a jQuery object encapsulating the form element.  To access the 
	        // DOM element for the form do this: 
	        // var formElement = jqForm[0]; 
	    //alert('About to submit: \n\n' + queryString); 
	        // here we could return false to prevent the form from being submitted; 
	        // returning anything other than false will allow the form submit to continue 
	    return true; 
	} 
	// post-submit callback 
	function showResponse(responseText, statusText, xhr, $form)  { 
	    // for normal html responses, the first argument to the success callback 
	    // is the XMLHttpRequest object's responseText property 
	    // if the ajaxForm method was passed an Options Object with the dataType 
	    // property set to 'xml' then the first argument to the success callback 
	    // is the XMLHttpRequest object's responseXML property 
	    // if the ajaxForm method was passed an Options Object with the dataType 
	    // property set to 'json' then the first argument to the success callback 
	    // is the json data object returned by the server 
	    //alert('status: ' + statusText + '\n\nresponseText: \n' + responseText); 
	    $("#elm"+$("#fmidanexo").text()).val(responseText);
	    var imagenes = responseText.split(";");
	    var mylist = $("#mylist"+$("#fmidanexo").text()).val();
	    $("#minilista"+$("#fmidanexo").text()).html(imagenes.length+" Documentos Cargados");
	    $("body").css("cursor", "default");
	    //alert(responseText);
	    $("#output1anexo").html(responseText)
	    var mylist = $("#fmidanexo").text();
	    $("#enviarbotonanexo"+mylist).css("display", "none");

	    $("#myanexosuc"+mylist).css("display", "block");
	    $("#myanexo"+mylist).css("display", "block");
	    $("#myanexo"+mylist).html('<span class="fa fa-search"></span> Volver a Cargar');
	    $("#elmdoctodato").val($("#tipo_documento").val());
	    
	}   
	function makeFileListAnexo() {
        var input = document.getElementById("pictures[]");
        var cont = 0;
        alert("Cargando Documentos, por favor espere un momento");
        var milistado = "innerlista"+$("#fmidanexo").text();
        var ul =   document.getElementById("fileListAnexo");
        var minl = document.getElementById(milistado);
        
        var mylist = $("#fmidanexo").text();
        $("#myanexo"+mylist).css("display", "none");
        $("#enviarbotonanexo"+mylist).css("display", "block");

        setTimeout(function(){
            $("#enviarbotonanexo"+mylist).click();
        }, 1000);

        while (ul.hasChildNodes()) {
            ul.removeChild(ul.firstChild);
        }
        for (var i = 0; i < input.files.length; i++) {
            cont++;
            var li = document.createElement("li");
            li.innerHTML = input.files[i].name;
            ul.appendChild(li);
        }
        if(!ul.hasChildNodes()) {
            var li = document.createElement("li");
            li.innerHTML = 'No Files Selected';
            ul.appendChild(li);
        }
        //while (minl.hasChildNodes()) {
        //    minl.removeChild(minl.firstChild);
        //}
        for (var i = 0; i < input.files.length; i++) {
            cont++;
            var li = document.createElement("li");
            li.innerHTML = input.files[i].name;
            minl.appendChild(li);
        }
        if(!minl.hasChildNodes()) {
            var li = document.createElement("li");
            li.innerHTML = 'No Files Selected';
            minl.appendChild(li);
        }
        $("#num").html(cont);
        
    }
</script>






<script>
    $(document).ready(function() { 
        var options = { 
            target:        '#output',      // target element(s) to be updated with server response 
            beforeSubmit:  showRequestM,    // pre-submit callback 
            success:       showResponseM,  // post-submit callback 
            // other available options: 
            url:       "/gestion/cargararchivocorrespondenciapublico/", // override for form's 'action' attribute 
            type:      "POST",        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            clearForm: true,        // clear all form fields after successful submit 
            resetForm: true        // reset the form after successful submit 
             // $.ajax options can be used here too, for example: 
            //timeout:   3000 
        }; 
        // bind form using 'ajaxForm' 
        $('#sendfiles').ajaxForm(options); 
    });

    $(document).ready(function() { 
        var options = { 
            target:        '#output2',      // target element(s) to be updated with server response 
            beforeSubmit:  showRequestM2,    // pre-submit callback 
            success:       showResponseM2,  // post-submit callback 
            // other available options: 
            url:       "/gestion/cargararchivocorrespondenciapublico2/", // override for form's 'action' attribute 
            type:      "POST",        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            clearForm: true,        // clear all form fields after successful submit 
            resetForm: true        // reset the form after successful submit 
             // $.ajax options can be used here too, for example: 
            //timeout:   3000 
        }; 
        // bind form using 'ajaxForm' 
        $('#sendfiles2').ajaxForm(options); 
    });
    // pre-submit callback 
function showRequestM(formData, jqForm, options) { 
        // formData is an array; here we use $.param to convert it to a string to display it 
        // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
        // jqForm is a jQuery object encapsulating the form element.  To access the 
        // DOM element for the form do this: 
        // var formElement = jqForm[0]; 
    //alert('About to submit: \n\n' + queryString); 
        // here we could return false to prevent the form from being submitted; 
        // returning anything other than false will allow the form submit to continue 
    return true; 
} 
function showRequestM2(formData, jqForm, options) { 
        // formData is an array; here we use $.param to convert it to a string to display it 
        // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
        // jqForm is a jQuery object encapsulating the form element.  To access the 
        // DOM element for the form do this: 
        // var formElement = jqForm[0]; 
    //alert('About to submit: \n\n' + queryString); 
        // here we could return false to prevent the form from being submitted; 
        // returning anything other than false will allow the form submit to continue 
    return true; 
} 
// post-submit callback 
function showResponseM(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
    //alert('status: ' + statusText + '\n\nresponseText: \n' + responseText); 
    var imagenes = responseText.split("////");

    $("body").css("cursor", "default");
    //alert(responseText);
    $("#output").html(imagenes[1])
    $("#enviaranexos").css("display", "none");

    $("#myanexocheck").css("display", "block");
    $("#myanexo").css("display", "block");
    $("#myanexo").html('<span class="fa fa-search"></span> Cargar Más');
    $("#filenameexcel").val(imagenes[0]);
    OpenGrid();
    
}
function showResponseM2(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
    //alert('status: ' + statusText + '\n\nresponseText: \n' + responseText); 
    var imagenes = responseText.split(";");

    $("body").css("cursor", "default");
    //alert(responseText);
    $("#output2").html(responseText)
    $("#enviaranexos2").css("display", "none");

    $("#myanexocheck2").css("display", "block");
    $("#myanexo2").css("display", "block");
    $("#myanexo2").html('<span class="fa fa-search"></span> Cargar Más');
    
}   
	function makeFileList() {
        var input = document.getElementById("pictures[]");
        var cont = 0;
        alert("Cargando Documentos, por favor espere un momento");
        var ul =   document.getElementById("fileList");
        var minl = document.getElementById("innerlista");
        
        $("#myanexo").css("display", "none");
        $("#enviaranexos").css("display", "block");

        setTimeout(function(){
            $("#enviaranexos").click();
        }, 1000);

        while (ul.hasChildNodes()) {
            ul.removeChild(ul.firstChild);
        }
        for (var i = 0; i < input.files.length; i++) {
            cont++;
            var li = document.createElement("li");
            li.innerHTML = input.files[i].name;
            ul.appendChild(li);
        }
        if(!ul.hasChildNodes()) {
            var li = document.createElement("li");
            li.innerHTML = 'No Files Selected';
            ul.appendChild(li);
        }
        //while (minl.hasChildNodes()) {
        //    minl.removeChild(minl.firstChild);
        //}
        for (var i = 0; i < input.files.length; i++) {
            cont++;
            var li = document.createElement("li");
            li.innerHTML = input.files[i].name;
            minl.appendChild(li);
        }
        if(!minl.hasChildNodes()) {
            var li = document.createElement("li");
            li.innerHTML = 'No Files Selected';
            minl.appendChild(li);
        }
        $("#num").html(cont);
        
    }
    function makeFileList2() {
        var input = document.getElementById("pictures2[]");
        var cont = 0;
        alert("Cargando Documentos, por favor espere un momento");
        var ul =   document.getElementById("fileList2");
        var minl = document.getElementById("innerlista");
        
        $("#myanexo2").css("display", "none");
        $("#enviaranexos2").css("display", "block");

        setTimeout(function(){
            $("#enviaranexos2").click();
        }, 1000);

        while (ul.hasChildNodes()) {
            ul.removeChild(ul.firstChild);
        }
        for (var i = 0; i < input.files.length; i++) {
            cont++;
            var li = document.createElement("li");
            li.innerHTML = input.files[i].name;
            ul.appendChild(li);
        }
        if(!ul.hasChildNodes()) {
            var li = document.createElement("li");
            li.innerHTML = 'No Files Selected';
            ul.appendChild(li);
        }
        //while (minl.hasChildNodes()) {
        //    minl.removeChild(minl.firstChild);
        //}
        for (var i = 0; i < input.files.length; i++) {
            cont++;
            var li = document.createElement("li");
            li.innerHTML = input.files[i].name;
            minl.appendChild(li);
        }
        if(!minl.hasChildNodes()) {
            var li = document.createElement("li");
            li.innerHTML = 'No Files Selected';
            minl.appendChild(li);
        }
        $("#num2").html(cont);
        
    }

    function OpenGrid(){
        id = $("#filenameexcel").val()
        $("#viewgrid").html('<h5>Abriendo Archivo...</h5>');
        $.ajax({
            type: "POST",
            url: '/importar_procesos/viewgrid/',
            success: function(msg){
                result = msg;
                $("#viewgrid").html(result);
            }
        });    
        return false;       
    }

    function leertablaexcel(){
        var str = $("#formgestion").serialize();
        $.ajax({
            data: str,
            type: "POST",
            url: '/importar_procesos/leertablaexcel/',
            success: function(msg){
                result = msg;
                $("#viewtable").html(result);
            }
        });    
        return false;
    }
</script>