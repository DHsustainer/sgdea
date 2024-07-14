<?
session_start();
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'CaratulaM.php');
	include_once(VIEWS.DS.'events'.DS.'calendar.php');	
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'NotificacionesM.php');
	include_once(MODELS.DS.'Demandado_procesoM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'FuentesM.php');
	include_once(MODELS.DS.'Mailer_messageM.php');
	include_once(MODELS.DS.'Mailer_from_messageM.php');
	include_once(MODELS.DS.'Gestion_compartirM.php');
	include_once(MODELS.DS.'Areas_dependenciasM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Dependencias_tipologiasM.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'LibrosM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	
	include_once(MODELS.DS.'Gestion_anexosM.php');
	include_once(MODELS.DS.'Gestion_anexos_permisosM.php');
	include_once(MODELS.DS.'Gestion_suscriptoresM.php');
	include_once(MODELS.DS.'Gestion_transferenciasM.php');
	include_once(MODELS.DS.'Dependencias_alertasM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'Big_dataM.php');
	include_once(MODELS.DS.'Ref_tablesM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Documentos_gestionM.php');
	include_once(MODELS.DS.'Dependencias_documentosM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Documentos_gestion_permisosM.php');
	include_once(MODELS.DS.'Dependencias_permisos_documentoM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Seccional_principalM.php');
	include_once(MODELS.DS.'SeccionalM.php');	
	include_once(MODELS.DS.'Solicitudes_documentosM.php');	
	include_once(MODELS.DS.'Gestion_tipologias_big_dataM.php');
	include_once(MODELS.DS.'Dependencias_tipologias_referenciasM.php');	
	include_once(MODELS.DS.'Meta_big_dataM.php');	
	include_once(MODELS.DS.'Meta_referencias_camposM.php');	
	include_once(MODELS.DS.'Meta_referencias_titulosM.php');	
	include_once(MODELS.DS.'Meta_listas_valoresM.php');	
	include_once(MODELS.DS.'Usuarios_configurar_firma_digitalM.php');	
	include_once(MODELS.DS.'Gestion_anexos_permisos_documentosM.php');	
	include_once(MODELS.DS.'Gestion_anexos_firmasM.php');	

	#error_reporting(E_ALL);
	#ini_set('display_errors', '1');

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CBuscador;
	$c = new Consultas;
	$f = new Funciones;
		
	// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
	// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
	if($c->sql_quote($_REQUEST['action']) == 'nbusquedaexpedientes')
		$ob->BuscarExpedientes($_REQUEST['id'], $_REQUEST['cn']);	
	elseif($c->sql_quote($_REQUEST['action']) == 'nbusquedasuscriptores')
		$ob->BuscarSuscriptores($_REQUEST['id']);	
	elseif($c->sql_quote($_REQUEST['action']) == 'nbusquedadocumentos')
		$ob->BuscarDocumentos($_REQUEST['id']);	
	elseif($c->sql_quote($_REQUEST['action']) == 'nbusquedametadatos')
		$ob->BuscarMetadatos($_REQUEST['id']);	
	elseif($c->sql_quote($_REQUEST['action']) == 'nbusquedajuridica')
		$ob->BuscarJuridica($_REQUEST['id']);	
	elseif($c->sql_quote($_REQUEST['action']) == 'nulled')
		$ob->Nulled($_REQUEST['id'], $_REQUEST['cn']);
	elseif($c->sql_quote($_REQUEST['action']) == 'sbyid')
		$ob->BuscarExpedientesById($_REQUEST['id']);
	else
	// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO	
		$ob->Nulled($_REQUEST['id'], $_REQUEST['cn']);
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CBuscador extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function BuscarExpedientes($id, $pag){

			global $con;
			global $f;
			global $c;
			
			//$sq = $con->Query($s1);
			$i2 = 0;

			$RegistrosAMostrar = 20;
			if(isset($pag)){
				$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
				$PagAct=$pag;
			}else{
				$RegistrosAEmpezar=0;
				$PagAct=1;
			}	
			
			$pathquery = ' or campot1 like "%'.$id.'%" or campot2 like "%'.$id.'%" or campot3 like "%'.$id.'%" or campot4 like "%'.$id.'%" or campot5 like "%'.$id.'%" or campot6 like "%'.$id.'%" or campot7 like "%'.$id.'%" or campot8 like "%'.$id.'%" or campot9 like "%'.$id.'%" or campot10 like "%'.$id.'%" or campot11 like "%'.$id.'%" or campot12 like "%'.$id.'%" or campot13 like "%'.$id.'%" or campot14 like "%'.$id.'%" or campot15 like "%'.$id.'%" ';
			
			$pathmulti = "";
			if ($_SESSION['MODULES']['multioficina'] == "1") {
				$pathmulti = " and oficina = '".$_SESSION['seccional']."'";
			}
			
			/*Usuario del sistema*/
			if ($_SESSION['suscriptor_id'] == "") {
				if ($_SESSION['buscador_global'] == "1") {
					$s1 = "select id 
								from gestion 
									where 
										(num_oficio_respuesta like '%".$id."%' or 
										radicado like '%".$id."%' or 
										observacion like '%".$id."%' or 
										observacion2 like '%".$id."%' or 
										nombre_radica like '%".$id."%' or 
										min_rad like '%".$id."%' $pathquery) and estado_archivo != '-99' $pathmulti
										order by id desc limit $RegistrosAEmpezar, $RegistrosAMostrar ";

					$sq = $con->Query($s1);					

					$qx = "select count(*) as t 
								from gestion 
									where 
										(num_oficio_respuesta like '%".$id."%' or 
										radicado like '%".$id."%' or 
										observacion like '%".$id."%' or 
										observacion2 like '%".$id."%' or 
										nombre_radica like '%".$id."%' or 
										min_rad like '%".$id."%' $pathquery) and estado_archivo != '-99'".$pathmulti;				
				}else{
					$s1 = "select g.id 
									from gestion as g 
										where 
											g.nombre_destino = '".$_SESSION['user_ai']."' and 
											(g.num_oficio_respuesta like '%".$id."%' or 
											g.radicado like '%".$id."%' or 
											g.observacion like '%".$id."%' or 
											g.observacion2 like '%".$id."%' or 
											g.min_rad like '%".$id."%'  $pathquery) and g.estado_archivo != '-99'".$pathmulti;
					/*
					or gestion_compartir.usuario_nuevo = '".$_SESSION['usuario']."' and 
					(g.num_oficio_respuesta like '%".$id."%' or 
					g.radicado like '%".$id."%' or 
					g.observacion like '%".$id."%' or 
					g.observacion2 like '%".$id."%' or 
					g.min_rad like '%".$id."%') and gestion.estado_archivo != '-99'
					*/

					$sq = $con->Query($s1);					

					$qx = "select count(*) as t 
								from gestion
										where 
											gestion.nombre_destino = '".$_SESSION['user_ai']."' and 
											(gestion.num_oficio_respuesta like '%".$id."%' or 
											gestion.radicado like '%".$id."%' or 
											gestion.observacion like '%".$id."%' or 
											gestion.observacion2 like '%".$id."%' or 
											gestion.min_rad like '%".$id."%'  $pathquery) and gestion.estado_archivo != '-99'".$pathmulti;
				}

				$NroRegistros = $con->Result($con->Query($qx), 0, 't');

		        if($NroRegistros == 0){
		        	echo '<div class="alert alert-info" role="alert">No hay registros de ingresos de este item</div><br><br>';
		        }

		        $PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;

		        $Res=$NroRegistros%$RegistrosAMostrar;


				while ($row = $con->FetchAssoc($sq)) {
					$i2++;
					$c->GetVistaAmple($row["id"]);
				}

			}else{/*Usuario suscriptor*/
				/*$s1 = "select id 
							from gestion 
								where 
									suscriptor_id in(select id from suscriptores_contactos where id = '".$_SESSION['suscriptor_id']."' union select id from suscriptores_contactos where dependencia = '".$_SESSION['suscriptor_id']."') and
									(num_oficio_respuesta like '%".$id."%' or 
									radicado like '%".$id."%' or 
									observacion like '%".$id."%' or 
									observacion2 like '%".$id."%' or 
									nombre_radica like '%".$id."%' or 
									min_rad like '%".$id."%') and estado_archivo != '-99'
									order by id desc limit $RegistrosAEmpezar, $RegistrosAMostrar ";

				$s1 = "select id 
							from gestion 
								where 
									(num_oficio_respuesta like '%".$id."%' or 
									radicado like '%".$id."%' or 
									observacion like '%".$id."%' or 
									observacion2 like '%".$id."%' or 
									nombre_radica like '%".$id."%' or 
									min_rad like '%".$id."%') and estado_archivo != '-99'
									order by id desc limit $RegistrosAEmpezar, $RegistrosAMostrar ";
									*/

				$s1 =  "SELECT id_gestion as id 
				            FROM gestion_suscriptores as gs inner join gestion as g on g.id = gs.id_gestion 
				            where gs.id_suscriptor = '".$_SESSION['suscriptor_id']."' 
				            and (   num_oficio_respuesta like '%".$id."%' or 
				                    radicado like '%".$id."%' or 
				                    observacion like '%".$id."%' or 
				                    observacion2 like '%".$id."%' or 
				                    nombre_radica like '%".$id."%' or 
				                    min_rad like '%".$id."%' $pathquery) and 
				                    estado_archivo != '-99' $pathmulti
				            order by id desc limit $RegistrosAEmpezar, $RegistrosAMostrar ";

				$sq = $con->Query($s1);					

				/*$qx = "select count(*) as t 
							from gestion 
								where
									suscriptor_id in(select id from suscriptores_contactos where id = '".$_SESSION['suscriptor_id']."' union select id from suscriptores_contactos where dependencia = '".$_SESSION['suscriptor_id']."') and
									(num_oficio_respuesta like '%".$id."%' or 
									radicado like '%".$id."%' or 
									observacion like '%".$id."%' or 
									observacion2 like '%".$id."%' or 
									nombre_radica like '%".$id."%' or 
									min_rad like '%".$id."%') and estado_archivo != '-99'";*/
									
				$qx = "select count(*) as t 
							from gestion 
								where
									(num_oficio_respuesta like '%".$id."%' or 
									radicado like '%".$id."%' or 
									observacion like '%".$id."%' or 
									observacion2 like '%".$id."%' or 
									nombre_radica like '%".$id."%' or 
									min_rad like '%".$id."%' $pathquery) and estado_archivo != '-99'".$pathmulti;

				$NroRegistros = $con->Result($con->Query($qx), 0, 't');

		        if($NroRegistros == 0){
		        	echo '<div class="alert alert-info" role="alert">No hay registros de ingresos de este item</div><br><br>';
		        }

		        $PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;

		        $Res=$NroRegistros%$RegistrosAMostrar;


				while ($row = $con->FetchAssoc($sq)) {
					$i2++;
					$c->GetVistaAmplePublica($row["id"]);
				}
			}

			/**datos comunes*/
			$url = "/buscador/nbusquedaexpedientes";
			if ($i2 > 0) {
				echo "<div class='paginator m-t-30'>";
				if($Res>0) $PagUlt=floor($PagUlt)+1;
			        echo "<a href='#' onClick='ActivarTab(\"$url/$id/1/\", \"buscartab1\")' class='pag'>Pag. 1</button> ";

		        if($PagAct>1) 
			        echo "<a href='#' onClick='ActivarTab(\"$url/$id/$PagAnt/\", \"buscartab1\")' class='pag'>Pag. Ant.</button> ";
			        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";

		        if($PagAct<$PagUlt)  
			        echo " <a href='#' onClick='ActivarTab(\"$url/$id/$PagSig/\", \"buscartab1\")' class='pag'>Pag. Sig.</button>  ";
			        echo " <a href='#' onClick='ActivarTab(\"$url/$id/$PagUlt/\", \"buscartab1\")' class='pag'>Pag. $PagUlt</button> ";

			    echo "</div>";
			
			
				//echo "<div class='alert alert-info' role='alert'>No se encontraron resultados...</div>";
			}			
		}

		function BuscarSuscriptores($id){
			global $con; 
			global $c;
			global $f;
			include_once(VIEWS.DS.'buscador'.DS.'BusquedaBySuscriptor.php');	

		}
		function BuscarExpedientesById($id){

			global $con;
			global $f;
			global $c;

				$s1 = "select gestion_suscriptores.id_gestion 
							from gestion
								inner join gestion_suscriptores on gestion_suscriptores.id_suscriptor = gestion.suscriptor_id 
								where 
									gestion_suscriptores.id_suscriptor =  '".$id."'";
				
				$sq = $con->Query($s1);
				$i2 = 0;
				while ($row = $con->FetchAssoc($sq)) {
					$i2++;
					$c->GetVistaExpedienteReducida($row["id_gestion"]);
					echo "<br><br><br>";
				}

			
			if ($i2 == "0") {
				echo "<div class='alert alert-info' role='alert'>No se encontraron resultados...</div>";
			}
			
		}
		function BuscarDocumentos($id){
			global $con; 
			global $c;
			global $f;

			$viewer =  array(     ".doc" => "google" , "docx" => "google" , ".zip" => "google" , ".rar" => "google" , ".tar" => "google" 
			, ".xls" => "google" , "xlsx" => "google" , ".ppt" => "google" , ".pps" => "google" , "pptx" => "google" , "ppsx" => "google" 
			, ".pdf" => "google" , ".txt" => "google" , ".jpg" => "image"  , "jpeg" => "image"  , ".bmp" => "image"  , ".gif" => "image"  
			, ".png" => "image"  , ".dib" => "image"  , ".tif" => "image"  , "tiff" => "image"  , "mpeg" => "video"  , ".avi" => "video"  
			, ".mp4" => "video"  , "midi" => "audio"  , ".acc" => "audio"  , ".wma" => "audio"  , ".ogg" => "audio"  , ".mp3" => "audio"  
			, ".flv" => "video"  , ".wmv" => "video"  , ".csv" => "google" , ".DOC" => "google" , "DOCX" => "google" , ".ZIP" => "google" 
			, ".RAR" => "google" , ".TAR" => "google" , ".XLS" => "google" , "XLSX" => "google" , ".PPT" => "google" , ".PPS" => "google" 
			, "PPTX" => "google" , "PPSX" => "google" , ".PDF" => "google" , ".TXT" => "google" , ".JPG" => "image"  , "JPEG" => "image"  
			, ".BMP" => "image"  , ".GIF" => "image"  , ".PNG" => "image"  , ".DIV" => "image"  , ".TIF" => "image"  , "TIFF" => "image"  
			, "MPEG" => "video"  , ".AVI" => "video"  , ".MP4" => "video"  , "MIDI" => "audio"  , ".ACC" => "audio"  , ".WMA" => "audio"  
			, ".OGG" => "audio"  , ".MP3" => "audio"  , ".FLV" => "video"  , ".WMV" => "video"  , ".CSV" => "google" );
			$iconfile = array("doc" => "mdi-file-word text-info" , "docx" => "mdi-file-word text-info" , "zip" => "mdi-zip-box text-info" , "rar" => "mdi-zip-box text-info" , "tar" => "mdi-zip-box text-info" , "xls" => "mdi-file-excel text-success" , "xlsx" => "mdi-file-excel text-success" , "ppt" => "mdi-file-powerpoint text-danger" , "pps" => "mdi-file-powerpoint text-danger" , "pptx" => "mdi-file-powerpoint text-danger" , "ppsx" => "mdi-file-powerpoint text-danger" , "pdf" => "mdi-file-pdf text-danger" , "txt" => "mdi-file-document text-muted" , "jpg" => "mdi-file-image text-success"  , "jpeg" => "mdi-file-image text-success"  , "bmp" => "mdi-file-image text-success"  , "gif" => "mdi-file-image text-success"  , "png" => "mdi-file-image text-success"  , "dib" => "mdi-file-image text-success"  , "tif" => "mdi-file-image text-success"  , "tiff" => "mdi-file-image text-success"  , "mpeg" => "mdi-file-video text-warning"  , "avi" => "mdi-file-video text-warning"  , "mp4" => "mdi-file-video text-warning"  , "midi" => "mdi-audiobook mdi-warning"  , "acc" => "mdi-audiobook mdi-warning"  , "wma" => "mdi-audiobook mdi-warning"  , "ogg" => "mdi-audiobook mdi-warning"  , "mp3" => "mdi-audiobook mdi-warning" , "flv" => "mdi-file-video text-warning"  , "wmv" => "mdi-file-video text-warning"  , "csv" => "mdi-file-excel text-success" , "" => "mdi-file-find text-warning" );


			$s1 = "select id, gestion_id from 
					gestion_anexos
						where 
							estado = 1 and
							nombre like '%".$id."%' group by gestion_id";

			$sq = $con->Query($s1);
			$i2 = 0;

			while ($row = $con->FetchAssoc($sq)) {
				$sx = "select * from gestion_anexos where estado = 1 and nombre like '%".$id."%' and gestion_id = '".$row['gestion_id']."'";

				$sxq = $con->Query($sx);
				$path = "";

				while ($col = $con->FetchAssoc($sxq)) {
					
					$type=explode('.', strtolower($col[url]));
			        $type=array_pop($type);
			        $tipologia = "";
			        $file = $col["url"];
			        $idb = $col[0];
			        $propietario_documento = false;			        
			        if ($file != "") {
			        	if($path == ""){
							$path .= "<b>Documentos</b>";
						}
			            $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$col['gestion_id'].trim("/anexos/ ").$file."";
			            $ruta2 = ROOT.DS."archivos_uploads/gestion/".$col['gestion_id'].trim("/anexos/ ").$file."";
			            $cadena_nombre = substr($file,0,200);
			            $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));			        	
			        	$exists = file_exists( $ruta2 );
			        	$exs = "";
			        	if (!$exists) {
							$exs = "<span class='text-danger mdi mdi-alert-octagon' data-toggle='tooltip'  title='Error al Leer el Archivo' data-placement='right'></span>";
			        	}
						$bad = (strlen($col[nombre]) > 80)?"...":"";
					 	$nombredoc = substr($col[nombre], 0, 80).$bad;

					 	$path .= "<div class='list-group-item' id='file_".$col[id]."'>
							<div class='row'>
								<div class='col-md-11 col-sm-12 col-xs-12 waves-effect'>
									<div class='material-icon-list-demo' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>
										<div class='icons'>
											<div class='row'>
												<div class='col-md-1 col-sm-2 col-xs-2'>
													<i class='mdi ".$iconfile[$type]."'></i>
												</div>
												<div class='col-md-11 col-sm-10 col-xs-10 p-l-0'>
							                    	<span> $nombredoc </span>
												</div>
											</div>
										</div>
									</div>
								</div>
				   			</div>
				   		</div>";
					 }

					//$path .= "ID: ".$ro['id']."<br>";
				}

				$c->GetVistaAmple($row["gestion_id"],$path);
				$i2++;
			}

			if ($i2 == "0") {
				echo "<div class='alert alert-info' role='alert'>No se encontraron resultados...</div>";
			}
		}
		function BuscarMetadatos($id){
			global $con; 
			global $c;
			global $f;

			$s1 = "";
			$sq = $con->Query($s1);
			$i2 = 0;

			while ($row = $con->FetchAssoc($sq)) {
				$i2++;
			}

			if ($i2 == "0") {
				echo "<div class='alert alert-info' role='alert'>No se encontraron resultados...</div>";
			}
		}
		function BuscarJuridica($attr){
			global $con; 
			global $c;
			global $f;

			include_once(VIEWS.DS.'home'.DS.'searchInCodes.php');
		}

		function Nulled(){
			echo "<div class='alert alert-info' role='alert'>Debe ingresar un parametro de busqueda</div>";
		}
		
	}
?>
		