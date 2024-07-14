<div class="container">

	<div class="row">

		<div class="col-md-12">

			<?

				$tipos = array("S" => "Subserie", "T" => "Tipología Documental");

				global $c;

				global $f;



				switch ($type) {

					case 'S':

						$typeel = "la Subserie ".$c->GetDataFromTable("dependencias", "id", $id, "nombre", "");

						break;



					case 'T':

						$typeel = "la tipología ".$c->GetDataFromTable("dependencias_tipologias", "id", $id, "tipologia", "");

						break;



					case 'A':

						$typeel = " el Area de Trabajo ".$c->GetDataFromTable("areas", "id", $id, "nombre", "");

						break;



					case 'U':

						$typeel = "la Subserie ".$c->GetDataFromTable("usuarios", "user_id", $id, "p_nombre, p_apellido", "");

						break;					

					default:

						# code...

						break;

				}

			?>

			<h2><span class="fa fa-sliders"></span>Gestionar Flujos de trabajo de <?= $typeel ?></h2>

		</div>

	</div>

<?

	if ($_SESSION['MODULES']['workflow'] == "1") {

?>	

	<div class="row">

		<div class="col-md-12" id="main_form_suscriptores_modulos">



			<div class="row">

				<div class="col-md-3">

				    <!--<div class="col-md-12"> -->

			    		

			    		<div class="navbar navbar-default">

			    			<br>

						    <div class="container-fluid">

						        <div class="navbar-header">

						            <button class="navbar-toggle" data-toggle="collapse" data-target="#mainNav">

						                <span class="icon-bar"></span>

						                <span class="icon-bar"></span>

						                <span class="icon-bar"></span>

						            </button>

						        </div>

						    </div>

							

							<div>

								<div>

							        <div class="collapse navbar-collapse" id="mainNav">

							        	<div class="tmain" align="center">Elementos Genericos</div>

							           	<ul id="navlist" class="nav nav-pills nav-stacked">

							           		<?

							           			$elementos = new MWf_elementos;

							           			$qelementos = $elementos->ListarWf_elementos();



							           			while ($ro = $con->FetchAssoc($qelementos)) {



							           				echo '<li role="presentation" id="alistas"><a href="#" onClick="InsertNode(\''.$ro['id'].'\',\''.$ro['titulo'].'\')">'.$ro['titulo'].'</a></li>';



							           			}

							           		?>



											<!--<li role="presentation"><a href="#" onClick="">Decisión</a></li> -->

										</ul>

										<!--<ul id="navlist2" class="nav nav-pills nav-stacked">

											<li role="presentation"><button type="button" class="btn btn-primary margin_left" data-toggle="modal" data-target="#myModalElementoGenerico">Crear Elemento</button></li>

										</ul>-->

							        </div>

							        	<textarea style="width:100%; height:100px; display:none" id="vectorelementos">node0</textarea>

							        	<form id='formwf_mapas_elementos' style=" display:none" action='/wf_mapas_elementos/registrar/' method='POST'> 

											<input type='text' value='<?= $mapa; ?>' placeholder='Id_mapa' name='id_mapa' id='id_mapa' maxlength='11' />

											<input type='text' value=''  name='id_elemento' id='id_elemento' maxlength='11' />

											<input type='text' value='' placeholder='Titulo' name='titulo' id='titulo' maxlength='200' />

											<input type='hidden' value='<?= date("Y-m-d H:i:s") ?>' placeholder='Fecha' name='fecha' id='fecha' maxlength='' />

											<input type='hidden' value='<?= $_SESSION['usuario'] ?>' placeholder='Usuario' name='usuario' id='usuario' maxlength='200' />

											<input type='hidden' value='<?= "0" ?>' placeholder='Id_evento' name='id_evento' id='id_evento' maxlength='11' />

											<input type='text' placeholder='id_dependencia' name='id_dependencia' id='id_dependencia' maxlength='11' />

											<input type='hidden' value='' placeholder='titulo_conector' name='titulo_conector' id='titulo_conector' maxlength='11' />

											<br>

											<input type='submit' value='Insertar'  style='margin:10px;'/>

										</form>



						  		</div>

							</div>

							<br>

						</div>

				   <!--</div>-->

				</div>



				<div class="col-md-9">

					<ul class="nav nav-tabs">

					<?php



						$mapas = new MWf_mapas;

						$query = $mapas->ListarWf_mapas("Where id_dependencia = '$id' and tipo_dependencia = '$type'");



						if ($mapa == 0) {

							# code...

						

							if ($con->NumRows($query) <= 0) {



								$mapas->InsertWf_mapas("Work-Flow Principal", "", $_SESSION['usuario'], date("Y-m-d H:i:s"), $id, $type);



								$query = $mapas->ListarWf_mapas("Where id_dependencia = '$id' and tipo_dependencia = '$type'");

								$mapa = $c->GetMaxIdTabla("wf_mapas", "id");



								$NewId = $c->GetMaxIdTabla("wf_mapas", "id");



								$me = new MWf_mapas_elementos;

								$me->InsertWf_mapas_elementos($NewId, 0, "Inicio", date("Y-m-d H:i:s"), $_SESSION['usuario'], 0);





								$log = new MWf_log;

								$log->InsertWf_log($_SESSION['usuario'], date("Y-m-d H:i:s"), "Se creó el mapa", $NewId);



								$i = 0;

								while ($row = $con->FetchAssoc($query)) {

									$i++;

									if ($i == 1) {

										$path = "class='active'";

									}



									$popover = "";

									if ($row['descripcion'] != "") {

										$popover = 'data-toggle="popover" data-trigger="hover" data-content="'.$row['descripcion'].'"';

									}



									echo '	<li role="presentation" '.$path.' id="xmapa'.$row['id'].'" >

												<a href="/flujos/mod/'.$id.'/S/'.$row['id'].'/" '.$popover.' id="mapa'.$row['id'].'" style="float:left; border-right: none; border-top-right-radius: 0px; border-bottom-right-radius: 0px;">'.utf8_decode($row['titulo']).'</a>

												<a style="float:left; padding-top: 20px;     border-left: none; margin-left: -2px; padding-bottom: 16px; border-bottom-left-radius: 0px; border-top-left-radius: 0px;" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>

												<ul class="dropdown-menu">

													<li><a href="#" onClick="LoadEditar(\'wf_mapas\', \''.$row['id'].'\')"  data-target="#myModal" data-toggle="modal" >Editar</a></li>

													<li><a href="#" onClick="EliminarMapa(\'wf_mapas\', \''.$row['id'].'\')">Eliminar</a></li>

		    									</ul>

											</li>';

								}



								#echo "<script>window.location.reload()</script>";

							}else{

								$i = 0;

								while ($row = $con->FetchAssoc($query)) {

									$i++;

									$path = "";

									if ($i == 1) {

										$mapa = $row['id'];

										$path = "class='active'";

									}

									

									$popover = "";

									if ($row['descripcion'] != "") {

										$popover = 'data-toggle="popover" data-trigger="hover" data-content="'.$row['descripcion'].'"';

									}



									echo '	<li role="presentation" '.$path.' id="xmapa'.$row['id'].'" >

												<a href="/flujos/mod/'.$id.'/S/'.$row['id'].'/" '.$popover.' id="mapa'.$row['id'].'" style="float:left; border-right: none; border-top-right-radius: 0px; border-bottom-right-radius: 0px;">'.utf8_decode($row['titulo']).'</a>

												<a style="float:left; padding-top: 20px;     border-left: none; margin-left: -2px; padding-bottom: 16px; border-bottom-left-radius: 0px; border-top-left-radius: 0px;" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>

												<ul class="dropdown-menu">

													<li><a href="#" onClick="LoadEditar(\'wf_mapas\', \''.$row['id'].'\')"  data-target="#myModal" data-toggle="modal" >Editar</a></li>

													<li><a href="#" onClick="EliminarMapa(\'wf_mapas\', \''.$row['id'].'\')">Eliminar</a></li>

		    									</ul>

											</li>';

								}

							}	

							echo "<script> $('#id_mapa').val('".$mapa."') </script>";

						}else{

							while ($row = $con->FetchAssoc($query)) {

									$path = "";

									if ($mapa == $row['id']) {

										$path = "class='active'";

									}



									$popover = "";

									if ($row['descripcion'] != "") {

										$popover = 'data-toggle="popover" data-trigger="hover" data-content="'.$row['descripcion'].'"';

									}



									echo '	<li role="presentation" '.$path.' id="xmapa'.$row['id'].'" >

												<a href="/flujos/mod/'.$id.'/S/'.$row['id'].'/" '.$popover.' id="mapa'.$row['id'].'" style="float:left; border-right: none; border-top-right-radius: 0px; border-bottom-right-radius: 0px;">'.utf8_decode($row['titulo']).'</a>

												<a style="float:left; padding-top: 20px;     border-left: none; margin-left: -2px; padding-bottom: 16px; border-bottom-left-radius: 0px; border-top-left-radius: 0px;" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>

												<ul class="dropdown-menu">

													<li><a href="#" onClick="LoadEditar(\'wf_mapas\', \''.$row['id'].'\')"  data-target="#myModal" data-toggle="modal" >Editar</a></li>

													<li><a href="#" onClick="EliminarMapa(\'wf_mapas\', \''.$row['id'].'\')">Eliminar</a></li>

		    									</ul>

											</li>';

								}



						}



					?>

					  

					  <li role="presentation"><a href="/wf_mapas/registrar/<?= $id."/"."$type/" ?>"><span class="fa fa-plus"></span> Nuevo DFD</a></li>

					  

					</ul>

					<div class="contenedor_mapa scrollable">

						<div class="body_metadatos " id="container_mapas">

							<?php

								$me = new MWf_mapas_elementos;

								$meq = $me->ListarWf_mapas_elementos("WHERE id_dependencia = '0' and id_mapa = '".$mapa."'");



								$raiz = new MWf_mapas_elementos;



								while ($rmeq = $con->FetchAssoc($meq)) {

									$raiz->CreateWf_mapas_elementos("id", $rmeq['id']);

									$popover = "";

									if ($rmeq['titulo_conector'] != "") {

										$popover = 'data-toggle="popover" data-trigger="hover" data-content="'.$rmeq['titulo_conector'].'"';

									}

									echo '  

											<div class="inicial elementonodo" id="'.$rmeq['id'].'">

												<ul class="nav nav-pills nav-stacked">

													<li role="presentation" '.$popover.' id="xnode'.$rmeq['id'].$rmeq['id'].'" data-role="'.$rmeq['id'].'" class="elementodelista active">

														<a href="#" onClick="ElementodeLista(\''.$rmeq['id'].'\')">

															<span class="fa fa-home"></span>

														</a>

													</li>

												</ul>

											</div>';

								}



							?>



						</div>	

					</div>

				</div>



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

    $('[data-toggle="popover"]').popover()



	$('#id_dependencia').val('<?= $raiz->GetId() ?>') 

	ElementodeLista('<?= $raiz->GetId() ?>');

});

	

	function ElementodeLista(id){

    	

    	var maine = $("#xnode"+id+id);



    	$(maine).siblings().removeClass("active");

    	$(maine).addClass("active");



    	obj= $(maine).parent().parent();

    	idpadre = $(obj).attr('id');



    	//indice = $(obj).index();

		//$("div.elementonodo:gt("+indice+")").remove();



		vactual = $("#vectorelementos").val();

		

		elementos = vactual.split(";");

		posicion = 0;

		

		//alert("Elemento en: "+jQuery.inArray( idpadre, elementos )) ;

		if (jQuery.inArray( idpadre, elementos ) == "-1") {

			$("#vectorelementos").val(vactual+";"+idpadre+";node"+id);

		}else{

			posicion = jQuery.inArray( idpadre, elementos );

			nuevovalor = "";

			for (var i = 0; i < elementos.length; i++) {

				if (i > posicion) {

					$("#"+elementos[i]).remove();

				}else{

					nuevovalor += elementos[i]+";";

				}

			};



			$("#vectorelementos").val(nuevovalor+";node"+id);

		}



		for (var i = 0; i < elementos.length ; i++) {



			if (idpadre == elementos[i]) {

//				alert("Encontrado en la posicion "+i+" No insertaré");

				posicion = i;

			}else{

//				alert("No encontré el elemento: -->"+idpadre+"<-- Debo insertarlo");

				break;

			}



		}



		



    	id_activo = $(maine).attr('data-role');

		$("#id_dependencia").val(id_activo);

		

		ExplorarProceso(id_activo);



	}



	function ShowLoader(show){

		if(show == "show"){



			$("body").css("cursor", "wait");



		}else if(show == "hide"){



			$("body").css("cursor", "default");



		}

	}





	function CheckImportantes(vform){



	    path = "Faltan por llenar los campos: ";

	    $('#'+vform+' .important').each(function(key, value) {

	        if ($(this).val() == "") {

	            path += "\n"+$(this).attr("placeholder");

	        }

	    });



	    if (path != "Faltan por llenar los campos: ") {

	        alert(path);

	        return false;

	    }else{

	        return true;

	    }

	}



	function ExplorarProceso(id){



		var URL = '/wf_mapas_elementos/GetListadoDependencias/'+id+'/';

	    $.ajax({

	        type: 'POST',

	        url: URL,

	        success:function(msg){

				$("#container_mapas").append(msg);

	        }

	    });   



	}



	function EditMapa(id){

		alert("hola mundo");

	}

	function OpenMapa(link){

		window.location.href = link;

	}



	function RegistrarElemento(){

		var URL = '/wf_elementos/registrar/';

		var str = $("#formwf_elementos").serialize();

	    $.ajax({

	        type: 'POST',

	        url: URL,

	        data: str,

	        success:function(msg){

	        	

				$("#navlist").append('<li role="presentation" id="alistas"><a href="#" onClick="">'+$("#formwf_elementos #titulo").val()+'</a></li>');

	        }

	    });   



	}



	function InsertNode(idn, titulo){

		if (confirm("¿Esta seguro que desea insertar un nuevo elemento?")) {

		 	$('#id_elemento').val(idn); 
		 	$('#titulo').val(titulo);
		 	dependencia = $("#id_dependencia").val();
			var URL = '/wf_mapas_elementos/registrar/';
			var str = $("#formwf_mapas_elementos").serialize();

		    $.ajax({
		        type: 'POST',
		        url: URL,
		        data: str,
		        success:function(msg){
					$("#node"+$("#id_dependencia").val()).remove();
		        	ElementodeLista(dependencia);
		        	
					//$("#node"+).html(msg);

		        }
		    });

		}
	}



	function LoadEditar(controller, id){

		var URL = '/'+controller+'/editar/'+id+'/';

		$.ajax({

			type: 'POST',

			url: URL,

			success: function(msg){

				$('#body-editar').html(msg);

			}

		});

	}

	function Eliminar(controller, id){

		if(confirm('Esta Seguro Desea Eliminar Este Elemento')){

			var URL = '/'+controller+'/eliminar/'+id+'/';

			$.ajax({

				type: 'POST',

				url: URL,

				success: function(msg){

					alert("Elemento Eliminado");

					if(msg == 'OK!')

						$("#xnode"+id+id).remove();

				}

			});

		}

	}

	function ActualizarElemento(formblock){

		var URL = '/wf_mapas_elementos/actualizar/';

		var str = $("#"+formblock).serialize();

	    $.ajax({

	        type: 'POST',

	        url: URL,

	        data: str,

	        success:function(msg){

	        	nodo = $("#"+formblock+" #id").val();

	        	titulo  = $("#"+formblock+" #titulo").val();

	        	descripcion  = $("#"+formblock+" #titulo_conector").val();

	        	$("#textnode"+nodo).html(titulo);

	        	$("#xnode"+nodo+nodo).attr("data-content", descripcion);

	        	//alert("Elemento Actualizado");

	        }

	    });   

	}



	function ActualizarMapa(formblock){

		var URL = '/wf_mapas/actualizar/';

		var str = $("#"+formblock).serialize();

	    $.ajax({

	        type: 'POST',

	        url: URL,

	        data: str,

	        success:function(msg){

	        	nodo = $("#"+formblock+" #id").val();

	        	titulo  = $("#"+formblock+" #titulo").val();

	        	descripcion  = $("#"+formblock+" #descripcion").val();



	        	alert(nodo+"-"+titulo+"-"+descripcion);

	        	$("#mapa"+nodo).html(titulo);

	        	$("#mapa"+nodo).attr("data-content", descripcion);

	        	//alert("Elemento Actualizado");

	        }

	    });   

	}



	function EliminarMapa(controller, id){

		if(confirm('Esta Seguro Desea Eliminar Este Mapa')){

			var URL = '/'+controller+'/eliminar/'+id+'/';

			$.ajax({

				type: 'POST',

				url: URL,

				success: function(msg){

					alert("Elemento Eliminado");

					$("#xmapa"+id+id).remove();

				}

			});

		}

	}

</script>



<style>

	.body_metadatos {

	    padding-top:5px;

	    padding-right:10px;

	    margin-bottom:20px;

	    min-width: 8000px;

	}



	.contenedor_mapa{

		width: 850px;

		overflow: none;

		overflow-x: auto;

		min-height: 435px;

		margin-bottom: 10px;

	    border: 1px solid #e7e7e7;

	    border-top:none;

	}



	.body_metadatos .inicial, .body_metadatos .mapa_elemento{

		border-right: 1px solid #e7e7e7;

		border-top: 1px solid #e7e7e7;

		border-bottom: 1px solid #e7e7e7;

		height: 424px;

		padding:10px;

		float:left;

		overflow:none;

		overflow-y: auto

	}



	.body_metadatos .inicial{

		width: 60px;

	}

	.body_metadatos .mapa_elemento{

		min-width: 100px;

	}



	#content {

	    padding-bottom: 20px;

	}



	.tmain {

	    font-size: 15px;

	    font-weight: 700;

	    color: #959595;

	    text-transform: uppercase;

	    margin-bottom: 15px;

	}

	.align-right {

	    text-align: right;

	}

	.margin_bottom {

	    margin-bottom: 20px !important;

	}

	#body-metadatosjs, #inner-metadatosjs{

		background-color: #FFF;

		border-radius: 4px;

		padding:20px;

	}

	input[type='text'], input[type='password'], input[type='time'] {

	    height: 46px !important;

	}



	select {

	    max-width: 100%;

	}



	.fullwidth {

	    width: 100%;

	    height: 40px;

	}



	.iconbox {

	    width: 50px !important;

	}

</style>







	<!-- Modal -->

	<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">

	  <div class="modal-dialog modal-sm" role="document">

	    <div class="modal-content">

		    <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

		        <h4 class="modal-title" id="myModalLabel">

					EDITAR ELEMENTO

		        </h4>

		    </div>

	      	<div class="modal-body" id="body-editar">....</div>

	    </div>

	  </div>

	  <br>

	</div>







<div class="modal fade bs-example-modal-sm" tabindex="-1" id="myModalElementoGenerico" role="dialog" aria-labelledby="mySmallModalLabel">

  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      	<div class="modal-header">

	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	        <h4 class="modal-title" id="myModalLabel">

				Registro de Elementos Genericos

	        </h4>

	    </div>

      	<div class="modal-body">

			<form id='formwf_elementos' action='/wf_elementos/registrar/' method='POST'> 

				<input type='text' class='form-control' placeholder='Titulo' name='titulo' id='titulo' maxlength='45' />

				<textarea class='form-control' style="height:150px" placeholder='Descripcion' name='descripcion' id='descripcion'></textarea>

				<input type='hidden' class='form-control' placeholder='Tipo_elemento' name='tipo_elemento' id='tipo_elemento' value="1" maxlength='11' />

				

				<div style="float:right">

	        		<button type="button" class="btn btn-primary" data-dismiss="modal" onClick="RegistrarElemento()">Guardar Elemento</button>

					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

				</div><br>

				<div style="clear:both"></div>



			</form>



      	</div>

    </div>

  </div>

</div>