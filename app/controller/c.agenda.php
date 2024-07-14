<?php 
session_start();
date_default_timezone_set("America/Bogota");

#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'EventsM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CEvents;
	$c = new Consultas;
	$f = new Funciones;
	$au = new MAlertas_usuarios;


	include_once(VIEWS.DS.'events'.DS.'calendar.php');


	$_SESSION["helper"] = "agenda";
// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('date', 'title', 'description', 'time', 'avisar_a');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['date']), $c->sql_quote($_REQUEST['title']), $c->sql_quote($_REQUEST['description']), $c->sql_quote($_REQUEST['time']), $c->sql_quote($_REQUEST['avisar_a']));	
	// DEFINIMOS LOS ESTADOS DE SALIDA
	$output = array('registro actualizado', 'no se pudo actualizar'); 
	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
	$constrain = 'WHERE id = '.$_REQUEST['id'];

		if($c->sql_quote($_REQUEST['action']) == 'dia')
			$ob->GetDia($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), "dia");
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR			
		elseif($c->sql_quote($_REQUEST['action']) == 'mes')
			$ob->GetDia($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), "mes");
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR				
		elseif($c->sql_quote($_REQUEST['action']) == 'anho')
			$ob->GetDia($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), "anho");		
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR				
		elseif($c->sql_quote($_REQUEST['action']) == 'semana')
			$ob->GetDia($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']), "semana");				
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	
			$ob->VistaInsertar();
		// ABRIR UN EVENTO
		elseif ($c->sql_quote($_REQUEST['action'] == 'ver'))
			$ob->OpenEvent($c->sql_quote($_REQUEST['id']));
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->Insertar ($_SESSION["usuario"], $c->sql_quote($_REQUEST["date"]), $c->sql_quote($_REQUEST["title"]), $c->sql_quote($_REQUEST["description"]), $c->sql_quote($_REQUEST["added"]), "0", $c->sql_quote($_REQUEST["deadline"]), "0", $c->sql_quote($_REQUEST["time"]), $c->sql_quote($_REQUEST["proceso_id"]), "1", $c->sql_quote($_REQUEST["avisar_a"]), "0", "1", $c->sql_quote($_REQUEST["fecha_vencimiento"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output, $c->sql_quote($_REQUEST['id']));
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));	
		elseif($c->sql_quote($_REQUEST['action']) == 'listadocarpetas')	
			$ob->ListarCarpetas();
		elseif($c->sql_quote($_REQUEST['action']) ==  'listadoprocesos')
			$ob->ListarProcesos($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'getmonths')
			$ob->GetMonths($c->sql_quote($_REQUEST['prm1']), $c->sql_quote($_REQUEST['prm2']), $c->sql_quote($_REQUEST['current']), $c->sql_quote($_REQUEST['pid']), $c->sql_quote($_REQUEST['folder']), $c->sql_quote($_REQUEST['actionx']));
			#echo "llego o no llego ?";
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->GetDia('', "", "dia");			

	class CEvents extends MainController{

		function GetDia($date = "", $id = "", $action = "dia"){

			global $con;
			global $c;

			if($date == "" || $date == "today"){
				$date = date("Y-m-d");
			}
			$idx = $id;
			$arr = explode(".", $id);

			$id = $arr[0];
			$pid = $arr[1];

			//echo $date;
			$time = $date." ". date("H:i:s");
			$fecha_c = date_create($time);
			$fecha_c = date_format($fecha_c, "Y-m-d H:i:s");
			$fecha_c = strtotime($fecha_c);

			$now = $fecha_c;
			$current = mktime(0, 0, 0, date("m", $now), date("d", $now), date("Y", $now));

			if($id != ""){		

				$name = $con->Query("select * from folder where id='".$id."'");
				$nombre_folder = $con->Result($name, 0, "nom");
				$pathfolder = "
								<optgroup label='Carpeta Actual'>
									<option value='".$id."'>".$nombre_folder."</option>
									<option value='*'>Mostrar Todo</option>

								</optgroup>";
			}else{
				$pathfolder = '<option> Selecciona una Carpeta </option>';
			}

			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$pagina = $this->load_template(PROJECTNAME.ST." Eventos");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();				
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'events/default.php');	   			
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}

		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar(){
			//CARGA EL TEMPLATE
			$pagina = $this->load_template('Crear Events');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'events/FormInsertEvents.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MEvents;
			// LO CREAMOS 			
			$object->CreateEvents('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'events/FormUpdateEvents.php');		
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MEvents;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Events');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarEvents('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'events/Listar.php');	   			
					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.								 								
					$table = ob_get_clean();	
					// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																		
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				}else{
						// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																			
			   			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	
				}		
			// CARGAMOS LA PAGINA EN EL BROWSER				
			$this->view_page($pagina);
	 	}		
		// FUNCION QUE OBTIENE UNA SERIE DE DATOS Y LOS INSERTA EN LA BASE DE DATOS		
		function Insertar($user_id, $date, $title, $description, $added, $status, $deadline, $dayevent, $time, $proceso_id, $alerted, $avisar_a, $echo, $type_event, $fecha_vencimiento){
			// DEFINIENDO EL OBJETO			
			$object = new MEvents;
			global $c;
			global $f;


			$fecha_vencimiento = $date;
			$alog = $c->consultarlog();
			$log = $c->GetFechaLog();
					
			$dif = $f->Diferencia($date, $log);
			$dif = $dif + $alog;
			
			$date = $dif; 

			if ($deadline != "") {
				$deadline = 1;
			}

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertEvents($user_id, $date, $title, $description, $added, $status, $deadline, $dayevent, $time, $proceso_id, $alerted, $avisar_a, $echo, $type_event, $fecha_vencimiento);
			

			#echo $date."---";
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create == '1')
				echo "Se Guardo el evento!";
			else
				echo "No Se Guardo el evento!";

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output, $id){
			$object = new MEvents;
			$create = $object->UpdateEvents($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1'){
				$this->GetDia($dia);
			}else{
				echo ' <div class="da-message success">Evento Actualizado</div>';
				$this->OpenEvent($id);						
			}
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MEvents;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteEvents($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
		
		function GetTemplate($web){

		}	

		function ListarCarpetas(){

			global $c;
			global $con;

			echo $c->GetListadoCarpetas($_SESSION["usuario"]);

		}

		function ListarProcesos($pid){

			global $c;
			global $con;

			echo $c->GetListadoProcesos($pid, $_SESSION["usuario"]);

		}

		function Paint_Events($date, $pid, $id){
			global $con;
			$query = $this->UserEvents($date, $pid, $id);
			$i = 0;
			while ($col = $con->FetchAssoc($query)) {
				$i++;
				$result.=$this->Create_Event($col);
			}
			if ($i >= 1) {
				return $result;
			}else{
				echo "<div class='da-message info'>No hay eventos creados...</div>";
			}
		}

		function Create_Event($col){
			global $f;
			$title=($col[title]=='')?'&nbsp':$col[title];
			$today = strtotime(date('Y-m-d'));
			$datecol = strtotime($col[fecha]);
			$type = 'list';
			$line = ($col['echo']==1)?'through':'';
			if ($today < $datecol) $type = 'prox';
			if ($col[deadline]=='1') $type = 'imp';
			$dat = $f->nicetime("$col[fecha] $col[time]");
			return "
			<div class='event-body $type-act $line' style='width:95%; height:auto;'>
				
				<div class='int-event'>
						<div class='foot-event' style='margin-top:10px;'>
							<div class='opc-event' style='position:inherit; float:right'>
								<a class='rea-event opc-link' onClick='closeBox()'>Cerrar</a>
							</div>
						</div>
					<div class='title-event'>$title</div>
					<div class='franja-event'>
						<div class='desc-event' style='width:100%'>$col[description]</div>
					</div>
					<div class='foot-event' style='margin-top:10px;'>
						<div class='date-event' style='position:inherit'>A las $col[time]</div>
						<div class='opc-event' style='position:inherit'>
							<a class='rea-event opc-link' onClick='editevent(\"".$col[id]."\")'>Editar</a>
							<a class='rea-event opc-link'>Realizar</a>
							<a class='anu-event opc-link'>Anular</a>
						</div>
					</div>
				</div>
			</div>";
		}
		function OpenEvent($id){

			global $con;
			$q_str = "select * from events where user_id = '".$_SESSION['usuario']."' and id = '".$id."'";
			$query = $con->Query($q_str);
			$i = 0;
			while ($col = $con->FetchAssoc($query)) {
				$i++;
				$result.=$this->Create_Event($col);
			}
			if ($i >= 1) {
				echo $result;
			}else{
				echo "<div class='da-message info'>El evento que intenta abrir no se encuentra en la base de datos o pertenece a otro usuario</div>";
			}
		}
		function UserEvents($day, $pid = "", $folder= ""){
			global $con;
			if($pid == ""){
				$q_str = "select * from events where user_id = '".$_SESSION['usuario']."' and date = '".$day."' order by date, time";
			}else{
				if($pid == "*"){

					$q_str_folder= "select * from folder_demanda where user_id = '".$_SESSION["usuario"]."' AND folder_id ='".$folder."'";
					$query_folder = $con->Query($q_str_folder);

					$path  = "(";
					$total_rows = $con->NumRows($query_folder);
					
					for ($i=0 ; $i<$total_rows ; $i++){

						$q_str = "SELECT * FROM caratula WHERE proceso_id= '".$con->Result($query_folder, $i, 'proceso_id')."' AND user_id = '".$_SESSION["usuario"]."'";
						$queryx = $con->Query($q_str);
						if($total_rows == 1){
							$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
						}else{
							if($i == $total_rows -1){
								$path .= "proceso_id = ".$con->Result($queryx, 0, 'id');	
							}else{
								$path .= "proceso_id = ".$con->Result($queryx, 0, 'id')." OR ";	
							}
						}
					}	
					$path  .= ") AND ";
					$q_str = "select * from events where $path user_id = '".$_SESSION['usuario']."' and date = '".$day."' order by date, time";
				}else{
					$q_str = "select * from events where user_id = '".$_SESSION['usuario']."' and date = '".$day."' and proceso_id = '".$pid."' order by date, time";
				}
			}

			$query = $con->Query($q_str);
			
			return $query;
		}

		function GetMonths($see, $day, $current, $pid, $id, $action){
			$usuario = $_SESSION['usuario'];
			global $f;
			
			$prm1	=	$see;
			$prm2	=	$day;
			$fac0 	=	$prm1;

			$prevp = $prm1 - 1;
			$next  = $prm1 + 1;

			echo 
			'
				<div id="btns_agenda">
					<div class="btn_agenda prev" onClick="printMonths(\''.$prevp.'\',\''.$prm1.'\',\''.$current.'\',\''.$pid.'\',\''.$id.'\')"></div>
					<div class="btn_agenda none" onClick="printMonths(\'0\', \'0\',\''.$current.'\',\''.$pid.'\',\''.$id.'\')">'.$f->ObtenerFecha_2(date("Y-m-d")).'</div>
					<div class="btn_agenda next" onClick="printMonths(\''.$next.'\', \''.$next.'\',\''.$current.'\',\''.$pid.'\',\''.$id.'\')"></div>
					<div class="clearb"></div>			
				</div>
			';

			printmonthtable($fac0, $current, $pid, $id, $action);



		}

	}
 ?>