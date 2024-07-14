<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>
			<?
			    $permisos = $_SESSION['vector'][3];
			    $module = $_REQUEST['m']."/".$_REQUEST['action'];

			    #print_r($_SESSION['vector']);
			    #echo $module;
			    $exist = true;
			    for ($k=0; $k < count($permisos) ; $k++) { 
			    	$link = explode(":", $permisos[$k])	;
			    	
			    	if ($module == $link[1]) {
				        echo '<span class="fa '.$link[2].'"></span>'.$link[0].'';
				        $exist = true;
				        break;
			    	}else{
			    		$exist = false;
			    	}
			    }
			?>
			</h2>
		</div>
	</div>
<?
	if ($exist) {
?>	
	<div class="row">
		<div class="col-md-12" id="main_form_suscriptores_modulos">

			<div class="row">
				<div class="col-md-4">
				    <div class="col-md-12">
			    		<div class="fa fa-plus bloque_plus" data-toggle="modal" data-target="#myModal"></div>
			    		<div class="titulo_nuevo" data-toggle="modal" data-target="#myModal">Añadir nueva <?= SUSCRIPTORDEPENDENCIA ?></div>
				   </div>
				</div>

				<?

					$db = new MMeta_big_data;
					$query = $db->ListarMeta_big_data("WHERE type_id = '$id' and ref_id = '1' group by grupo_id");

					

					while($row = $con->FetchAssoc($query)){
						$l = new MMeta_big_data;
						
						$bigd = $l->ObjectBigData($row['grupo_id']);

						echo 
							'	
								<div class="col-md-4">
								    <div class="col-md-12 bloque_division">
										<div class="col-md-4" style="padding:0px;">
												<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
												  <!-- Wrapper for slides -->
												  <div class="carousel-inner" role="listbox">';

										$ima = explode(";", $bigd['Fotografia']['value']);
										for ($i=0; $i < count($ima) ; $i++) { 
											if (trim($ima[$i]) != "") {
												if ($i == 0) {
													$active = "active";
												}else{
													$active = "";
												}
												$nom = $c->GetDataFromTable('meta_documentos', 'url', $ima[$i], 'nombre', " ");
												$URL = HOMEDIR.DS.'app/plugins/meta_uploads/'.$ima[$i];
												echo '  <div class="item '.$active.'">
	      													<img src="'.$URL.'" alt="..." title="'.$nom.'">
	    												</div>';
											}
										}

									echo '					</div>
													  <!-- Controls -->
														<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
													    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
													    	<span class="sr-only">Previous</span>
													  	</a>
														<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
														    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
														    <span class="sr-only">Next</span>
														</a>
													</div>

										</div>
										<div class="col-md-8">
											<h4 style="text-transform:uppercase"><b>'.$bigd['NOMBRE']['value'].'</b></h4>
											<h5>Edad: <b>'.$bigd['Edad']['value'].' años</b></h5>
											<h5>Raza: <b>'.$bigd['Raza']['value'].'</b></h5>
										</div>';

						echo '		 </div>
								</div>';
					}


				?>
				
				
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Registrar nueva <?= SUSCRIPTORDEPENDENCIA ?></h4>
	      </div>
	      <div class="modal-body">
	        	<? 
	        		$ref = new MMeta_referencias_titulos;
	        		$query = $ref->ListarMeta_referencias_titulos("where tipo = '3'");
	        		
	        	?>
				<h3>Seleccione un tipo de <?= SUSCRIPTORDEPENDENCIA ?></h3>
					<select id="GetTipoSuscriptor">
						<option value="0">Seleccione un Tipo de <?= SUSCRIPTORDEPENDENCIA ?></option>
						<?
							$i = 0;
							while($row = $con->FetchAssoc($query)){
								$i++;
								$l = new MMeta_referencias_titulos;
								$l->CreateMeta_referencias_titulos('id', $row[id]);

								echo '<option value="'.$l->GetId().'">'.$l->GetTitulo().'</option>';
							}
							if ($i == "0") {
								echo '<option value="0">No se ha definido ningún tipo de  '.SUSCRIPTORDEPENDENCIA.'</option>';
							}
						?>
						<option value="-1">Crear <?= SUSCRIPTORDEPENDENCIA ?></option>
					</select>

	      	</div>
			<div id="showformregistro"></div>
	    </div>
	  </div>
	</div>
<?
	}
?>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 


    $("#GetTipoSuscriptor").change(function(){
    	if ($(this).val() == "0") {
    		alert("Seleccione un Tipo de Mascota");
    	}else if($(this).val() == "-1") {
    		OpenWindow("/metadatos/");
    	}else{
    		$(".main_col_data").css("display", "none");
    		var seleccion = document.getElementById('GetTipoSuscriptor');
    		var valor = seleccion.options[seleccion.selectedIndex].value;//coges el valor
			var texto = seleccion.options[seleccion.selectedIndex].text;//esto es lo que ve el usuario
			var ids = "<?= $id ?>";
    		$("#nametypeform").html(texto);
    		$("body").css("cursor", "wait");
		    var URL = '/meta_big_data/nuevo/'+valor+'/'+ids+'/';
		   	$.ajax({
			  	type: "POST",
				url: URL,
			  	success: function(msg){
			  		$("body").css("cursor", "normal");
			  		$("#showformregistro").slideDown();
			  		$("#showformregistro").html(msg);
			  	}
			});

    	}
    })
});
</script>

<style type="text/css">
	
	.bloque_division{
		border:1px solid #D4D4D4;
	}

	.bloque_plus{
		font-size: 20px;
		line-height: 20px;
		color: #929292;
		border:1px solid #929292;
		border-radius: 20px;
		padding: 20px;
		margin: 10px;
		float:left;
		width: 60px;
		text-align: center;
	}
	.titulo_nuevo{
		float:lefT;
		width: auto;
		margin-left:10px;
		line-height: 80px;
		font-size: 17px;
		color: #727272;
	}
	.titulo_nuevo:hover{
		cursor: pointer;
		text-decoration: underline;
	}
	.bloque_plus:hover{
		cursor: pointer;
		color: #FFF;
		background-color: #929292;
	}

	.mycutelabel{
		font-size: 12px;
	}

	#showformregistro{
		display: none; 
	}



</style>
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
    $("#elm"+$("#fmid").text()).val(responseText);

    var imagenes = responseText.split(";");
    
    $("#minilista"+$("#fmid").text()).html(imagenes.length+" Documentos Cargados");
    $("body").css("cursor", "normal");
    alert("Documentos Cargados Correctamente")
}	

function makeFileList() {
		var input = document.getElementById("pictures[]");
		var cont = 0;
		//alert(input.files[i].name);
		var milistado = "innerlista"+$("#fmid").text();

		var ul =   document.getElementById("fileList");
		var minl = document.getElementById(milistado);
		
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


		while (minl.hasChildNodes()) {
			minl.removeChild(minl.firstChild);
		}
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
