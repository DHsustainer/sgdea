
<h2>Crear una nueva Actuación</h2>
<form id='formevents_gestion' action='/events_gestion/registrar/' method='POST'> 

	<input type='hidden' name='user_id' id='user_id' value="<?= $_SESSION['usuario'] ?>" />
	<input type='hidden' name='gestion_id' id='gestion_id' value="<?= $object->GetId() ?>" />
	<input type='hidden' name='added' id='added' value="<?= date("Y-m-d") ?>" />
	<input type='hidden' name='status' id='status' value="1" />
	<input type='hidden' name='alerted' id='alerted'  value="0" />
	<input type='hidden' name='fecha_vencimiento' id='fecha_vencimiento'/>
	<input type='hidden' name='type_event' id='type_event' value="1" />
	<input type="hidden" name="grupo" id="grupo" value="<?= $_SESSION['user_ai'] ?>">
	<div class="row m-t-20">
		<div class="col-md-7">
			<label for="tipoalerta">Tipo de Actuación</label><br>
			<select class="form-control required" style="width: 100%;" name='tipoalerta' id='tipoalerta'>
				<option value="">Seleccione un tipo de Alerta o Actuación</option>
				<?
					$GetAlertas = $con->Query("select * from estadosx where tipo = 'tipoalerta'");
					while ($row = $con->FetchAssoc($GetAlertas)) {
						echo "<option value='".$row["valor"]."'>".$row["nombre"]."</option>";
					}
				?>
			</select>
		</div>
	</div>
	<div class="row m-t-20">
		<div class="col-md-7">
			<label for="tipoalerta">Título de la Actuación</label><br>
			<?
				if ($con->NumRows($query) >= '1') {
			?>
				<div id="title_select_group">
					<select class="form-control select2" style="width: 100%;" onChange="setWhiteTitle('title_select')" name='title_select' id='title_select'>>
						<option value="0">Título de la Actuación</option>
						<option value="-1">PERSONALIZAR Actuación</option>
						<?
							$da = new MDependencias_alertas;
							$da->GetDependientes($id_dependencia, 0, "-");	
						?>
					</select>
					
				</div>
				<input type="text" name="title" id="title" class="form-control dn" placeholder="Escriba un Titulo Personalizado para la Actuación">
			<?
				}else{
			?>
					<input type="hidden" name="title_select" id="title_select" class="form-control" value="0">
					<input type="text" name="title" id="title" class="form-control" placeholder="Escriba un Titulo Personalizado para la Actuación">
			<?
				}
			?>
		</div>
		<div class="col-md-5">
			<label for="tipoalerta">Responsable</label><br>
			<input type="text" id="dtformcompartircom" value="<?= $_SESSION['nombre'] ?>" name="dtformcompartircom" placeholder="Nombre Usuario" class="form-control important">
			<div id="bloquebusquedacompartircom"></div>
		</div>
	</div>
	<div class="row m-t-20">
		<div class="col-md-4">
			<label for="tipoalerta">Fecha de Actuación</label><br>
			<input type='date' style="width:185px" class="form-control fecha important" placeholder="Día de la Actuación" name='fecha' id='fecha' maxlength='' value="<?= date("Y-m-d") ?>" />
		</div>
		<div class="col-md-4">
			<label for="tipoalerta">Hora Actuación</label><br>
			<input type='time' style="width:185px" class="form-control important" placeholder="Hora de Actuación Ej: 14:50" name='time' id='time' maxlength='' value="<?= date("H:i") ?>" />
		</div>
		<div class="col-md-4">
			<label for="tipoalerta">Activar Actuación...</label><br>
			<select name="avisar_a" id="avisar_a" class="form-control" >
				<option value="1">Activar...</option>
				<?

					global $au;

					$GetAlertas = $au->ListarAlertas_usuariosByType("2");
					while ($row = $con->FetchAssoc($GetAlertas)) {
						echo "<option value='".$row["dias"]."'>".$row["titulo"]."</option>";
					}

				?>

			</select>
		</div>
	</div>
	<div class="row m-t-20">
		<div class="col-md-12">
			<label for="tipoalerta">Descripción de la Actuación</label><br>
			<textarea class="form-control" placeholder="Descripción de la Actuación" name='description' id='description' style="height: 100px; resize: none;"></textarea>
		</div>
	</div>
	<div class="row m-t-20">
		<div class="col-md-8">
			<label>
				<?	
					$alertapublica = (ACTUACIONESPUBLICAS == "1")?"checked='checked'":"";
				?>
				<input type="checkbox" id="es_publica" name="es_publica" checked <?= $alertapublica?> > Activar la Actuación como publica
			</label>
			<label>
				<input type="checkbox" id="es_recordatorio" name="es_recordatorio"> ¿La Actuación es un Recordatorio? <small>(Generará alarmas a futuro)</small>
			</label>
		</div>
		<div class="col-md-4">

	            <input type="hidden" name="C_F_0" id="elm0" value="0">

	            <button style="float:right" type="button" id="myanexo0" class="btn btn-info">
	                <span class="fa fa-search"></span> Buscar Documento
	            </button>
	            <button style="display:none; float:right;" type="button" id="enviarbotonanexo0" class="btn btn-success">
	                <span class="fa fa-upload"></span> Cargando Archivo...
	            </button>
	            
	            <button style="display:none; float:right; line-height:20px; margin-right:5px" title="Documento Cargado" type="button" id="myanexosuc0" class="btn btn-success fa fa-check"></button>

	            <input type="hidden" id="mylist0" value="0">
	            <script type="text/javascript">
	                $("#myanexo0").click(function() {
	                    $(".selfileanexo").click();
	                    $("#fmidanexo").html("0")
	                });
	                $("#enviarbotonanexo0").click(function(){
	                    $("body").css("cursor", "wait");
	                    $("#sendfilesanexo").submit();
	                })
	            </script>

		</div>
	</div>
	<div class="row m-t-10 m-b-30">
		<div class="col-md-6">
			<input type='button' onclick="CheckExistsGestionRegistrar()" value='Crear Actuación' class="btn btn-info"/>
		</div>
	</div>
</form>
<hr class="m-t-30 m-b-30">

<script type="text/javascript">
$("#dtformcompartircom").on("keyup", function(){
	$("#bloquebusquedacompartircom").fadeIn();					
	$("#bloquebusquedacompartircom").html("");
	$.ajax({
		type: "POST",
		url: '/usuarios/ListadoUsuariosTodos/'+$(this).val()+"/",
		success: function(msg){
			result = msg;
			$("#bloquebusquedacompartircom").html(result);
			$("#bloquebusquedacompartircom ul").prepend("<li class='list-group-item'  onclick='AddUsuario(\"AllOficina\", \"Toda la Oficina\")'>Toda la Oficina</li>");
		}
	});
});

function AddUsuario(id, nombre){
	$("#bloquebusquedacompartircom").fadeOut("fast");
	$("#dtformcompartircom").val(nombre);
	$("#grupo").val(id);

}
function setWhiteTitle(elm){

	if($("#"+elm).val() == -1){
		$("#title").removeClass('dn');
		$("#title_select_group").addClass('dn');
		$("#title").focus();
	}else{

		enlace = "/dependencias_alertas/obtenerdetallealerta/"+$("#"+elm).val()+"/";
		$.ajax({
			type: 'POST',
			url: enlace,
			success: function(msg){
				$("#title").val(msg['title']);
				$("#fecha").val(msg['fecha']);
				$("#time").val(msg['hora']);
				$("#avisar_a").val(msg['avisar']);
				$("#description").val(msg['description']);
				if (msg['es_publica'] == "1") {
					$("#es_publica").prop('checked', true);
				}else{
					$("#es_publica").prop('checked', false);
				}
			}
		});

	}
}

function CheckExistsGestionRegistrar(){
    if (CheckImportantes("formevents_gestion")) {
           $("#formevents_gestion").submit(); 
    }else{
        return false;
   
    }
}
</script>
<link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/select2/css/select2.min.css'/>
<script language='javascript' type='text/javascript' src='<?= HOMEDIR.DS ?>app/plugins/select2/js/select2.min.js'></script>
<script type="text/javascript">
    (function($) {
        if ($('.select2').length){
            $(".select2").select2();
        }
    	$('input').attr('autocomplete','off');
    })(jQuery);
</script>

<div style="display: none;">
    <p><strong>Upload Files:</strong>
        <form method="post" id="sendfilesanexo" enctype="multipart/form-data"> 
            <input type="file" name="pictures[]" id="pictures[]" class="selfileanexo" onChange="makeFileListAnexo();" />
            <input type="text" name="id_gestion" id="id_gestion" value="<?= $object->GetId() ?>"/>
        </form>
    </p>
    <ul id="fileListAnexo"><li>No Files Selected</li></ul>
    <div id="output1anexo"></div>   
    <div id="fmidanexo">id</div>
    <div class="progress">
        <div class="bar"></div>
        <div class="percent">0%</div>
    </div>
</div>
<script src="<?= HOMEDIR.DS ?>/app/plugins/malsup/jquery.form.js"></script> 
<script>
    $(document).ready(function() { 
        var options = { 
            target:        '#output1anexo',      // target element(s) to be updated with server response 
            beforeSubmit:  showRequest,    // pre-submit callback 
            success:       showResponse,  // post-submit callback 
            // other available options: 
            url:       "/gestion_anexos/uploadanexoactuacion/",   // override for form's 'action' attribute 
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
   // var partes = responseText.split("|");
    //var mylist = $("#mylist"+$("#fmidanexo").text()).val();
    $("#minilista"+$("#fmidanexo").text()).html(imagenes.length+" Documentos Cargados");
    $("body").css("cursor", "default");
    $("#myanexosuc0").css("display", "block");
    $("#myanexo0").css("display", "block");
    $("#myanexo0").html('<span class="fa fa-search"></span> Volver a Cargar');
  //  $("#elmNF"+$("#fmidanexo").text()).val(partes[10]);
    $("#enviarbotonanexo0").css("display", "none");


   	$("#output1anexo").html(responseText+"<hr>"+msg)
//    var mylist = $("#fmidanexo").text();

    //$("#mydiv0").html("<em style='padding-top:10px !important'>Documento Cargado...</em>");

}   
function makeFileListAnexo() {
    var input = document.getElementById("pictures[]");
    var cont = 0;

	//    alert("Cargando Documentos, por favor espere un momento");

    var milistado = "innerlista"+$("#fmidanexo").text();
    var ul =   document.getElementById("fileListAnexo");
    var minl = document.getElementById(milistado);
    
    //var mylist = $("#fmidanexo").text();
    $("#myanexo0").css("display", "none");
    $("#enviarbotonanexo0").css("display", "block");

    setTimeout(function(){
        $("#enviarbotonanexo0").click();
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
