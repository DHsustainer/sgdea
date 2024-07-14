<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?
				$tipos = array("S" => "Subserie", "T" => "Tipología Documental");
				global $c;
				global $f;

				$object = new MGestion;
				$object->CreateGestion("id", $id);

				$id = $object->GetTipo_documento();

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
			<h2><span class="fa fa-sliders"></span>Gestionar Flujos de trabajo en el Expediente <?= $object->GetMin_rad(); ?></h2>
		</div>
	</div>
<?
	if ($_SESSION['MODULES']['workflow'] == "1") {
?>	
	<div class="row">
		<div class="col-md-12" id="main_form_suscriptores_modulos">

			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
					<?php

						$mapas = new MWf_gestion_mapas;
						$query = $mapas->ListarWf_gestion_mapas("Where id_gestion = '".$object->GetId()."' and tipo_dependencia = '$type'");

						if ($mapa == 0) {
							# code...
						
							if ($con->NumRows($query) <= 0) {
								$qx = $con->Query("Select * from wf_mapas where id_dependencia = '".$object->GetTipo_documento()."' and tipo_dependencia = '$type'");
								while ($rx = $con->FetchAssoc($qx)) {
								 	
								#	echo "Select * from wf_mapas_elementos where id_mapa = '".$rx['id']."'";
									$mapas->InsertWf_gestion_mapas($rx['titulo'], $rx['descripcion'], $_SESSION['usuario'], date("Y-m-d H:i:s"), $rx['id_dependencia'], $object->GetId(), $type, $rx['id']);
								#	echo "Select * from wf_mapas_elementos where id_mapa = '".$rx['id']."'";
									$elementos_mapa = $con->Query("Select * from wf_mapas_elementos where id_mapa = '".$rx['id']."'");


									$mapa = $c->GetMaxIdTabla("wf_gestion_mapas", "id");
									$NewId = $c->GetMaxIdTabla("wf_gestion_mapas", "id");
									
									while ($rel = $con->FetchAssoc($elementos_mapa)) {
								#		echo "ID: ".$rel["id"];
										$me = new MWf_gestion_mapas_elementos;

											 #InsertWf_gestion_mapas_elementos($id_mapa, $id_elemento, $titulo, $fecha, $usuario, $id_evento, $id_dependencia, $id_mapas_elementos, $estado, $titulo_conector)

										if ($rel['id_dependencia'] == "0") {
											$evento = "2";
										}else{
											$evento = "1";
										}

										$me->InsertWf_gestion_mapas_elementos($NewId, $rel['id_elemento'], $rel['titulo'], date("Y-m-d H:i:s"), $_SESSION['usuario'], $evento, $rel['id_dependencia'], $rel['id_mapa'], '1', '', $object->GetId(), $rel['id']);
											

									}

								}



								$query = $mapas->ListarWf_gestion_mapas("Where id_gestion = '".$object->GetId()."' and tipo_dependencia = '$type'");



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
												<a href="/flujos/gestion/'.$object->GetId().'/S/'.$row['id'].'/" '.$popover.' id="mapa'.$row['id'].'" >'.utf8_decode($row['titulo']).'</a>
											</li>';
								}

#								echo "<script>window.location.reload()</script>";
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
												<a href="/flujos/gestion/'.$object->GetId().'/S/'.$row['id'].'/" '.$popover.' id="mapa'.$row['id'].'" >'.utf8_decode($row['titulo']).'</a>
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
												<a href="/flujos/gestion/'.$object->GetId().'/S/'.$row['id'].'/" '.$popover.' id="mapa'.$row['id'].'" >'.utf8_decode($row['titulo']).'</a>
											</li>';
								}

						}

					?>
					</ul>
					<div class="contenedor_mapa scrollable">
						<div class="body_metadatos " id="container_mapas">
							<?php
								$me = new MWf_gestion_mapas_elementos;
								$meq = $me->ListarWf_gestion_mapas_elementos("WHERE id_dependencia = '0' and id_mapa = '".$mapa."'");

								$raiz = new MWf_gestion_mapas_elementos;

								while ($rmeq = $con->FetchAssoc($meq)) {
									$raiz->CreateWf_gestion_mapas_elementos("id", $rmeq['id']);
									$popover = "";
									if ($rmeq['titulo_conector'] != "") {
										$popover = 'data-toggle="popover" data-trigger="hover" data-content="'.$rmeq['titulo_conector'].'"';
									}
									echo '  
											<div class="inicial elementonodo" id="'.$rmeq['id_elemento_mapa_elemento'].'">
												<ul class="nav nav-pills nav-stacked">
													<li role="presentation" '.$popover.' id="xnode'.$rmeq['id_elemento_mapa_elemento'].$rmeq['id_elemento_mapa_elemento'].'" data-role="'.$rmeq['id_elemento_mapa_elemento'].'" class="elementodelista active">
														<a href="#">
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

	$('#id_dependencia').val('<?= $raiz->GetId_elemento_mapa_elemento() ?>') 
	ElementodeLista('<?= $raiz->GetId_elemento_mapa_elemento() ?>');
});
	
	function ElementodeLista(id){
    	
    	var maine = $("#xnode"+id+id);

    	$(maine).siblings().removeClass("active");
    	$(maine).addClass("active");

    	obj= $(maine).parent().parent();
    	idpadre = $(obj).attr('id');

    	//indice = $(obj).index();
		//$("div.elementonodo:gt("+indice+")").remove();
	
		//alert("Elemento en: "+jQuery.inArray( idpadre, elementos )) ;

		var vactual = $("#vectorelementos").val();
		
		var elementos = vactual.split(";");
		posicion = 0;
		//alert(idpadre);
		if (jQuery.inArray( idpadre, elementos ) == "-1") {
			$("#vectorelementos").val(vactual+";;node"+id);

		}else{
			posicion = jQuery.inArray( idpadre, elementos );
			//alert(posicion)
			nuevovalor = "";
			for (var i = 0; i < elementos.length; i++) {
				//alert(elementos[i])
				if (i > posicion) {
			//		alert("cierto q no ?")
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

		var id_gestion = "<?= $object->GetId() ?>";

		

    	id_activo = $(maine).attr('data-role');
		//alert(id_activo)
		$("#id_dependencia").val(id_activo);
		ExplorarProceso(id_activo, id_gestion);

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

	function ExplorarProceso(id, id_gestion){
	//	alert(id+":"+id_gestion);
		var URL = '/wf_gestion_mapas_elementos/GetListadoDependencias/'+id+'/'+id_gestion+'/';
	    $.ajax({
	        type: 'POST',
	        url: URL,
	        success:function(msg){
				$("#container_mapas").append(msg);
	        }
	    });   

	}


	function OpenMapa(link){
		window.location.href = link;
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
	

	function ActivarActividad(id, id_gestion, id_elemento){


			var URL = '/wf_gestion_mapas_elementos/editar/'+id+'/'+id_gestion+'/'+id_elemento+'/';
			$.ajax({
				type: 'POST',
				url: URL,
				success: function(msg){
					$('#body-editar').html(msg);
				}
			});
	}

	function Editaractividad(id, id_gestion, id_elemento, action){

	}

	function RegistarEvento_Elemento(){

		if(CheckImportantes("FormUpdatewf_gestion_mapas_elementos")){

			var URL = '/wf_gestion_mapas_elementos/actualizar/';
			var str = $("#FormUpdatewf_gestion_mapas_elementos").serialize();

		    $.ajax({
		        type: 'POST',
		        url: URL,
		        data: str,
		        success:function(msg){
		            /*
		        	$("#outputme").html(msg);
		            */
		            alert("Se ha Activado el Proceso");
		            $("#modalclose").click();

		        }
		    });   
		}
	}
</script>
<textarea style="width:100%; height:100px; display:none" id="vectorelementos">node0</textarea>

<style>
	.body_metadatos {
	    padding-top:5px;
	    padding-right:10px;
	    margin-bottom:20px;
	    min-width: 8000px;
	}

	.contenedor_mapa{
		width: 1140px;
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
	<div class="modal fade bs-example-modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" id="modalclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">
					EDITAR ELEMENTO
		        </h4>
		    </div>
	      	<div class="modal-body" id="body-editar"></div>
	    </div>
	  </div>
	  <br>
	</div>

