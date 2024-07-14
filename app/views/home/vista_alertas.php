<?



	$q_str = "SELECT * FROM alertas WHERE user_id = '".$_SESSION['usuario']."' and log <= '".$c->GetIdLog(date("Y-m-d"))."' and keep_alive = '1' group by log desc limit $pagina_paginador, $cantidad_paginador";



	$query = $con->Query($q_str);



    $aar = array( "0" => "azulclaro", 



                  "1" => "verde", 



                  "2" => "rojo" 



                );



	$aar2 = array( "0" => "gen-act", 



                  "1" => "my-act", 



                  "2" => "late-act" 



                );



    $i = 0;



    echo "<div>";



    $j = 0;



	while($row = $con->FetchAssoc($query)){



		$path = "";



		$j++;



		if($i == "1"){



			$path = "style='border-top:none'";



		}		



		$lid = $con->Result($con->Query("select * from log where id='".$row["log"]."'"), 0, "fecha");	



		echo '<div class="daybloq"><div class="title_alerta '.$add.'"><b>'.$f->ObtenerFecha($lid).'</b>	</div>';



		$wa = "select * from alertas inner join tipos_alertas on tipos_alertas.alt = alertas.extra where log = '".$row["log"]."' and keep_alive = '1' and user_id='".$_SESSION['usuario']."' order by alertas.time desc";



		$qwa = $con->Query($wa);



		while($rrt = $con->FetchArray($qwa)){



			$NOMUSUARIO = "";



			$NOMDOCUMENTO = "";



			$NUMRADICACION = "";



			$NOMFORMULARIO = "";



			$NOMSUSCRIPTOR = "";



			$NOTIFICACION = "";



			$NOMDOCUMENTO = "";



			$TITULO_PROCESO = "";



			$MAIL_REMITENTE = "";



			$LEERMENSAJE = "";



			$USERNAMEX = "";



			$GUIA = "";



			$ASUNTO = "";



			$DATOSGUIA = "";



			$ALTEVENTO = "";



			$TITULOEVENTO = "";



			$MENSAJERIA = "";



			$FECHAVENCIMIENTO = "";



			$i++;



			$c = new Consultas;



            $filter= $rrt["nombre"];



            $lnid = $con->Result($con->Query("select * from log where id='".$row["log"]."'"), 0, "fecha");



            $b=array( 



                      "#NOMUSUARIO#",



                      "#NOMDOCUMENTO#",



                      "#NUMRADICACION#",



                      "#NOMFORMULARIO#",



                      "#NOMSUSCRIPTOR#",



                      "#NOTIFICACION#",



                      "#NOMDOCUMENTO#",



                      "#TITULO_PROCESO#",



                      "#MAIL_REMITENTE#",



                      "#LEERMENSAJE#",



                      "#USERNAMEX#",



                      "#GUIA#",



                      "#ASUNTO#",



                      "#DATOSGUIA#",



                      "#ALTEVENTO#",



                      "#TITULOEVENTO#",



                      "#MENSAJERIA#",



                      "#FECHAVENCIMIENTO#",



                      "#CANTIDAD#"



                    );



            if ($rrt['extra'] == "rad") {



					$g = new MGestion;



					$g->CreateGestion("id", $rrt['id_gestion']);



					$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



					$NOMUSUARIO = $c->GetDataFromTable("usuarios", "a_i", $g->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");



/*



(20, 'Se ha creado un nuevo expediente #NUMRADICACION# asignada al usuario: #NOMUSUARIO#', 'rad'),



*/



            }elseif ($rrt['extra'] == "anu") {



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



		                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google");



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ga = new MGestion_anexos;



				$ga->CreateGestion_anexos("id", $rrt['id_act']);



				$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";



				$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  



				$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $ga->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



/*				



(21, 'El usuario #NOMUSUARIO# ha cargado información en un documento obligatorio llamado #NOMDOCUMENTO# en el expediente #NUMRADICACION#', 'anu'),



*/



            }elseif ($rrt['extra'] == "aveg") {



            	$CANTIDAD = "<a href='/gestion/vencimientoexpedientesarchivo/1/'>".'('.$rrt['id_act'].') expedientes </a>';



            	$NOMDOCUMENTO = "";



            	if($rrt['id_evento'] > 0){



            		$NOMDOCUMENTO = " en el ".CAMPOAREADETRABAJO." de ".$c->GetDataFromTable("dependencias", "id", $rrt['id_evento'], "nombre", $separador = " ");



            	}



 /*



(23, 'El usuario #NOMUSUARIO# ha creado un documento llamado #NOMDOCUMENTO# que debe ser revisado por usted para poder ser exportado en el expediente #NUMRADICACION#', 'pr'),



*/



            }elseif ($rrt['extra'] == "avec") {



            	$CANTIDAD = "<a href='/gestion/vencimientoexpedientesarchivo/2/'>".'('.$rrt['id_act'].') expedientes </a>';



            	$NOMDOCUMENTO = "";



            	if($rrt['id_evento'] > 0){



            		$NOMDOCUMENTO = " en el ".CAMPOAREADETRABAJO." de ".$c->GetDataFromTable("dependencias", "id", $rrt['id_evento'], "nombre", $separador = " ");



            	}



 /*



(23, 'El usuario #NOMUSUARIO# ha creado un documento llamado #NOMDOCUMENTO# que debe ser revisado por usted para poder ser exportado en el expediente #NUMRADICACION#', 'pr'),



*/



            }elseif ($rrt['extra'] == "avecm") {



            	$cantidadq = $con->Result($con->Query("SELECT count(*) cantidad FROM `gestion_cambio_ubicacion_archivo` where estado_archivo_destino = '2' and estado = '0'"), 0, "cantidad");



            	$CANTIDAD = "<a href='/gestion/vencimientoexpedientesarchivo/11/'>".'('.$cantidadq.') expedientes </a>';



            	$NOMDOCUMENTO = "";



 /*



(23, 'El usuario #NOMUSUARIO# ha creado un documento llamado #NOMDOCUMENTO# que debe ser revisado por usted para poder ser exportado en el expediente #NUMRADICACION#', 'pr'),



*/



            }elseif ($rrt['extra'] == "avehm") {



            	$cantidadq = $con->Result($con->Query("SELECT count(*) cantidad FROM `gestion_cambio_ubicacion_archivo` where estado_archivo_destino = '3' and estado = '0'"), 0, "cantidad");



            	$CANTIDAD = "<a href='/gestion/vencimientoexpedientesarchivo/22/'>".'('.$cantidadq.') expedientes </a>';



            	$NOMDOCUMENTO = "";



 /*



(23, 'El usuario #NOMUSUARIO# ha creado un documento llamado #NOMDOCUMENTO# que debe ser revisado por usted para poder ser exportado en el expediente #NUMRADICACION#', 'pr'),



*/



            }elseif ($rrt['extra'] == "aisnc") {



            	$cantidadq = $con->Result($con->Query("SELECT count(*) as cantidad FROM `suscriptores_contactos` s inner join suscriptores_contactos_direccion sc on s.id = sc.id_contacto where s.estado = '1' and (sc.ciudad = '' or sc.direccion = '' or s.identificacion = '' or s.nombre = '')"), 0, "cantidad");



            	$CANTIDAD = "<a href='/herramientas/suscriptores/#contacts/'>".'('.$cantidadq.') suscriptores </a>';



            	$NOMDOCUMENTO = "";



            }elseif ($rrt['extra'] == "aecv") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);







				$l = new MGestion_compartir;



				$l->Creategestion_compartir('id', $rrt['id_act']);



				



				$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id",  $l->GetUsuario_nuevo(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



				$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



				$FECHAVENCIMIENTO = $l -> Getfecha_caducidad();



            }elseif ($rrt['extra'] == "aecvv") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);







				$l = new MGestion_compartir;



				$l->Creategestion_compartir('id', $rrt['id_act']);



				



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



				$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



				$FECHAVENCIMIENTO = $l -> Getfecha_caducidad();



            }elseif ($rrt['extra'] == "an") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



/*



				#$ga = new MGestion_anexos;



				#$ga->CreateGestion_anexos("id", $rrt['id_act']);



				$numdocumentos = $con->Result($con->Query("select count(*) as t from gestion_anexos where fecha = '$lnid' and gestion_id = '".$g->GetId()."'"), 0, 't');



				$listanexos = "	<div class='listanexos scrollable'>



									<ul>";



				$qan = $con->Query("select * from gestion_anexos where fecha = '$lnid' and gestion_id = '".$g->GetId()."'");



					while ($rowan = $con->FetchAssoc($qan)) {



						$ga = new MGestion_anexos;



						$ga->CreateGestion_anexos("id", $rowan['id']);



						$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";



						$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  



						$nom    = "<div class='smallname'>".$c->GetDataFromTable("usuarios", "user_id", $ga->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</div>";



						$link  = "<div class='filename' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".substr($ga->GetNombre(), 0, 60)."</div>";



						$listanexos .= "<li>$link $nom</li>";



					}



				$listanexos .= "	</ul>



								</div>";



*/



				$NOMDOCUMENTO  = "<span>Nuevos Documentos $listanexos</span>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



/*



(22, 'El usuario #NOMUSUARIO# ha cargado un documento llamado #NOMDOCUMENTO# en el expediente #NUMRADICACION#', 'an'),



*/



            }elseif ($rrt['extra'] == "pr") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



            	$doc = new MDocumentos_gestion;



            	$doc->CreateDocumentos_gestion("id", $rrt['id_act']);



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $doc->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$NOMDOCUMENTO  = "<a href='/documentos_gestion/nuevo/".$g->GetId()."/".$doc->GetId()."/'>".$doc->GetNombre()."</a>";



/*



(23, 'El usuario #NOMUSUARIO# ha creado un documento llamado #NOMDOCUMENTO# que debe ser revisado por usted para poder ser exportado en el expediente #NUMRADICACION#', 'pr'),



*/



            }elseif ($rrt['extra'] == "doc") {



				$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



            	$doc = new MDocumentos_gestion;



            	$doc->CreateDocumentos_gestion("id", $rrt['id_act']);



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $doc->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$NOMDOCUMENTO  = "<a href='/documentos_gestion/nuevo/".$g->GetId()."/".$doc->GetId()."/'>".$doc->GetNombre()."</a>";



			}elseif ($rrt['extra'] == "edoc") {



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



		                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google");



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ga = new MGestion_anexos;



				$ga->CreateGestion_anexos("id", $rrt['id_act']);



				$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";



				$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$ALTEVENTO = "<div class='descripcion'>".$ev->GetDescription()."</div>";



				$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $ga->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				#$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";



				$NOMDOCUMENTO  = "<b>".$ga->GetNombre()."</b>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



/*



(24, 'El usuario #NOMUSUARIO# ha creado un documento en el expediente #NUMRADICACION#', 'doc'),



*/



            }elseif ($rrt['extra'] == "form") {



				$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



            	$bigd = new MBig_data;



            	$bigd->CreateBig_data("id", $rrt['id_act']);



            	$maindoc = new MRef_tables;



            	$maindoc->CreateRef_tables("id", $bigd->GetRef_tables_id());



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $bigd->Getusername(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$NOMFORMULARIO  = "<a href='#'>".$maindoc->GetTitle()." - ".$bigd->GetCol_1()."</a>";



/*



(25, 'El usuario #NOMUSUARIO# ha creado un formulario en el expediente #NUMRADICACION#', 'form'),



*/



            }elseif ($rrt['extra'] == "eform") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



            	$bigd = new MBig_data;



            	$bigd->CreateBig_data("id", $rrt['id_act']);



            	$maindoc = new MRef_tables;



            	$maindoc->CreateRef_tables("id", $bigd->GetRef_tables_id());



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$ALTEVENTO = "<div class='descripcion'>".$ev->GetDescription()."</div>";



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $bigd->Getusername(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$NOMFORMULARIO  = "<a href='#'>".$maindoc->GetTitle()." - ".$bigd->GetCol_1()." </a>";



/*



(28, 'El usuario #NOMUSUARIO# ha editado la informacion del formulario #NOMFORMULARIO en el expediente #NUMRADICACION#', 'eform'),



*/



            }elseif ($rrt['extra'] == "sus") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



            	$gs = new MGestion_suscriptores;



            	$gs->CreateGestion_suscriptores("id", $rrt['id_act']);



            	$suscriptor = new MSuscriptores_contactos;



            	$suscriptor->CreateSuscriptores_contactos("id", $gs->GetId_suscriptor());



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $gs->GetUsuario_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$NOMFORMULARIO  = "<a href='#/'>".$suscriptor->GetNombre()." </a>";



/*



(26, 'El usuario #NOMUSUARIO# ha agregado al suscriptor #NOMFORMULARIO# a el expediente #NUMRADICACION#', 'sus'),



*/



            }elseif ($rrt['extra'] == "esus") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



            	$gs = new MGestion_suscriptores;



            	$gs->CreateGestion_suscriptores("id", $rrt['id_act']);



            	$suscriptor = new MSuscriptores_contactos;



            	$suscriptor->CreateSuscriptores_contactos("id", $gs->GetId_suscriptor());



            	$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$ALTEVENTO = "<div class='descripcion'>".$ev->GetDescription()."</div>";



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $gs->GetUsuario_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$NOMSUSCRIPTOR  = "<a href='#/'>".$suscriptor->GetNombre()." </a>";



/*



(27, 'El usuario #NOMUSUARIO# ha editado la configuración del suscriptor #NOMSUSCRIPTOR# en el expediente #NUMRADICACION#', 'esus'),



*/



            }elseif ($rrt['extra'] == "doca") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$docp = new MDocumentos_gestion_permisos;



				$docp->CreateDocumentos_gestion_permisos("id", $rrt['id_act']);



            	$doc = new MDocumentos_gestion;



            	$doc->CreateDocumentos_gestion("id", $docp->GetId_documento());



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $docp->GetUsuario_permiso(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$NOMDOCUMENTO  = "<a href='/documentos_gestion/nuevo/".$g->GetId()."/".$doc->GetId()."/'>".$doc->GetNombre()."</a>";



/*



(29, 'El usuario #NOMUSUARIO# ha creado un nuevo evento/actuación programada en el expediente #NUMRADICACION#', 'ev'),



*/



            }elseif ($rrt['extra'] == "A") {



				$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



            	$ev = new MEvents_gestion;



            	$ev->CreateEvents_gestion("id", $rrt["id_act"]);



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $ev->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				#$NOMDOCUMENTO  = "<a href='/gestion/ver/".$g->GetId()."/'>".$doc->GetNombre()."</a>";



				$TITULOEVENTO = "<b>".$ev->GetTitle()."</b>";



				$ALTEVENTO = "<div class='descripcion'>".$ev->GetId().$ev->GetDescription()."</div>";



/*



(29, 'El usuario #NOMUSUARIO# ha creado un nuevo evento/actuación programada en el expediente #NUMRADICACION#', 'ev'),



*/



            }elseif ($rrt['extra'] == "expdpc") {



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



		                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google");



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ga = new MGestion_anexos;



				$ga->CreateGestion_anexos("id", $rrt['id_act']);



				$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";



				$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  



				$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $ga->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



/*



(30, 'El usuario #NOMUSUARIO# ha creado un exportado el documento #NOMDOCUMENTO# en el expediente #NUMRADICACION#', 'expdpc'),



*/



            }elseif ($rrt['extra'] == "texp") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$ALTEVENTO = "<div class='descripcion'>".$ev->GetDescription()."</div>";



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $ev->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



/*



(31, 'Se le ha dado asignado el expediente #NUMRADICACION#', 'texp'),



*/



            }elseif ($rrt['extra'] == "eexp") {



           		$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$ALTEVENTO = "<div class='descripcion'>".$ev->GetDescription()."</div>";



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



				$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $ev->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



/*



(32, 'Se le ha dado acceso al expediente #NUMRADICACION#', 'comp');



*/



            }elseif ($rrt['extra'] == "eexpr") {



           		$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$ALTEVENTO = "<div class='descripcion'>".$ev->GetDescription()."</div>";



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $ev->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



/*



(32, 'Se le ha dado acceso al expediente #NUMRADICACION#', 'comp');



*/



            }elseif ($rrt['extra'] == "comp") {



				$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$gc = new MGestion_compartir;



				$gc->CreateGestion_compartir("id", $rrt["id_act"]);



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



				$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $gc->GetUsuario_comparte(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$USERNAMEX	   = "<b>".$c->GetDataFromTable("usuarios", "user_id", $gc->GetUsuario_nuevo(), "p_nombre, p_apellido", $separador = " ")."</b>";



            }elseif ($rrt['extra'] == "mejd") {



#El usuario #NOM USUARIO# ha enviado un mensaje de datos #ASUNTO# en el expediente #NUMRADICACION#



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$to = new MMailer_from_message;



				$to->CreateMailer_from_message("id", $rrt['id_act']);



				$msj = new MMailer_message;



				$msj->CreateMailer_message("message_id", $to->GetMessage_code());



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $to->GetUser_ID(), "p_nombre, p_apellido", $separador = " ")."</b>";



            	$USERNAMEX     = "<b>".$to->GetEmail()."</b>";



            	#$LEERMENSAJE   = "<a href='/correo/ver/.1.".$to->GetToken_ID()."/'>Mensaje de datos (".$msj->GetSubject().")</a>";



            	$LEERMENSAJE   = "<a href='/gestion/ver/".$g->GetId()."/inbox/'>Mensaje de datos (".$msj->GetSubject().")</a>";



            }elseif ($rrt['extra'] == "reciv") {



#El usuario #NOM USUARIO# ha enviado un mensaje de datos #ASUNTO# en el expediente #NUMRADICACION#



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$to = new MMailer_from_message;



				$to->CreateMailer_from_message("id", $rrt['id_act']);



				$msj = new MMailer_message;



				$msj->CreateMailer_message("message_id", $to->GetMessage_code());



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $to->GetUser_ID(), "p_nombre, p_apellido", $separador = " ")."</b>";



            	$USERNAMEX     = "<b>".$to->GetEmail()."</b>";



            	#$LEERMENSAJE   = "<a href='/correo/ver/.1.".$to->GetToken_ID()."/'>Mensaje de datos (".$msj->GetSubject().")</a>";



            	$LEERMENSAJE   = "<a href='/gestion/ver/".$g->GetId()."/inbox/'>Mensaje de datos (".$msj->GetSubject().")</a>";



            }elseif ($rrt['extra'] == "newmsj") {



            	#El usuario #NOM USUARIO# ha enviado un mensaje de datos #ASUNTO# en el expediente #NUMRADICACION#



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$to = new MMailer_from_message;



				$to->CreateMailer_from_message("id", $rrt['id_act']);



				$msj = new MMailer_message;



				$msj->CreateMailer_message("message_id", $to->GetMessage_code());



            	$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            	$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $to->GetUser_ID(), "p_nombre, p_apellido", $separador = " ")."</b>";



            	$USERNAMEX     = "<b>".$to->GetEmail()."</b>";



            	#$LEERMENSAJE   = "<a href='/correo/veracuse/".$to->GetToken_ID().".1/'>Mensaje de datos (".$msj->GetSubject().")</a>";



            	$LEERMENSAJE   = "<a href='/gestion/ver/".$g->GetId()."/inbox/'>Mensaje de datos (".$msj->GetSubject().")</a>";



#ha recibido un mensaje de datos #ASUNTO# del usuario #NOMUSUARIO# relacionado con el en el expediente #NUMRADICACION#            



			}elseif ($rrt['extra'] == "lsus") {



#el servicio #DATOSGUIA# del expediente #NUMRADICAC...



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



		                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google");



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ga = new MGestion_anexos;



				$ga->CreateGestion_anexos("id", $rrt['id_act']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";



				$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  



				$NOMUSUARIO    = "<b>".$c->GetDataFromTable("suscriptores_contactos", "id", $ev->GetUser_id(), "nombre", $separador = " ")."</b>";



				$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



			}elseif($rrt['extra'] == "rdoc") {



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



		                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google");



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ga = new MGestion_anexos;



				$ga->CreateGestion_anexos("id", $rrt['id_act']);



				$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";



				$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  



				$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $ga->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				#$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";



				$NOMDOCUMENTO  = "<b>".$ga->GetNombre()."</b>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



#el correo #ASUNTO#" del expediente #NUMRADICACION# ha sido entregado



            }elseif($rrt['extra'] == "rdocs") {



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



		                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google");



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ga = new MGestion_anexos;



				$ga->CreateGestion_anexos("id", $rrt['id_act']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";



				$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  



				$USERNAMEX    = "<b>".$c->GetDataFromTable("suscriptores_contactos", "id", $ev->GetUser_id(), "nombre", $separador = " ")."</b>";



				$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $ga->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				#$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";



				$NOMDOCUMENTO  = "<b>".$ga->GetNombre()."</b>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



#el correo #ASUNTO#" del expediente #NUMRADICACION# ha sido entregado



            }elseif($rrt['extra'] == "crdocs") {



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



		                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google");



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ga = new MGestion_anexos;



				$ga->CreateGestion_anexos("id", $rrt['id_act']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";



				$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  



				$NOMUSUARIO = "<b>".$c->GetDataFromTable("suscriptores_contactos", "id", $ev->GetUser_id(), "nombre", $separador = " ")."</b>";



				#$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";



				$NOMDOCUMENTO  = "<b>".$ga->GetNombre()."</b>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



#el correo #ASUNTO#" del expediente #NUMRADICACION# ha sido entregado



            }elseif($rrt['extra'] == "crdoc") {



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



		                              ".MP3" => "audio"                         , ".FLV" => "video"                         , ".WMV" => "video"							, ".CSV" => "google");



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$docp = new MGestion_anexos_permisos;



				$docp->CreateGestion_anexos_permisos("id", $rrt['id_act']);



				$ga = new MGestion_anexos;



				$ga->CreateGestion_anexos("id", $docp->GetId_documento());



				$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";



				$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  



				$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $docp->GetUsuario_permiso(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";



				#$NOMDOCUMENTO  = "<b>".$ga->GetNombre()."</b>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



#el correo #ASUNTO#" del expediente #NUMRADICACION# ha sido entregado



            }elseif ($rrt['extra'] == "cert") {



#el servicio numero #GUIA#" del expediente #NUMRADICACION# ha tenido actualizaciones



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$m = new MNotificaciones;



				$m->CreateNotificaciones("id", $rrt['id_act']);



				// $cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);



        //         $error = $cliente->getError();



        //         if ($error) {



        //             echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";



        //         }



        //         $array = array("id" => $m->GetId_postal());



        //         $result = $cliente->call("GetDetalleOperador", $array);



        //         if ($cliente->fault) {



        //             echo "<h2>Fault</h2><pre>";



        //             echo "</pre>";



        //         }else{



        //             $error = $cliente->getError();



        //             if ($error) {



        //                 echo "<h2>Error</h2><pre>" . $error . "</pre>";



        //             }else {



        //                 if ($result == "") {



        //                     echo "No se creo el WS";



        //                 }else{



        //                     $x  = explode(",", $result);



        //                     $MENSAJERIA = "<b>".$x[0]."</b>";



        //                     $msj = $x[2];



        //                 }



        //             }



        //         }



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



				$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



                $DATOSGUIA = "<a href='".$msj.$m->GetGuia_id()."' target='_blank'>".$m->GetGuia_id()."</a>";



			}elseif ($rrt['extra'] == "dfis") {



#el servicio numero #GUIA#" del expediente #NUMRADICACION# ha tenido actualizaciones



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$m = new MNotificaciones;



				$m->CreateNotificaciones("id", $rrt['id_act']);



				// $cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);



        //         $error = $cliente->getError();



        //         if ($error) {



        //             echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";



        //         }



        //         $array = array("id" => $m->GetId_postal());



        //         $result = $cliente->call("GetDetalleOperador", $array);



        //         if ($cliente->fault) {



        //             echo "<h2>Fault</h2><pre>";



        //             echo "</pre>";



        //         }else{



        //             $error = $cliente->getError();



        //             if ($error) {



        //                 echo "<h2>Error</h2><pre>" . $error . "</pre>";



        //             }else {



        //                 if ($result == "") {



        //                     echo "No se creo el WS";



        //                 }else{



        //                     $x  = explode(",", $result);



        //                     $MENSAJERIA = "<b>".$x[0]."</b>";



        //                     $msj = $x[2];



        //                 }



        //             }



        //         }



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



				$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



                $DATOSGUIA = "<a href='".$msj.$m->GetGuia_id()."' target='_blank'>".$m->GetGuia_id()."</a>";



			}elseif ($rrt['extra'] == "rfis") {



#el servicio #DATOSGUIA# del expediente #NUMRADICAC...



				$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$m = new MNotificaciones;



				$m->CreateNotificaciones("id", $rrt['id_act']);



				// $cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);



        //         $error = $cliente->getError();



        //         if ($error) {



        //             echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";



        //         }



        //         $array = array("id" => $m->GetId_postal());



        //         $result = $cliente->call("GetDetalleOperador", $array);



        //         if ($cliente->fault) {



        //             echo "<h2>Fault</h2><pre>";



        //             echo "</pre>";



        //         }else{



        //             $error = $cliente->getError();



        //             if ($error) {



        //                 echo "<h2>Error</h2><pre>" . $error . "</pre>";



        //             }else {



        //                 if ($result == "") {



        //                     echo "No se creo el WS";



        //                 }else{



        //                     $x  = explode(",", $result);



        //                     $MENSAJERIA = "<b>".$x[0]."</b>";



        //                     $msj = $x[2];



        //                 }



        //             }



        //         }



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



				$DATOSGUIA = "<a href='".$msj.$m->GetGuia_id()."' target='_blank'>".$m->GetGuia_id()."</a>";



            }elseif ($rrt['extra'] == "nfis") {



#Se ha enviado correspondencia fisica en el expediente #NUMRADICACION#



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            }elseif ($rrt['extra'] == "ev") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$ALTEVENTO = "<div class='descripcion'>".$ev->GetDescription()."</div>";



				$NOMUSUARIO    = "<b>".$c->GetDataFromTable("usuarios", "user_id", $ev->GetUser_id(), "p_nombre, p_apellido", $separador = " ")."</b>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            }elseif ($rrt['extra'] == "vexp") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            }elseif ($rrt['extra'] == "avoe") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



				$TITULOEVENTO = "<b>".$ev->GetTitle()."</b>";



				$FECHAVENCIMIENTO = "<b>".$f->nicetime($ev->GetFecha())."</b>";



				$ALTEVENTO = "<div class='descripcion'>".$ev->GetDescription()."</div>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            }elseif($rrt['extra'] == "nsdoc"){



				$sol = new MSolicitudes_documentos;



				$sol->CreateSolicitudes_documentos("id", $rrt['id_act']);



				if ($sol->GetGestion_id() != "0") {



					$g = new MGestion;



					$g->CreateGestion("id", $sol->GetGestion_id());



					$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



				}



					$NOMUSUARIO = "<b>".$c->GetDataFromTable("usuarios", "user_id", $sol->GetUsuario_solicita(), "p_nombre, p_apellido", $separador = " ")."</b>";



					$ALTEVENTO = "<div class='descripcion'>".$sol->GetObservacion()."</div>";



            }elseif($rrt['extra'] == "dcu") {


				$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);







				$MGestion_anexos_permisos_documentos = new MGestion_anexos_permisos_documentos;



				$MGestion_anexos_permisos_documentos->CreateGestion_anexos_permisos_documentos("id", $rrt["id_act"]);







				$ga = new MGestion_anexos;



				$ga->CreateGestion_anexos("id", $MGestion_anexos_permisos_documentos->GetId_documento());







				$ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$g->GetId().trim("/anexos/ ").$ga->GetUrl()."";



				$extension = substr($ga->GetUrl(), strlen($ga->GetUrl())-4, strlen($ga->GetUrl()));  



				#$NOMDOCUMENTO  = "<b><span class='smaplink' onClick='AbrirDocumento(\"".$ruta."\", \"".$viewer[$extension]."\", \"".$ga->GetNombre()."\", \"4\", \"".$ga->GetId()."\")'>".$ga->GetNombre()."</span></b>";



				$NOMDOCUMENTO  = "<b>".$ga->GetNombre()."</b>";



				$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



#el correo #ASUNTO#" del expediente #NUMRADICACION# ha sido entregado



            }elseif($rrt['extra'] == "dndoc"){



				$sol = new MSolicitudes_documentos;



				$sol->CreateSolicitudes_documentos("id", $rrt['id_act']);



				if ($sol->GetGestion_id() != "0") {



					$g = new MGestion;



					$g->CreateGestion("id", $sol->GetGestion_id());



					$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



				}



					$NOMUSUARIO = "<b>".$c->GetDataFromTable("usuarios", "user_id", $sol->GetUsuario_destino(), "p_nombre, p_apellido", $separador = " ")."</b>";



					$ALTEVENTO = "<div class='descripcion'>".$sol->GetRespuesta()."</div>";



            }elseif ($rrt['extra'] == "avne") {



            	$g = new MGestion;



				$g->CreateGestion("id", $rrt['id_gestion']);



				$ev = new MEvents_gestion;



				$ev->CreateEvents_gestion("id", $rrt["id_evento"]);



#Tienes una actividad llamada #TITULOEVENTO# para realizar el día de hoy en el expediente #NUMRADICACION# #ALTEVENTO#



				$TITULOEVENTO = "<b>".$ev->GetTitle()."</b>";



				$ALTEVENTO = "<div class='descripcion'>".$ev->GetDescription()."</div>";



				$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 



					$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";



            }



            $c=array( "$NOMUSUARIO",



                      "$NOMDOCUMENTO",



                      "$NUMRADICACION",



                      "$NOMFORMULARIO",



                      "$NOMSUSCRIPTOR",



                      "$NOTIFICACION",



                      "$NOMDOCUMENTO",



                      "$TITULO_PROCESO<a href='".HOMEDIR.DS."correo/ver/".$bptahx[1]."/'><strong>$titulo</strong></a>",



                      "$MAIL_REMITENTE<a href='".HOMEDIR.DS."correo/veracuse/".$bptah[1].".1/'>Ver Mensaje</a>",



                      "$LEERMENSAJE", 



                      "$USERNAMEX",



                      "$GUIA",



                      "$ASUNTO",



                      "$DATOSGUIA",



                      "$ALTEVENTO",



                      "$TITULOEVENTO",



                      "$MENSAJERIA",



                      "$FECHAVENCIMIENTO",



                      "$CANTIDAD"



                    );



          $filter=str_replace($b,$c,$filter);   



          $styloresaltado = "";



          $mark = "";



          $checked = "";



          $statusact = $aar[$rrt['type']];



          $typeact = $aar2[$rrt['type']];



          $exc = array("aveg", "avec", "nsdoc", 'dndoc',"avecm", "avehm", "aisnc", "aecvv","aecv");



          if(!in_array($rrt['extra'], $exc)){

          	$bgp = 'background-color:#FFF';

          	if ($g->GetPrioridad() == "2") {


          		$bgp = 'color: #8a6d3b; background-color: #fcf8e3; border-color: #faebcc;';
         		$iconflag = "<img title='Expediente de Prioridad Alta' src='".ASSETS.DS."images/star.png'>";



          	}elseif ($g->GetPrioridad() == "1") {


          		$bgp = 'background-color:#FFF';
          		$iconflag = "<img title='Expediente de Prioridad Media' src='".ASSETS.DS."images/star-half.png'>";



          	}elseif ($g->GetPrioridad() == "0") {


          		$bgp = 'background-color:#FFF';
          		$iconflag = "<img title='Expediente de Prioridad Baja' src='".ASSETS.DS."images/star-empty.png'>";



          	}else{



          		$iconflag = "<img title='Expediente de Prioridad Baja' src='".ASSETS.DS."images/star-empty.png'>";



          	}



          } else {



          		$styloresaltado = 'style="background-color: orange;color: #fff;"';



          		$iconflag = "<img title='Expediente de Prioridad Alta' src='".ASSETS.DS."images/star.png'>";



          }



          if($rrt["status"] == "2"){



            $checked = 'checked="checked"';



          }



          if ($rrt['type'] == 1 && $rrt["status"] == "0" && $lnid < date("Y-m-d")) {



				$statusact = $aar[2];



				$typeact = $aar2[$rrt['type']]." ".$aar2[2];



          }



          echo "<div $styloresaltado class='notification_bloq ".$typeact."' style='".$bgp."'>
                    <div class='notificationicon ".$statusact."'></div>
                    <div class='flag_icon'>".$iconflag."</div>
                    <div class='checkbox'>".$aar2['id']."
                    	<input type='checkbox' $checked onChange='ChangeStatusAlerta(\"".$rrt[0]."\")' id='act_".$rrt[0]."' >
                    </div>
                    <div class='texto'>".$filter.$ALTEVENTO."</div>
                    <div class='clearb'></div>
                </div>";						



		}



        echo "</div>";



	}



		if ($j == "0" && $_SESSION['paginador_alertas_noregistros'] == 0) {



			if($_SESSION['paginador_alertas'] > 1){



				echo "<br><br><div class='alert alert-info'>No hay mas actividades :-)</div><br><br>";



			} else {



				echo "<br><br><div class='alert alert-info'>No tienes actividades :-)</div><br><br>";



			}



			$_SESSION['paginador_alertas_noregistros'] = 1;



		}



echo "</div>";



	?>