<?php
	
	if($_REQUEST['cn'] != "tipodocumental"){


	$hidef = ($_REQUEST['cn'] == "nombre")?"dn":"";
	$hiden = ($_REQUEST['cn'] == "carpeta")?"dn":"";

    $nombre = ($_REQUEST['cn'] == 'nombre')?"Renombrar Documento":"Cambiar Carpeta del Documento";
	echo '

	<form class="form-material m-l-30 m-r-30 form-horizontal" role="form" id="fromupdatedoc_'.$ga->GetId().'">
    	<div class="form-body">
    		<div class="row">
	            <h3 class="titulo">'.$nombre.$c->Ayuda('111').'</h3>
	        </div>
	        <div class="row">
	            <div class="col-md-12 '.$hiden.'">
	                <div class="form-group">
	                    <label class="control-label font-12">Nombre:</label>
	                    <input type="text" class="form-control" value="'.utf8_encode($ga->GetNombre()).'" name="nombre" id="nombre">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-md-12 '.$hidef.'">
	                <div class="form-group">
	                    <label class="control-label font-12">Carpeta:</label>
                    	<select id="changetypedoc'.$ga->GetId().'" name="folder_id" class="form-control">';
						if ($ga->GetFolder_id() == "0") {
							echo "<option value='0'>Carpeta Principal</option>";
						}else{
							$idf = $c->GetDataFromTable("gestion_folder", "id", $ga->GetFolder_id(), "nombre", "");
							echo "<option value='".$ga->GetFolder_id()."'>".$idf."</option>";
							echo "<option value='0'>Carpeta Principal</option>";
						}
						echo $c->GetArbolCarpetasSelect($ga->GetGestion_id(), 0, "-");
						echo '
						</select>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-md-12">
	                <input type="button" class="btn btn-info  pull-right" value="Actualizar Documento" onclick="UpdateGAnexo(\''.$ga->GetId().'\')">
	            </div>
	        </div>
        </div>
    </form>';
	}else{
		$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$dep->GetId()."'");
		if ($tipo->GetTipologia() != "") {
			$tipologia = $tipo->GetTipologia();
		}else{
			$tipologia = "-";
		}
		if (($_SESSION['t_cuenta'] == "1" && $_SESSION['suscriptor_id'] == "") || ($ga->GetUser_id() == $_SESSION['usuario'] && $_SESSION['suscriptor_id'] == "")){
			if ($_SESSION['sadminid'] == "1" || $tipologia == "-" || $ga->GetUser_id() == $_SESSION['usuario']) {
				#if ($tipo->GetTipologia() == "") {
					$tipologia = '<select class="form-control" id="changetypedoc'.$ga->GetId().'" onChange="changetypedoc(\''.$ga->GetId().'\', \''.$object->GetId().'\', this.value)">';
					$tipologia .=  "<option value=''>Seleccione una Tipología</option>";	
					while ($rl = $con->FetchAssoc($listado)) {
					    $sel = ($ga->GetTipologia() == $rl['id'])?"selected='selected'":"";
						$tipologia .=  "<option value='".$rl['id']."' ".$sel.">".$rl['tipologia']."</option>";	
					}
					$tipologia .= "</select>";
				#}else{
				#	$tipologia =  $tipo->GetTipologia()."";	
				#}
			}
		}else{
			if ($tipo->GetTipologia() == "" || $tipo->GetTipologia() == "0") {
				$tipologia = "-";
			}else{
				$tipologia = $tipo->GetTipologia();
			}
		}
		echo '
		<div class="form-body  m-l-30 m-r-30 	">
			<div class="row">
		        <h2 class="titulo">Tipologia Documental</h2>'.$tipologia.'
		    </div>
		</div>';

}


echo '
<div class="form-body  m-l-30 m-r-30">
	<div class="row dn">
        <h2 class="titulo">Propiedades del Documento '.$c->Ayuda('112').'</h2>
    </div>';
    if ($_SESSION['sadminid'] == "1" || $_SESSION['usuario'] == $ga->GetUser_id() || $_SESSION['user_ai'] == $object->GetNombre_destino()){
	    $pathtype = "
	    <div class='row dn'>
	   		<div class='col-md-6'>
	        	<div class='form-group'>
	    			<label class='control-label font-12'>El Documento Publico: ".$c->Ayuda('113')."</label>";
					$pathtype .= '
					<select id="changePublic'.$ga->GetId().'" onChange="changePublic(\''.$ga->GetId().'\')" class="form-control">';
					if ($ga->GetIs_publico() == "0") {
						$pathtype .=  "<option value='0'>NO</option>";	
						$pathtype .=  "<option value='1'>SI</option>";	
					}else{
						$pathtype .=  "<option value='1'>SI</option>";	
						$pathtype .=  "<option value='0'>NO</option>";	

					}
					$pathtype .= "
					</select>
				</div>
			</div>
			<div class='col-md-6'>
				<div class='form-group'>
					<label class='control-label font-12'>Origen del Documento: ".$c->Ayuda('114')."</label>";
					if ($ga->GetIn_out() == "0") {
						$pathtype .=  '<select style="width:250px; height:35px;" id="changeInOut'.$ga->GetId().'" onChange="changeInOut(\''.$ga->GetId().'\')" class="form-control">';
						$pathtype .=  "		<option value='0'>Selecciona Opción</option>";	
						$pathtype .=  "		<option value='1'>El Documento es de Entrada</option>";
						$pathtype .=  "		<option value='-1'>El Documento es de Salida</option>";	
						$pathtype .=  "</select>";
					}else{
						if ($ga->GetIn_out() == "-1") {
							$pathtype .=  "<span>El Documento es de Salida</span>";	
						}else{
							$pathtype .=  "<span>El Documento es de Entrada</span>";
						}
					}
				$pathtype .= "
				</div>
			</div>
		</div>";
		$pathtype .= '<div id="output'.$ga->GetId().'"></div>';
        echo $pathtype;
    }else{
    	$pathtype =  "<div style='float:left'>";
		if ($tipo->GetTipologia() == "" || $tipo->GetTipologia() == "0") {
			$nomt = "-";
		}else{
			$nomt = $tipo->GetTipologia();
		}
		$pathtype .= "</div>";
        echo $pathtype;
    }
    echo "
    <div class='row'>";
	if ($extension == ".zip") {
		echo '
			<div class="col-md-6">
	                <div class="btn btn-info m-t-10 m-b-10" onclick="window.location.href=\'/gestion_anexos/unzip/'.$ga->GetId().'/\'">Descomprimir Zip! '.$c->Ayuda('115').'</div>
			</div>';
	}
	echo '
	<div class="col-md-6 dn">
            <div class="btn btn-info m-t-10 m-b-10" onclick="OpenWindow(\'/gestion/imprimirdocumento/'.$ga->GetId().'/\')" '.$c->Ayuda('116', 'tog').'>Imprimir Radicacion del Documento</div>
	</div>';
	
	if ($ga->GetTipologia() != "0") {
		if($_SESSION['MODULES']['metadatos'] == "1"){
			echo "
			<div class='col-md-6 dn'>
		            <input class='btn btn-warning  m-t-10 m-b-10' type='button' value='Ver Metadatos' class='btn_red' onClick='OpenWindow(\"/gestion_anexos/vermetadatos/".$ga->GetId()."/\")'>
			</div>";
		}
	}
	if($_SESSION['recargar_documentos'] == 1){
		echo '	<div class="col-md-12 dn">
					<form action="/gestion_anexos/updatephoto/'.$ga->GetId().'/" id="formpicture'.$ga->GetId().'"  name="formpicture'.$ga->GetId().'" method="post" enctype="multipart/form-data">
						<b><i>Volver a Cargar el Documento</i></b>
						<input name="archivo" id="selfile'.$ga->GetId().'" type="file" size="35" class="btn btn-warning"/>
					</form>
			      	<script>
			      		$("#selfile'.$ga->GetId().'").change(function() {
			      			$("#formpicture'.$ga->GetId().'").submit();
			      		});
					
			      	</script>
			    </div>';
	}
echo '</div>';
?>
<script type="text/javascript">
	$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
	});
</script>
<script type="text/javascript">

	function onTecla(e){	

		var num = e?e.keyCode:event.keyCode;

		if (num == 9 || num == 27){

			$(".bloquebusqueda_"+ide).fadeOut();		

		}

	}

	document.onkeydown = onTecla;

	if(document.all){

		document.captureEvents(Event.KEYDOWN);	

	}

	function UpdateGAnexo(id){

		if (confirm("¿Está Seguro que Actualizar Este Documento?")) {

			var str = $("#fromupdatedoc_"+id).serialize();

			$.ajax({

				type: "POST",

				data: str,

				url: '/gestion_anexos/actualizar/'+id+"/",

				success: function(msg){

					result = msg;

					//alert(msg);

					alert("Documento Actualizado");
					showfiles('/gestion/GetAnexos/<?= $ga->GetGestion_id() ?>/0/1/', 'cargador_box_upfiles_menu')

					//window.location.reload();				

				}

			});			

		}

	}
</script>