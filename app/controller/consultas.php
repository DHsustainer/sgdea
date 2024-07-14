<?
require(PLUGINS.DS.'phpmailer/class.phpmailer.php');
include_once(PLUGINS.DS.'phpmailer/PHPMailerAutoload.php');
include_once(MODELS.DS.'Plantillas_emailM.php');

class Consultas{



	//Funcion para obtejer el maximo ID de una tabla X



	function GetMaxIdTabla($tbl_name, $field){



		global $con;



		$str = "SELECT MAX(".$field.") as mx FROM ".$tbl_name;



		$query = $con->Query($str);



		return $con->Result($query, 0, 'mx');



	}



	//Funcion para filtrar las variables recibidas y evitar inyecciones de SQL



	function sql_quote($value){



		if(get_magic_quotes_gpc())



		$value = stripslashes($value);



#		if(function_exists('mysql_real_escape_string'))



#			$value = mysql_real_escape_string( $value );



#		else //for PHP version <4.3.0 use addslashes



#			$value = addslashes( $value );



		$value = $this->Reemplazo($value);



	#	$value = $this->SqlParser($value);



		return $value;



	}



/*FUNCIONES DE PARSEO*/



 function SqlParser($string, $typefile = "text", $size = "1000", $options = ""){



        try {



            $values = array("text" => "TEXT", "password" => "TEXT", "search" => "TEXT", "textarea" => "TEXT", "file" => "TEXT", "hidden" => "TEXT", "select" => "TEXT", "video" => "TEXT", "color" => "TEXT",



                        "number" => "NUMBER", "month" => "NUMBER", "week" => "NUMBER", "range" => "NUMBER", "tel" => "NUMBER");



            $string = substr($string, 0, $size);



            $string = htmlspecialchars($string);



            $string = addslashes($string);



            $string = trim($string);



            if ($values[$typefile] == "TEXT") {



                if (filter_var($string, FILTER_SANITIZE_STRING)) {



                    return $this->filtrado($string);



                }else{



                    $string = "";



                    return $this->filtrado($string);



                }



            }elseif ($values[$typefile] == "NUMBER") {



                if (filter_var($string, FILTER_VALIDATE_INT) === false) {



                    $string = 0;



                    return $string;



                }else{



                    return $string;



                }



            }elseif($typefile == "date"){



                if ($this->validateDate($string, "Y-m-d")) { return $string; }else{ $string = ""; return $string; }



            }elseif($typefile == "time"){



                if ($this->validateDate($string, "H:i:s")) { return $string; }else{ $string = ""; return $string; }



            }elseif($typefile == "datetime"){



                if ($this->validateDate($string, "Y-m-d H:i:s")) { return $string; }else{ $string = ""; return $string; }



            }elseif($typefile == "email"){



                if (filter_var($string, FILTER_SANITIZE_EMAIL) === false) {



                    $string = "";



                    return $string;



                }else{



                    return $string;



                }



            }elseif($typefile == "url"){



                if (filter_var($string, FILTER_VALIDATE_URL) === false) {



                    $string = "";



                    return $string;



                }else{



                    return $string;



                }



            }



        } catch (Exception $e) {



            $string = "Error al parsear el string;";



        }



    }



    function validateDate($date, $format = 'Y-m-d H:i:s'){



        $d = DateTime::createFromFormat($format, $date);



        return $d && $d->format($format) == $date;



    }



    function filtrado($texto, $reemplazo = "") {



        $f =  array(    //evita email injection



                        "/Content-Type:/","/MIME-Version:/", "/Content-Transfer-Encoding:/","/Return-path:/","/Subject:/","/From:/","/Envelope-to:/","/To:/","/bcc:/","/cc:/",



                        // evita sql injection



                        "/UNION/", "/DELETE/","/DROP/","/SELECT/","/INSERT/","/UPDATE/","/CRERATE/","/TRUNCATE/","/ALTER/","/INTO/","/DISTINCT/","/GROUP BY/","/WHERE/","/RENAME/","/DEFINE/","/UNDEFINE/","/PROMPT/","/ACCEPT/","/VIEW/","/COUNT/","/HAVING/"



                    );



        $reemplazo = preg_replace($f, $reemplazo, $texto);



        return $reemplazo;



    }



/*FIN FUNCIONES DE PARSEO*/



	  	//funcion para filtrar caracteres especiales para el motor de busquedas



	function Reemplazo ($temp) {



		$b=array('Á','á','É','é','Í','í','Ó','ó','Ñ','ñ','Ú','ú','ü','Ü');



		$c=array("&Aacute;","&aacute;","&Eacute;","&eacute;","&Iacute;","&iacute;","&Oacute;","&oacute;","&Ntilde;","&ntilde;","&Uacute;","&uacute;","&uuml;","&Uuml;");



		$temp=str_replace($b,$c,$temp);



		return $temp;



	}



	//Funcion para armar un select a partir de un contenido obtenido desde la base de datos



	function MakeSelect($id, $value, $optionname, $action, $style, $tbl_name, $constrain, $sortby){



		$str = 'SELECT * FROM $tbl_name '.$constrain.$sortby;



		global $con;



		$query = $con->Query($str);



		echo '<select id="'.$id.'" $style name="'.$id.'" $action>';



		echo 	'<option value="">{Seleccione Una Opcion}</option>';



		while($row = $con->FetchAssoc($query)){



			echo '<option value="'.$row[$value].'">'.utf8_encode($row[$optionname]).'</option>';



		}



		echo '</select>';



	}



	//Funciones para armar un select a partir de un contenido obtenido desde la base de datos pero con restrinciones...



	function MakeSelectNL($id, $value, $optionname, $action, $style, $tbl_name, $constrain, $sortby, $ppram){



		$str = 'SELECT * FROM $tbl_name '.$constrain.$sortby;



		global $con;



		$query = $con->Query($str);



		echo '<select id="'.$id.'" $style name="'.$id.'" $action>';



		if(trim(empty($ppram)))



			echo 	'<option value="">Sin Especificar</option>';



		else



			echo 	'<option value="'.utf8_encode($ppram).'">'.utf8_encode($ppram).'</option>';



		while($row = $con->FetchAssoc($query)){



			echo 	'<option value="'.utf8_encode($row[$value]).'">'.utf8_encode($row[$optionname]).'</option>';



		}



		echo '</select>';



	}



	function GetListadoProcesos($id, $usuario){



		global $con;



		$q_str_folder= "select * from folder_demanda where user_id = '".$usuario."' AND folder_id ='".$id."'";



		$query_folder = $con->Query($q_str_folder);



		echo "<option value='*'>Mostrar Toda la Carpeta</option>";



		for ($i=0;$i<$con->NumRows($query_folder);$i++){



			// BUSCO EN LA BD LA DEMANDA POR EL CAMPO DE TIPO DE DEMANDA /////////



			$q_str = "SELECT * FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $i, 'proceso_id')."' AND user_id = '".$usuario."'";



			$query = $con->Query($q_str);



			if($con->Result($query, 0, "est_proceso") == "ACTIVO"){



				echo "<option value='".$con->Result($query, 0, 'id')."'>".$con->Result($query, 0, 'tit_demanda')."</option>";



			}



		}



	}



	function GetListadoCarpetas($usuario){



		global $con;



		if ($_SESSION['folder'] == '') {



			echo "<option value='*'>Todas las Carpetas</option>";



			echo '	<optgroup label="Carpetas con Demandante Natural">';



			          $sql = "SELECT * FROM folder inner join folder_demandante_proceso on folder_demandante_proceso.id_folder = folder.id



			                  WHERE folder.user_id = '".$usuario."' and folder.estado = '1' ORDER BY folder.nom";



			          $query_sql = $con->Query($sql);



			            for($i=0;$i<$con->NumRows($query_sql);$i++){



			              echo "<option value='".$con->Result($query_sql, $i, 'id')."'>".ucfirst(strtolower($con->Result($query_sql, $i, 'nom')))."</option>";



			            }



			echo '  </optgroup>



			 		<optgroup label="Carpetas con Demandante Juridico">';



			          $sql = "SELECT * FROM folder inner join folder_demandante_proceso_juridico on folder_demandante_proceso_juridico.id_folder = folder.id



			                  WHERE folder.user_id = '".$usuario."' and folder.estado = '1' ORDER BY folder.nom";



			          $query_sql = $con->Query($sql);



			            for($i=0;$i<$con->NumRows($query_sql);$i++){



			              echo "<option value='".$con->Result($query_sql, $i, 'id')."'>".ucfirst(strtolower($con->Result($query_sql, $i, 'nom')))."</option>";



			            }



			echo ' 	</optgroup>  ';



		}else{



          $sql = "SELECT * FROM folder inner join folder_demandante_proceso on folder_demandante_proceso.id_folder = folder.id



                  WHERE folder.id = '".$_SESSION['folder']."' and folder.estado = '1' ORDER BY folder.nom";



          $query_sql = $con->Query($sql);



            for($i=0;$i<$con->NumRows($query_sql);$i++){



              echo "<option value='".$con->Result($query_sql, $i, 'id')."'>".ucfirst(strtolower($con->Result($query_sql, $i, 'nom')))."</option>";



            }



          $sql = "SELECT * FROM folder inner join folder_demandante_proceso_juridico on folder_demandante_proceso_juridico.id_folder = folder.id



                  WHERE folder.id = '".$_SESSION['folder']."' and folder.estado = '1' ORDER BY folder.nom";



          $query_sql = $con->Query($sql);



            for($i=0;$i<$con->NumRows($query_sql);$i++){



              echo "<option value='".$con->Result($query_sql, $i, 'id')."'>".ucfirst(strtolower($con->Result($query_sql, $i, 'nom')))."</option>";



            }



		}



	}



	function GetLogs(){



		global $con;



		$qstr = "select * from log";



		$query = $con->Query($qstr);



		return $query;



	}



	function GetIdLog($ff){



		global $con;



		$qstr = "select * from log where fecha='".$ff."'";



		$query = $con->Query($qstr);



		if ($con->Result($query, 0, "id") == "") {



			$qstr2 = "select * from log where fecha='".date("Y-m-d")."'";



			$query2 = $con->Query($qstr2);



			$hoyid = $con->Result($query2, 0, "id");



			$dif = $this->Diferencia($ff, date("Y-m-d"));



			$id = $hoyid+$dif;



		}else{



			$id = $con->Result($query, 0, "id");



		}



		return $id;



	}



	function GetFechaLogD($ff){



		global $con;



		$qstr = "select * from log where id='".$ff."'";



		$query = $con->Query($qstr);



		return $con->Result($query, 0, "fecha");



	}



	function GetFechaLogById($id){



		global $con;



		$qstr = "select * from log where id='$id'";



		$query = $con->Query($qstr);



		return $con->Result($query, 0, "fecha");



	}



	function consultarlog(){



		global $con;



	    $query = "select max(id) as max from log";



	    $response = $con->Query($query);



		$row = $con->FetchAssoc($response);



	    $valor = $row['max'];



	    return $valor;



	}



	function GetFechaLog(){



		global $con;



		$log = $this->consultarlog();



		$qstr = "select date(fecha) as d from log where id='".$log."'";



		$query = $con->Query($qstr);



		return $con->Result($query, 0, "d");



	}



	function Diferencia ($f1, $f2){



		$date1=$f1;



		$date2=$f2;



		$s = strtotime($date1)-strtotime($date2); ///para mi caso, simplemente $s = strtotime($periodo_ep_2)-strtotime($periodo_ep_1);



		$d = intval($s/86400);



		$s -= $d*86400;



		$h = intval($s/3600);



		$s -= $h*3600;



		$m = intval($s/60);



		$s -= $m*60;



		$dif= (($d*24)+$h).hrs." ".$m."min";



		$dif2= $d;



		return $dif2;



	}



	function crearLog(){



		global $con;



		$qr = "INSERT INTO log (fecha) VALUES ('".date('Y-m-d')."')";



		$query = $con->Query($qr,'insert');



		if($query){



			return "success";



		}else{



			return "Error";



		}



	}



	function CalcularFecha($fecha, $dias, $type){



		$fecha_c = date_create($fecha);



		date_modify($fecha_c, "$type$dias day");



		$fecha_c = date_format($fecha_c, "Y-m-d");



		return $fecha_c;



	}



	function InsertarAlerta($usuario, $type, $extra, $id_act = "", $id_gestion = ""){



		global $con;



		$alog = $this->consultarlog();



		$q_str = "insert into alertas (fechahora, user_id, type, log, status, extra, id_act, id_gestion) values('".date("Y-m-d H:i:s")."', '$usuario','$type','$alog', '0', '$extra', '$id_act', '$id_gestion')";



	//	echo $q_str;



		$query = $con->Query($q_str);



		if($query){



			return true;



		}



		else{



			return false;



		}



	}



	function Insert_Event($id,$title,$description,$status,$echo,$color = "0", $usuario=''){



		global $con;



		global $f;







		if ($_SESSION[usuario] == $usuario || $usuario == "") {



			$usuario = $_SESSION[usuario];



		}



		$this->crearLog();



		$date=$this->consultarlog();



		$time=date('H:i:s');



		$con->Query("INSERT INTO events (user_id,proceso_id,title,description,date,added,status,time,echo, deadline)



					values ('$usuario','$id','$title','$description','$date','$date','$status','$time','$echo','$color')");



		$st = $con->FetchAssoc($con->Query("select notif_usuario from usuarios where user_id  = '".$_SESSION['usuario']."'"));



		$stx = $con->FetchAssoc($con->Query("select tit_demanda from caratula where id  = '".$id."'"));



		if ($st['notif_usuario'] == '1') {







				$MPlantillas_email = new MPlantillas_email;



				$MPlantillas_email->CreatePlantillas_email('id', '2');



				$contenido_email = $MPlantillas_email->GetContenido();



				$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,     $contenido_email );



				$contenido_email = str_replace("[elemento]ASUNTO[/elemento]", $title,     	   $contenido_email );



				$contenido_email = str_replace("[elemento]Estado[/elemento]",      $stx['tit_demanda'],   $contenido_email );



				$contenido_email = str_replace("[elemento]observacion[/elemento]",      $description,   $contenido_email );



				$contenido_email = str_replace("[elemento]Fecha_registro[/elemento]",      date("d-m-Y h:i:s a"),   $contenido_email );
				$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );






				$this->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Actualizacion en el proceso ".$stx['tit_demanda'],$contenido_email,$nst['id_super_admin']);



		}



		$nst = $con->FetchAssoc($con->Query("select id_super_admin from arbol_super_admin where id_usuario  = '".$_SESSION['usuario']."'"));



		if ($nst['id_super_admin'] != "") {



			$nstx = $con->FetchAssoc($con->Query("select notif_admin from usuarios where user_id  = '".$nst['id_super_admin']."'"));



			if($nstx['notif_admin'] == "1"){







				$MPlantillas_email = new MPlantillas_email;



				$MPlantillas_email->CreatePlantillas_email('id', '2');



				$contenido_email = $MPlantillas_email->GetContenido();



				$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,     $contenido_email );



				$contenido_email = str_replace("[elemento]ASUNTO[/elemento]", $title,     	   $contenido_email );



				$contenido_email = str_replace("[elemento]Estado[/elemento]",      $stx['tit_demanda'],   $contenido_email );



				$contenido_email = str_replace("[elemento]observacion[/elemento]",      $description,   $contenido_email );



				$contenido_email = str_replace("[elemento]Fecha_registro[/elemento]",      date("d-m-Y h:i:s a"),   $contenido_email );
				$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );






				$this->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"Actualizacion en el proceso ".$stx['tit_demanda'],$contenido_email,$nst['id_super_admin']);



			}



		}



	}



	function GetNewMailsNumber(){



		global $con;



		$str = "select count(*) as t



					from mailer_message



						INNER JOIN mailer_replys on mailer_message.message_id = mailer_replys.message_id



							INNER JOIN mailer_from_message ON mailer_from_message.token_ID = mailer_replys.receiver_token



								WHERE 	mailer_message.user_ID = '".$_SESSION['usuario']."' and



										( mailer_replys.message_status = '1' or mailer_replys.message_status = '2' ) and



										mailer_replys.readed = '0'";



		$q = $con->Query($str);



		$row = $con->FetchAssoc($q);



		$strf = "select count(*) as t



					from mailer_message



						INNER JOIN mailer_replys on mailer_message.message_id  = mailer_replys.message_id



							INNER JOIN mailer_from_message ON mailer_from_message.token_ID = mailer_replys.receiver_token



								WHERE 	mailer_from_message.email = '".$_SESSION['usuario']."' and mailer_replys.message_status = '0'";



		$qf = $con->Query($strf);



		$rowf = $con->FetchAssoc($qf);



	    #return $row["t"]+$rowf["t"];



	    return $row["t"];



	}



	function RestartNotification($usuario, $type, $log){



		global $con;



		$con->Query("update alertas set status= 0 where user_id = '".$usuario."' and type = '".$type."' and log = '".$log."'");



	}



	function GetFutureAppointmets(){



		global $con;



		$alog = date("Y-m-d");



		$usuario = $_SESSION["usuario"];



		$str = "select * from events where date > '".$alog."' and user_id = '".$usuario."' and echo = '0'";



		$query = $con->Query($str);



		while($row = $con->FetchAssoc($query)){



			$dayevent = $row["date"];



			$eid = $row["id"];



			$aviso = $row["avisar_a"];



			$rs = $dayevent - $aviso;



			$check = $rs - $alog;



			$hoy = date("Y-m-d");



			$m5 = $this->CalcularFecha($hoy, $check, "");



			// el dia



			if($check == 0){



				$this->CheckNewNotification($usuario, "10", $alog, $eid);



			// dias menos



			}elseif($check  < 0){



				$this->CheckNewNotification($usuario, "11", $alog, $eid);



			}



		}



	}



	function CheckNewNotification($usuario, $type, $log, $extra){



		global $con;



		$verify = $con->Query("select count(*) as t from alertas where user_id = '$usuario' and type = '$type' and log = '$log' and extra = '$extra'");



		$t = $con->Result($verify, 0, "t");



		if($t <= 0){



			$q_str = "insert into alertas (fechahora, user_id, type, log, status, extra) values('".date("Y-m-d H:i:s")."', '$usuario','$type','$log', '0', '$extra')";



			$query = $con->Query($q_str);



		}



	//	return $usuario;



	}



	function CheckFailedMails(){



		global $con;



		$alog = $this->consultarlog();



		$usuario = $_SESSION["usuario"];



		$str = "select * from mailer_message where exp_day < '".$alog."' and user_id = '".$usuario."' and descarted = '0'";



		$query = $con->Query($str);



		while($row = $con->FetchAssoc($query)){



			$dayevent = $row["date"];



			$eid = $row["id"];



			$aviso = $row["avisar_a"];



			$rs = $dayevent - $aviso;



			$check = $rs - $alog;



			$hoy = date("Y-m-d");



			$m5 = $this->CalcularFecha($hoy, $check, "");



			// el dia



			if($check == 0){



				$this->CheckNewNotification($usuario, "16", $alog, $eid);



			// dias menos



			}



		}



	}



	function SendNewNotification($usuario, $type, $log){



		global $con;



		$verify = $con->Query("select count(*) as t from alertas where user_id = '$usuario' and type = '$type' and log = '$log' and status = '0'");



		$t = $con->Result($verify, 0, "t");



		if($t <= 0){



			$q_str = "insert into alertas (fechahora, user_id, type, log, status) values('".date("Y-m-d H:i:s")."', '$usuario','$type','$log', '0')";



			$query = $con->Query($q_str);



		}



	}



	function UnviewAppointmets(){



		global $con;



		$log = $this->consultarlog();



		$verify = $con->Query("select count(*) as t from events where user_id = '".$_SESSION["usuario"]."' and alerted = '0' and date between -999 and $log");



		$t = $con->Result($verify, 0, "t");



		if($t <= 0){



			return false;



		}else{



			return true;



		}



	}



	function GetAppointmets(){



		global $con;



		$alog = $this->consultarlog();



		$x = $this->UnviewAppointmets();



		if($x){



			$this->SendNewNotification($_SESSION["usuario"], '6', $alog);



			$con->Query("update events set alerted = '1' where user_id = '".$_SESSION["usuario"]."' and date between -999 and $alog");



		}



	}



	function parseBBCodex( $text ){



	    $path = "/\[citaelemento:(.*?)\](.*?)\[\/citaelemento\]/is";



		$text = preg_replace($path, "<a href=\"http://editorajuridicanacional.com/elementos/leerarticulo/$1/\" target=\"_blank\" class=\"link\">$2</a>", $text);



		return $text;



	}



	function SetSession(){



		global $con;



		$con->Query("INSERT INTO auditoria_rastreo_ip (ip, fecha, browser, city, hour) VALUES('".$_SERVER['REMOTE_ADDR']."','".date("Y-m-d")."', '".$_SERVER['HTTP_USER_AGENT']."', ' ','".date("G:i:s")."')");



	}



	function GetSession(){



		global $con;



		return $con->Result($con->Query("select count(*) as t from auditoria_rastreo_ip"), 0, 't');



	}



	function GetExpedientesCompartidos(){



		global $con;


		$minfilt = "";
		if ($_SESSION['filtro_estado'] != "Todos") {
			$minfilt .= " AND estado_respuesta = '".$_SESSION['filtro_estado']."'";
		}
		if ($_SESSION['filtro_prioridad'] != "Todos") {
			$minfilt .= " AND prioridad = '".$_SESSION['filtro_prioridad']."'";
		}
		$pathfiltro = " AND f_recibido between '".$_SESSION['filtro_fi']."' and '".$_SESSION['filtro_ff']."' $minfilt";




		return $con->Result($con->Query("select count(*) as t from gestion_compartir inner join gestion on gestion.id = gestion_compartir.gestion_id where usuario_nuevo = '".$_SESSION['usuario']."' and gestion.estado_archivo = '".$_SESSION['typefolder']."' $pathfiltro"), 0, 't');



	}



	function GetTotalExpedientesSinAsignar(){



		global $con;

		$minfilt = "";
		if ($_SESSION['filtro_estado'] != "Todos") {
			$minfilt .= " AND estado_respuesta = '".$_SESSION['filtro_estado']."'";
		}
		if ($_SESSION['filtro_prioridad'] != "Todos") {
			$minfilt .= " AND prioridad = '".$_SESSION['filtro_prioridad']."'";
		}
		$pathfiltro = " AND f_recibido between '".$_SESSION['filtro_fi']."' and '".$_SESSION['filtro_ff']."' $minfilt";




		return $con->Result($con->Query("select count(*) as t from gestion where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and estado_archivo = '".$_SESSION['typefolder']."' $pathfiltro "), 0, 't');



	}



	function GetDataFromTable($table, $field, $id, $fields, $separador = " "){



		global $con;



		$query = $con->Query("Select $fields from $table where $field = '$id'");



		$row = $con->FetchAssoc($query);



		$path = "";



		$ar = explode(",", $fields);



		for ($i=0; $i < count($ar) ; $i++) {



			$sep = $separador;



			if ($i == count($ar)-1) {



				$sep = "";



			}



			$path .= $row[trim($ar[$i])].$sep;



		}



		return $path;



	}



	function GetCantidadExpedientes($user_id, $fi, $ff, $pathsearch = ""){



		global $con;



		$path = "";



		$query = $con->Query("Select count(*) as t from gestion where nombre_destino = '$user_id' and f_recibido between '$fi' and '$ff' $pathsearch");



		$path .= "Exp. en Filtro: ".$con->Result($query, 0, 't');



		$query = $con->Query("Select count(*) as t from gestion where nombre_destino = '$user_id' $pathsearch");



		$path .= " / Totales:".$con->Result($query, 0, 't');



		return $path;



	}



	function GetArbolDocumentos($id_gestion, $parent, $prefijo){



		global $con;



		$sql = "select id, nombre from gestion_folder where gestion_id = '".$id_gestion."' and folder_id = '".$parent."' and estado = '1'";



		$rs = $con->Query($sql);



		if($rs){



			while($arr = $con->FetchAssoc($rs)){



				echo "<tr>";



				echo 	"<td colspan='3' class='th_act' style='text-align:left'></td>";



				echo 	"<td colspan='9' class='th_act' style='text-align:left'>".$arr['nombre']."</td>";



				echo "</tr>";



				$v = $con->Query("select * from gestion_anexos where gestion_id = '".$id_gestion."' and  folder_id = '".$arr[id]."'  and (estado = '1' or estado = '3')  order by orden");



				$i = 0;



				$last = $con->NumRows($v);



				while ($row = $con->FetchAssoc($v)) {



					$i++;



					if ($row['tipologia'] != "") {



						$tipologia = $con->Result($con->Query("select tipologia from dependencias_tipologias where id = '".$row['tipologia']."'"), 0, 'tipologia');



					}else{



						$tipologia = "";



					}



					$orden = $row['orden'];



					if ($orden == '0') {



						$orden = $i;



					}



					$next = $orden+1;



					$prev = $orden-1;



					echo "<tr class='tblresult'>";



						echo "



								<td width='15px;' style='border-right:1px solid #CCC' align='center'><b>".$orden."</b></td>";



						if ($i != $last) {



							echo "	<td width='16px' style='border-right:1px solid #CCC'><img style='cursor:pointer;' id='mybtnorden".$row['id']."' onClick='UpdateOrden(\"".$row['id']."\", \"".$next."\", \"0\", \"0\" )' src='".ASSETS."/images/arrow_down.png' width='16px' title='Bajar una posición'></td>";



						}else{



							echo "<td width='16px' style='border-right:1px solid #CCC'></td>";



						}



						if ($i != 1) {



							echo "<td width='16px' style='border-right:1px solid #CCC'>	<img style='cursor:pointer;' id='mybtnorden".$row['id']."' onClick='UpdateOrden(\"".$row['id']."\", \"".$prev."\", \"1\", \"0\" )' src='".ASSETS."/images/arrow_up.png' width='16px' title='Subir una posición'></td>";



						}else{



							echo "<td width='16px' style='border-right:1px solid #CCC'></td>";



						}



						$x = @stat (ROOT.DS."archivos_uploads/gestion/".$id_gestion.trim("/anexos/ ").$row['url']);



						$size = round($x["size"] / 1024, 2)." Kb (".$x["size"]." Bytes)";



						echo "	<td style='border-right:1px solid #CCC' ></td>";



						echo "	<td style='border-right:1px solid #CCC' >$row[nombre]</td>";



						echo "	<td style='border-right:1px solid #CCC' >$tipologia</td>";



						echo "	<td style='border-right:1px solid #CCC' >$row[fecha]</td>";



						echo "	<td style='border-right:1px solid #CCC' >$row[user_id]</td>";



						echo "	<td style='border-right:1px solid #CCC' >$size</td>";



						echo "	<td style='border-right:1px solid #CCC'  align='center'>



									<input type='text' class='calcval' id='calc".$row['id']."' alt='".$row['id']."' style='width:30px; text-align:center' value='$row[cantidad]'>



									<input type='hidden' class='firstone' id='first".$row['id']."' style='width:30px' placeholder='Pr'>



									<input type='hidden' class='lastone' id='last".$row['id']."' style='width:30px' placeholder='F'>



								</td>";



						echo "	<td align='center' style='border-right:1px solid #CCC' >$row[folio] - $row[folio_final]</td>";



						echo "	<td align='center'><img style='cursor:pointer; display:none' class='mybtn' id='mybtn".$row['id']."' onClick='UpdateFolio(\"".$row['id']."\")' src='".ASSETS."/images/gckeck.png' width='20px'></td>";



					echo "</tr>";



				}



				$this->GetArbolDocumentos($id_gestion, $arr['id'], $prefijo.$prefijo);



			}



		}



	}



	function GetArbolCarpetasSelect($id_gestion, $parent, $prefijo){



		global $con;



		$sql = "select id, nombre from gestion_folder where gestion_id = '".$id_gestion."' and folder_id = '".$parent."' and estado = '1'";



		$rs = $con->Query($sql);



		if($rs){



			while($arr = $con->FetchAssoc($rs)){



				echo "<option value='".$arr['id']."'>";



				echo 	$prefijo." ".$arr['nombre'];



				echo "</option>";



				$this->GetArbolCarpetasSelect($id_gestion, $arr['id'], $prefijo.$prefijo);



			}



		}



	}



	function GetTotalExpedientesUsuario($id, $area){

		global $con;

		$minfilt = "";
		if ($_SESSION['filtro_estado'] != "Todos") {
			$minfilt .= " AND estado_respuesta = '".$_SESSION['filtro_estado']."'";
		}
		if ($_SESSION['filtro_prioridad'] != "Todos") {
			$minfilt .= " AND prioridad = '".$_SESSION['filtro_prioridad']."'";
		}
		$pathfiltro = " AND f_recibido between '".$_SESSION['filtro_fi']."' and '".$_SESSION['filtro_ff']."' $minfilt";

		return  $con->Result($con->Query("SELECT count(*) as t FROM gestion where ciudad = '".$_SESSION['ciudad']."' and nombre_destino = '".$_SESSION['user_ai']."' and dependencia_destino = '".$area."' and oficina = '".$_SESSION['seccional']."' and version = '".$_SESSION['active_vista']."' and estado_archivo = '".$_SESSION['typefolder']."' $pathfiltro "), 0, 't');
	}

	function GetTotalExpedientesCreadosUsuario($id, $area){

		global $con;

		$minfilt = "";
		if ($_SESSION['filtro_estado'] != "Todos") {
			$minfilt .= " AND estado_respuesta = '".$_SESSION['filtro_estado']."'";
		}
		if ($_SESSION['filtro_prioridad'] != "Todos") {
			$minfilt .= " AND prioridad = '".$_SESSION['filtro_prioridad']."'";
		}
		$pathfiltro = " AND f_recibido between '".$_SESSION['filtro_fi']."' and '".$_SESSION['filtro_ff']."' $minfilt";

		#echo "SELECT count(*) as t FROM gestion where ciudad = '".$_SESSION['ciudad']."' and usuario_registra = '".$_SESSION['usuario']."' and dependencia_destino = '".$area."' and oficina = '".$_SESSION['seccional']."' and version = '".$_SESSION['active_vista']."' and estado_archivo = '".$_SESSION['typefolder']."' $pathfiltro ";
		return  $con->Result($con->Query("SELECT count(*) as t FROM gestion where usuario_registra = '".$_SESSION['usuario']."' and estado_archivo = '".$_SESSION['typefolder']."' $pathfiltro "), 0, 't');
	}



	function Getcounter($tbl_name, $constrain){



		global $con;



		$uaid = $con->Result($con->Query("select a_i from usuarios where user_id = '".$_SESSION['usuario']."'"), 0,'a_i');

		$pathfiltro == "";

		if ($tbl_name == "gestion") {
			$minfilt = "";
			if ($_SESSION['filtro_estado'] != "Todos") {
				$minfilt .= " AND estado_respuesta = '".$_SESSION['filtro_estado']."'";
			}
			if ($_SESSION['filtro_prioridad'] != "Todos") {
				$minfilt .= " AND prioridad = '".$_SESSION['filtro_prioridad']."'";
			}
			$pathfiltro = " AND f_recibido between '".$_SESSION['filtro_fi']."' and '".$_SESSION['filtro_ff']."' $minfilt";


		}

		return $con->Result($con->Query("select count(*) as t from $tbl_name where $constrain and nombre_destino = '".$uaid."' and estado_archivo = '".$_SESSION['typefolder']."' and dependencia_destino = '".$_SESSION['area_principal']."' $pathfiltro "), 0, 't');



	}

	function Getcounter_v2($tbl_name, $constrain, $idr){



		global $con;



		$uaid = $con->Result($con->Query("select a_i from usuarios where user_id = '".$_SESSION['usuario']."'"), 0,'a_i');

		$pathfiltro == "";

		if ($tbl_name == "gestion") {
			$minfilt = "";
			if ($_SESSION['filtro_estado'] != "Todos") {
				$minfilt .= " AND estado_respuesta = '".$_SESSION['filtro_estado']."'";
			}
			if ($_SESSION['filtro_prioridad'] != "Todos") {
				$minfilt .= " AND prioridad = '".$_SESSION['filtro_prioridad']."'";
			}
			$pathfiltro = " AND f_recibido between '".$_SESSION['filtro_fi']."' and '".$_SESSION['filtro_ff']."' $minfilt";


		}


# and oficina = '13' and id_dependencia_raiz = '15' and version = '1'

		return $con->Result($con->Query("select count(*) as t from $tbl_name where $constrain and ciudad = '".$_SESSION['ciudad']."' and nombre_destino = '".$uaid."' and estado_archivo = '".$_SESSION['typefolder']."' and dependencia_destino = '".$_SESSION['area_principal']."' and oficina = '".$_SESSION['seccional']."' and id_dependencia_raiz = '".$idr."' and version = '".$_SESSION['active_vista']."'  $pathfiltro "), 0, 't');



	}



	function GetNocounter($tbl_name, $constrain){



		global $con;



		return $con->Result($con->Query("select count(*) as t from $tbl_name where $constrain and gestion.dependencia_destino != '".$_SESSION['area_principal']."' and usuario_registra = '".$_SESSION['usuario']."' and oficina = '".$_SESSION['seccional']."'"), 0, 't');



	}


	function GetNocounterAreas($tbl_name, $constrain, $area){



		global $con;




#		echo "select count(*) as t from $tbl_name where $constrain and gestion.dependencia_destino = '".$area."' and usuario_registra = '".$_SESSION['usuario']."' and oficina = '".$_SESSION['seccional']."'";
		return $con->Result($con->Query("select count(*) as t from $tbl_name where $constrain and gestion.dependencia_destino = '".$area."' and (usuario_registra = '".$_SESSION['usuario']."' or nombre_destino = '".$_SESSION['user_ai']."') and oficina = '".$_SESSION['seccional']."'"), 0, 't');





	}



	function GetAnexosGesetionElectronico($id_gestion, $parent, $prefijo){

		global $con;
		$sql = "select id, nombre from gestion_folder where gestion_id = '".$id_gestion."' and folder_id = '".$parent."' and estado = '1'";
		$rs = $con->Query($sql);
		$viewer =   array(".doc" => "google"     , "docx" => "google"     , ".zip" => "google"     , ".rar" => "google"    ,
                          ".tar" => "google"     , ".xls" => "google"     , "xlsx" => "google"     , ".ppt" => "google"    ,
                          ".pps" => "google"     , "pptx" => "google"     , "ppsx" => "google"     , ".pdf" => "google"    ,
                          ".txt" => "google"     , ".jpg" => "image"      , "jpeg" => "image"      , ".bmp" => "image"     ,
                          ".gif" => "image"      , ".png" => "image"      , ".dib" => "image"      , ".tif" => "image"     ,
                          "tiff" => "image"      , "mpeg" => "video"      , ".avi" => "video"      , ".mp4" => "video"     ,
                          "midi" => "audio"      , ".acc" => "audio"      , ".wma" => "audio"      , ".ogg" => "audio"     ,
                          ".mp3" => "audio"      , ".flv" => "video"      , ".wmv" => "video"	   , ".csv" => "google"    ,
                          ".DOC" => "google"   	 , "DOCX" => "google"     , ".ZIP" => "google"      , ".RAR" => "google"   ,
                          ".TAR" => "google"   	 , ".XLS" => "google"     , "XLSX" => "google"      , ".PPT" => "google"   ,
                          ".PPS" => "google"   	 , "PPTX" => "google"     , "PPSX" => "google"      , ".PDF" => "google"   ,
                          ".TXT" => "google"   	 , ".JPG" => "image"      , "JPEG" => "image"       , ".BMP" => "image"    ,
                          ".GIF" => "image"    	 , ".PNG" => "image"      , ".DIV" => "image"       , ".TIF" => "image"    ,
                          "TIFF" => "image"    	 , "MPEG" => "video"      , ".AVI" => "video"       , ".MP4" => "video"    ,
                          "MIDI" => "audio"    	 , ".ACC" => "audio"      , ".WMA" => "audio"       , ".OGG" => "audio"    ,
                          ".MP3" => "audio"    	 , ".FLV" => "video"      , ".WMV" => "video"		, ".CSV" => "google");

		$iconfile = array("doc" => "mdi-file-word text-info" , "docx" => "mdi-file-word text-info" , "zip" => "mdi-zip-box text-info" , "rar" => "mdi-zip-box text-info" , "tar" => "mdi-zip-box text-info" , "xls" => "mdi-file-excel text-success" , "xlsx" => "mdi-file-excel text-success" , "ppt" => "mdi-file-powerpoint text-danger" , "pps" => "mdi-file-powerpoint text-danger" , "pptx" => "mdi-file-powerpoint text-danger" , "ppsx" => "mdi-file-powerpoint text-danger" , "pdf" => "mdi-file-pdf text-danger" , "txt" => "mdi-file-document text-muted" , "jpg" => "mdi-file-image text-success"  , "jpeg" => "mdi-file-image text-success"  , "bmp" => "mdi-file-image text-success"  , "gif" => "mdi-file-image text-success"  , "png" => "mdi-file-image text-success"  , "dib" => "mdi-file-image text-success"  , "tif" => "mdi-file-image text-success"  , "tiff" => "mdi-file-image text-success"  , "mpeg" => "mdi-file-video text-warning"  , "avi" => "mdi-file-video text-warning"  , "mp4" => "mdi-file-video text-warning"  , "midi" => "mdi-audiobook mdi-warning"  , "acc" => "mdi-audiobook mdi-warning"  , "wma" => "mdi-audiobook mdi-warning"  , "ogg" => "mdi-audiobook mdi-warning"  , "mp3" => "mdi-audiobook mdi-warning" , "flv" => "mdi-file-video text-warning"  , "wmv" => "mdi-file-video text-warning"  , "csv" => "mdi-file-excel text-success" , "" => "mdi-file-find text-warning" );
		
		if($rs){
			while($arr = $con->FetchAssoc($rs)){

				echo 	"<div class='list-group-item'><span class='mdi mdi-folder text-warning'></span> ".$arr['nombre']."<div class='list-group'>";

				$v = $con->Query("select * from gestion_anexos where gestion_id = '".$id_gestion."' and  folder_id = '".$arr[id]."'  and (estado = '1' or estado = '3')  order by orden");
				$i = 0;
				$last = $con->NumRows($v);
				while ($col = $con->FetchAssoc($v)) {
					$type=explode('.', strtolower($col[url]));
	                $type=array_pop($type);
	                $file = $col["url"];
	                if ($file != "") {
		                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";
		                $cadena_nombre = substr($file,0,200);
		                $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));
						$bad = (strlen($col[nombre]) > 40)?"...":"";
					 	$nombredoc = substr($col[nombre], 0, 40).$bad;

					 	if ($retorno == "SID") {
							$retorno = $col["id"];
						}else{
							$retorno = $ruta;
						}
						$retorno = $col["id"];


					 	echo "  
							<div class='list-group-item' id='$col[id]'>
								<div class='row'>
									<div class='col-md-12 waves-effect'>
										".'
										<input type="checkbox" name="servicio[]" id="a'.$col['id'].'" value="'.$retorno.'" class="active_check" onclick="ActiveCheck(\'a'.$col['id'].'\')" title="'.$titulo.'" style="float:left; margin-right:5px; margin-top:15px" />'."
										<div class='material-icon-list-demo' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>
											<div class='icons'>
												<div>
								                    <i class='mdi ".$iconfile[$type]."'></i><span style='font-size:11px; cursor:pointer'> $nombredoc</span>
												</div>
											</div>
										</div>
									</div>
					   			</div>
					   		</div>";

	                }
				}
				echo "</ul></li>";
				$this->GetAnexosGesetionElectronico($id_gestion, $arr['id'], $prefijo.$prefijo);
			}
		}
	}

	function GetAnexosGesetionAdministar($id_gestion, $parent, $prefijo){

		global $con;
		$sql = "select id, nombre from gestion_folder where gestion_id = '".$id_gestion."' and folder_id = '".$parent."' and estado = '1'";
		$rs = $con->Query($sql);


		$ge = new MGestion;
		$ge->CreateGestion("id", $id_gestion);

		$dep = new MDependencias;
		$dep->CreateDependencias("id", $ge->GetTipo_documento());


		$iconfile = array("doc" => "mdi-file-word text-info" , "docx" => "mdi-file-word text-info" , "zip" => "mdi-zip-box text-info" , "rar" => "mdi-zip-box text-info" , "tar" => "mdi-zip-box text-info" , "xls" => "mdi-file-excel text-success" , "xlsx" => "mdi-file-excel text-success" , "ppt" => "mdi-file-powerpoint text-danger" , "pps" => "mdi-file-powerpoint text-danger" , "pptx" => "mdi-file-powerpoint text-danger" , "ppsx" => "mdi-file-powerpoint text-danger" , "pdf" => "mdi-file-pdf text-danger" , "txt" => "mdi-file-document text-muted" , "jpg" => "mdi-file-image text-success"  , "jpeg" => "mdi-file-image text-success"  , "bmp" => "mdi-file-image text-success"  , "gif" => "mdi-file-image text-success"  , "png" => "mdi-file-image text-success"  , "dib" => "mdi-file-image text-success"  , "tif" => "mdi-file-image text-success"  , "tiff" => "mdi-file-image text-success"  , "mpeg" => "mdi-file-video text-warning"  , "avi" => "mdi-file-video text-warning"  , "mp4" => "mdi-file-video text-warning"  , "midi" => "mdi-audiobook mdi-warning"  , "acc" => "mdi-audiobook mdi-warning"  , "wma" => "mdi-audiobook mdi-warning"  , "ogg" => "mdi-audiobook mdi-warning"  , "mp3" => "mdi-audiobook mdi-warning" , "flv" => "mdi-file-video text-warning"  , "wmv" => "mdi-file-video text-warning"  , "csv" => "mdi-file-excel text-success" , "" => "mdi-file-find text-warning" );
		
		if($rs){
			while($arr = $con->FetchAssoc($rs)){
				echo '	<tr>
							<td colspan="5">'."<span class='mdi mdi-folder text-warning'></span> ".$arr['nombre'].'</td>
						</tr>';

				$v = $con->Query("select * from gestion_anexos where gestion_id = '".$id_gestion."' and  folder_id = '".$arr[id]."' order by ".ORDENARDOCUMENTOSBY);
				$i = 0;
				$last = $con->NumRows($v);


				while ($col = $con->FetchAssoc($v)) {
					$type=explode('.', strtolower($col[url]));
	                $type=array_pop($type);
	                $file = $col["url"];
	                if ($file != "") {
		                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";
		                $cadena_nombre = substr($file,0,200);
		                $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));
						$bad = (strlen($col[nombre]) > 40)?"...":"";
					 	$nombredoc = $col[nombre]; //substr($col[nombre], 0, 40).$bad;

					 	if ($retorno == "SID") {
							$retorno = $col["id"];
						}else{
							$retorno = $ruta;
						}
						$retorno = $col["id"];

						$optiona = '<select class="form-control" id="changetypedoc'.$col['id'].'" onChange="changetypedoc(\''.$col['id'].'\', \''.$ge->GetId().'\', this.value)">';
						$optiona .= "<option value=''>Seleccione una Tipología</option>";
		
						$tipo = new MDependencias_tipologias;
						$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$dep->GetId()."'");
						while ($rl = $con->FetchAssoc($listado)) {
							$sel = ($col['tipologia'] == $rl['id'])?"selected='selected'":"";
							$optiona .= "<option value='".$rl['id']."' $sel>".$rl['tipologia']."</option>";	
						}
						$optiona .= "</select>";

						$estado = ($col['estado'] == "1")?"Activo":"Eliminado";
						$selecpublicsi = ($col['is_publico'] == "0")?"selected = 'selected'":"";
						$selecpublicno = ($col['is_publico'] == "1")?"selected = 'selected'":"";

						echo '	<tr>
									<td>'."<i class='mdi ".$iconfile[$type]."'></i><span style='font-size:11px;'> $nombredoc</span>".'</td>
									<td>'.$estado.'</td>
									<td>'.$optiona.'</td>';
						echo '		<td>
										<select class="form-control" onChange=" changePublic(\''.$col['id'].'\', this.value)">';
								echo  "		<option value='0' $selecpublicsi>Privado</option>";	
								echo  "		<option value='1' $selecpublicno>Publico</option>";	
						echo "			</select>
									</td>";			
						echo 	'	<td>
									<textarea  class="form-control" id="obsx'.$col['id'].'" onblur="changeObservacionDocumento(\''.$col['id'].'\')">'.$col['observacion'].'</textarea>';
						echo		'</td>
								</tr>';
	                }
				}
				$this->GetAnexosGesetionAdministar($id_gestion, $arr['id'], $prefijo.$prefijo);
			}
		}
	}



	function GetAnexosFisico($id_gestion, $parent, $prefijo){



		global $con;



		$sql = "select id, nombre from gestion_folder where gestion_id = '".$id_gestion."' and folder_id = '".$parent."' and estado = '1'";



		$rs = $con->Query($sql);



		$viewer =   array(".doc" => "google"     , "docx" => "google"     , ".zip" => "google"     , ".rar" => "google"    ,



                          ".tar" => "google"     , ".xls" => "google"     , "xlsx" => "google"     , ".ppt" => "google"    ,



                          ".pps" => "google"     , "pptx" => "google"     , "ppsx" => "google"     , ".pdf" => "google"    ,



                          ".txt" => "google"     , ".jpg" => "image"      , "jpeg" => "image"      , ".bmp" => "image"     ,



                          ".gif" => "image"      , ".png" => "image"      , ".dib" => "image"      , ".tif" => "image"     ,



                          "tiff" => "image"      , "mpeg" => "video"      , ".avi" => "video"      , ".mp4" => "video"     ,



                          "midi" => "audio"      , ".acc" => "audio"      , ".wma" => "audio"      , ".ogg" => "audio"     ,



                          ".mp3" => "audio"      , ".flv" => "video"      , ".wmv" => "video"	   , ".csv" => "google"    ,



                          ".DOC" => "google"   	 , "DOCX" => "google"     , ".ZIP" => "google"      , ".RAR" => "google"   ,



                          ".TAR" => "google"   	 , ".XLS" => "google"     , "XLSX" => "google"      , ".PPT" => "google"   ,



                          ".PPS" => "google"   	 , "PPTX" => "google"     , "PPSX" => "google"      , ".PDF" => "google"   ,



                          ".TXT" => "google"   	 , ".JPG" => "image"      , "JPEG" => "image"       , ".BMP" => "image"    ,



                          ".GIF" => "image"    	 , ".PNG" => "image"      , ".DIV" => "image"       , ".TIF" => "image"    ,



                          "TIFF" => "image"    	 , "MPEG" => "video"      , ".AVI" => "video"       , ".MP4" => "video"    ,



                          "MIDI" => "audio"    	 , ".ACC" => "audio"      , ".WMA" => "audio"       , ".OGG" => "audio"    ,



                          ".MP3" => "audio"    	 , ".FLV" => "video"      , ".WMV" => "video"		, ".CSV" => "google");



		if($rs){



			while($arr = $con->FetchAssoc($rs)){



				echo "	<li class='TituloCarpeta'>".$arr['nombre']."



							<ul>";



				$v = $con->Query("select * from gestion_anexos where gestion_id = '".$id_gestion."' and  folder_id = '".$arr[id]."'  and (estado = '1' or estado = '3')  order by orden");



				$i = 0;



				$last = $con->NumRows($v);



				while ($col = $con->FetchAssoc($v)) {



					$type=explode('.', strtolower($col[url]));



	                $type=array_pop($type);



	                $file = $col["url"];



	                if ($file != "") {



		                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$id.trim("/anexos/ ").$file."";



		                $cadena_nombre = substr($file,0,200);



		                $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));



						$bad = (strlen($col[nombre]) > 40)?"...":"";



					 	$nombredoc = substr($col[nombre], 0, 40).$bad;



		                echo "  <li class='anexos-li' id='$col[id]'>



                                    <input type='checkbox' name='servicio[]' id='a".$col['id']."' value='".$col['id']."' class='album_inner_button active_check' title='".$titulo."' />



                                    <div style='padding-top:0px;' class='img-icon $type' style='width:30px' ></div>



                                    <div class='nom_anexo' title='$col[nombre]' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>$nombredoc </div>



                                </li>";



	                }



				}



				echo "		</ul>



						</li>";



				$this->GetAnexosFisico($id_gestion, $arr['id'], $prefijo.$prefijo);



			}



		}



	}



	function GetDocumentosParaFirmar(){



		global $con;



		if ($_SESSION['suscriptor_id'] == "") {



			$usuario_firma = $_SESSION['usuario'];



		}else{



			$usuario_firma = $_SESSION['suscriptor_id'];



		}



		$query = $con->Query("select count(*) as t from gestion_anexos_firmas where usuario_firma = '".$usuario_firma."' and estado_firma = '0'");



		$result = $con->Result($query, 0, 't');



		return $result;



	}



	function GetTotalFromTable($tabla, $constrain = ""){



		global $con;



		$result = $con->Result($con->Query("select count(*) as t from $tabla $constrain"), 0, 't');



		return $result;



	}



	function FirmaDigitalExterno($id, $keyf, $posf, $sqr, $surl, $archivo, $user_id, $seccional, $area_principal){



		global $con;



		global $f;



		#Array ( [m] => firmas_usuarios [action] => EnviarFirma



		/*$id = $c->sql_quote($_REQUEST['id']);



		$keyf = $c->sql_quote($_REQUEST['clave_firma']);



		$posf = $c->sql_quote($_REQUEST['posfirma']);



		$sqr = $c->sql_quote($_REQUEST['showqr']);



		$surl = $c->sql_quote($_REQUEST['showurl']);*/



		$Gestion_anexos_firmas_id = $id;



		$ganf = new MGestion_anexos_firmas;



		$ganf->CreateGestion_anexos_firmas("id", $id);



		$ga = new MGestion_anexos;



		$ga->CreateGestion_anexos("id", $ganf->GetAnexo_id());



		$user = new MUsuarios;



		$user->CreateUsuarios("user_id", $user_id);



		$sadmin = new MSuper_admin;



        $sadmin->CreateSuper_admin("id", "6");



		/*$tamano = $_FILES["archivo"]['size'];



		$tipo = $_FILES["archivo"]['type'];



		$archivo = $_FILES["archivo"]['name'];*/



		$tamano = filesize(ROOT."/plugins/firmasdigitales/".$archivo);



		$tipo = filetype(ROOT."/plugins/firmasdigitales/".$archivo);



		$archivo = $archivo;



		if ($ganf->GetCod_alt() != "") {



			return "Este documento no puede ser firmado. <br>El documento ya fue firmado anteriormente.";



			exit;



		}



		if (true == true) {



			$px = 0;



			$py = 0;



			if ($posf == "1,1") {



				$px = 0; $py = 0;



			}elseif ($posf == "1,2") {



				$px = 0; $py = 40;



			}elseif ($posf == "1,3") {



				$px = 0; $py = 60;



			}elseif ($posf == "2,1") {



				$px = 60; $py = 0;



			}elseif ($posf == "2,2") {



				$px = 60; $py = 40;



			}elseif ($posf == "2,3") {



				$px = 60; $py = 60;



			}elseif ($posf == "3,1") {



				$px = 100; $py = 0;



			}elseif ($posf == "3,2") {



				$px = 100; $py = 40;



			}elseif ($posf == "3,3") {



				$px = 100; $py = 60;



			}else{



				$px = 0; $py = 0;



			}



			### INCIO DEL PROCESO DE FIRMA ###



			$pdf = new FPDI();



		    $numero_aleatorio=time()."-".strtoupper($f->randomText(3));



		    $fillx = 23 + $px;



		    $filly = 135 + $py;



		    $fillh = "100";



		    $fillw = "35";



		    $sellox = $fillx + 5;



		    $selloy = $filly + 3;



		    $x = $fillx + 4;



		    $y = $filly + 12;



		    $h = $fillh - 10;



		    $w = $fillw - 20;



		    $x2 = $fillx + 7;



		    $y2 = $filly + 14;



		    $h2 = $fillh - 20;



		    $w2 = $fillw - 23;



		    $filename = $ga->GetUrl();



		    $linkfile = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();



		    $linkfile2 = "app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();



		    //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);



		    $path_file2 = $_SERVER["DOCUMENT_ROOT"]."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."";



		    $file = realpath($path_file2);



		    $pagecount = $pdf->setSourceFile($file);



		        for($i = 1 ; $i <= $pagecount ; $i++){



		            $tpl  = $pdf->importPage($i);



		            $size = $pdf->getTemplateSize($tpl);



		            $orientation = $size['h'] > $size['w'] ? 'P':'L';



		            $pdf->SetFont('Helvetica', 0, '10');



		            $pdf->SetTextColor(0, 0, 0);



		            $pdf->SetXY(3, 4);



		            $pdf->Write(0, 'Documento firmado con Código '.$numero_aleatorio. " El día: ".date('d-m-Y')." a las: ".date('h:i:s'));



		            #$pdf->SetFont('helvetica', '', 8);



		            #$pdf->write1DBarcode($numero_aleatorio, 'C93', 170, 2, 40, 10, 0.4, array('border'=>true,'text'=>true,'stretchtext'=>0,'fitwidth'=>true), 'N');



					if ($sqr == "1") {



						$pdf->Image('http://chart.googleapis.com/chart?chs=50x50&cht=qr&chl='.$linkfile,189,2,25,25);



					}



					if ($surl == "1") {



					    $pdf->SetXY(3,254);



					    $pdf->Cell(0, 0, "Puede verificar la autenticidad de este documento en: ".HOMEDIR.DS."sort/".$numero_aleatorio);



					}



		            $pdf->AddPage($orientation);



		            $pdf->useTemplate($tpl, null, null, $size['w'], $size['h'], true);



		        }



		    $certificate = 'file://'.$_SERVER["DOCUMENT_ROOT"]."/app/plugins/firmasdigitales/".$archivo;



		    $info = array(



		        'Name' => $user->GetP_nombre().' '.$user->GetP_apellido(),



		        'Location' => $sadmin->GetCiudad(),



		        'Reason' => $sadmin->GetP_nombre(),



		        'ContactInfo' => $user->GetEmail(),



		        );



		    if($pdf->setSignature($certificate, $certificate, $keyf, '', 1, $info)){



			    $pdf->Rect($x, $y, $h, $w, 'F', array(), array(128,255,128));



			    $bg_url = ASSETS."/images/signature_bg.png";



				$user_url = HOMEDIR.DS.trim("/app/plugins/thumbnails/").$user->GetFirma();



				$arrarch = explode(".", $user->GetFirma());



				$ext_firma = end($arrarch);



			    $pdf->Image($bg_url, $x, $y, $h, $w, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false);



			  	$pdf->Image($user_url, $x2, $y2, $h2, $w2, $ext_firma, '', '', false, 300, '', false, false, 0, false, false, false);



			    // Set Code in Signature image



			    $pdf->SetFont('Helvetica', 'B', '12');



			    $pdf->SetTextColor(0, 0, 0);



			    $pdf->SetXY($x2, $y2+7);



			    $pdf->Write(0, $user->GetP_nombre().' '.$user->GetP_apellido());



			    $pdf->SetFont('Helvetica', 0, '10');



			    $pdf->SetTextColor(0, 0, 0);



			    $pdf->SetXY($x2, $y2+12);



			    $pdf->Write(0, $user->GetT_profesional());



			    $pdf->SetFont('Helvetica', 0, '10');



			    $pdf->SetTextColor(0, 0, 0);



			    $pdf->SetXY($x2, $y2+17);



			    $pdf->Write(0, 'Teléfono: (+57) '.$user->GetCelular());



			    $pdf->SetFont('Helvetica', 0, '10');



			    $pdf->SetTextColor(0, 0, 0);



			    $pdf->SetXY($x2, $y2+22);



			    $pdf->Write(0, 'E-mail: '.$user->GetEmail());



			    // Set Code in Signature image



			    // define active area for signature appearance



			    // print autencitity log text



			    $pdf->SetFont('Helvetica', 0, '10');



	            $pdf->SetTextColor(0, 0, 0);



	            $pdf->SetXY(3, 4);



	            $pdf->Write(0, 'Documento firmado con Código '.$numero_aleatorio. " El día: ".date('d-m-Y')." a las: ".date('h:i:s'));



				if ($sqr == "on") {



					$pdf->Image('http://chart.googleapis.com/chart?chs=50x50&cht=qr&chl='.$linkfile,189,2,25,25);



				}



			    $pdf->setSignatureAppearance($fillx,$filly,$fillh,$fillw);



				if ($surl != "0") {



				    $pdf->SetXY(3,254);



				    $pdf->Cell(0, 0, "Puede verificar la autenticidad de este documento en: ".HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl(),'','','','',HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl());



				}



			    #$pdf->Output("DDDD.pdf",'F');



			    $pdf->Output($path_file2,'F');



			    $status = "Documento Generado y Firmado Digitalmente Puede Descargar este Documento <a href='".HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl()."'>Aqui</a>";



			    /*Se guarda la url corta*/



			    $MSort = new MSort;



				$MSort->InsertSort($numero_aleatorio,  $linkfile2, date('Y-m-d H:i:s'));



	##ALMACENANDO LA FIRMA EN LA BASE DE DATOS



				$objectfirma = new MGestion_anexos_firmas;



				$objectfirma->CreateGestion_anexos_firmas("id", $this->sql_quote($id));



				$gestion_anexos_permisos_id = $con->Result($con->Query("select id from gestion_anexos_permisos where usuario_permiso = '".$user_id."' and id_documento = '".$objectfirma->GetAnexo_id()."'"), 0, "id");



				$object = new MGestion_anexos_permisos;



				$object->CreateGestion_anexos_permisos("id", $gestion_anexos_permisos_id);



				$estadodc = "1";



				$ar1x = array($estadodc, date("Y-m-d H:i:s"), $object->GetObservacion()."<br><b>".$user_id." dice: </b> El documento ha sido Firmado Digitalmente");



				$create = $object->UpdateGestion_anexos_permisos('WHERE id = '.$gestion_anexos_permisos_id, array('estado','fecha_actualizacion', 'observacion'), $ar1x,  array('registro actualizado', 'no se pudo actualizar'));



				$doc = new MGestion_anexos;



				$doc->CreateGestion_anexos("id", $object->GetId_documento());



				$gestion_id = $doc->GetGestion_id();



				$objecte = new MEvents_gestion;



				$responsablea = $this->GetDataFromTable("usuarios", "user_id", $user_id, "p_nombre, p_apellido", $separador = " ");



				$estado = array("0" => "Pendiente por Revisar", "1" => "Aprobado", "2" => "Rechazado");



				$estado = $estado[$estadodc];



				$objecte->InsertEvents_gestion($user_id, $gestion_id, date("Y-m-d"), "Se firmado un documento", "El documento ".$doc->GetNombre()." ha sido firmado digitalmente por el usuario ".$responsablea." " , date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $seccional, $area_principal, $area_principal, $doc->GetUser_id(), "crdoc", $id);



				$fields = array('fecha_firma', 'codigo_firma', 'clave_primaria', 'estado_firma', 'repo_1', 'repo_2', 'firma_crt', 'ip', 'cod_alt');



				$updates = array(date("Y-m-d H:i:s"), $_SESSION["ACTIVEKEY"], $_SESSION["SID"], "1", "", "", $name, $_SERVER['REMOTE_ADDR'], $numero_aleatorio);



				$output = array('Documento Actualizado', 'no se pudo actualizar');



				$constrain = 'WHERE id = '.$Gestion_anexos_firmas_id;



				$objectfirma = new MGestion_anexos_firmas;



				$status .= "<br>".$objectfirma->UpdateGestion_anexos_firmas($constrain, $fields, $updates, $output);



				/*actualizar archivo contenido*/



				//base 64



				$base_file = '';



				$data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$ga->GetGestion_id()."/anexos".DS.$ga->GetUrl());



				$base_file = base64_encode($data_base_file);



				$fields = array('base_file');



				$updates = array($base_file);



				$output = array('Documento Actualizado', 'no se pudo actualizar');



				$constrain = 'WHERE id = '.$ganf->GetAnexo_id();



				$ga->UpdateGestion_anexos($constrain, $fields, $updates, $output);



		    }else{



		    	return "Error al firmar";



		    }



		    ### FIN DEL PROCESO DE FIRMA ###



			#include_once(VIEWS.DS.'firmas_usuarios/signaturedDoc.php');



		}



		return true;



	}



	function CodeQrExterno($id){



		$ganf = new MGestion_anexos_firmas;



		$ganf->CreateGestion_anexos_firmas("id", $id);



		$ga = new MGestion_anexos;



		$ga->CreateGestion_anexos("id", $ganf->GetAnexo_id());



		$linkfile = HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();



		$arrarch = explode(".", $ga->GetUrl());



		$nom_archivo = $arrarch[0];



		$filename = ROOT."/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$nom_archivo.'.png';



		$matrixPointSize = 10;



		$errorCorrectionLevel = 'L';



		QRcode::png($linkfile, $filename, $errorCorrectionLevel, $matrixPointSize, 2);



		$data = file_get_contents($filename);



		$base64 = base64_encode($data);



		return $base64;



	}



	function CodeQrExterno2($pid,$usuario){



		global $con;



		global $f;



		$qsus = $con->Query("select suscriptor_id from gestion where id = '".$pid."'");



		$arex = $con->Result($qsus, 0, 'suscriptor_id');



		$con->Query("insert consultas_varias (suscriptor_id, gestion_id, fecha, ip, type, estado, user_id) VALUES ('".$arex."', '".$pid."', '".date("Y-m-d H:i:s")."', '".$_SERVER['REMOTE_ADDR']."', 'QR', '0','".$usuario."')");



		$id_consultas_varias = $this->GetMaxIdTabla("consultas_varias", "id");



		$url = HOMEDIR.DS."gestion/listadodocumentosqr/".$id_consultas_varias."/";



		$codigo_qr = $this->GenerarCodeQr_base64($url,$usuario);



		$docle = $con->Query("select * from gestion_anexos where gestion_id = '".$pid."' and (estado = '1' or estado = '3') and is_publico = '1'");



		while ($xt = $con->FetchAssoc($docle)) {



			$con->Query("insert consultas_varias_anexo (id_consultas_varias, id_anexo, fecha) VALUES ('".$id_consultas_varias."', '".$xt["id"]."', '".date("Y-m-d H:i:s")."')");



		}



		return $codigo_qr;



	}



	function GenerarCodeQr_base64($url,$usuario){



		$linkfile = $url;



		$rand = md5(date('Y-m-d').rand().$usuario);



		$filename = ROOT."/archivos_uploads/gestion/qr/".$rand.'.png';



		$matrixPointSize = 10;



		$errorCorrectionLevel = 'L';



		QRcode::png($linkfile, $filename, $errorCorrectionLevel, $matrixPointSize, 2);



		$data = file_get_contents($filename);



		$base64 = base64_encode($data);



		return $base64;



	}



	function GenerarCodeQr($url){



		$linkfile = $url;



		$rand = md5(date('Y-m-d').rand().$_SESSION['usuario']);



		$filename = ROOT."/archivos_uploads/gestion/qr/".$rand.'.png';



		$matrixPointSize = 10;



		$errorCorrectionLevel = 'L';



		QRcode::png($linkfile, $filename, $errorCorrectionLevel, $matrixPointSize, 2);



		$data = file_get_contents($filename);



		$base64 = base64_encode($data);



		return $rand.'.png';



	}



	function ImpresionDocumentoExterno($id){



		$ganf = new MGestion_anexos_firmas;



		$ganf->CreateGestion_anexos_firmas("id", $id);



		$ga = new MGestion_anexos;



		$ga->CreateGestion_anexos("id", $ganf->GetAnexo_id());



		$linkfile = ROOT."/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();



		$data = file_get_contents($linkfile);



		$base64 = base64_encode($data);



		return $base64;



	}



	function InterraccionElectronocaExterno($id,$nombre,$usuario,$id_gestion){



			global $con;



			global $f;



			$objectx = new MSuscriptores_contactos;



			$objectx->CreateSuscriptores_contactos("id", $id);



			$usuario = $objectx->GetCod_ingreso();



			$clave = $objectx->GetDec_pass();



			$SSC = new MSuscriptores_contactos_direccion;



			$query = $SSC->ListarSuscriptores_contactos_direccion("WHERE id_contacto = '".$objectx -> GetId()."'");



			$email = $con->Result($query, 0, 'email');



			$m = new MUsuarios;



			$m->CreateUsuarios("user_id", $usuario);







			$MPlantillas_email = new MPlantillas_email;



			$MPlantillas_email->CreatePlantillas_email('id', '8');



			$contenido_email = $MPlantillas_email->GetContenido();



			$contenido_email = str_replace("[elemento]ubicacion[/elemento]",      $objectx->GetNom(),     $contenido_email );



			$contenido_email = str_replace("[elemento]CLAVE_USUARIO[/elemento]",      $clave,     $contenido_email );



			$contenido_email = str_replace("[elemento]USUARIO[/elemento]",      $usuario,     $contenido_email );



			$contenido_email = str_replace("[elemento]responsable[/elemento]",      $_SESSION['nombre'],   $contenido_email );



			$contenido_email = str_replace("[elemento]serie[/elemento]",      $id,   $contenido_email );



			$contenido_email = str_replace("[elemento]HOMEDIR[/elemento]",      HOMEDIR,   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );






			$this->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$email);







			$con->Query("insert consultas_varias (suscriptor_id, gestion_id, fecha, ip, type, estado) VALUES ('".$id."', '".$id_gestion."', '".date("Y-m-d H:i:s")."', '".$_SERVER['REMOTE_ADDR']."', 'IE', '0')");



			return 'Se han enviado los datos de acceso al cliente '.$email;



		}



		function EnvioFisicoExterno($user_id,$dcontenido,$id_gestion,$titulo, $spostal, $id_suscriptor, $direccion, $comparecer, $nom_destinatario, $anexos_listado, $urls_archivos){



			global $con;



			// DEFINIENDO EL OBJETO



			$u = new MUsuarios;



			$u->CreateUsuarios("user_id", $user_id);



			$remitente = $u->GetP_nombre()." ".$u->GetP_apellido();



			$demandado = $u->GetDireccion()." / ".$u->GetTelefono()." - ".$u->GetCelular();



			$object = new MNotificaciones;



			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA



			$ddo = explode("@@", $id_suscriptor);



			$create = $object->InsertNotificaciones($user_id, $id_gestion, $ddo[0], $titulo, $spostal, date("Y-m-d"), '0', '', $direccion, $comparecer, '', '', $nom_destinatario);



			#echo $anexos_listado."<br>";



			#echo $urls_archivos;



			$max = $this->GetMaxIdTabla("notificaciones", "id");



			$objecte = new MEvents_gestion;



			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO



			/*



				InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto ignorar),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))



			*/



			# code...



			$objecte->InsertEvents_gestion($user_id, $id_gestion, date("Y-m-d"), "Carga de Documento", "Se ha cargado un documento llamado: \"".$_FILES['upl']['name']."\"", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $u->GetSeccional(), $u->GetRegimen(), $u->GetRegimen(), "*", "nfis", $max);



			$g = new MGestion;



			$g->CreateGestion("id", $id_gestion);



			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK



			$create = 1;



			if($create == '1'){



				$attachments = explode(";",$anexos_listado);



				for($i = 0; $i < count($attachments); $i++){



					if($attachments[$i] != ""){



						$con->Query("INSERT INTO notificaciones_attachments (id_notificacion, id_anexo, fecha_hora, estado) VALUES ('".$max."','".$attachments[$i]."', '".date("Y-m-d H:i:s")."', '0')");



						$ga = new MGestion_anexos;



						$ga->CreateGestion_anexos("id", $attachments[$i]);



						$c->SendContabilizadorDocumentos($ga->GetCantidad(), $g->GetTipo_documento(), $g->GetId(), "NT");



					}



				}



				$nom = $remitente;



				$cliente = new nusoap_client("http://laws.com.co/ws/GetDetailPostalO.wsdl", true);



                $error = $cliente->getError();



                if ($error) {



                    return "Error";



                    //"<h2>Constructor error</h2><pre>" . $error . "</pre>";



                }



                $array = array("id" => $spostal);



               # print_r($array);



                #print_r($_REQUEST);



                $result = $cliente->call("GetDetalleOperador", $array);



                if ($cliente->fault) {



                    //echo "<h2>Fault</h2><pre>";



                    //echo "</pre>";



                    return "Error";



                }else{



                    $error = $cliente->getError();



                    if ($error) {



                        //echo "<h2>Error</h2><pre>" . $error . "</pre>";



                        return "Error";



                    }else {



                        if ($result == "") {



                            return "No se creo el WS";



                        }else{



                            $x  = explode(",", $result);



            				$id_postal = $x[1];



            				$nomPostal = $x[0];



                        }



                    }



                }



				$con->Query("UPDATE notificaciones set nombre_postal = '".$nomPostal."'  where id = '".$max."'");



				$url = $id_postal;



				$cliente = new nusoap_client($url, true);



			    $error = $cliente->getError();



			    if ($error) {



			        //echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";



			        return "Error";



			    }



			    $array = array("user_id" => $user_id, "message_id" => $max, "direccion" => $direccion, "rid" => $id_gestion , "type" => $titulo, "nombre" => $nom, "destinatario" => $nom_destinatario, "url" => $urls_archivos, "juzgado" => $entidad, "naturaleza" => $naturalezaproceso, "radicado" => $radicado, "demandado" => $demandado, "remitente" => $remitente, "anexos" => $dcontenido, "keyword" => $_SERVER['HTTP_HOST']);



			   # print_r($array);



			    $result = $cliente->call("InsertNotification", $array);



			    if ($cliente->fault) {



			        //echo "<h2>Fault</h2><pre>";



			        //echo "</pre>";



			        return "Error";



			    }else{



			        $error = $cliente->getError();



			        if ($error) {



			            //echo "<h2>Error</h2><pre>" . $error . "</pre>";



			            return "Error";



			        }else {



						if ($result == "") {



							return "No se creo el WS";



						}else{



							return "Servicio registrado y enviado a la empresa: ".$nomPostal;



						}



			        }



			    }



			}else{



				return "Error al Registrar";



			}



			return "error";



		}



		function EmailCertificadoExterno($gestion_anexos_firmas_id,$pid, $usuario, $seccional, $area_principal, $to, $subject, $message, $anexos_listado, $archivos_anexos_listado, $titulos_anexos_listado, $deadline, $folder_id_search){



			$ganf = new MGestion_anexos_firmas;



			$ganf->CreateGestion_anexos_firmas("id", $gestion_anexos_firmas_id);



			$ga = new MGestion_anexos;



			$ga->CreateGestion_anexos("id", $ganf->GetAnexo_id());



			$anexos_listado = ";a".$ganf->GetAnexo_id();



			if($archivos_anexos_listado != "" && $gestion_anexos_firmas_id != ""){



				$archivos_anexos_listado = ";".HOMEDIR.DS."app/archivos_uploads/gestion/".$ga->GetGestion_id().trim("/anexos/ ").$ga->GetUrl();



			}



			// DEFINIENDO EL OBJETO



			$object = new MMailer_message;



			global $con;



			global $f;



			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA



	#		$create = $object->InsertMailer_message($message_id, $sID, $user_ID, $ip, $date, $size, $from_nom, $subject, $message, $exp_day, $p_id, $name);



			$sID 		= $_SESSION["SID"];



			$user_ID 	= $usuario;



			$ip 		= $_SERVER['REMOTE_ADDR'];



			$date 		= date("Y-m-d H:i:s");



			$subject_message = $subject;



			$id 	= $pid;



			$tox	= $to;



			$email 	= $tox;



			$mensajecorrecto = "No se envio el Mensaje a la direccion de correo: ".$email;



		// INFORMACION DEL USUARIO ///////////////



			$u = new MUsuarios;



			$u->CreateUsuarios("user_id", $user_ID);



		//////////////////////////////////////////



			$id_gestion = "0";



			if ($folder_id_search != "") {



				$gestion = new MGestion;



				$gestion->CreateGestion("id", $folder_id_search);



				$id_gestion = $gestion->GetId();



			}



		//////////////////////////////////



			$from = $u->GetEmail();



			$Mid = $this->GetMaxIdTabla("mailer_message", 'id');



			$message_id = $Mid + 1;



			$message_id .= $from.$ip.$date;



			$message_id = md5($message_id);



			$message_id = hash ("sha256", $message_id);



			$subject = "Esto es un mensaje de datos de ".$u->GetP_nombre()." ".$u->GetP_apellido();



			$size = 0;

			$exp_day = $f->CalcularFecha(date("Y-m-d"), $deadline, "+");

			$from_name = $u->GetP_nombre()." ".$u->GetP_apellido();

			#  $object->InsertMailer_message($message_id, $sID, $user_ID, $ip, $date, $size, $from_nom, $subject, $message, $exp_day, $p_id, $name);

			$create = $object->InsertMailer_message($message_id, $sID, $user_ID, $ip, $date, $size, $from , $subject_message, $message, $exp_day, $id_gestion, $from_name);



			$reciepments = explode(';', $email);

			for($i = 0; $i < 1; $i++){

				$email = trim($reciepments[$i]);

				if ($email != "") {

					# code...

					$token = md5($message_id.$reciepments[$i]);

					$token = hash ("sha256", $token);

					$recibir = $f->MakeButtonMail(HOMEDIR.DS.'correo'.DS.'acuse'.DS.$token.'.1'.DS, "Ver Contenido del mensaje");

					$norecibir = $f->MakeButtonMail(HOMEDIR.DS.'correo'.DS.'acuse'.DS.$token.'.2'.DS, "Rehusarse");



					$MPlantillas_email = new MPlantillas_email;

					$MPlantillas_email->CreatePlantillas_email('id', '4');

					$contenido_email = $MPlantillas_email->GetContenido();

					$contenido_email = str_replace("[elemento]Fecha_registro[/elemento]",   date("d-m-Y h:i:s a"),     	   $contenido_email );

					$contenido_email = str_replace("[elemento]ASUNTO[/elemento]",      $subject_message,   $contenido_email );

					$contenido_email = str_replace("[elemento]responsable[/elemento]",      $from_name,   $contenido_email );

					$contenido_email = str_replace("[elemento]BOTON_NORECIBIR[/elemento]",      $recibir,   $contenido_email );

					$contenido_email = str_replace("[elemento]BOTON_RECIBIR[/elemento]",      $norecibir,   $contenido_email );
					$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );


					$bodymessage = $contenido_email;



					$sfile= PLUGINS.DS."messages/$token.txt";

					$fp = fopen($sfile,"w");

					fwrite($fp,$bodymessage);

					fclose($fp);

					$x = stat($sfile);

					$size = $x["size"];

					$dns = $f->GetDNS();

					$name = "";

					$to = new MMailer_from_message;

					$to->InsertMailer_from_message($Mid, $message_id, $sID, $token, $user_ID, $email, $size, $this->sql_quote($bodymessage), $this->sql_quote($body.$path), "1", $name, $dns);

					$adjuntos = explode(";", $archivos_anexos_listado);

					$anexos = explode(";", $anexos_listado);

					for($i = 0; $i < count($adjuntos); $i++){

						if($adjuntos[$i] != ""){

							$fielan = substr($anexos[$i], 1);

							$ruta = $adjuntos[$i];

							$x = @stat($ruta);

							$size = $x["size"];

							$type_file = "3";

							$fn = $i;

							$imcode = md5($token.$fn);

							$imcode = hash ("sha256", $imcode);

							$totalfiles = count($adjuntos)-1;

							$folio = $i;

							$filename = explode("/", $ruta);

							$img_name = end($filename);

							$gestion_anexo = new MGestion_anexos;

							// LO CREAMOS

							$gestion_anexo->CreateGestion_anexos('id', $fielan);

							$titles = $gestion_anexo->GetNombre();

							$atachments = new MMailer_attachments;

							$atachments->InsertMailer_attachments($message_id, $ruta, $size, $gestion_anexo->GetId(), $type_file, $titles, $i, $imcode);

						}

					}



					$rid = $this->GetMaxIdTabla("mailer_from_message", 'id') ;

					$rp = new MMailer_replys;

					$rp->InsertMailer_replys($rid, $message_id, $token, "SENT", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");



					$exito = $this->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$subject,$contenido_email,$email);



					if ($exito) {

						$mensajecorrecto = 'Mensaje enviado a la direccion de correo: '.$email;

					}



					$id_table = $this->GetDataFromTable("mailer_from_message", "token_ID", $token, "id", $separador = "");

					if ($id_gestion != "0") {

						$objecte = new MEvents_gestion;

						// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO

						/*

							InsertEvents_gestion(	usuario_registra, 	gestion_id, 	fecha_evento, titulo, 	descripcion, 	fecha_creacion, estado(0 por defecto echo),  hora, 	$alerted = validar si alertado(0 = sin avisar, 1 = avisado), 	$avisar_a = dias para avisar, 	$type_event (ignorar), 	$fecha_vencimiento, $id_generico = si viene de alerta generica (0 =  ninguna), 	$seccional, 	$oficina, 	$area, 	$grupo = a que usuarios notificar (* = todos, B = Jefe de Area, B-X = Jefe de Area y x = otro usuario))

						*/

						$objecte->InsertEvents_gestion($usuario, $id_gestion, date("Y-m-d"), "Nuevo Mensaje de datos", "Se ha enviado un mensaje de datos a $email", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $seccional, $area_principal, $area_principal, "*", "mejd", $id_table);

					}

					$con->Query("INSERT INTO alertas

													   (fechahora, user_id,      type, log,                               status, extra,    id_gestion,        id_act)

												VALUES ('".date("Y-m-d H:i:s")."', '".$email."', '1',  '".$this->GetIdLog(date("Y-m-d"))."', '0',    'newmsj', '".$id_gestion."', '".$id_table."')");

				}

			}

			return $mensajecorrecto;

		}

		function GetExpedientesPorCompartir(){

		}

		function GetVistaExpedienteDefault($id, $path = ""){

			global $con;
			global $c;

			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");

			$rg = new MGestion;

			$rg->CreateGestion("id", $id);

			if ($rg->GetId() != "") {

			$serie = $this->GetDataFromTable("dependencias", "id", $rg->GetId_dependencia_raiz(), "nombre", $separador = " ");

			$subserie = $this->GetDataFromTable("dependencias", "id", $rg->GetTipo_documento(), "nombre", $separador = " ");

			$suscriptor = $this->GetDataFromTable("suscriptores_contactos", "id", $rg->GetSuscriptor_id(), "nombre, type", " (").")";

			$estado = $rg->GetEstado_respuesta(); #$this->GetDataFromTable("estados_gestion", "id", $rg->GetEstado_solicitud(), "nombre", $separador = " ");

			$usuario_registra = $this->GetDataFromTable("usuarios", "user_id", $rg->GetUsuario_registra(), "p_nombre, p_apellido", $separador = " ");

			$propietario = $this->GetDataFromTable("usuarios", "a_i", $rg->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");

			$area = $this->GetDataFromTable("areas", "id", $rg->GetDependencia_destino(), "nombre", $separador = " ");

			$s = new MDependencias;

			$q = $s->ListarDependencias(" where dependencia = '0'");

			$leftclass = ($_SESSION['usuario'] != $rg->GetUsuario_registra())?"propietario":"no-propietario";


			$trs = "";
			#echo $rg->GetId().$rg->GetTransferencia();
			if ($rg->GetTransferencia() == "1"){
                $qut = $con->Query("select user_recibe from gestion_transferencias where gestion_id = '".$rg->GetId()."' and estado = '0'");
                $ut = $con->FetchAssoc($qut);
                $usuario_transfiere = $c->GetDataFromTable("usuarios", "a_i", $ut['user_recibe'], "p_nombre, p_apellido", $separador = " ");

                $trs .= "<br>";
                $trs .= "En Transferencia a: <br>$usuario_transfiere";
            }


			echo '

					<div class="row bloque_gestion primera '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">

						<div class="2u 12u(narrower) "align="left">

							<b>Título del Expediente</b>

						</div>

						<div class="10u 12u(narrower) " align="left">

							'.$rg->GetObservacion().'

						</div>

					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">

						<div class="1u 12u(narrower) " align="left">

							<b> Identificación del Expediente: </b>

						</div>

						<div class="5u 12u(narrower) " align="left">

							<a href="'.HOMEDIR.'/gestion/ver/'.$rg->GetId().'/" target="_blank">'.$rg->GetNum_oficio_respuesta().'</a>

						</div>

						<div class="2u 12u(narrower) "align="left">

							<b> Radicado Externo: </b>

						</div>

						<div class="1u 12u(narrower) " align="left">

							<a href="'.HOMEDIR.'/gestion/ver/'.$rg->GetId().'/" target="_blank">'.$rg->GetRadicado().'</a>

						</div>

						<div class="2u 12u(narrower) "align="left">

							<b> Radicado: </b>

						</div>

						<div class="1u 12u(narrower) " align="left">

							<a href="'.HOMEDIR.'/gestion/ver/'.$rg->GetId().'/" target="_blank">'.$rg->GetMin_rad().'</a>

						</div>

					</div>

					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">

						<div class="2u 12u(narrower) "align="left">

							<b>Fecha de Registro:</b>

						</div>

						<div class="2u 12u(narrower) "align="left">

							'.$rg->GetF_recibido().'

						</div>

						<div class="2u 12u(narrower) "align="left">

							<b>Registrado Por:</b>

						</div>

						<div class="2u 12u(narrower) "align="left">

							'.$usuario_registra.'

						</div>

						<div class="2u 12u(narrower) "align="left">

							<b>Usuario Responsable:</b>

						</div>

						<div class="2u 12u(narrower) " style="color: red" align="left">

							<b>'.$propietario.'</b> <small>'.$trs.'</small>

						</div>

					</div>

					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">

						<div class="1u 12u(narrower) "align="left">

							<b>Suscriptores:</b>

						</div>

						<div class="3u 12u(narrower) "align="left">';

						$lgestions = new MGestion_suscriptores;

                        $querysuscriptores2 = $lgestions->ListarGestion_suscriptores("WHERE id_gestion = '".$rg->GetId()."'");

                            $ixx = 0;

                            while($rowsuscriptores = $con->FetchAssoc($querysuscriptores2)){

                                $ixx++;

                                $llstt = new MGestion_suscriptores;

                                $llstt->Creategestion_suscriptores('id', $rowsuscriptores['id']);

                                $sustrs = new MSuscriptores_contactos;

                                $sustrs->CreateSuscriptores_contactos("id", $llstt -> GetId_suscriptor());

                                echo '<b>'.$sustrs->GetNombre().'</b> / '.$sustrs->GetType()."<br>";

                            }

                            if ($ixx == "0") {

                                echo "SUSCRIPTORES SIN DETERMINAR";

                            }

            $showultima = ($path == "")?"ultima":"";

                            	# code...

			echo '		</div>

						<div class="1u 12u(narrower) "align="left">

							<b>Tipo de Documento</b>

						</div>

						<div class="4u 12u(narrower) "align="left">

							'.$serie.' - <b>'.$subserie.'</b>

						</div>

						<div class="1u 12u(narrower) "align="left">

							<b>'.CAMPOAREADETRABAJO.': </b>

						</div>

						<div class="2u 12u(narrower) "align="left">

							'.$area.'</b>

						</div>

					</div>

					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">

						<div class="1u 12u(narrower) "align="left">

							<b>Folios</b>

						</div>

						<div class="2u 12u(narrower) "align="left">

						'.$rg->GetFolio().'

						</div>

						<div class="2u 12u(narrower) "align="left">

							<b>Estado </b>

						</div>

						<div class="2u 12u(narrower) "align="left">

							'.$estado.'

						</div>

						<div class="2u 12u(narrower) "align="left">

							<b>Ubicación</b>

						</div>

						<div class="2u 12u(narrower) "align="left">

							'.$ar2[$rg->GetEstado_archivo()].'

						</div>

					</div>

					<div class="row bloque_gestion '.$showultima.'  '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">

						<div class="2u 12u(narrower) "align="left">

							<b>Observacion</b>

						</div>

						<div class="10u 12u(narrower) " align="left">

							'.$rg->GetObservacion2().'

						</div>

					</div>';

					if ($path != "") {

						echo '<div class="row bloque_gestion ultima '.$leftclass.' bg-info" style="margin-left:0px; margin-top: 0px;" align="left">

								'.$path.'

							</div>';

						# code...

					}

					echo '<style>

						.addd{

							cursor:pinter;

						}

						.addd td:hover{

							text-decoration:underline;

							cursor:pointer;

						}

						.row > * {

 					   		padding: 5px 0 0 5px;

 					   		margin-bottom:10px !important;

						}

						.row {

						    margin: -50px 0 -1px -50px;

						}

						.row.ultima{

						    margin: -50px 0 20px -50px;

						    margin-bottom:30px !important;

						    border-bottom: 1px solid #DDD !important;

						}

						.row.primera{

						    border-top: 1px solid #DDD !important;

						}

						div.table, div.table_2 {

						    background-color: #fff;

						    padding: 20px 0px 20px 20px;

						}

					</style>';
				}

		}

		function GetVistaAmplePublica($id, $path = "", $type = "full"){

			global $con;
			global $c;

			$g = new MGestion;
			$g->CreateGestion("id", $id);

			$usuario = $c->GetDataFromTable("usuarios", "a_i", $g->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");

			switch (TIPO_RADICACION) {
	            	case '1':
	            		$radicado = $g->GetRadicado();
	            		break;
	            	case '2':
	            		$radicado = $g->GetMin_rad()." <small>(".$g->GetRadicado().")</small>";
	            		break;
	            	case '3':
	            		$radicado = $g->GetRadicado()." <small>(".$g->GetMin_rad().")</small>";
	            		break;
	            	default:
	            		$radicado = $g->GetMin_rad();
	            		break;
	            }

			echo "<div class='list-group-item'>";
			echo "	<div class='row'>
						<div class='col-md-1'><h5><b>Título:</b></h5></div>
						<div class='col-md-7' style='padding-top:8px'>".$g->GetObservacion()."</div>
						<div class='col-md-1'><h5><b>Radicado:</b></h5></div>
						<div class='col-md-3'>
							<a href='/consultapublica/resultados_radicado/".$g->GetRadicado()."/' class='btn btn-primary' style='width:auto; padding-left:35px; padding-right:34px; color:#FFF' target='_blank'>".$radicado."</a>
						</div>
					</div>";
			echo "	<div class='row'>
						<div class='col-md-1'><h5><b>Observación:</b></h5></div>
						<div class='col-md-7' style='padding-top:8px'>".$g->GetObservacion2()."</div>
						<div class='col-md-2'><h5><b>Fecha:</b></h5></div>
						<div class='col-md-2' style='padding-top:8px'>".$g->GetTs()."</div>
					</div>";
			echo "	<div class='row'>
						<div class='col-md-12'><h5><b>Documentos:</b></h5></div>
					</div>";

			$q = $con->Query("Select * from gestion_anexos where gestion_id = '".$g->GetId()."' and is_publico = '1' and url != '' ");
			while ($col = $con->FetchAssoc($q)) {
				$arra = array("1" => "mdi-check", "0" => "mdi-clock-outline", "-1" => "mdi-close-circle-outline");
				$statdoc = $arra[$col['checked']];
				$nota = "";

				if ($col['observacion'] != "") {
					$nota = "(Nota: ".$col['observacion'].")";
				}
				echo "	<div class='row'>
							<div class='col-md-1' style='text-align:right'><div class='mdi $statdoc'> </div></div>
							<div class='col-md-11'><b>".$col['nombre']."</b> $nota </div>

						</div>";

			}
			echo "</div>";

		}

		function GetVistaMailExpediente($id){

			global $con;
			global $c;
			global $f;

			$g = new MGestion;
			$g->CreateGestion("id", $id);

			$usuario = $c->GetDataFromTable("usuarios", "a_i", $g->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");

			switch (TIPO_RADICACION) {
            	case '1':
            		if ($g->GetRadicado() != "") {
            			$radicado = $g->GetRadicado();
            		}else{
            			$radicado = "Pendiente de Asignar";
            		}
            		break;
            	case '2':
            		$radicado = $g->GetMin_rad()." <small>(".$g->GetRadicado().")</small>";
            		break;
            	case '3':
            		$radicado = $g->GetRadicado()." <small>(".$g->GetMin_rad().")</small>";
            		break;
            	default:
            		$radicado = $g->GetMin_rad();
            		break;
            }

            $label = "";
            $label_class = "";
            switch ($g->GetEstado_respuesta()) {
				case 'Pendiente':
					$label = "Pendiente";
					$label_class = "label-inverse";
					break;
				case 'Rechazado':
					$label = "Rechazado";
					$label_class = "label-danger";
					break;
				case 'En Espera Correccion':
					$label = "En Pausa";
					$label_class = "label-warning";
					break;
				case 'Abierto':
					$label = "En Progreso";
					$label_class = "label-success";
					break;
				case 'Cerrado':
					$label = "Cerrado";
					$label_class = "label-inverse";
					break;
				default:
					$label = "En Progreso";
					$label_class = "label-success";
					break;
			}

			$type = "";
			$user_id = "";

			if ($_SESSION['suscriptor_id'] == "") {
				$type = "U";
				$user_id = $_SESSION['usuario'];
				$fieldto = 'usuario_leido';
			}else{
				$type = "S";
				$user_id = $_SESSION['suscriptor_id'];
				$fieldto = 'suscriptor_leido';
			}

			$novedades = $con->Query("select count(*) as t from alertas_suscriptor where suscriptor_id = '".$user_id."' and estado = '0' and tipo_usuario = '".$type."' and id_gestion = '".$g->GetId()."'");

			$nov = $con->FetchAssoc($novedades);
			$nov = $nov['t'];

			$field = $con->Query("select $fieldto from gestion where id = '".$g->GetId()."'");
			$nov2 = $con->FetchAssoc($field);
			$nov2 = $nov2[$fieldto];


			$fav = new MGestion_favoritos;
			$q = $fav->ListarGestion_favoritos("WHERE user_id = '".$user_id."' and gestion_id = '".$g->GetId()."' and tipo_user = '".$type."'");
			$tot = $con->NumRows($q);

			$class= "fa-star-o text-muted";
			$role = 1;
			if ($tot > "0") {
				$class= "fa-star text-warning";
				$role = 0;
			}

			$classlock= "fa-lock text-muted";
			if ($g->GetEstado_respuesta() == "Abierto") {
				$classlock= "fa-unlock text-muted";
				$rolelock = "Cerrado";
			}else{
				$classlock= "fa-lock text-muted";
				$rolelock = "Abierto";
			}

			$unred = "";
			$new = "";
			if ($nov > 0 || $nov2 == '1') {
				$unred = 'class="unread"';
				$new = '<span class="mdi mdi-alert-circle text-warning m-r-5" '.$c->Ayuda('353', 'tog').'></span>';
			}


#<tr >

			echo '
				<tr '.$unred.' id="col_'.$g->GetId().'">
				    <td class="hidden-xs">
				    	<i class="fa '.$class.' " '.$c->Ayuda('352', 'tog').' style="cursor:pointer" id="fav'.$g->GetId().'" data-role="'.$role.'" onclick="AddToFav(\''.$g->GetId().'\')"></i>
				    	<i class="fa '.$classlock.' " '.$c->Ayuda('353', 'tog').' style="cursor:pointer" id="lock'.$g->GetId().'" data-role="'.$rolelock.'" onclick="AddToLock(\''.$g->GetId().'\')"></i>
				    </td>
				    <td style="padding-top:5px; padding-bottom:5px">
				    	<a href="/gestion/ver/'.$g->GetId().'/" style="width:auto">
				    		'.$radicado.'
				    	</a>
				    	<a href="/gestion/ver/'.$g->GetId().'/">
							'.$new.'
				    		<span class="label '.$label_class.'">'.$label.'</span>  '.$g->GetObservacion().'
				    	</a>
				    </td>
				    <td class="text-right" width="250"> <small>'.$f->nicetime($g->GetTs()).'</small> </td>
				</tr>';



		}

		function GetVistaMailExpedienteUser($id){

			global $con;
			global $c;
			global $f;

			$g = new MGestion;
			$g->CreateGestion("id", $id);

			$usuario = $c->GetDataFromTable("usuarios", "a_i", $g->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");

			switch (TIPO_RADICACION) {
            	case '1':
            		if ($g->GetRadicado() != "") {
            			$radicado = $g->GetRadicado();
            		}else{
            			$radicado = "Pendiente de Asignar <small>(".$g->GetMin_rad().")</small>";
            		}
            		break;
            	case '2':
            		$radicado = $g->GetMin_rad()." <small>(".$g->GetRadicado().")</small>";
            		break;
            	case '3':
            		$radicado = $g->GetRadicado()." <small>(".$g->GetMin_rad().")</small>";
            		break;
            	default:
            		$radicado = $g->GetMin_rad();
            		break;
            }
            $path = "";

            $label = "";
            $label_class = "";
            switch ($g->GetEstado_respuesta()) {
				case 'Pendiente':
					$label = "Pendiente";
					$label_class = "label-inverse";
					break;
				case 'Rechazado':
					$label = "Rechazado";
					$label_class = "label-danger";
					break;
				case 'En Espera Correccion':
					$label = "En Pausa";
					$label_class = "label-warning";
					break;
				case 'Abierto':
					$label = "En Progreso";
					$label_class = "label-success";
					break;
				case 'Cerrado':
					$label = "Cerrado";
					$label_class = "label-inverse";
					break;
				default:
					$label = "En Progreso";
					$label_class = "label-success";
					break;
			}

			$type = "";
			$user_id = "";

			if ($_SESSION['suscriptor_id'] == "") {
				$type = "U";
				$user_id = $_SESSION['usuario'];
				$fieldto = 'usuario_leido';
			}else{
				$type = "S";
				$user_id = $_SESSION['suscriptor_id'];
				$fieldto = 'suscriptor_leido';
			}

			$novedades = $con->Query("select count(*) as t from alertas_suscriptor where suscriptor_id = '".$user_id."' and estado = '0' and tipo_usuario = '".$type."' and id_gestion = '".$g->GetId()."'");

			$nov = $con->FetchAssoc($novedades);
			$nov = $nov['t'];

			$field = $con->Query("select $fieldto from gestion where id = '".$g->GetId()."'");
			$nov2 = $con->FetchAssoc($field);
			$nov2 = $nov2[$fieldto];


			$fav = new MGestion_favoritos;
			$q = $fav->ListarGestion_favoritos("WHERE user_id = '".$user_id."' and gestion_id = '".$g->GetId()."' and tipo_user = '".$type."'");
			$tot = $con->NumRows($q);

			$class= "fa-star-o text-muted";
			$role = 1;
			if ($tot > "0") {
				$class= "fa-star text-warning";
				$role = 0;
			}

			$classlock= "fa-lock text-muted";
			if ($g->GetEstado_respuesta() == "Abierto") {
				$classlock= "fa-unlock text-muted";
				$rolelock = "Cerrado";
			}else{
				$classlock= "fa-lock text-muted";
				$rolelock = "Abierto";
			}



			$unred = "";
			$new = "";
			if ($nov > 0 || $nov2 == '1') {
				$unred = 'class="unread"';
				$new = '<span class="mdi mdi-alert-circle text-warning m-r-5" '.$c->Ayuda('353', 'tog').'></span>';
			}


#<tr >

			$path = '
				<tr '.$unred.' id="col_'.$g->GetId().'">
				    <td class="hidden-xs" style="padding-top:12px !important;">
				    	<i class="fa '.$class.' " '.$c->Ayuda('352', 'tog').' style="cursor:pointer" id="fav'.$g->GetId().'" data-role="'.$role.'" onclick="AddToFav(\''.$g->GetId().'\')"></i>
				    	<i class="fa '.$classlock.' " '.$c->Ayuda('353', 'tog').' style="cursor:pointer" id="lock'.$g->GetId().'" data-role="'.$rolelock.'" onclick="AddToLock(\''.$g->GetId().'\')"></i>
				    </td>
				    <td style="padding-top:5px; padding-bottom:5px">
				    	<a href="#" style="width:auto" onclick="LoadAlertas(\''.$g->GetId().'\')">
				    		'.$radicado.'
				    	</a>
				    	<a href="#" onclick="LoadAlertas(\''.$g->GetId().'\')">
							'.$new.'
				    		<span class="label '.$label_class.'">'.$label.'</span>  '.$g->GetObservacion().'
				    	</a>
				    </td>
				    <td class="text-right" width="250"> <small>'.$f->nicetime($g->GetTs()).'</small> </td>
				</tr>';

				return $path;

		}

		function GetVistaAmple($id, $path = "", $type = ""){

			global $con;
			global $c;

			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");

			$rg = new MGestion;

			$rg->CreateGestion("id", $id);

			if ($rg->GetId() != "") {

				$serie = $this->GetDataFromTable("dependencias", "id", $rg->GetId_dependencia_raiz(), "nombre", $separador = " ");

				$subserie = $this->GetDataFromTable("dependencias", "id", $rg->GetTipo_documento(), "nombre", $separador = " ");

				$suscriptor = $this->GetDataFromTable("suscriptores_contactos", "id", $rg->GetSuscriptor_id(), "nombre", "");
				$ts = $this->GetDataFromTable("suscriptores_contactos", "id", $rg->GetSuscriptor_id(), "type", "");
				$ts = $this->GetDataFromTable("suscriptores_tipos", "id", $ts, "nombre", "");

				$estado = $rg->GetEstado_respuesta(); #$this->GetDataFromTable("estados_gestion", "id", $rg->GetEstado_solicitud(), "nombre", $separador = " ");

				$usuario_registra = $this->GetDataFromTable("usuarios", "user_id", $rg->GetUsuario_registra(), "p_nombre, p_apellido", $separador = " ");

				$propietario = $this->GetDataFromTable("usuarios", "a_i", $rg->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");

				$area = $this->GetDataFromTable("areas", "id", $rg->GetDependencia_destino(), "nombre", $separador = " ");

				$estado_archivo = $con->Query("select nombre from estadosx where valor = '".$rg->GetEstado_archivo()."' and tipo = 'estado_archivo'");
				$estado_archivo = $con->Result($estado_archivo, 0, 'nombre');

				$s = new MDependencias;

				$q = $s->ListarDependencias(" where dependencia = '0'");

				$leftclass = ($_SESSION['usuario'] != $rg->GetUsuario_registra())?"propietario":"no-propietario";


				$trs = "";
				#echo $rg->GetId().$rg->GetTransferencia();
				if ($rg->GetTransferencia() == "1"){
	                $qut = $con->Query("select user_recibe from gestion_transferencias where gestion_id = '".$rg->GetId()."' and estado = '0'");
	                $ut = $con->FetchAssoc($qut);
	                $usuario_transfiere = $c->GetDataFromTable("usuarios", "a_i", $ut['user_recibe'], "p_nombre, p_apellido", $separador = " ");

	                $trs .= "<br>";
	                $trs .= "En Transferencia a: <br>$usuario_transfiere";
	            }

	            switch (TIPO_RADICACION) {
	            	case '1':
	            		if ($rg->GetRadicado() != "") {
				            $radicado = $rg->GetRadicado();
				        }else{
				            $radicado = $rg->GetMin_rad()." <small>(".$rg->GetRadicado().")</small>";
				        }
	            		break;
	            	case '2':
				        if ($rg->GetRadicado() != "") {
				            $radicado = $rg->GetMin_rad()." <small>(".$rg->GetRadicado().")</small>";
				        }else{
				            $radicado = $rg->GetMin_rad();
				        }
				        break;
				    case '3':
				        if ($rg->GetMin_rad() != "") {
				            $radicado = $rg->GetRadicado()." <small>(".$rg->GetMin_rad().")</small>";
				        }else{
				            $radicado = $rg->GetRadicado();
				        }
	            		break;
	            	default:
	            		$radicado = $rg->GetMin_rad();
	            		break;
	            }



				echo "<div class='list-group-item'>";
				echo "	<div class='row'>
							<div class='col-md-12'><h2>".$rg->GetObservacion()."</h2></div>
						</div>";
				echo "	<div class='row'>
							<div class='col-md-2'><h5><b>Radicado:</b></h5></div>
							<div class='col-md-10'>
								<a href='/gestion/ver/".$rg->GetId()."/".DIRECCIONARALERTAS."/' class='btn btn-primary' ".$this->Ayuda('99', 'tog')." target='_blank'>$radicado</a>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-2'><h5><b>".RESPONSABLE.":</b></h5></div>
							<div class='col-md-10'><h5 class='text-danger'>".$propietario.'<small>'.$trs."</small></h5></div>
						</div>";
				echo '	<div class="row">
							<div class="col-md-2"><h5><b>'.FECHA_APERTURA.':</b></h5></div>
							<div class="col-md-3"><h5>'.$rg->GetF_recibido().'</h5></div>
							<div class="col-md-2"><h5><b>'.COTEJADO.':</b></h5></div>
							<div class="col-md-5"><h5>'.$usuario_registra.'</h5></div>
						</div>';
				echo '	<div class="row">
							<div class="col-md-2">
								<h5><b>'.SUSCRIPTORCAMPONOMBRE.':</b></h5>
							</div>
							<div class="col-md-10"><h5>';
							$lgestions = new MGestion_suscriptores;
	                        $querysuscriptores2 = $lgestions->ListarGestion_suscriptores("WHERE id_gestion = '".$rg->GetId()."'");
	                            $ixx = 0;
	                            while($rowsuscriptores = $con->FetchAssoc($querysuscriptores2)){
	                                $ixx++;
	                                $llstt = new MGestion_suscriptores;
	                                $llstt->Creategestion_suscriptores('id', $rowsuscriptores['id']);
	                                $sustrs = new MSuscriptores_contactos;
	                                $sustrs->CreateSuscriptores_contactos("id", $llstt -> GetId_suscriptor());
	                                $ts = $sustrs->GetType();
									$ts = $this->GetDataFromTable("suscriptores_tipos", "id", $ts, "nombre", "");
	                                echo '<b>'.$sustrs->GetNombre().'</b> / '.$ts."<br>";
	                            }
	                            if ($ixx == "0") {
	                                echo SUSCRIPTORCAMPONOMBRE." SIN DETERMINAR";
	                            }
	            echo '			</h5>
	            			</div>
	            		</div>';
	          	if ($type == "full") {

	            echo '	<div class="row">';
				echo '  	<div class="col-md-2">
								<h5><b>'.SUB_SERIE.':</b></h5>
							</div>
							<div class="col-md-4"align="left">
								<h5>'.$serie.' - <b>'.$subserie.'</b></h5>
							</div>
							<div class="col-md-2">
								<h5><b>'.CAMPOAREADETRABAJO.': </b></h5>
							</div>
							<div class="col-md-4">
								<h5>'.$area.'</b></h5>
							</div>
						</div>';
				echo '	<div class="row">
							<div class="col-md-2">
								<h5><b>'.ESTADO.':</b></h5>
							</div>
							<div class="col-md-4">
								<h5>'.$estado.' </h5>
							</div>
							<div class="col-md-2">
								<h5><b>'.UBICACION.':</b></h5>
							</div>
							<div class="col-md-4">
								<h5>'.$estado_archivo.'</h5>
							</div>
						</div>';
				echo "	<div class='row'>
							<div class='col-md-4'><h5><b>".OBSERVACION.":</b></h5></div>
							<div class='col-md-8'>".$rg->GetObservacion2()."</div>
						</div>";
				}
				echo '	<div class="row">';
				if (CAMPOT1 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT1.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot1().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT2 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT2.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot2().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT3 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT3.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot3().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT4 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT4.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot4().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT5 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT5.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot5().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT6 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT6.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot6().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT7 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT7.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot7().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT8 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT8.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot8().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT9 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT9.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot9().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT10 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT10.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot10().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT11 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT11.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot11().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT12 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT12.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot12().'&nbsp;</h5>
						</div>';
			    }
			    if (CAMPOT13 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT13.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot13().'&nbsp;</h5>
						</div>';
			    }
			     if (CAMPOT14 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT14.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot14().'&nbsp;</h5>
						</div>';
			    }
			     if (CAMPOT15 != ""){
			        echo '
			            <div class="col-md-4">
							<h5><b>'.CAMPOT15.':</b></h5>
						</div>
						<div class="col-md-8">
							<h5>'.$rg->GetCampot15().'&nbsp;</h5>
						</div>';
			    }

				echo '		</div>';
				if ($path != "") {
					echo '<div class="row p-10 jumbotron m-t-20" style="padding:10px !important; border-radius:0px !important">
							'.$path.'
						</div>';
					# code...
				}
			echo '</div>';
			}

		}

		function SendContabilizadorDocumentos($pagecount, $tipo_documento, $id_documento, $proceso ){

			global $con;

			$con->Query("INSERT INTO contador_inmaterializacion (type, type_id, cantidad, usuario, fecha) VALUES ('".$proceso."', '".$tipo_documento."', '".$pagecount."', '".$_SESSION['usuario']."', '".date("Y-m-d")."')");

			$url = "http://laws.com.co/ws/GetInmaterializacion.wsdl";

			$cliente = new nusoap_client($url, true);

		    $error = $cliente->getError();

		    if ($error) {

		        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

		    }

		    $array = array("cliente" => "http://".$_SERVER['HTTP_HOST'], "usuario" => $_SESSION['usuario'], "type" => $proceso, "cantidad" => $pagecount, "subserie" => $tipo_documento, "gestion" => $id_documento);

		    #$array = array("user_id" => $_SESSION['usuario'], "message_id" => $max, "direccion" => $_REQUEST['direccion'], "rid" => $_REQUEST['id_gestion'] , "type" => $_REQUEST['titulo'], "nombre" => $nom, "destinatario" => $_REQUEST["nom_destinatario"], "url" => $urls_archivos, "juzgado" => $entidad, "naturaleza" => $naturalezaproceso, "radicado" => $radicado, "demandado" => $demandado, "remitente" => $remitente, "anexos" => $dcontenido, "keyword" => $_SERVER['HTTP_HOST']);

		   # print_r($array);

		    $result = $cliente->call("ContabilizarMovimientos", $array);

		    if ($cliente->fault) {

		        echo "<h2>Fault</h2><pre>";

		        echo "</pre>";

		    }else{

		        $error = $cliente->getError();

		        if ($error) {

		            echo "<h2>Error</h2><pre>" . $error . "</pre>";

		        }else {

					if ($result == "") {

						echo "No se creo el WS";

					}else{

						echo "";

					}

		        }

		    }

		}

		function GetCalculoPapel($type){
			global $con;
			$query = $con->Query("select sum(cantidad) as t from contador_inmaterializacion");
#	        $query = $con->Query("select sum(cantidad) as t from gestion_anexos inner join dependencias on dependencias_tipologias.es_inmaterial = gestion_anexos.tipologia WHERE dependencias_tipologias.es_inmaterial = '1'");
	        $data = $con->Result($query, 0, "t");
	        if ($type == "a") {
	            $data = number_format($data);
	        }elseif($type == "b"){
	            $r = 500;
	            $data = $data / $r;
	            $data = round($data, 2);
	        }elseif ($type == "c") {
	            $r = 500;
	            $a = 16;
	            $rt = $data / $r;
	            $data = $rt / $a;
	            $data = round($data, 2);
	        }else{
	            $data = number_format($data);
	        }
	        return $data;
		}
		function LimpiarEspacios($t){
			return trim($t);
		}
		function CharsSearchEngine($t){
			return trim($t);
		}

		function GetVistaPublicaExpediente($id, $path = ""){

			global $con;

			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");

			$rg = new MGestion;
			$rg->CreateGestion("id", $id);

			$serie = $this->GetDataFromTable("dependencias", "id", $rg->GetId_dependencia_raiz(), "nombre", $separador = " ");
			$subserie = $this->GetDataFromTable("dependencias", "id", $rg->GetTipo_documento(), "nombre", $separador = " ");
			$suscriptor = $this->GetDataFromTable("suscriptores_contactos", "id", $rg->GetSuscriptor_id(), "nombre, type", " (").")";
			$estado = $rg->GetEstado_respuesta(); #$this->GetDataFromTable("estados_gestion", "id", $rg->GetEstado_solicitud(), "nombre", $separador = " ");
			$usuario_registra = $this->GetDataFromTable("usuarios", "user_id", $rg->GetUsuario_registra(), "p_nombre, p_apellido", $separador = " ");
			$propietario = $this->GetDataFromTable("usuarios", "a_i", $rg->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");
			$area = $this->GetDataFromTable("areas", "id", $rg->GetDependencia_destino(), "nombre", $separador = " ");

			$s = new MDependencias;
			$q = $s->ListarDependencias(" where dependencia = '0'");

			$leftclass = ($_SESSION['usuario'] != $rg->GetUsuario_registra())?"propietario":"no-propietario";
			echo '
						<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">
						<div class="col-md-2 "align="left">
							<b>Título del Expediente:</b>
						</div>
						<div class="col-md-10 " align="left">
							'.$rg->GetObservacion().'
						</div>
					</div>
					<div class="row bloque_gestion primera '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">
						<div class="col-md-2 "align="left">
							<b> Radicado Externo: </b>
						</div>
						<div class="col-md-2 " align="left">
							'.$rg->GetRadicado().'
						</div>
						<div class="col-md-2 "align="left">
							<b> Radicado: </b>
						</div>
						<div class="col-md-1 " align="left">
							'.$rg->GetMin_rad().'
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">
						<div class="col-md-2 "align="left">
							<b>Fecha de Apertura:</b>
						</div>
						<div class="col-md-2 "align="left">
							'.$rg->GetF_recibido().'
						</div>
						<div class="col-md-2 "align="left">
							<b>Registrado Por:</b>
						</div>
						<div class="col-md-2 "align="left">
							'.$usuario_registra.'
						</div>
						<div class="col-md-2 "align="left">
							<b>Usuario Responsable:</b>
						</div>
						<div class="col-md-2 " style="color: red" align="left">
							<b>'.$propietario.'</b>
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">
						<div class="col-md-1 "align="left">
						<b>Suscriptores:</b>
						</div>
						<div class="col-md-11"align="left">';
						$lgestions = new MGestion_suscriptores;
                        $querysuscriptores2 = $lgestions->ListarGestion_suscriptores("WHERE id_gestion = '".$rg->GetId()."'");
                            $ixx = 0;
                            while($rowsuscriptores = $con->FetchAssoc($querysuscriptores2)){
                                $ixx++;
                                $llstt = new MGestion_suscriptores;
                                $llstt->Creategestion_suscriptores('id', $rowsuscriptores['id']);
                                $sustrs = new MSuscriptores_contactos;
                                $sustrs->CreateSuscriptores_contactos("id", $llstt -> GetId_suscriptor());

                                $ts = $sustrs->GetType();
								$ts = $this->GetDataFromTable("suscriptores_tipos", "id", $ts, "nombre", "");
	                            echo '<b>'.$sustrs->GetNombre().'</b> / '.$ts."<br>";


                                #echo '<b>'.$sustrs->GetNombre().'</b> / '.$sustrs->GetType()."<br>";
                            }
                            if ($ixx == "0") {
                                echo "SUSCRIPTORES SIN DETERMINAR";
                            }
			echo '		</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">
						<div class="col-md-1 "align="left">
							<b>Serie:</b>
						</div>
						<div class="col-md-2 " align="left">
							'.$serie.'</b>
						</div>
						<div class="col-md-2 "align="left">
							<b>Tipo de Documento:</b>
						</div>
						<div class="col-md-3 "align="left">
							'.$subserie.'</b>
						</div>
						<div class="col-md-2 "align="left">
							<b>'.CAMPOAREADETRABAJO.': </b>
						</div>
						<div class="col-md-2 "align="left">
							'.$area.'</b>
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px;">
						<div class="col-md-1 "align="left">
							<b>Folios:</b>
						</div>
						<div class="col-md-2 "align="left">
							'.$rg->GetFolio().'
						</div>
						<div class="col-md-2 "align="left">
							<b>Estado/Terminado:</b>
						</div>
						<div class="col-md-2 "align="left">
							'.$estado.'
						</div>
						<div class="col-md-2 "align="left">
							<b>Ubicación:</b>
						</div>
						<div class="col-md-2 "align="left">
							'.$ar2[$rg->GetEstado_archivo()].'
						</div>
					</div>

					<div class="row bloque_gestion '.$leftclass.' m-t-30">
					<div class="col-md-12"><!--
						<ul class="nav nav-tabs">
							<li onClick="ActivarTab(\'tabdocumentos\', \'buscardocumentos\')" id="buscardocumentos" role="presentation"><a href="#buscardocumentos">Actuaciones del Expediente</a></li>
							<li onClick="ActivarTab(\'tabsuscriptores\', \'buscarsuscriptores\')" id="buscarsuscriptores" role="presentation"><a href="#buscarsuscriptores">Documentos Públicos</a></li>
						</ul>
						<div class="col-md-12 busquedaresultadotab" id="tabdocumentos"> -->';

						$query = $con->Query("select * from events_gestion where gestion_id = '".$rg->GetId()."' and es_publico = '1'");
						$i = 0;
						echo "<table class='table table-striped'>
								<thead>
									<tr>
										<th>Fecha</th>
										<th>Título</th>
										<th>Descripción</th>
										<th>Adjunto</th>
									</tr>
								</thead>
								<tbody>";
						while ($row = $con->FetchAssoc($query)) {
							$i++;
							echo "	<tr>
										<td>".$row['fecha']."</td>
										<td>".$row['title']."</td>
										<td>".$row['description']."</td>
										<td align='center'>";

							$doc = $con->Query("select * from gestion_anexos where id_event = '".$row['id']."'");
		                	$docg  = $con->FetchAssoc($doc);

		                	if ($docg['id'] != "") {

		                		$ga = new MGestion_anexos;
		                		$ga->CreateGestion_anexos("id", $docg['id']);

		                		$url = HOMEDIR.DS.'app/archivos_uploads/gestion/'.$ga->GetGestion_id().'/anexos/'.$ga->GetUrl();

		                		echo '<a href="'.$url.'" target="_blank" title="'.$ga->GetNombre().'"><i class="mdi mdi-paperclip"></i></a>';
		                	}
                				

							echo "		</td>
									</tr>";
						}
						if ($i == 0) {
							echo "	<tr>
										<td colspan='4'><div class='alert alert-info'>No se encontraron actuaciones publicadas</div></td>
									</tr>";
						}

			echo	'			</tbody>
							</table>
						<!--</div>
						<div class="busquedaresultadotab" id="tabsuscriptores">';

						$query = $con->Query("select * from gestion_anexos where gestion_id = '".$rg->GetId()."' and is_publico = '1'");
						$i = 0;
						echo "<div class='list-group'>";
						while ($row = $con->FetchAssoc($query)) {
							$i++;
							$fname = $row['url'];
							$linkfile = HOMEDIR.DS."app/archivos_uploads/gestion/".$rg->GetId().trim("/anexos/ ").$fname;
							$ext = end(explode(".", $fname));

							echo "<a href='/app/plugins/descargar.php?f=".$linkfile."&tf=".$row['nombre']."&format=pdf' target='_blank' class='list-group-item'>".$row['nombre']."</a>";
						}
						echo "</div>";
						if ($i == 0) {
							echo "<div class='alert alert-info'>No se encontraron documentos publicados</div>";
						}

			echo 	'	</div>-->
					</div>
				</div>



				<script type="text/javascript">
					$(document).ready(function(){
						$(".breadcrumb li").last().addClass("active");
					});

					function ActivarTab(tab, selector){

						$("#buscardocumentos").removeClass(\'active\');
						$("#buscarsuscriptores").removeClass(\'active\');

						$("#tabdocumentos").css(\'display\', \'none\');
						$("#tabsuscriptores").css(\'display\', \'none\');

						$("#"+selector).addClass("active");
						$("#"+tab).css("display", \'block\');

					}

					ActivarTab(\'tabdocumentos\', \'buscardocumentos\')
				</script>
				<style type="text/css">

					.busquedaresultadotab{
						border: 1px solid #CCC;
					    min-height: 100px;
					    border-top: none;
					    margin-top: -1px;
					    display: none;
					    padding: 20px;
					}

				</style>


					<div class="row bloque_gestion ultima '.$leftclass.'" style="margin-left:0px; margin-top: 0px;" align="left">
						'.$path.'
					</div>';
					echo '<style>
						.addd{
							cursor:pinter;
						}
						.addd td:hover{
							text-decoration:underline;
							cursor:pointer;
						}
						.row.ultima{
						    margin: -50px 0 20px -50px;
						}
						.row{
							padding-top:10px;
							padding-bottom:10px;
						}
						.bloque_gestion{
							font-size:14px;
						}
						div.table, div.table_2 {
						    background-color: #fff;
						    padding: 20px 0px 20px 20px;
						}
					</style>';
		}



		function GetVistaPublicaExpedienteResumida($id, $path = ""){



			global $con;



			$ar2 = array("1" => "A. de Gestión", "2" => "A. Central", "3" => "A. Histórico");



			$rg = new MGestion;



			$rg->CreateGestion("id", $id);



			$serie = $this->GetDataFromTable("dependencias", "id", $rg->GetId_dependencia_raiz(), "nombre", $separador = " ");



			$subserie = $this->GetDataFromTable("dependencias", "id", $rg->GetTipo_documento(), "nombre", $separador = " ");



			$suscriptor = $this->GetDataFromTable("suscriptores_contactos", "id", $rg->GetSuscriptor_id(), "nombre, type", " (").")";



			$estado = $rg->GetEstado_respuesta(); #$this->GetDataFromTable("estados_gestion", "id", $rg->GetEstado_solicitud(), "nombre", $separador = " ");



			$usuario_registra = $this->GetDataFromTable("usuarios", "user_id", $rg->GetUsuario_registra(), "p_nombre, p_apellido", $separador = " ");



			$propietario = $this->GetDataFromTable("usuarios", "a_i", $rg->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");



			$area = $this->GetDataFromTable("areas", "id", $rg->GetDependencia_destino(), "nombre", $separador = " ");



			$s = new MDependencias;



			$q = $s->ListarDependencias(" where dependencia = '0'");



			$leftclass = ($_SESSION['usuario'] != $rg->GetUsuario_registra())?"propietario":"no-propietario";



			echo '





					<div class="row bloque_gestion primera '.$leftclass.'" style="margin-left:0px; margin-top: 0px; padding-top:8px; padding-bottom:8px">



						<div style=" width: 16.66666667%; float:left" align="left">



							<b>Título del Expediente</b>



						</div>



						<div style="    width: 83.33333333%; float:left" align="left">



							'.$rg->GetObservacion().'



						</div>



					</div>



					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; padding-top:8px; padding-bottom:8px">



						<div style="width:25%; float:left" align="left">



							<b> Identificación del Expediente: </b>



						</div>



						<div style="width:75%; float:left" align="left">



							'.$rg->GetNum_oficio_respuesta().'



						</div>



					</div>



					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; padding-top:8px; padding-bottom:8px">



						<div style="width:25%; float:left"align="left">



							<b> Radicado Externo: </b>



						</div>



						<div style="width:25%; float:left" align="left">



							'.$rg->GetRadicado().'



						</div>



						<div style="width:25%; float:left"align="left">



							<b> Radicado: </b>



						</div>



						<div style="width:25%; float:left" align="left">



							'.$rg->GetMin_rad().'



						</div>



					</div>



					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; padding-top:8px; padding-bottom:8px">



						<div style="width:25%; float:left"align="left">



							<b>Fecha de Apertura:</b>



						</div>



						<div style="width:25%; float:left"align="left">



							'.$rg->GetF_recibido().'



						</div>



						<div style="width:25%; float:left"align="left">



							<b>Registrado Por:</b>



						</div>



						<div style="width:25%; float:left"align="left">



							'.$usuario_registra.'



						</div>



					</div>



					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; padding-top:8px; padding-bottom:8px">



						<div style="width:25%; float:left"align="left">



							<b>Usuario Responsable:</b>



						</div>



						<div style="width:25%; float:left" style="color: red" align="left">



							<b>'.$propietario.'</b>



						</div>



						<div style="width:25%; float:left"align="left">



							<b>'.CAMPOAREADETRABAJO.': : </b>



						</div>



						<div style="width:25%; float:left"align="left">



							'.$area.'</b>



						</div>



					</div>



					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; padding-top:8px; padding-bottom:8px">



						<div style="width:25%; float:left"align="left">



							<b>Tipo de Documento</b>



						</div>



						<div style="width:75%; float:left" align="left">



							'.$serie.' - <b>'.$subserie.'</b>



						</div>



					</div>



					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; padding-top:8px; padding-bottom:8px">



						<div style="width:25%; float:left"align="left">



							<b>Suscriptores:</b>



						</div>



						<div style="width:75%; float:left" align="left">';



						$lgestions = new MGestion_suscriptores;



                        $querysuscriptores2 = $lgestions->ListarGestion_suscriptores("WHERE id_gestion = '".$rg->GetId()."'");



                            $ixx = 0;



                            while($rowsuscriptores = $con->FetchAssoc($querysuscriptores2)){



                                $ixx++;



                                $llstt = new MGestion_suscriptores;



                                $llstt->Creategestion_suscriptores('id', $rowsuscriptores['id']);



                                $sustrs = new MSuscriptores_contactos;



                                $sustrs->CreateSuscriptores_contactos("id", $llstt -> GetId_suscriptor());



                                echo '<b>'.$sustrs->GetNombre().'</b> / '.$sustrs->GetType()."<br>";



                            }



                            if ($ixx == "0") {



                                echo "SUSCRIPTORES SIN DETERMINAR";



                            }



			echo '		</div>



					</div>



					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; padding-top:8px; padding-bottom:8px">



						<div style="width: 8.33333333%; float:left" align="left">



							<b>Folios</b>



						</div>



						<div style=" width: 16.66666667%; float:left" align="left">



							'.$rg->GetFolio().'



						</div>



						<div style=" width: 16.66666667%; float:left" align="left">



							<b>Estado</b>



						</div>



						<div style=" width: 16.66666667%; float:left" align="left">



							'.$estado.'



						</div>



						<div style=" width: 16.66666667%; float:left" align="left">



							<b>Ubicación</b>



						</div>



						<div style=" width: 16.66666667%; float:left" align="left">



							'.$ar2[$rg->GetEstado_archivo()].'



						</div>



					</div>';



					echo '<style>



						.addd{



							cursor:pinter;



						}



						.addd td:hover{



							text-decoration:underline;



							cursor:pointer;



						}



						.row.ultima{



						    margin: -50px 0 20px -50px;



						}



						.row{



							padding-top:10px;



							padding-bottom:10px;



						}



						.bloque_gestion{



							font-size:14px;



						}



						div.table, div.table_2 {



						    background-color: #fff;



						    padding: 20px 0px 20px 20px;



						}



					</style>';



		}



		function InsertGestion_anexos_consultas($id_anexo, $id_gestion, $fecha, $usuario, $ip)



		{



			global $con;



			// DEFINIMOS LA CONSULTA



			$q_str = "INSERT INTO gestion_anexos_consultas (id_anexo, id_gestion, fecha, usuario, ip, fecha_consulta) VALUES ('$id_anexo', '$id_gestion', '".date("Y-m-d H:i:s")."',  '$usuario', '$ip', '".date("Y-m-d H:00:00")."')";



			// EJECUTAMOS LA CONSULTA



			$query = $con->Query($q_str);



			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE



			return "";



		}



		function fnEnviaEmailGlobal2($de_email,$de_nombre, $subject, $message, $email, $x, $tm){

			global $con;


#			if ($usar_sms_propio == "1") {
			#echo "select * from usuarios where user_id = '".$tm."';";
			#exit;
				$u = $con->Query("select * from usuarios where user_id = '".$tm."'");
				$duser = $con->FetchAssoc($u);

				if ($duser['smtp_user'] != "") {
					$issmtp   = $duser['smtp_es'];
					$smtpaut  = $duser['smtp_aut'];
					$port     = $duser['smtp_puerto'];                     // set the SMTP port for the GMAIL server
					$username = $duser['smtp_user'];
					$password = $duser['smtp_pww'];
					$host 	  = $duser['smtp_host'];
					$helo 	  = $duser['smtp_helo'];
					$tls      = $duser['smtp_tls'];

				}else{
					$issmtp   = $_SESSION['variablessmtp'][5];
					$smtpaut  = $_SESSION['variablessmtp'][4];
					$port     = $_SESSION['variablessmtp'][1];                     // set the SMTP port for the GMAIL server
					$username = $_SESSION['variablessmtp'][2];
					$password = $_SESSION['variablessmtp'][3];
					$host 	  = $_SESSION['variablessmtp'][0];
					$tls = 'tls';
					
					$xpo = explode("@", $username);
					$helo = $xpo[1];
				}
/*
			}else{
				$issmtp   = $_SESSION['variablessmtp'][5];
				$smtpaut  = $_SESSION['variablessmtp'][4];
				$port     = $_SESSION['variablessmtp'][1];                     // set the SMTP port for the GMAIL server
				$username = $_SESSION['variablessmtp'][2];
				$password = $_SESSION['variablessmtp'][3];
				$host 	  = $_SESSION['variablessmtp'][0];

				$xpo = explode("@", $username);
				$helo = $xpo[1];
			}
*/
// $issmtp = "1";
// $smtpaut = "1";
// $port = "465";
// $username = "notificaciones@pgdpersoneriadeibague.com";
// $password = ")n{]]h8u[$=#";
// $host = "mail.pgdpersoneriadeibague.com";
// $helo = "pgdpersoneriadeibague.com";
// $tls = "ssl";

			
			echo "<h4>Variables de Conexión</h4>";
			echo "HOST: ".$host."<br>";
			echo "PUERTO: ".$port."<br>";
			echo "USUARIO: ".$username."<br>";
			echo "CLAVE: ".$password."<br>";
			echo "USA SMTP: ".$issmtp."<br>";
			echo "AUTH SMPT: ".$smtpaut."<br>";
			echo "HELO: ".$helo."<br>";
			echo "TIPO DE CONEXIÓN: ".$tls."<br>";
			echo '<hr>';
			echo "<h4>Log del Servidor</h4>";
			
	        // if(mail("sanderkdna@gmail.com", "prueba", "Hola sander!")){
	        //     echo "mensaje enviado con funcion mail";
	        // }else{
	        //     echo "no se pudo enviar por aca";
	        // }
        
			#echo "host $host user: $username pw: $password : $port";
			$_SESSION['debug'] = '';
			$mail = new PHPMailer;
			$mail->Helo = $helo;//HELLO_EMAIL; //Muy importante para que llegue a hotmail y otros
			$mail->Host     = $host; // SMTP server
			$mail->Username = $username;
			$mail->Password = $password;
			$mail->Port     = $port;                     // set the SMTP port for the GMAIL server
			
			$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
    		$debug = '';

    		$mail->Debugoutput = function($str, $level) { if($level == '1' || $level == '2'){$_SESSION['debug'] .= strip_tags(htmlentities($str))."<br>";}};

			if(!empty($archivos_adjuntos_ruta)){
				if ($archivos_adjuntos_ruta != "1") {
					for ($i=0; $i < count($archivos_adjuntos_ruta) ; $i++) {

						"Adjuntar: ".$archivos_adjuntos_ruta[$i]." Nombre:".$nombres[$i]."<br>";
						$mail->AddAttachment($archivos_adjuntos_ruta[$i], $nombres[$i]); // attachment
						echo "<hr>";
					}
				}
			}

			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPKeepAlive = true;
            $mail->SMTPSecure   = $tls;
            $mail->SMTPAutoTLS = false;
            
            if ($helo != "yahoo.com") {
	            if($_SESSION['usuario'] != ""){

	            	$u = new MUsuarios;
	            	$u->CreateUsuarios("user_id", $_SESSION['usuario']);
	                $mail->AddReplyTo($u->GetEmail(), ucwords(strtolower($de_nombre)));    

	            }else{
	                $mail->AddReplyTo("info@laws.com.co", ucwords("Controla Tu Proceso"));    
	            }
	        }
            
			$mail->SetFrom($username, ucwords(strtolower($de_nombre)));
			$mail->Subject    =  ucwords(strtolower($subject));
			$mail->AltBody    = "Este es un mensaje de datos ".date('Y-m-d H:i:s');
			$mail->IsHTML(true);
			$bodymessage = ($message);
			$mail->MsgHTML($bodymessage);
			$mail->AddAddress($email);
			$exit = $mail->Send();
			$mail->ClearAddresses();
			$mail->ClearAttachments();

			if ($_SESSION['usuario'] == 'sanderkdna@gmail.com') {
				#var_dump($mail)
				#echo "exit.".$exit;
	    		echo $_SESSION['debug'];
			}

			return $exit;




		}

		function fnEnviaEmailGlobal($de_email,$de_nombre, $subject, $message, $email, $archivos_adjuntos_ruta = "", $nombres = "", $usar_sms_propio = "0"){

			global $con;

			//$issmtp   = $_SESSION['variablessmtp'][5];
			//$smtpaut  = $_SESSION['variablessmtp'][4];
			//$port     = $_SESSION['variablessmtp'][1];                     // set the SMTP port for the GMAIL server
			//$username = $_SESSION['variablessmtp'][2];
			//$password = $_SESSION['variablessmtp'][3];
			//$host 	  = $_SESSION['variablessmtp'][0];
			//$tls = "tls";
			
			$issmtp   = 1;
			$smtpaut  = 1;
			$port     = 465;                     // set the SMTP port for the GMAIL server
			$username = 'notificacionespersonerianeiva@sgdea.com';
			$password = 'iH3PFxvOZJ_C';
			$host 	  = 'sgdea.com';
			$tls = "ssl";
			
			$xpo = explode("@", $username);
			$helo = $xpo[1];
			
        
			#echo "host $host user: $username pw: $password : $port";
			$_SESSION['debug'] = '';
			$mail = new PHPMailer;
			$mail->Helo = $helo;//HELLO_EMAIL; //Muy importante para que llegue a hotmail y otros
			$mail->Host     = $host; // SMTP server
			$mail->Username = $username;
			$mail->Password = $password;
			$mail->Port     = $port;                     // set the SMTP port for the GMAIL server
			
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    		$debug = '';

    		$mail->Debugoutput = function($str, $level) { if($level == '1' || $level == '2'){$_SESSION['debug'] .= strip_tags(htmlentities($str))."<br>";}};

			if(!empty($archivos_adjuntos_ruta)){
				if ($archivos_adjuntos_ruta != "1") {
					for ($i=0; $i < count($archivos_adjuntos_ruta) ; $i++) {

						"Adjuntar: ".$archivos_adjuntos_ruta[$i]." Nombre:".$nombres[$i]."<br>";
						$mail->AddAttachment($archivos_adjuntos_ruta[$i], $nombres[$i]); // attachment
						echo "<hr>";
					}
				}
			}

			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPKeepAlive = true;
            $mail->SMTPSecure   = $tls;
            $mail->SMTPAutoTLS = false;

            if ($helo != "yahoo.com") {
	            if($_SESSION['usuario'] != ""){

	            	$u = new MUsuarios;
	            	$u->CreateUsuarios("user_id", $_SESSION['usuario']);
	                $mail->AddReplyTo($username, ucwords("Personería de Neiva"));    

	            }else{
	                $mail->AddReplyTo($username, ucwords("Personería de Neiva"));    
	            }
	        }
            
			$mail->SetFrom($username, ucwords(strtolower($de_nombre)));
			$mail->Subject    =  ucwords(strtolower($subject));
			$mail->AltBody    = "Este es un mensaje de datos ".date('Y-m-d H:i:s');
			$mail->IsHTML(true);
			$bodymessage = ($message);
			$mail->MsgHTML($bodymessage);
			$mail->AddAddress($email);
			$exit =  $mail->Send();
			$mail->ClearAddresses();
			$mail->ClearAttachments();

			if ($_SESSION['usuario'] == 'sanderkdna@gmail.com') {
				#var_dump($mail)
				#echo "exit.".$exit;
	    		#echo $_SESSION['debug'];
			}

			return $exit;
		}

		function fnEnviaEmailGlobalGoogle($de_email,$de_nombre, $subject, $message, $email, $archivos_adjuntos_ruta = "", $nombres = "", $usar_sms_propio = "0"){

			global $con;
				
			$replyto = $_SESSION['usuario'];
			$issmtp   = $_SESSION['variablessmtp'][5];
			$smtpaut  = $_SESSION['variablessmtp'][4];
			$port     = $_SESSION['variablessmtp'][1];                     // set the SMTP port for the GMAIL server
			$username = $_SESSION['variablessmtp'][2];
			$password = $_SESSION['variablessmtp'][3];
			$host 	  = $_SESSION['variablessmtp'][0];
			$tls = 'tls';
			
			$xpo = explode("@", $username);
			$helo = $xpo[1];



			#echo "host $host user: $username pw: $password : $port";
			$_SESSION['debug'] = '';
			$mail = new PHPMailer;
			$mail->Helo = $helo;//HELLO_EMAIL; //Muy importante para que llegue a hotmail y otros
			$mail->Host     = $host; // SMTP server
			$mail->Username = $username;
			$mail->Password = $password;
			$mail->Port     = $port;                     // set the SMTP port for the GMAIL server
			
			$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
    		$debug = '';

    		$mail->Debugoutput = function($str, $level) { 
    			if($level == '1' || $level == '2'){
    				$_SESSION['debug'] .= strip_tags(htmlentities($str))."<br>";
    			}
    		};

			if(!empty($archivos_adjuntos_ruta)){
				if ($archivos_adjuntos_ruta != "1") {
					for ($i=0; $i < count($archivos_adjuntos_ruta) ; $i++) {

						"Adjuntar: ".$archivos_adjuntos_ruta[$i]." Nombre:".$nombres[$i]."<br>";
						$mail->AddAttachment($archivos_adjuntos_ruta[$i], $nombres[$i]); // attachment
						echo "<hr>";
					}
				}
			}

			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPKeepAlive = true;
            $mail->SMTPSecure   = $tls;
            $mail->SMTPAutoTLS = false;
            
            if ($helo != "yahoo.com") {
	            if($_SESSION['usuario'] != ""){
	                $mail->AddReplyTo($replyto, ucwords(strtolower($de_nombre)));    
	            }else{
	                $mail->AddReplyTo("info@laws.com.co", ucwords("Controla Tu Proceso"));    
	            }
            }
            
			$mail->SetFrom($username, ucwords(strtolower($de_nombre)));
			$mail->Subject    =  ucwords(strtolower($subject));
			$mail->AltBody    = "Este es un mensaje de datos ".date('Y-m-d H:i:s');
			$mail->IsHTML(true);
			$bodymessage = ($message);
			$mail->MsgHTML($bodymessage);
			$mail->AddAddress($email);
			$exit =  $mail->Send();
			$mail->ClearAddresses();
			$mail->ClearAttachments();

			#echo "exit.".$exit;
    		#echo $_SESSION['debug'];

    		if ($_SESSION['usuario'] == 'info@laws.com.co') {
				#var_dump($mail)
				#echo $exit;
	    		#$_SESSION['debug'] = $exit;
			}

			return $exit;
		}

		function wscontrol($key){
			global $con;
			$str = "SELECT count(*) as t FROM ws_keys where llave = '$key' and estado = '1'";
			$query = $con->Query($str);
			return $con->Result($query, 0, 't');
		}


		function GetIdRecursivo(){

			global $f;
			global $con;

			$nid = $f->randomText(6);

			$s1 = "select id, num_oficio_respuesta from gestion where uri = '".$nid."'";

			$query = $con->Query($s1);
			$row = $con->FetchAssoc($query);

			$radicado = $row['id'];

			if ($radicado != "") {
				$this->GetIdRecursivo();
			}else{
				return strtoupper($nid);
			}

		}


		function GetIdRecursivoTabla($campo,$tabla,$ext){

			global $f;
			global $con;

			$nid = strtoupper(md5($f->randomText(10)));
			if($ext != ""){
				$nid2 = $nid.'.'.$ext;
			}else{
				$nid2 = $nid;
			}

			$s1 = "select id from $tabla where $campo = '".$nid2."'";

			$query = $con->Query($s1);
			$row = $con->FetchAssoc($query);

			$radicado = $row['id'];

			if ($radicado != "") {
				$this->GetIdRecursivoTabla($campo,$tabla,$ext);
			}else{
				return $nid;
			}

		}

		function GetVistaExpedienteReducida($id, $path = ""){

			global $con;

			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");
			$rg = new MGestion;
			$rg->CreateGestion("id", $id);
			$serie = $this->GetDataFromTable("dependencias", "id", $rg->GetId_dependencia_raiz(), "nombre", $separador = " ");
			$subserie = $this->GetDataFromTable("dependencias", "id", $rg->GetTipo_documento(), "nombre", $separador = " ");
			$suscriptor = $this->GetDataFromTable("suscriptores_contactos", "id", $rg->GetSuscriptor_id(), "nombre, type", " (").")";
			$estado = $rg->GetEstado_respuesta(); #$this->GetDataFromTable("estados_gestion", "id", $rg->GetEstado_solicitud(), "nombre", $separador = " ");
			$usuario_registra = $this->GetDataFromTable("usuarios", "user_id", $rg->GetUsuario_registra(), "p_nombre, p_apellido", $separador = " ");
			$propietario = $this->GetDataFromTable("usuarios", "a_i", $rg->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");
			$area = $this->GetDataFromTable("areas", "id", $rg->GetDependencia_destino(), "nombre", $separador = " ");
			$s = new MDependencias;
			$q = $s->ListarDependencias(" where dependencia = '0'");
			$leftclass = ($_SESSION['usuario'] != $rg->GetUsuario_registra())?"propietario":"no-propietario";
			echo '
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important;">
						<div class="3u 12u(narrower) "align="left">
							<b>Título del Expediente:</b>
						</div>
						<div class="9u 12u(narrower) " align="left" style="font-size:18px;">
							'.$rg->GetObservacion().'
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important;">
						<div class="4u 12u(narrower) " align="left">
							<b> Identificación del Expediente: </b>
						</div>
						<div class="4u 12u(narrower) " align="left">
							<a href="'.HOMEDIR.'/gestion/ver/'.$rg->GetId().'/" target="_blank">'.$rg->GetNum_oficio_respuesta().'</a>
						</div>
						<div class="2u 12u(narrower) "align="left">
							<b> Radicado: </b>
						</div>
						<div class="2u 12u(narrower) " align="left">
							<a href="'.HOMEDIR.'/gestion/ver/'.$rg->GetId().'/" target="_blank">'.$rg->GetMin_rad().'</a>
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important;">
						<div class="3u 12u(narrower) "align="left">
							<b>Registrado Por:</b>
						</div>
						<div class="9u 12u(narrower) "align="left">
							'.$usuario_registra.'
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important;">
						<div class="3u 12u(narrower) "align="left">
							<b>Fecha de Registro:</b>
						</div>
						<div class="9u 12u(narrower) "align="left">
							'.$rg->GetF_recibido().'
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important;">
						<div class="3u 12u(narrower) "align="left">
							<b>Suscriptores:</b>
						</div>
						<div class="9u 12u(narrower) "align="left">';
						$lgestions = new MGestion_suscriptores;
                        $querysuscriptores2 = $lgestions->ListarGestion_suscriptores("WHERE id_gestion = '".$rg->GetId()."'");
                            $ixx = 0;
                            while($rowsuscriptores = $con->FetchAssoc($querysuscriptores2)){
                                $ixx++;
                                $llstt = new MGestion_suscriptores;
                                $llstt->Creategestion_suscriptores('id', $rowsuscriptores['id']);

                                $lx = new MSuscriptores_tipos;
								$lx->CreateSuscriptores_tipos("id", $llstt->GetType());

                                $sustrs = new MSuscriptores_contactos;
                                $sustrs->CreateSuscriptores_contactos("id", $llstt -> GetId_suscriptor());
                                echo '<b>'.$sustrs->GetNombre().'</b> / '.$lx->GetNombre()."<br>";
                            }
                            if ($ixx == "0") {
                                echo "SUSCRIPTORES SIN DETERMINAR";
                            }
            $showultima = ($path == "")?"ultima":"";
                            	# code...
			echo '		</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important;">
						<div class="3u 12u(narrower) "align="left">
							<b>Tipo de Documento:</b>
						</div>
						<div class="9u 12u(narrower) "align="left">
							'.$serie.' - <b>'.$subserie.'</b>
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important;">
						<div class="1u 12u(narrower) "align="left">
							<b>Folios:</b>
						</div>
						<div class="2u 12u(narrower) "align="left">
						'.$rg->GetFolio().'
						</div>
						<div class="2u 12u(narrower) "align="left">
							<b>Estado:</b>
						</div>
						<div class="2u 12u(narrower) "align="left">
							'.$estado.'
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important;">
						<div class="3u 12u(narrower) "align="left">
							<b>Observacion:</b>
						</div>
						<div class="9u 12u(narrower) " align="left">
							'.$rg->GetObservacion2().'
						</div>
					</div>';
					if ($path != "") {
						echo '<div class="row bloque_gestion '.$leftclass.' bg-info" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important;" align="left">
								'.$path.'
							</div>';
						# code...
					}
					echo '<style>
						.addd{
							cursor:pinter;
						}
						.addd td:hover{
							text-decoration:underline;
							cursor:pointer;
						}
						.row > * {
 					   		padding: 5px 0 0 5px;
 					   		margin-bottom:10px !important;
						}
						.row {
						    margin: -50px 0 -1px -50px;
						}
						.row.ultima{
						    margin: -50px 0 20px -50px;
						    margin-bottom:30px !important;
						    border-bottom: 1px solid #DDD !important;
						}
						.row.primera{
						    border-top: 1px solid #DDD !important;
						}
						div.table, div.table_2 {
						    background-color: #fff;
						    padding: 20px 0px 20px 20px;
						}
					</style>';
		}



		function GetVistaExpedienteValidar($id, $path = ""){

			global $con;

			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");
			$rg = new MGestion;
			$rg->CreateGestion("id", $id);
			$serie = $this->GetDataFromTable("dependencias", "id", $rg->GetId_dependencia_raiz(), "nombre", $separador = " ");
			$subserie = $this->GetDataFromTable("dependencias", "id", $rg->GetTipo_documento(), "nombre", $separador = " ");
			$suscriptor = $this->GetDataFromTable("suscriptores_contactos", "id", $rg->GetSuscriptor_id(), "nombre, type", " (").")";
			$estado = $rg->GetEstado_respuesta(); #$this->GetDataFromTable("estados_gestion", "id", $rg->GetEstado_solicitud(), "nombre", $separador = " ");
			$usuario_registra = $this->GetDataFromTable("usuarios", "user_id", $rg->GetUsuario_registra(), "p_nombre, p_apellido", $separador = " ");
			$propietario = $this->GetDataFromTable("usuarios", "a_i", $rg->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");
			$area = $this->GetDataFromTable("areas", "id", $rg->GetDependencia_destino(), "nombre", $separador = " ");
			$s = new MDependencias;
			$q = $s->ListarDependencias(" where dependencia = '0'");
			$leftclass = ($_SESSION['usuario'] != $rg->GetUsuario_registra())?"propietario":"no-propietario";
			$retorno = "";
			$retorno .= '
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important; border-right:1px solid #ccc">
						<div class="3u 12u(narrower) "align="left">
							<b>Título del Expediente:</b>
						</div>
						<div class="9u 12u(narrower) " align="left" style="font-size:18px;">
							'.$rg->GetObservacion().'
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important; border-right:1px solid #ccc">
						<div class="4u 12u(narrower) " align="left">
							<b> Identificación del Expediente: </b>
						</div>
						<div class="4u 12u(narrower) " align="left">
							<a href="'.HOMEDIR.'/gestion/ver/'.$rg->GetId().'/" target="_blank">'.$rg->GetNum_oficio_respuesta().'</a>
						</div>
						<div class="2u 12u(narrower) "align="left">
							<b> Radicado: </b>
						</div>
						<div class="2u 12u(narrower) " align="left">
							<a href="'.HOMEDIR.'/gestion/ver/'.$rg->GetId().'/" target="_blank">'.$rg->GetMin_rad().'</a>
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important; border-right:1px solid #ccc">
						<div class="3u 12u(narrower) "align="left">
							<b>Registrado Por:</b>
						</div>
						<div class="9u 12u(narrower) "align="left">
							'.$usuario_registra.'
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important; border-right:1px solid #ccc">
						<div class="3u 12u(narrower) "align="left">
							<b>Fecha de Registro:</b>
						</div>
						<div class="9u 12u(narrower) "align="left">
							'.$rg->GetF_recibido().'
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important; border-right:1px solid #ccc">
						<div class="3u 12u(narrower) "align="left">
							<b>Suscriptores:</b>
						</div>
						<div class="9u 12u(narrower) "align="left">';
						$lgestions = new MGestion_suscriptores;
                        $querysuscriptores2 = $lgestions->ListarGestion_suscriptores("WHERE id_gestion = '".$rg->GetId()."'");
                            $ixx = 0;
                            while($rowsuscriptores = $con->FetchAssoc($querysuscriptores2)){
                                $ixx++;
                                $llstt = new MGestion_suscriptores;
                                $llstt->Creategestion_suscriptores('id', $rowsuscriptores['id']);
                                $sustrs = new MSuscriptores_contactos;
                                $sustrs->CreateSuscriptores_contactos("id", $llstt -> GetId_suscriptor());
                                $retorno .=  '<b>'.$sustrs->GetNombre().'</b> / '.$sustrs->GetType()."<br>";
                            }
                            if ($ixx == "0") {
                                $retorno .=  "SUSCRIPTORES SIN DETERMINAR";
                            }
            $showultima = ($path == "")?"ultima":"";
                            	# code...
			$retorno .=  '		</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important; border-right:1px solid #ccc">
						<div class="3u 12u(narrower) "align="left">
							<b>Tipo de Documento:</b>
						</div>
						<div class="9u 12u(narrower) "align="left">
							'.$serie.' - <b>'.$subserie.'</b>
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important; border-right:1px solid #ccc">
						<div class="1u 12u(narrower) "align="left">
							<b>Folios:</b>
						</div>
						<div class="2u 12u(narrower) "align="left">
						'.$rg->GetFolio().'
						</div>
						<div class="2u 12u(narrower) "align="left">
							<b>Estado:</b>
						</div>
						<div class="2u 12u(narrower) "align="left">
							'.$estado.'
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important; border-right:1px solid #ccc">
						<div class="3u 12u(narrower) "align="left">
							<b>Observacion:</b>
						</div>
						<div class="9u 12u(narrower) " align="left">
							'.$rg->GetObservacion2().'
						</div>
					</div>';
					if ($path != "") {
						$retorno .=  '<div class="row bloque_gestion '.$leftclass.' bg-info" style="margin-left:0px; margin-top: 0px; font-size:14px; line-height:30px; padding:0px 5px !important; border-right:1px solid #ccc" align="left">
								'.$path.'
							</div>';
						# code...
					}
					$retorno .=  '<style>
						.addd{
							cursor:pinter;
						}
						.addd td:hover{
							text-decoration:underline;
							cursor:pointer;
						}
						.row > * {
 					   		padding: 5px 0 0 5px;
 					   		margin-bottom:10px !important;
						}
						.row {
						    margin: -50px 0 -1px -50px;
						}
						.row.ultima{
						    margin: -50px 0 20px -50px;
						    margin-bottom:30px !important;
						    border-bottom: 1px solid #DDD !important;
						}
						.row.primera{
						    border-top: 1px solid #DDD !important;
						}
						div.table, div.table_2 {
						    background-color: #fff;
						    padding: 20px 0px 20px 20px;
						}
					</style>';

					return $retorno;
		}

		function GetVistaExpedienteValidarNuevo($id, $path = ""){

			global $con;

			$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");
			$rg = new MGestion;
			$rg->CreateGestion("id", $id);
			$serie = $this->GetDataFromTable("dependencias", "id", $rg->GetId_dependencia_raiz(), "nombre", $separador = " ");
			$subserie = $this->GetDataFromTable("dependencias", "id", $rg->GetTipo_documento(), "nombre", $separador = " ");
			$suscriptor = $this->GetDataFromTable("suscriptores_contactos", "id", $rg->GetSuscriptor_id(), "nombre, type", " (").")";
			$estado = $rg->GetEstado_respuesta(); #$this->GetDataFromTable("estados_gestion", "id", $rg->GetEstado_solicitud(), "nombre", $separador = " ");
			$usuario_registra = $this->GetDataFromTable("usuarios", "user_id", $rg->GetUsuario_registra(), "p_nombre, p_apellido", $separador = " ");
			$propietario = $this->GetDataFromTable("usuarios", "a_i", $rg->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");
			$area = $this->GetDataFromTable("areas", "id", $rg->GetDependencia_destino(), "nombre", $separador = " ");
			$s = new MDependencias;
			$q = $s->ListarDependencias(" where dependencia = '0'");
			$leftclass = ($_SESSION['usuario'] != $rg->GetUsuario_registra())?"propietario":"no-propietario";
			$retorno = "";
			$retorno .= '
				<div class="list-group-item" id="pp'.$rg->GetId().'">
					<div class="row bloque_gestion '.$leftclass.'">
						<div class="col-md-12">
							<h2>'.$rg->GetObservacion().'</h2>
						</div>
					</div>
					<div class="row bloque_gestion '.$leftclass.'">
						<div class="col-md-2 col-sm-4">
							<h5><b> Radicado: </b></h5>
						</div>
						<div class="col-md-2 col-sm-8">

							<a href="/gestion/ver/'.$rg->GetId().'/" target="_blank" class="btn btn-primary">'.$rg->GetMin_rad().'</a>
						</div>
						<div class="col-md-3 col-sm-4">
							<h5><b>Fecha de Registro:</b></h5>
						</div>
						<div class="col-md-2 col-sm-8">
							<h5>'.$rg->GetF_recibido().' </h5>
						</div>
						<div class="col-md-1 col-sm-4">
							<h5><b>Estado:</b></h5>
						</div>
						<div class="col-md-2 col-sm-8">
							<h5>'.$estado.' </h5>
						</div>
					</div>
					<div class="row m-t-10">
						<div class="col-md-2" align="left">
							<h5><b>Suscriptores:</b></h5>
						</div>
						<div class="col-md-10">';
						$lgestions = new MGestion_suscriptores;
                        $querysuscriptores2 = $lgestions->ListarGestion_suscriptores("WHERE id_gestion = '".$rg->GetId()."'");
                            $ixx = 0;
                            while($rowsuscriptores = $con->FetchAssoc($querysuscriptores2)){
                                $ixx++;
                                $llstt = new MGestion_suscriptores;
                                $llstt->Creategestion_suscriptores('id', $rowsuscriptores['id']);
                                $sustrs = new MSuscriptores_contactos;
                                $sustrs->CreateSuscriptores_contactos("id", $llstt -> GetId_suscriptor());
                                $retorno .= '<div class="col-md-12 m-b-10"><div class="pull-left m-r-10"><b><h5>'.$sustrs->GetNombre().'</b> / </h5></div>';
                                $retorno .= '<div class="pull-left">
                                <select  class="form-control" name="type'.$rowsuscriptores['id'].'" id="type'.$rowsuscriptores['id'].'" onChange="ChangeStatusSuscriptor(\''.$sustrs->GetId().'\', this)">';
								$lx = new MSuscriptores_tipos;
								$query_eg = $lx->ListarSuscriptores_tipos();
								while($row_type = $con->FetchAssoc($query_eg)){
									$s = "";
									if ($sustrs->Gettype() == $row_type['id']) {
										$s = "selected = 'selected'";
									}
									$retorno .= "<option value='".$row_type['id']."' $s>".$row_type['nombre']."</option>";
								}
							$retorno .= '
											<option value="OTRO">OTRO</option>
										</select></div></div>';
                                $retorno .= "<br>";
                            }
                            if ($ixx == "0") {
                                $retorno .=  "SUSCRIPTORES SIN DETERMINAR";
                            }

			$retorno .=  '		</div>
					</div>';
					if ($path != "") {
						$retorno .=  '<div class="row m-t-30">
								'.$path.'
							</div>';
						# code...
					}


					return $retorno."</div>";
		}


		function GetLogo(){
			global $con;
			$str = "SELECT foto_perfil FROM `super_admin` order by id desc limit 1";
			$query = $con->Query($str);
			return $con->Result($query, 0, 'foto_perfil');
		}

	function fnplantillacontenidoemail($id_plantilla,$token="",$Fecha_registro="",$ASUNTO="",$responsable="",$fecha_vence="",$CLAVE_USUARIO="",$USUARIO="",$rad_completo="",$Suscriptor="",$rad_rapido="",$URI="",$FECHA_HORA="",$MOVIMIENTO=""){
		global $con;
		global $f;
		$str = "SELECT * FROM plantillas_email where id ='$id_plantilla'";
		$query = $con->Query($str);
		$contenido_email = $con->Result($query, 0, "contenido");

		$recibir = $f->MakeButtonMail(HOMEDIR.DS.'correo'.DS.'acuse'.DS.$token.'.1'.DS, "Ver Contenido del mensaje");
		$norecibir = $f->MakeButtonMail(HOMEDIR.DS.'correo'.DS.'acuse'.DS.$token.'.2'.DS, "Rehusarse");

		$contenido_email = str_replace("[elemento]LOGO[/elemento]",'<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$this->getLogo().'" width="150px">',$contenido_email );
		$contenido_email = str_replace("[elemento]BOTON_NORECIBIR[/elemento]",      $recibir,   $contenido_email );
		$contenido_email = str_replace("[elemento]BOTON_RECIBIR[/elemento]",      $norecibir,   $contenido_email );
		$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );

		$contenido_email = str_replace("[elemento]Fecha_registro[/elemento]",   $Fecha_registro,     	   $contenido_email );
		$contenido_email = str_replace("[elemento]ASUNTO[/elemento]",      $ASUNTO,   $contenido_email );
		$contenido_email = str_replace("[elemento]responsable[/elemento]",      $responsable,   $contenido_email );

		$contenido_email = str_replace("[elemento]fecha_vence[/elemento]",      $fecha_vence,     $contenido_email );
		$contenido_email = str_replace("[elemento]CLAVE_USUARIO[/elemento]",     $CLAVE_USUARIO,   $contenido_email );

		$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $USUARIO,    $contenido_email );
		$contenido_email = str_replace("[elemento]rad_completo[/elemento]",      $rad_completo,   $contenido_email );

		$contenido_email = str_replace("[elemento]Suscriptor[/elemento]",      $Suscriptor,   $contenido_email );
		$contenido_email = str_replace("[elemento]rad_rapido[/elemento]",      $rad_rapido,   $contenido_email );
		$contenido_email = str_replace("[elemento]URI[/elemento]",      $URI,   $contenido_email );

		$contenido_email = str_replace("[elemento]FECHA_HORA[/elemento]",  $FECHA_HORA,     $contenido_email );
		$contenido_email = str_replace("[elemento]MOVIMIENTO[/elemento]",  $MOVIMIENTO,    $contenido_email );

		return $contenido_email;
	}

	function Ayuda($id, $type = ''){
		if ($_SESSION['showhelps'] == "1") {
			global $con;

			$q = $con->Query("select * from ayuda_elementos where id = '$id' and estado = '1'");
			$row = $con->FetchAssoc($q);

			$texto = $row['texto'];
			if($_SESSION['usuario'] == 'sanderkdna@gmail.com'){
				$texto = ''.$id.': '.$texto;
			}

			if ($row['texto'] != "Informacion de prueba") {
				if ($row['id'] > "0") {
					if ($type == "tog") {
						return 'data-toggle="popover" data-trigger="hover" data-content="'.$texto.'" data-placement="'.$row['posicion'].'"';
					}else{
						#return '<span>df</span>';
						return '<span class="mdi mdi-help-circle-outline" style="cursor:pointer" data-toggle="popover" data-trigger="hover" data-content="'.$texto.'" data-placement="'.$row['posicion'].'"></span>';
					}
				}
			}else{

				if ($_SESSION['usuario'] == "sanderkdna@gmail.com") {
					if ($row['id'] > "0") {
						if ($type == "tog") {
							return 'data-toggle="popover" data-trigger="hover" data-content="'.$texto.'" data-placement="'.$row['posicion'].'"';
						}else{
							#return '<span>df</span>';
							return '<span class="mdi mdi-help-circle-outline" style="cursor:pointer" data-toggle="popover" data-trigger="hover" data-content="'.$texto.'" data-placement="'.$row['posicion'].'"></span>';
						}
					}
				}

			}
		}
	}

	function Find($elemento, $tipo_elemento, $gestion_id){
		global $con;

		switch ($tipo_elemento) {
			case 'gestion':
				return "";
				break;
			case 'meta':
				$buscarmeta = explode("_", $elemento);
				$pm = $buscarmeta[0];
				$qv = $con->Query("select valor from meta_big_data where campo_id = '".$pm."' and type_id = '".$gestion_id."' and tipo_form = '1' limit 0, 1");

				$val = $con->FetchAssoc($qv);
				return $val['valor'];

				break;
			case 'suscriptor':
				$buscarmeta = explode("_", $elemento);
				$pm = $buscarmeta[0];
				$qv = $con->Query("select sc.id from suscriptores_contactos as sc inner join gestion_suscriptores as gs on gs.id_suscriptor = sc.id where gs.id_gestion = '$gestion_id' and sc.type = '$pm'");

				while ($row = $con->FetchAssoc($qv) ) {
					$s = new MSuscriptores_contactos;
					$s->CreateSuscriptores_contactos("id", $row['id']);
					$sd = new MSuscriptores_contactos_direccion;
					$sd->CreateSuscriptores_contactos_direccion("id_contacto", $row['id']);

					$tipo = $this->GetDataFromTable("suscriptores_tipos", "id", $s->GetType(), "nombre", " ");

					$path .= '
							<tr>
								<td style="border-bottom:1px solid #DEDEDE;">'.$tipo.'</td>
								<td style="border-bottom:1px solid #DEDEDE;">'.$s->GetNombre().'</td>
								<td style="border-bottom:1px solid #DEDEDE;">'.$s->GetIdentificacion().'</td>
								<td style="border-bottom:1px solid #DEDEDE;">'.$sd->GetTelefonos().'</td>
							</tr>';
				}
				return $path;
				break;
			default:
				return "";
				break;
		}

	}

	function DescontarCupo($cupo, $tipo_cuenta, $add = "-"){

		global $con;
    	$field = "";

    	if ($tipo_cuenta == "cupo_negocio") {
    		$cupo_negocio = CUPONEGOCIO;
    		$field = "CUPONEGOCIO";
    	}else{
    		$cupo_negocio = CUPOCUENTA;
    		$field = "CUPOCUENTA";
    	}

    	if ($add == "add") {
    		$cupo_actual = $cupo_negocio + $cupo;
    	}else{
    		$cupo_actual = $cupo_negocio - $cupo;
    	}

    	#echo "update super_admin set $tipo_cuenta = '$cupo_actual' where id = '6'";
    	#exit;

    	$con->Query("update keywords set p_clave = '$cupo_actual' where codeword = '".$field."'");

    	#if ($_SESSION['usuario'] == 'info@laws.com.co') {
    	#	echo "update keywords set p_clave = '$cupo_actual' where codeword = '".$field."'";
    	#	exit;
    		# code...
    	#}

    	if ($cupo_actual <= "50000") {
    		$mensaje = "EL CUPO DE LA CUENTA ".HOMEDIR." ESTÁ INFERIOR A $ 50.000 CONTACTAR CON EL ADMINISTRADOR DEL NEGOCIO PARA QUE RECARGUE SU CUENTA...";
    		$this->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,"REGISTRO DE NUEVO USUARIO",$mensaje, EMAILLIMITECUPOS);
    	}

	}

}

?>