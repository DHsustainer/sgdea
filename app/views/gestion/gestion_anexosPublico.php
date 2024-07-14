<?

$folder;

	$RegistrosAMostrar = 12;

	if(isset($pag)){

		$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;

		$PagAct=$pag;

	}else{

		$RegistrosAEmpezar=0;

		$PagAct=1;

	}	

	global $f;

	global $c;

  	$viewer =       array(".doc" => "google"                        , "docx" => "google"                        , ".zip" => "google"                        , ".rar" => "google"                        ,

                          ".tar" => "google"                        , ".xls" => "google"                        , "xlsx" => "google"                        , ".ppt" => "google"                        ,

                          ".pps" => "google"                        , "pptx" => "google"                        , "ppsx" => "google"                        , ".pdf" => "google"                        ,

                          ".txt" => "google"                        , ".jpg" => "image"                         , "jpeg" => "image"                         , ".bmp" => "image"                         ,

                          ".gif" => "image"                         , ".png" => "image"                         , ".dib" => "image"                         , ".tif" => "image"                         ,

                          "tiff" => "image"                         , "mpeg" => "video"                         , ".avi" => "video"                         , ".mp4" => "video"                         ,

                          "midi" => "audio"                         , ".acc" => "audio"                         , ".wma" => "audio"                         , ".ogg" => "audio"                         ,

                          ".mp3" => "audio"                         , ".flv" => "video"                         , ".wmv" => "video"							, ".csv" => "google"                        ,

                          ".DOC" => "google"                        , "DOCX" => "google"                        , ".ZIP" => "google"                        , ".RAR" => "google"                        ,

                          ".TAR" => "google"                        , ".XLS" => "google"                        , "XLSX" => "google"                        , ".PPT" => "google"                        ,

                          ".PPS" => "google"                        , "PPTX" => "google"                        , "PPSX" => "google"                        , ".PDF" => "google"                        ,

                          ".TXT" => "google"                        , ".JPG" => "image"                         , "JPEG" => "image"                         , ".BMP" => "image"                         ,

                          ".GIF" => "image"                         , ".PNG" => "image"                         , ".DIV" => "image"                         , ".TIF" => "image"                         ,

                          "TIFF" => "image"                         , "MPEG" => "video"                         , ".AVI" => "video"                         , ".MP4" => "video"                         ,

                          "MIDI" => "audio"                         , ".ACC" => "audio"                         , ".WMA" => "audio"                         , ".OGG" => "audio"                         ,

                          ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google"						,

                          ".xml" => "google");


	echo '<input type="hidden" value="'.$folder.'" id="folder_id">';

	echo '


 		<div id="form" class="white">

            <form id="anexosdescargas" style="width:100%">';

        	$ang = new MGestion_anexos;

        	$fol = new MGestion_folder;

        	

        		$query = $ang->ListarGestion_anexos("WHERE gestion_id = '".$id."' and folder_id = '".$_SESSION["folder_exp"]."' and (estado = '1' or estado = '3') and is_publico = '1'", "order by  orden, id", "limit $RegistrosAEmpezar, $RegistrosAMostrar");


        		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$_SESSION["folder_exp"]."' and tipo= '1' and (estado = '1' or estado = '3') and is_publico = '1'");



            echo "<ul id='list-anexos'>";

            echo '	<form action="/gestion_anexos/updatephoto/0/" id="formpicture0"  name="formpicture0" method="post" enctype="multipart/form-data">

						<input name="archivo" id="selfile0" type="file" size="35" style="display:none"/>

					</form>';

		
			

			$fol->CreateGestion_folder("id", $folder);

			if ($folder != "0") {

				$typefol = ($fol->GetTipo() == "1")?"folder":"folder_private";

				echo "  

                        <li class='anexos-li' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$fol->GetFolder_id()."/1/\", \"cargador_box_upfiles_menu\")' >

                            <div style='padding-top:0px;' class='img-icon folderback' style='width:30px' ></div>

                            <div class='nom_anexo' title='Regresar a la Carpeta Anterior'>Regresar a la Carpeta Anterior</div>

                        </li>

						<li class='anexos-li'>

                            <div style='padding-top:0px;' class='img-icon $typefol' style='width:30px' ></div>

                            <div class='nom_anexo curfolder' title='Carpeta Actual: ".$fol->GetNombre()."'>'";

                        if ($_SESSION['usuario'] == $fol->GetUser_id()) {

                            echo "<b>

                            		<div style='float:left'>

                            			Carpeta Actual: 

                            		</div>

                            		<input type='text' value='".$fol->GetNombre()."' id='foldername' class='form-control' style='float:left; width:270px; margin-top:0px;'>

                            		<img style='cursor:pointer; margin-top:4px; margin-right:7px' class='mybtn' onClick='UpdateFolderName(\"".$fol->GetId()."\")' src='".ASSETS."/images/gckeck.png' width='20px' title='Actualizar Nombre de Carpeta'>

                            		<img style='cursor:pointer; margin-top:4px;' class='mybtn' onClick='DeleteFolder(\"".$fol->GetId()."\")' src='".ASSETS."/images/undone.png' width='22px' title='Eliminar Carpeta'>

                            		<div class='clear' style='clear:both;'></div>

                            	</b>";

                        }else{

                        	echo "<b> Carpeta Actual: ".$fol->GetNombre()."</b>";

                        }

                echo "         	<div class='clear' style='clear:both;'></div>

                            </div>

                            <div class='clear' style='clear:both;'></div>

                        </li>

                     ";

			}

			
            while ($col=$con->FetchArray($query)) {
            	
                $type=explode('.', strtolower($col[url]));

                $type=array_pop($type);

                $tipologia = "";

                $file = $col["url"];

                $idb = $col[0];

                $propietario_documento = false;

                if ($file != "") {

	                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";

	                $cadena_nombre = substr($file,0,200);

	                $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

	                if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {

	                    if ($_SESSION['folder'] == '') {

	                        $path = "onclick='changetext(this)'";

	                    }

	                }

	                $tipo = new MDependencias_tipologias;

					$tipo->CreateDependencias_Tipologias("id", $col['tipologia']);

					$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$dep->GetId()."'");

					if ($tipo->GetTipologia() != "") {

						$tipologia = substr($tipo->GetTipologia(), 0, 40).(strlen($tipo->GetTipologia()) > 40)?"...":"";

					}else{

						$tipologia = "-";

					}

					$bad = (strlen($col[nombre]) > 40)?"...":"";

				 	$nombredoc = substr($col[nombre], 0, 40).$bad;
					if ($_SESSION['suscriptor_id'] == "") {
						# code...
					
					if (($_SESSION['t_cuenta'] == "1" && $_SESSION['suscriptor_id'] == "" || $object->GetNombre_destino() == $_SESSION['user_ai']) || ($col['user_id'] == $_SESSION['usuario'] && $_SESSION['suscriptor_id'] == "")){

						if ($_SESSION['sadminid'] == "1" || $tipologia == "-" || $col['user_id'] == $_SESSION['usuario'] || $object->GetNombre_destino() == $_SESSION['user_ai']) {

							# code...

							if ($tipo->GetTipologia() == "") {

								$tipologia = '<select style="width:100px; height:35px;" id="changetypedoc'.$idb.'" onChange="changetypedoc(\''.$idb.'\', \''.$ge->GetId().'\', this.value)">';

								$tipologia .=  "<option value=''>Seleccione una Tipología</option>";	

								while ($rl = $con->FetchAssoc($listado)) {

									$tipologia .=  "<option value='".$rl['id']."'>".$rl['tipologia']."</option>";	

								}

								$tipologia .= "</select>";

							}else{

								if ($_SESSION['t_cuenta'] == "1") {
									$tipologia = '<select style="width:100px; height:35px;" id="changetypedoc'.$idb.'" onChange="changetypedoc(\''.$idb.'\', \''.$ge->GetId().'\', this.value)">';
									$tipologia .=  "<option value=''>Seleccione una Topología</option>";	
									while ($rl = $con->FetchAssoc($listado)) {
										if($tipo->GetId() == $rl['id']){
											$ntp = "selected = 'selected'";
										}else{
											$ntp = "";
										}

										$tipologia .=  "<option value='".$rl['id']."' ".$ntp.">".$rl['tipologia']."</option>";	
									}
									$tipologia .= "</select>";
								}else{
									$tipologia = substr($tipo->GetTipologia(), 0, 40).(strlen($tipo->GetTipologia()) > 40)?"...":"";
								}



							}

						}

					}else{

						if ($tipo->GetTipologia() == "" || $tipo->GetTipologia() == "0") {

							$tipologia = "-";

						}else{

							$tipologia = substr($tipo->GetTipologia(), 0, 40).(strlen($tipo->GetTipologia()) > 40)?"...":"";

						}

					}
				}else{
						if ($tipo->GetTipologia() == "" || $tipo->GetTipologia() == "0") {

							$tipologia = "-";

						}else{

							$tipologia = substr($tipo->GetTipologia(), 0, 40).(strlen($tipo->GetTipologia()) > 40)?"...":"";

						}

				}


				

	                echo "  <li class='anexos-li' id='file_$col[0]'>


	                            <div style='padding-top:0px;' class='img-icon $type' style='width:30px' ></div>

	                            <div class='nom_anexo' title='$col[nombre]' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>$nombredoc</div>
";
echo '<div class="btn-group pull-right m-t-5">
    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-bars m-r-5"></i></button>
    <ul role="menu" class="dropdown-menu">
        <li><a href="#" onclick="OpenWindow(\'/gestion/imprimirdocumento/'.$col[0].'/\')">Imprimir Radicacion del Documento</a></li>

    </ul>
</div>';

	            	
					echo "	        
							    <div class='nom_anexo tipoelementosanexo' style='float:right'>$tipologia</div>
	                            <div class='bloq_data_anexo'>
	                            	<div class='inner_item_anexo' id='detail_$col[0]' style='display:none'>";

				if ($_SESSION['suscriptor_id'] == "") {
					                            	
	                echo          		"<div class='title'>Propiedades del Documento</div>";
					
						
						echo '<br><div class="btn btn-primary"  style="width:auto; margin-left:10px "></div>';
						echo "<div class='clear'></div>";
						
						echo "<div class='clear'></div>";
					}else{
						echo '<div class="btn btn-primary" onclick="OpenWindow(\'/gestion/imprimirdocumento/'.$col[0].'/\')" style="width:auto; ">Imprimir Radicacion del Documento</div>';
					}
	                echo "			</div>
		                            	<div class='inner_item_anexo' id='share_$col[0]' style='display:none'>";
					echo "				<div class='title'>Compartir Documento</div>";
						
					if ($_SESSION['mayedit'] == "1") {

							echo "				<input type='text' id='whoishare_$col[0]' placeholder='Escriba el numero de radicado rápido del expediente a compartir' style='width:425px; height:25px'>
												<input type='button' value='Compartir' onClick='shareDocumento($col[0])'>";
							echo "				<input type='text' alt='".$col[0]."' id='whoishare2_$col[0]' placeholder='Escriba el usuario para compartir el documento' style='width:425px; height:25px'  class='activarbuscador2'>
												<input type='button'  value='Compartir' onClick='shareDocumentoUsuario($col[0])'>
												<div id='bloquebusqueda' class='bloquebusqueda2_".$col[0]." bloquebusqueda2'></div>
												<input type='hidden' id='id_usuario_".$col[0]."'>";
						}

						echo "					<div class='clear'></div>
												<ul class='sharelistdoc' id='listshare$col[0]'>";
													$queryxtt = $con->Query("select gestion_id from gestion_anexos where origen = '".$col[0]."' group by gestion_id");
													$i = 0;
													while ($rxt = $con->FetchAssoc($queryxtt)) {
														$i++;
														$gx = new MGestion;
														$gx->CreateGestion("id", $rxt[gestion_id]);
														echo "<li>Documento Compartido con el expediente ".$gx->GetNum_oficio_respuesta()."</li>";
													}
													$queryxtt = $con->Query("SELECT * FROM gestion_anexos_permisos_documentos where id_documento = '$col[0]' and estado = '1'");
													$i = 0;
													while ($rxt = $con->FetchAssoc($queryxtt)) {
														$i++;
														$MUsuarios = new MUsuarios;
														$MUsuarios->CreateUsuarios("user_id", $rxt[usuario_permiso]);
														echo "<li>Documento Compartido con el usuario ".$MUsuarios->GetP_nombre()." ".$MUsuarios->GetS_nombre()." ".$MUsuarios->GetP_apellido()." ".$MUsuarios->GetS_apellido()."</li>";
													}
													if ($i <= 0) {
														echo '<li id="da_message_warning'.$col[0].'"><div class="da-message warning">Este documento no se está compartiendo con ningún expediente o usuario</div></li>';
													}
						echo "					</ul>";											
						echo "				<div class='clear'></div>";
		                echo "         	</div>
		                            	<div class='inner_item_anexo' id='lookfor_$col[0]' style='display:none'>";
		                echo "				<div class='title'>Revisar Documento</div>";
	#							        if ($propietario_documento) {
					    echo '              <div id="listado_solicitudes">
										    	<div class="listado_seleccion">
										    		<select id="diasmaxtoresponse_'.$col[0].'" name="diasmaxtoresponse" style="width:160px; height:42px" class="important">
										    			<option value="1">Seleccione los días maximos para revisar el documento (1 por defecto)</option>
										    			<option value="1">1 Días</option>
										    			<option value="2">2 Días</option>
										    			<option value="3">3 Días</option>
										    			<option value="7">7 Días</option>
										    			<option value="15">15 Días</option>
										    			<option value="30">1 Mes</option>
										    		</select>

										    		<input type="text" alt="'.$col[0].'" id="searchbform" style="width:375px; height:35px;" class="form-control searchbform_'.$col[0].' activarbuscador important" placeholder="Solicitar Revisión a:" >

										    		<div id="bloquebusqueda" class="bloquebusqueda_'.$col[0].' bloquebusqueda"></div>

										    		<!--<textarea id="observacion" name="observacion" class="form-control" placeholder="Observacion" style="width:550px; height:70px; resize:none"></textarea>-->';

						echo '			    	</div>';



						echo '			    </div>  ';



		                echo "        		
		                				</div>";
	            						


		                echo "         	
		                            </div>
		                        </li>";
                }else{
                	echo "  <li class='anexos-li' id='ppic$col[0]'>
	                            <input type='checkbox' name='servicio[]'  class='album_inner_button active_check' />
	                            <div style='padding-top:0px;' class='img-icon unknow' style='width:30px' ></div>
	                            <div class='nom_anexo' title='$col[nombre]'>$col[nombre]</div>
	                            <div class='nom_anexo' style='float:right'>$col[fecha]</div>
	                            <div class='nom_anexo' title='Tipología Documental' style='float:right'>".$tipologia."</div>";
					echo '		
									<form action="/gestion_anexos/updatephoto/'.$col[0].'/" id="formpicture'.$col[0].'"  name="formpicture'.$col[0].'" method="post" enctype="multipart/form-data">
								        <input name="archivo" id="selfile'.$col[0].'" type="file" size="35"/>
						      		</form>
					      	</li>
					      	<script>
					      		$("#selfile'.$col[0].'").change(function() {
					      			$("#formpicture'.$col[0].'").submit();
					      		});
					      	</script>';

                }

            }

            echo "</ul>

						<input type='hidden' id='id_documento'>";

	        if ($_SESSION['suscriptor_id'] == "") {

                $querypag="SELECT count(*) as t from gestion_anexos WHERE gestion_id = '".$id."' and folder_id = '".$folder."'";

        	}else{

        		$querypag="SELECT count(*) as t from gestion_anexos WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and is_publico = '1'";

        	}

            echo '<div class="paginator m-t-30 m-b-30" style="text-align:center">';

                $NroRegistros = $con->Result($con->Query($querypag), 0, 't');

                if($NroRegistros == 0){

                echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';

                }

                $PagAnt=$PagAct-1;

                $PagSig=$PagAct+1;

                $PagUlt=$NroRegistros/$RegistrosAMostrar;

                $Res=$NroRegistros%$RegistrosAMostrar;

                if($Res>0) $PagUlt=floor($PagUlt)+1;

#  ;

                echo "<a class='btn btn-danger' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/1/\", \"cargador_box_upfiles_menu\")' >Pagina 1</a> ";

                if($PagAct>1) 

                echo "<a class='btn btn-danger' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/".$PagAnt."/\", \"cargador_box_upfiles_menu\")'>Pagina Anterior.</a> ";

                echo "<span style='line-height:30px; vertical-align:top; font-size:15px; margin-right:10px; margin-left:10px' class='texto_italic'>Pagina ".$PagAct." de ".$PagUlt."</span>";

				if ($PagUlt > 5) {

					echo "<select onChange='GotoPag(this.value, \"".$id."\", \"".$folder."\")'  > ";

					echo "		<option value='".$PagAct."'>".$PagAct."</option>";

						for ($i=1; $i <  $PagUlt+1 ; $i++) { 

							if ($i != $PagAct) {

								echo "<option value='".$i."'>".$i."</option>";

							}

						}

					echo "</select>";                

				}

                if($PagAct<$PagUlt)  

                echo " <a class='btn btn-danger' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/".$PagSig."/\", \"cargador_box_upfiles_menu\")'>Pagina Siguiente.</a> ";

                echo " <a class='btn btn-danger' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/".$PagUlt."/\", \"cargador_box_upfiles_menu\")'>Pagina. $PagUlt</a>";

            echo '</div>

            </form>

        </div>';


?>

<script type="text/javascript">

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

					showfiles('/gestion/GetAnexos/<?= $id ?>/<?= $folder ?>/1/', 'cargador_box_upfiles_menu')

					//window.location.reload();				

				}

			});			

		}

	}

</script>