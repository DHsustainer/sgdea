<?



	$RegistrosAMostrar = 10;

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

        	if ($_SESSION['suscriptor_id'] == "") {

        		

        		$object = new MGestion;

        		$object->CreateGestion("id", $id);



        		$usua = new MUsuarios;

        		$usua->CreateUsuarios("user_id", $_SESSION['usuario']);



   		        $isboss = false;

		        $insuscriptor = false;

				$inshare = false;

			 	$haveshared = false;



		        if ($_SESSION['t_cuenta'] == "1" && $usua->GetRegimen() == $object->GetDependencia_destino()) {

		            $isboss = true;

		        }



				$gc = new MGestion_compartir;

				$qn = $gc->ListarGestion_compartir(" where usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");

				$com = $con->NumRows($qn);



				if ($com >= 1) {

				    $inshare = true;

				    $gc->CreateGestion_compartirQuery("usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");

				    $_SESSION['mayedit'] = $gc->GetType();

				}



				if ($_SESSION['usuario'] == $object->GetUsuario_registra() || $usua->GetA_i() == $object->GetNombre_destino()) {

					$_SESSION['mayedit'] = "1";

				}



				$sg = new MGestion_suscriptores;

				$qns = $sg->ListarGestion_suscriptores(" where id_suscriptor = '".$_SESSION['suscriptor_id']."' and id_gestion = '".$object->GetId()."'");

				$coms = $con->NumRows($qns);



				if ($coms >= 1) {

				    $insuscriptor = true;

				}



		        $conx = $con->NumRows($con->Query("select * from gestion_anexos_permisos where gestion_id = '".$object->GetId()."' and usuario_permiso = '".$_SESSION['usuario']."'"));

		        if ($conx >= 1) {

		            $haveshared = true;

		        }



				if ($object->Getnombre_destino() == $usua->GetA_i() || $insuscriptor || $inshare || $object->GetUsuario_registra() == $usua->GetUser_id() || $isboss) {

#					echo "Tengo Acceso por X o Y Motivo Excepto un documento compartido";				

	        		$query = $ang->ListarGestion_anexos("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and (estado = '1' or estado = '3')", "order by nombre", "limit $RegistrosAEmpezar, $RegistrosAMostrar");

	        		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and (estado = '1' or estado = '3')");

				}else{

#					echo "Solo me Compartieron así que no debería tener acceso a este expediente excepto a los documentos que me compartieron";

					

					$query = $ang->ListarGestion_anexos(" as ga inner join gestion_anexos_permisos as gap on gap.id_documento=ga.id  WHERE ga.gestion_id = '".$id."' and ga.folder_id = '".$folder."' and gap.usuario_permiso = '".$_SESSION['usuario']."' and (ga.estado = '1' or ga.estado = '3')", "order by nombre", "limit $RegistrosAEmpezar, $RegistrosAMostrar");

	        		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and (estado = '1' or estado = '3')");

				}





        	}else{

        		$query = $ang->ListarGestion_anexos("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and (estado = '1' or estado = '3') and is_publico = '1'", "order by nombre", "limit $RegistrosAEmpezar, $RegistrosAMostrar");

        		$queryf = $fol->ListarGestion_folder("WHERE gestion_id = '".$id."' and folder_id = '".$folder."' and tipo= '1' and (estado = '1' or estado = '3')");

        	}





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

                            <div class='nom_anexo' title='Carpeta Actual: ".$fol->GetNombre()."'>'";

                        echo "<b> Carpeta Actual: ".$fol->GetNombre()."</b>";

                echo "         	<div class='clear' style='clear:both;'></div>

                            </div>

                            <div class='clear' style='clear:both;'></div>

                        </li>

                     ";

			}

			while($rfolder = $con->FetchAssoc($queryf)){

				$typefol = ($rfolder["tipo"] == "1")?"folder":"folder_private";

                echo "  <li class='anexos-li' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$rfolder['id']."/1/\", \"cargador_box_upfiles_menu\")' >

                            <div style='padding-top:0px;' class='img-icon $typefol' style='width:30px' ></div>

                            <div class='nom_anexo' title='$rfolder[nombre]'>$rfolder[nombre]</div>

                            <div class='nom_anexo' style='float:right'>$rfolder[fecha]</div>

                        </li>";

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
						$tipologia = $tipo->GetTipologia();
					}else{
						$tipologia = "-";
					}



					$bad = (strlen($col[nombre]) > 40)?"...":"";

				 	$nombredoc = substr($col[nombre], 0, 40).$bad;





					if (($_SESSION['t_cuenta'] == "1" && $_SESSION['suscriptor_id'] == "") || ($col['user_id'] == $_SESSION['usuario'] && $_SESSION['suscriptor_id'] == "")){

						if ($_SESSION['sadminid'] == "1" || $tipologia == "-" || $col['user_id'] == $_SESSION['usuario']) {

							# code...


							if ($tipo->GetTipologia() == "") {
								$tipologia = '<select style="width:100px; height:35px;" id="changetypedoc'.$idb.'" onChange="changetypedoc(\''.$idb.'\', \''.$ge->GetId().'\', this.value)">';

								$tipologia .=  "<option value=''>Seleccione una Topología</option>";	

								while ($rl = $con->FetchAssoc($listado)) {
									$tipologia .=  "<option value='".$rl['id']."'>".$rl['tipologia']."</option>";	
								}
								$tipologia .= "</select>";

							}else{

								$tipologia =  $tipo->GetTipologia()."";	

							}


						}

					}else{

						

						if ($tipo->GetTipologia() == "" || $tipo->GetTipologia() == "0") {

							$tipologia = "-";

						}else{

							$tipologia = $tipo->GetTipologia();

						}

						

					}



					if ($tipologia != "-") {



						$fecha_firma    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "fecha_firma", $separador = " ");

						$usuario_fir    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "usuario_firma", $separador = " ");

						$usuario_fir    = $c->GetDataFromTable("usuarios", "user_id", $usuario_fir, "p_nombre, p_apellido", $separador = " ");



						$ar_firmo = array(	"" => HOMEDIR.DS."app/views/assets/images/white_spot.png", 

											"-" => HOMEDIR.DS."app/views/assets/images/white_spot.png", 

											"0" => HOMEDIR.DS."app/views/assets/images/firmaw.png", 

											"1" => HOMEDIR.DS."app/views/assets/images/firmao.png", 

											"2" => HOMEDIR.DS."app/views/assets/images/firmae.png");



						$ar_title = array(	""  => "", 

											"-" => "", 

											"0" => "Documento Pendiente de Firma", 

											"1" => "Documento Firmado por $usuario_fir el $fecha_firma", 

											"2" => "Firma Rechazada por $usuario_fir el $fecha_firma");



						$se_firmo    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "estado_firma", $separador = " ");

						$se_firmo = "<img src='".$ar_firmo[$se_firmo]."' title='".$ar_title[$se_firmo]."' style='margin-left:10px;' >";



						$tipologia .= $se_firmo;

					}else{

						$se_firmo = "<img src='".HOMEDIR."/app/views/assets/images/white_spot.png'>";

						


						$fecha_firma    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "fecha_firma", $separador = " ");

						$usuario_fir    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "usuario_firma", $separador = " ");

						$usuario_fir    = $c->GetDataFromTable("usuarios", "user_id", $usuario_fir, "p_nombre, p_apellido", $separador = " ");




						$ar_firmo = array(	"" => HOMEDIR.DS."app/views/assets/images/white_spot.png", 

											"-" => HOMEDIR.DS."app/views/assets/images/white_spot.png", 

											"0" => HOMEDIR.DS."app/views/assets/images/firmaw.png", 

											"1" => HOMEDIR.DS."app/views/assets/images/firmao.png", 

											"2" => HOMEDIR.DS."app/views/assets/images/firmae.png");



						$ar_title = array(	""  => "", 

											"-" => "", 

											"0" => "Documento Pendiente de Firma", 

											"1" => "Documento Firmado por $usuario_fir el $fecha_firma", 

											"2" => "Firma Rechazada por $usuario_fir el $fecha_firma");



						$se_firmo    = $c->GetDataFromTable("gestion_anexos_firmas", "anexo_id", $col['id'], "estado_firma", $separador = " ");

						$se_firmo = "<img src='".$ar_firmo[$se_firmo]."' title='".$ar_title[$se_firmo]."' style='margin-left:10px;' >";

						$tipologia .= $se_firmo;

					}



	                echo "  <li class='anexos-li' id='file_$col[0]'>

	                            <!--<input type='checkbox' value='".$file."' name='servicio[]'  class='album_inner_button active_check' />-->

	                            <div style='padding-top:0px;' class='img-icon $type' style='width:30px' ></div>

	                            <div class='nom_anexo' title='$col[nombre]' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>$nombredoc</div>

	                                <div class='nom_anexo' style='float:right'>

								        <div class='impr_box'>";

				if ($_SESSION['suscriptor_id'] == "") {



					echo "		            <ul>

								                <li class='bl_pro properties' id='sowitem1_$col[0]' title='Ver Propiedades del Documento' onClick='shoideitem(\"detail_$col[0]\", \"sowitem1_$col[0]\")'>Propiedades del Documento</li>         

								                <li class='bl_pro share' id='sowitem2_$col[0]' title='Compartir Documento' onClick='shoideitem(\"share_$col[0]\", \"sowitem2_$col[0]\")'>Compartir Documento</li>";



	                		$GetDoc_shared = $con->Result($con->Query('select count(*) as t from gestion_anexos_permisos where id_documento = "'.$col[0].'" and usuario_permiso = "'.$_SESSION['usuario'].'"'), 0, 't');



	                		if (($_SESSION['usuario'] == $col['user_id'] || $GetDoc_shared >= 1) && $_SESSION['suscriptor_id'] == "" ) {

		                		if ($GetDoc_shared >= 1) {

		                			$propietario_documento = false;

		                				$gap = new MGestion_anexos_permisos;

							        	$qgap = $gap->ListarGestion_anexos_permisos("where id_documento = '".$col[0]."' and usuario_permiso = '".$_SESSION['usuario']."'");

							        	while ($rogap = $con->FetchAssoc($qgap)) {

							        		

								        	$objectgap = new MGestion_anexos_permisos;

								        	$objectgap->CreateGestion_anexos_permisos("id", $rogap['id']);

								        	if ($_SESSION['MODULES']['firma_electronica'] == "1" || $_SESSION['MODULES']['firma_digital'] == "1") {

									        	if ($objectgap->GetEstado() == '0') {

								        			echo "<li class='bl_pro needtocheck' id='sowitem3_$col[0]' onClick='shoideitem(\"lookfor_$col[0]\", \"sowitem3_$col[0]\")'>Firmas del Documento</li>";

									        	}else{

								        			echo "<li class='bl_pro check' id='sowitem3_$col[0]' onClick='shoideitem(\"lookfor_$col[0]\", \"sowitem3_$col[0]\")'>Firmas del Documento</li>";

									        	}

								        	}

							        	}

		                			

		                		}else{

		                			if ($_SESSION['MODULES']['firma_electronica'] == "1" || $_SESSION['MODULES']['firma_digital'] == "1") {

			                			$Getstatusfile = $con->Result($con->Query('select count(*) as t from gestion_anexos_permisos where id_documento = "'.$col[0].'" and estado != "0"'), 0, 't');

			                			if ($Getstatusfile >= 1 && $col['estado'] == "3") {

			                				echo "<li class='bl_pro warning' id='sowitem3_$col[0]' onClick='shoideitem(\"lookfor_$col[0]\", \"sowitem3_$col[0]\")'>Firmas del Documento</li>";

			                			}else{

			                				$Getcerocounter = $con->Result($con->Query('select count(*) as t from gestion_anexos_permisos where id_documento = "'.$col[0].'" and estado = "0"'), 0, 't');

		                					if ($Getcerocounter >= 1) {

		                						echo "<li class='bl_pro waiting' id='sowitem3_$col[0]' onClick='shoideitem(\"lookfor_$col[0]\", \"sowitem3_$col[0]\")'>Firmas del Documento</li>";

		                					}else{

		                						echo "<li class='bl_pro check' id='sowitem3_$col[0]' onClick='shoideitem(\"lookfor_$col[0]\", \"sowitem3_$col[0]\")'>Firmas del Documento</li>";

		                					}

			                			}

			                			$propietario_documento = true;

		                			}

		                		}	



		                		$timessent = $con->Result($con->Query('select count(*) as t from mailer_attachments where alt = "'.$col[0].'" '), 0, 't');

								if ($timessent >= 1) {

		                			echo "<li class='bl_pro at' id='sowitem4_$col[0]' onClick='shoideitem(\"mailer_$col[0]\", \"sowitem4_$col[0]\")'>Envíos</li>";

	                			}



	                			$timessent = $con->Result($con->Query('select count(*) as t from notificaciones_attachments where id_anexo = "'.$col[0].'" '), 0, 't');

								if ($timessent >= 1) {

		                			echo "<li class='bl_pro messenger' id='sowitem5_$col[0]' onClick='shoideitem(\"mensajeria_$col[0]\", \"sowitem5_$col[0]\")'>Envíos</li>";

	                			}





	                		}else{



	                			if ($col['estado'] == "3") {

	                				echo "<li class='bl_pro warning' id='sowitem3_$col[0]'>documento en revisión</li>";

	                			}

	                			

	                		}



	                echo "      		</ul>";

	            }

					echo "	        </div>

							    </div>

							    <div class='nom_anexo' style='float:right'>$tipologia</div>

	                            <div class='bloq_data_anexo'>

	                            	<div class='inner_item_anexo' id='detail_$col[0]' style='display:none'>";

					if ($_SESSION['usuario'] == $col['user_id']) {

						echo    '<div class="title">Editar Documento</div>

									<div style="float:left">

										<form id="fromupdatedoc_'.$col[0].'">

										<table border="0" style="margin-left:30px">

											<tr>

												<td width="70px"><b>Nombre:</b></td>

												<td align="left"><input type="text" value="'.$col['nombre'].'" name="nombre" class="form-control" style="width:400px; height:27px;"></td>

											</tr>

											<tr>

												<td><b>Carpeta:</b></td>

												<td align="left">

													<select style="width:410px; height:35px;" id="changetypedoc'.$idb.'" name="folder_id" class="form-control">';

													if ($col['folder_id'] == "0") {

														echo "<option value='0'>Carpeta Principal</option>";

													}else{

														$idf = $c->GetDataFromTable("gestion_folder", "id", $col['folder_id'], "nombre", "");

														echo "<option value='".$col['folder_id']."'>".$idf."</option>";

														echo "<option value='0'>Carpeta Principal</option>";

													}

												echo 	

														$c->GetArbolCarpetasSelect($col['gestion_id'], 0, "-"); 

						echo '						</select>

												</td>

											</tr>

											<tr>

												<td colspan="2" align="right"><input type="button" value="Actualizar Documento" onclick="UpdateGAnexo(\''.$col[0].'\')"></td>

											</tr>

										</table>

										</form>';

							echo 	'	

									</div>

									<div class="clear"></div>';

					}	                            	

	                echo          		"<div class='title'>Propiedades del Documento</div>";

									

/*	

									*/

								if ($_SESSION['sadminid'] == "1"){

											$pathtype =  "<div>Tipología Documental: ";

											

											if ($tipo->GetTipologia() == "") {

												$pathtype .=  "-";	

											}else{

												$pathtype .=  $tipo->GetTipologia();	

											}



											$pathtype .= "</div><div>El Doc. Publico:";



											$pathtype .= '<select style="width:100px; height:35px;" id="changePublic'.$idb.'" onChange="changePublic(\''.$idb.'\')" class="form-control">';

											if ($col["is_publico"] == "0") {

												$pathtype .=  "<option value='0'>NO</option>";	

												$pathtype .=  "<option value='1'>SI</option>";	

											}else{

												$pathtype .=  "<option value='1'>SI</option>";	

												$pathtype .=  "<option value='0'>NO</option>";	

											}



											$pathtype .= "</select></div>";



									}else{

										$pathtype =  "<div style='float:left'>";

										if ($tipo->GetTipologia() == "" || $tipo->GetTipologia() == "0") {

											$nomt = "-";

										}else{

											$nomt = $tipo->GetTipologia();

										}

										$pathtype .=  "Tipología Documental: <b>".$nomt."</b>";



										$pathtype .= "</div><div style=' margin-left:15px'>Permisos del Documento: ";



											if ($col["is_publico"] == "0") {

												$pathtype .=  "<b>El documento es público</b>";	

											}else{

												$pathtype .=  "<b>ES un documento privado</b>";	

											}



											$pathtype .= "</div>";

									}



									$pathtype .= "<div>Fecha de Creación: ";

										$pathtype .=  "<b>".$col['fecha']."</b>";	

									$pathtype .= "</div>";



# AQUI DEBO PONER LA FECHA NUEVA

									echo	$pathtype;

									if ($col['origen'] == "0") {

										$origen = "<div style='float:left'><b> Propio</b></div>";

									}else{



										$doco = new MGestion_anexos;

										$doco->CreateGestion_anexos("id", $col['origen']);



										$ng = new MGestion;

										$ng->CreateGestion("id", $doco->GetGestion_id());



										$origen = "<div style='float:left'><a href='/gestion/ver/".$ng->GetId()."/' target='_blank'>".$ng->GetNum_oficio_respuesta()."</a></div>";

									}

									$x = @stat (ROOT.DS."archivos_uploads/gestion/".$id.trim("/anexos/ ").$file);

									$size = round($x["size"] / 1024, 2)." Kb (".$x["size"]." Bytes)";



									$responsablea = $c->GetDataFromTable("usuarios", "user_id", $col['user_id'], "p_nombre, p_apellido", $separador = " ");

									echo "<div class='clear'></div>";

									echo "<div style='float:left'>Origen:&nbsp;</div>".$origen;

									if ($origen != "<div style='float:left'><b> Propio</b></div>") {

										echo "<div class='clear'></div>";

									}

									echo "<div style='float:left; margin-left:15px'>Peso:&nbsp;<b>".$size."</b></div>";



									echo "<div style='float:left; margin-left:15px'>Folios:&nbsp;<b>".$col['cantidad']."</b></div>";

									

									echo "<div class='clear'></div>";



									echo "<div style='float:left;'>Cod Encriptacion:&nbsp;<b>".$col['hash']."</b></div>";

									

									echo "<div class='clear'></div>";



									echo "<div style='float:left'> Cargado por: <b>".$responsablea."</b> el día ".$f->ObtenerFecha4($col['timest'])."</div>";

									echo "<div class='clear'></div>";

									if ($propietario_documento && $_SESSION['suscriptor_id'] == "") {

										if($_SESSION['eliminar'] == 1){

											echo "<input type='button' value='Eliminar Documento' style='margin-left:10px; margin-right:10px' class='btn_red' onClick='ChangeStatusDoc(\"".$col[0]."\", \"0\")'>";

										}

									}



									if ($col['tipologia'] != "0") {

										if($_SESSION['MODULES']['metadatos'] == "1"){

											echo "<input type='button' value='Ver Metadatos' class='btn_red' onClick='OpenWindow(\"/gestion_anexos/vermetadatos/".$col[0]."/\")'>";

										}

									}

									echo "<div class='clear'></div>";



	                echo "			</div>

	                            	<div class='inner_item_anexo' id='share_$col[0]' style='display:none'>";

					echo "				<div class='title'>Compartir Documento</div>";

					if ($_SESSION['mayedit'] == "1") {

						# code...

						echo "				<input type='text' id='whoishare_$col[0]' placeholder='Escriba el numero de radicado rápido del expediente a compartir' style='width:425px; height:25px'>

											<input type='button' value='Compartir' onClick='shareDocumento($col[0])'>";

					}

					echo "					<div class='clear'></div>

					

											<ul class='sharelistdoc' id='listshare$col[0]'>";

												$queryxtt = $con->Query("select gestion_id from gestion_anexos where origen = '".$col[0]."' group by gestion_id");

												$i = 0;

												while ($rxt = $con->FetchAssoc($queryxtt)) {

													$i++;

													$gx = new MGestion;

													$gx->CreateGestion("id", $rxt[gestion_id]);

													echo "<li>".$gx->GetNum_oficio_respuesta()."</li>";

												}

												if ($i <= 0) {

													echo '<li><div class="da-message warning">Este documento no se está compartiendo con ningún expediente</div></li>';

												}

					echo "					</ul>

							";											

					echo "				<div class='clear'></div>";

	                echo "         	</div>

	                            	<div class='inner_item_anexo' id='lookfor_$col[0]' style='display:none'>";

	                echo "				<div class='title'>Revisar Documento</div>";

							        if ($propietario_documento) {

				    echo '              <div id="listado_solicitudes">

									    	<div class="listado_seleccion">

									    		<select id="diasmaxtoresponse_'.$col[0].'" name="diasmaxtoresponse" style="width:160px; height:42px" class="important">

									    			<option value="0">Seleccione los días maximos para revisar el documento</option>

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

													$gap = new MGestion_anexos_permisos;

										        	$qgap = $gap->ListarGestion_anexos_permisos("where id_documento = '".$col[0]."'");

										        	$yz = 0;

										        	$ct = 0;

										        	$cp = 0;

										        	while ($rogap = $con->FetchAssoc($qgap)) {

										        		$ct++;

										        		if ($rogap['estado'] == "2") {

										        			$yz++;

										        		}

										        		if ($rogap['estado'] == "1") {

										        			$cp++;

										        		}

											        	$objectgap = new MGestion_anexos_permisos;

											        	$objectgap->CreateGestion_anexos_permisos("id", $rogap['id']);



										        		include(VIEWS.DS.'gestion_anexos_permisos/Listar.php');



										        	}				    

					echo '			    	</div>';

											if ($yz >= '1') {

											echo '		

													<form action="/gestion_anexos/updatephoto/'.$col[0].'/" id="formpicture'.$col[0].'"  name="formpicture'.$col[0].'" method="post" enctype="multipart/form-data">

												        <b><i>Volver a Cargar el Documento</i></b>

												        <input name="archivo" id="selfile'.$col[0].'" type="file" size="35"/>

										      		</form>

										      	<script>

										      		$("#selfile'.$col[0].'").change(function() {

										      			$("#formpicture'.$col[0].'").submit();

										      		});

										      	</script>';

											}elseif ($cp == $ct  && $col['estado'] == 3) {

												echo "<input type='button' value='Activar Documento' onClick='ChangeStatusDoc(\"".$col[0]."\", \"1\")'>";

											}

					echo '			    </div>  ';

							        }else{

							        	$gap = new MGestion_anexos_permisos;

							        	#if ($col['user_id'] == $_SESSION['usuario']) {

							        	#	$qgap = $gap->ListarGestion_anexos_permisos("where id_documento = '".$col[0]."'");

							        	#}else{

								        	$qgap = $gap->ListarGestion_anexos_permisos("where id_documento = '".$col[0]."' and usuario_permiso = '".$_SESSION['usuario']."'");

							        		

							        	#}

							        	while ($rogap = $con->FetchAssoc($qgap)) {

							        		

								        	$objectgap = new MGestion_anexos_permisos;

								        	$objectgap->CreateGestion_anexos_permisos("id", $rogap['id']);



								        	if ($objectgap->GetEstado() == '0') {

							        			include_once(VIEWS.DS.'gestion_anexos_permisos/FormUpdateGestion_anexos_permisos.php');

								        	}else{

								        		include_once(VIEWS.DS.'gestion_anexos_permisos/Listar.php');

								        	}

							        	}

							        	

							        }



	                echo "        		

	                					<ul class='sharelistdoc' id='listlookfor_$col[0]'></ul>

	                				</div>





            						<div class='inner_item_anexo' id='mailer_$col[0]' style='display:none'>";

					echo "				<div class='title'>Correos electrónicos a los que se ha enviado este documento</div>";

					echo "					<div class='clear'></div>

												<ul class='sharelistdoc' id='listshare$col[0]'>";

												$queryxtt = $con->Query("select * from mailer_attachments where alt = '".$col[0]."'");

												$i = 0;

												while ($rxtt = $con->FetchAssoc($queryxtt)) {

													$i++;

													$ma = new MMailer_attachments;

													$ma->CreateMailer_attachments("id", $rxtt['id']);



													$fm = new MMailer_from_message;

													$fm->CreateMailer_from_message("message_code", $ma->GetMessage_id());



													$mm = new MMailer_message;

													$mm->CreateMailer_message("message_id", $ma->GetMessage_id());



													$mr = new MMailer_replys;

													$mr->CreateMailer_replys("message_id", $ma->GetMessage_id());

													

													$rstatus = array("0" => "Mensaje Sin Leer", "1" => "El mensaje fue <strong>Abierto</strong>", "2" => "El mensaje ah sido <strong>Rehusado</strong>", "3" => "El mensaje fue <strong>abierto</strong> con anterioridad");

													

													echo 	"<li>".

																	"<b>Asunto:</b> ".$mm->GetSubject().

																	" / <b>Estado:</b> ".$rstatus[$mr->GetReaded()].

																	" / <b>Enviado a:</b> ".$fm->GetEmail()."<hr>";



															"</li>";

												}

												if ($i <= 0) {

													echo '<li><div class="da-message warning">Este documento no se ha enviado a ninguna dirección de correo</div></li>';

												}

					echo "					</ul>



										<div class='clear'></div>";

	                echo "         	</div>









									<div class='inner_item_anexo' id='mensajeria_$col[0]' style='display:none'>";

					echo "				<div class='title'>Correos Fisicos a los que se ha enviado este documento</div>";

					echo "					<div class='clear'></div>

												<ul class='sharelistdoc' id='listshare$col[0]'>";

												$queryxtty = $con->Query("select * from notificaciones_attachments inner join notificaciones on notificaciones.id = notificaciones_attachments.id_notificacion where notificaciones_attachments.id_anexo = '".$col[0]."'");

												$i = 0;

												while ($rxtty = $con->FetchAssoc($queryxtty)) {

													$i++;

													$not = new MNotificaciones;

													$not->CreateNotificaciones("id", $rxtty['id_notificacion']);



													if ($not->GetNom_archivo() == "") {

														$estadonot = "Enviada a Operador Postal";

													}else{

														$estadonot = $not->GetNom_archivo();

													}



													if ($not->GetGuia_id() == "") {

														$guiaid = "N/A";

													}else{

														$guiaid = $not->GetGuia_id();

													}

													echo 	"<li>".

																	"<b>Num. Guia: </b> ".$guiaid." / ".

																	"<b>Estado Actual: </b> ".$estadonot." / ".

																	"<b>Fecha Envio: </b> ".$not->GetF_citacion()."<hr>".

															"</li>";

												}

												if ($i <= 0) {

													echo '<li><div class="da-message warning">Este documento no se ha enviado a ninguna dirección de correo</div></li>';

												}

					echo "					</ul>



										<div class='clear'></div>";

	                echo "         	</div>

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





            echo '<div class="btn-group m-t-30">';

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

                echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/1/\", \"cargador_box_upfiles_menu\")' >Pagina 1</a> ";



                if($PagAct>1) 

                       

                echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/".$PagAnt."/\", \"cargador_box_upfiles_menu\")'>Pagina Anterior.</a> ";





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

                echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/".$PagSig."/\", \"cargador_box_upfiles_menu\")'>Pagina Siguiente.</a> ";



                echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='showfiles(\"/gestion/GetAnexos/".$id."/".$folder."/".$PagUlt."/\", \"cargador_box_upfiles_menu\")'>Pagina. $PagUlt</a>";

            echo '</div>

            </form>

        </div>';



?>

<script type="text/javascript">

	

	function shoideitem(id, me){

		$(".bloq_data_anexo .inner_item_anexo").slideUp();

		$(".bl_pro").removeClass("active");



		if ($(".bloq_data_anexo #"+id).hasClass('active')) {

			$(".bloq_data_anexo #"+id).removeClass('active');

		}else{

			$(".bloq_data_anexo .inner_item_anexo").slideUp();

			$(".bloq_data_anexo #"+id).slideDown();		

			$(".bloq_data_anexo #"+id).addClass('active');		

			$("#"+me).addClass('active');

		}

	}



		

	$(".activarbuscador").on("keyup", function(){

		var ide = $(this).attr('alt')

		$("#id_documento").val(ide);

		$(".bloquebusqueda_"+ide).fadeIn();				



		$.ajax({

			type: "POST",

			url: '/usuarios/GestListadoUsuariosSuscriptores/'+$(this).val()+"/",

			success: function(msg){

				result = msg;

				$(".bloquebusqueda_"+ide).html(result);					

			}

		});				

	})

	

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



	function AddUsuarioToListado(nombre, email, id){

		if (email == "<?= $_SESSION['usuario'] ?>") {

				$(".activarbuscador").val("");

				$(".bloquebusqueda").fadeOut();		



				var URL = '/gestion_anexos_permisos/registrar/';

				var essuscriptor = '';

				if(email.indexOf("@") < 0){

					essuscriptor = 'S';

				}

				

		        var str = "id_documento="+$("#id_documento").val()+"&usuario_permiso="+id+"&observacion="+''+"&diasmaxtoresponse="+$("#diasmaxtoresponse_"+$("#id_documento").val()).val()+"&usuario_permiso_username="+email+"&essuscriptor="+essuscriptor;

		        $.ajax({

		            type: 'POST',

		            url: URL,

		            data: str,

		            success:function(msg){

		            	showfiles('/gestion/GetAnexos/<?= $id ?>/<?= $folder ?>/1/', 'cargador_box_upfiles_menu');

		            	OpenWindow("/firmas_usuarios/firmar/"+msg+"/");

		            }

		        });

		}else{

			if ($("#diasmaxtoresponse_"+$("#id_documento").val()).val() == "0") {

				

				alert("Debe seleccionar de primero los días para revisar el expediente");

				$(".activarbuscador").val("");

				$(".bloquebusqueda").fadeOut();		



				return false;



			}else{

				if (confirm("¿Está seguro que desea solicitar revisar este documento con el usuario "+nombre+"?")) {

					var observacion = prompt("¿Algúna observación para este documento?");



					$(".activarbuscador").val("");

					$(".bloquebusqueda").fadeOut();		



					var URL = '/gestion_anexos_permisos/registrar/';

					var essuscriptor = '';

					if(email.indexOf("@") < 0){

						essuscriptor = 'S';

					}

					

			        var str = "id_documento="+$("#id_documento").val()+"&usuario_permiso="+id+"&observacion="+observacion+"&diasmaxtoresponse="+$("#diasmaxtoresponse_"+$("#id_documento").val()).val()+"&usuario_permiso_username="+email+"&essuscriptor="+essuscriptor;

			        $.ajax({

			            type: 'POST',

			            url: URL,

			            data: str,

			            success:function(msg){

			            	alert(msg);

			            	if (email == "<?= $_SESSION['usuario'] ?>") {

			            		alert("Envio la alerta al mismo usuario");

			            	};

			            	showfiles('/gestion/GetAnexos/<?= $id ?>/<?= $folder ?>/1/', 'cargador_box_upfiles_menu');

			                //var string = "<li id='elm"+id+"_"+$("#id_documento").val()+"'><div class='t_listado' style='float:left'>"+nombre+"</div>"+'<div class="nom_anexo" style="float:right"><div class="mini-ico green-deact" style="float:left" title="El documento aún no ha sido revisado por el usuario '+email+'"></div></div>'+"</li>";

							//$("#listlookfor_"+$("#id_documento").val()).append(string);

			            }

			        });

		

				}else{

		

					$(".activarbuscador").val("");

					$(".bloquebusqueda").fadeOut();		



					return false;

				}



			}

		}

	}



	function UpdateFolderName(id){

		if (confirm("¿Está seguro que desea cambiar el nombre de la carpeta?")) {

			fname = $("#foldername").val();



			$.ajax({

				type: "POST",

				url: '/gestion_folder/ActualizarNombre/'+id+"/"+fname+"/",

				success: function(msg){

				result = msg;

					alert(result);					

				}

			});			

		};

	}



	function DeleteFolder(id){

		if (confirm("¿Está seguro que desea Eliminar esta carpeta?")) {

			$.ajax({

				type: "POST",

				url: '/gestion_folder/eliminar/'+id+"/",

				success: function(msg){

					result = msg;

					alert(result);	

					window.location.reload();				

				}

			});			

		}

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

					showfiles('/gestion/GetAnexos/<?= $id ?>/<?= $folder ?>/1/', 'cargador_box_upfiles_menu')

					//window.location.reload();				

				}

			});			

		}

	}



</script>