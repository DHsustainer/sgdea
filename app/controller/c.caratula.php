<?php
session_start();
date_default_timezone_set("America/Bogota");
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'CaratulaM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'AnexosM.php');
	include_once(MODELS.DS.'ActuacionesM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'MemorialesM.php');
	include_once(MODELS.DS.'EventsM.php');
	include_once(MODELS.DS.'CompartirM.php');
	include_once(MODELS.DS.'Demandado_procesoM.php');
	include_once(MODELS.DS.'Demandante_proceso_juridicoM.php');
	include_once(MODELS.DS.'PlantillaM.php');
	include_once(MODELS.DS.'ContactosM.php');
	include_once(MODELS.DS.'Contactos_direccionM.php');
	include_once(MODELS.DS.'Contactos_emailsM.php');
	include_once(MODELS.DS.'Contactos_telefonosM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(PLUGINS.DS.'dompdf/dompdf_config.inc.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CCaratula;
	$c = new Consultas;
	$f = new Funciones;
	$au = new MAlertas_usuarios;	
	$obj = new MCaratula;
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$_SESSION["helper"] = "caratula";
	$_SESSION["typefolder"] = "ACTIVO";

	
		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA
		if($c->sql_quote($_REQUEST['action']) == 'listar')
			$ob->VistaListar('');	
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	
			$ob->VistaInsertar_2($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'crear')	
			$ob->VistaInsertar_2($c->sql_quote($_REQUEST['id']));
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->Insertar(/*$c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["proceso_id"]), $c->sql_quote($_REQUEST["tip_demanda"]), $c->sql_quote($_REQUEST["juzgado"]), $c->sql_quote($_REQUEST["rad"]), $c->sql_quote($_REQUEST["dir_juz"]), $c->sql_quote($_REQUEST["tel_juz"]), $c->sql_quote($_REQUEST["email_juz"]), $c->sql_quote($_REQUEST["est_proceso"]), $c->sql_quote($_REQUEST["tit_demanda"]), $c->sql_quote($_REQUEST["fec_pres"]), $c->sql_quote($_REQUEST["val_demanda"]), $c->sql_quote($_REQUEST["tipo_demandante"]), $c->sql_quote($_REQUEST["fec_auto"]), $c->sql_quote($_REQUEST["num_oficio"]), $c->sql_quote($_REQUEST["contenido"]), $c->sql_quote($_REQUEST["costas"]), $c->sql_quote($_REQUEST["edit_juz"]), $c->sql_quote($_REQUEST["tracking"]), $c->sql_quote($_REQUEST["rad_completo"]), $c->sql_quote($_REQUEST["fecha_creacion"]), $c->sql_quote($_REQUEST["type_proceso"]), $c->sql_quote($_REQUEST["usuario_registra"])*/);
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		elseif ($c->sql_quote($_REQUEST['action']) == "transferircarpeta") 
			$ob->TransferirCarpeta($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['transferir']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'ver'){
			$_SESSION['typefolder'] = $c->sql_quote($_REQUEST['cn']);
			$ob->VistaListar($c->sql_quote($_REQUEST['id']), '');
			
		}
		elseif($c->sql_quote($_REQUEST['action']) == 'opcion'){
			$opc="opcion_".$_REQUEST['cn'];
			$ob->Opcion($_REQUEST[id]);
		}elseif($c->sql_quote($_REQUEST['action']) == 'exportaranexo') {
			$ob->ExportarAnexo($c->sql_quote($_REQUEST['id']));
		}elseif($c->sql_quote($_REQUEST['action']) == 'exportaranexoword') {
			$ob->ExportarAnexoWord($c->sql_quote($_REQUEST['datos_a_enviar']));
		}elseif($c->sql_quote($_REQUEST['action']) == 'updateddo') {
			$ob->UpdateDDO($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}elseif($c->sql_quote($_REQUEST['action']) == 'updatedte') {
			$ob->UpdateDDE($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}elseif($c->sql_quote($_REQUEST['action']) == 'save_demandante') {
			$ob->Save_Demandante();
		}elseif($c->sql_quote($_REQUEST['action']) == 'save_demandado') {
			$ob->Save_Demandado();
		}elseif($c->sql_quote($_REQUEST['action']) == 'save_contacto') {
			$ob->Save_contacto();
		}elseif($c->sql_quote($_REQUEST['action']) == 'delete_contacto') {

			$ob->delete_contacto($c->sql_quote($_REQUEST['id']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'mover') {
			$ob->CambiarCarpetaProceso($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'xee') {

			$st = "select * from folder";
			$q = $con->Query($st);

			while ($row = $con->FetchAssoc($q)) {
				$r = $con->Query("select a_i from usuarios where user_id = '".$row['user_id']."'");
				$rt = $con->FetchAssoc($r);
					
				$rt = $rt["a_i"];

				if($rt != ''){
					$pp = $f->zerofill($rt, 4);
					$fp = $f->zerofill($row['id'], 4);
					$un = $pp.$fp;
					$pw = $f->GenerarSmallId();
					$dc = md5($pw);
					$str = "UPDATE folder SET cod_ingreso = '".$un."', password =  '".$dc."', dec_pass='".$pw."' where id = '".$row['id']."'";
					
					/*
						$query = $con->Query($str);
						if (!$query) {
							echo "$row[id] ok!; <br>";
						}else{
							echo "$row[id] false!; <br>";
						}
					*/
				}
			}

		}
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CCaratula extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar($id='', $cn = "ACTIVO"){
			// CREANDO UN NUEVO MODELO			
			$object = new MCaratula;
			$folder = new MFolder;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f; 
			global $c;
			$cn = $_SESSION['typefolder'];
			if (isset($_POST[submit])) {
				switch ($_POST[submit]) {
					case 'Transferir':
						$object->CreateCaratula("id", $_POST[proceso_id]);
						$new_us=$_POST[transferir];
						$new_id=$con->Result($con->Query("SELECT * from caratula where user_id = '$new_us' order by proceso_id desc limit 0,1"),0,'proceso_id')+1;
						$query=$con->Query("SELECT * from folder where nom='Procesos Transferidos' and user_id = '$new_us'");
						if($con->NumRows($query)>0){
							$new_folder=$con->Result($query,0,'id');
						}else{
							$new_folder=$con->Query("INSERT into folder(user_id,nom) values('$new_us','Procesos Transferidos')",'insert');
							$con->Query("INSERT into folder_demandante_proceso (user_id,p_nombre,id_folder) values('$new_us','Procesos Transferidos','$new_folder')");
						}
						$query=$con->Query("SELECT * from abonos_img where id = '$_POST[proceso_id]'");
						$this->copy_paste($query,'nom_img','abonos',$new_us);
						$query=$con->Query("SELECT * from gastos_img where id = '$_POST[proceso_id]'");
						$this->copy_paste($query,'nom_img','gastos',$new_us);
						$query=$con->Query("SELECT * from anexos where id = '$_POST[proceso_id]' and estado = '1'");
						$this->copy_paste($query,'nom_img','anexos',$new_us);
						$con->Query("UPDATE folder_demanda 	set user_id = '$new_us',proceso_id='$new_id',folder_id='$new_folder' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE caratula 		set user_id = '$new_us',proceso_id='$new_id' where id = '$_POST[proceso_id]'");
						$con->Query("UPDATE abonos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE abonos_img 		set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE actuaciones 	set user_id = '$new_us', where proceso_id = '$_POST[proceso_id]'");
						$con->Query("UPDATE anexos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE gastos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE gastos_img  	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE memoriales  	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
#						$con->Query("UPDATE notificaciones 	set user_id = '$new_us',proceso_id='$new_id' where id = '$_POST[proceso_id]'");
						$con->Query("UPDATE notas 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE demandado_proceso 	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE demandante_proceso_juridico 	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");

						$con->Query("INSERT into trasabilidad_transferencia (proceso,usuario_i,usuario_f,fecha) values('$_POST[proceso_id]','$_SESSION[usuario]','$new_us','".date('Y-m-d H:i:s')."')");
					
						global $c;
						$c->Insert_Event(	$proceso_id,
											'Tansferencia de Proceso',
											"Se ha transferido proceso: <a href=\'/caratula/opcion/$proceso_id/ver/\' class=\'link_event\'>$_POST[titulo]</a>",
											'1',
											'1');

						$c->Insert_Event(	$proceso_id,
											'Tansferencia de Proceso',
											"Se ha transferido proceso: <a href=\'/caratula/opcion/$proceso_id/ver/\' class=\'link_event\'>$_POST[titulo]</a>",
											'1',
											'1');

						$q = $con->FetchAssoc($con->Query("select p_nombre, p_apellido from usuarios where user_id = '$new_us'"));
						$uq = $con->FetchAssoc($con->Query("select p_nombre, p_apellido from usuarios where user_id = '".$_SESSION['nombre']."'"));

						$mail = new PHPMailer;
						$mail->Host = "Carpeta Ciudadana";
						$mail->From = $_SESSION["usuario"];
						$mail->FromName =  $uq['p_nombre']." ".$uq['p_apellido'];
						$mail->Subject = "Se ha transferido un proceso a su cuenta";
						$mail->ConfirmReadingTo = $_SESSION["usuario"];

						$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
									<p>El usuario ".$uq['p_nombre']." ".$uq['p_apellido']." le ha transferido a su cuenta el proceso ".$object->GetTit_demanda()."</p>
									<p><b>Fecha de transferencia: </b>".date("d-m-Y h:i:s a")."</p>";
						$mail->IsHTML(true);
						
						$bodymessage = $f->BodyMail($body);
						$mail->Body = $bodymessage;
						$mail->AddAddress($new_us);
						$mail->Send();

						break;
					
					default:
						# code...
						break;
				}
			}
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Caratula');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $folder->ListarFolder("WHERE user_id='$_SESSION[usuario]' and id <> '$id'", 'order by nom asc');
			$unique = $folder->ListarFolder("WHERE id = '$id'", 'order by fecha desc');
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			if($con->NumRows($query) <= 0 || $query !=''){
				
				# INICIO DE PAGINADOR 
				# DEFINICION DE RESULTADOS QUE SE MUESTRAN
				$RegistrosAMostrar = 20;
				if(isset($_GET['p1'])){
					$RegistrosAEmpezar=($_GET['p1']-1)*$RegistrosAMostrar;
					$PagAct=$_GET['p1'];
				//caso contrario los iniciamos
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
					
				}	
				#FIN DE DEFINICION DE PAGINAS	

				$type=($id==0)?1:0;
				$unique = $folder->Create_List($unique,$type);
		   		$result = $folder->Create_List($query);
		   		$query = ($id==0)
		   		?$object->ListarCaratula("c,compartir fd where fd.compartir = '$_SESSION[usuario]' and c.id=fd.pid and c.user_id=fd.user_id","order by fd.id", "limit $RegistrosAEmpezar, $RegistrosAMostrar")
		   		:$object->ListarCaratula("c,folder f,folder_demanda fd where fd.folder_id=f.id and fd.user_id = '$_SESSION[usuario]' and c.proceso_id=fd.proceso_id and fd.user_id=c.user_id and f.id='$id'",' order by fd.fecha desc', "limit $RegistrosAEmpezar, $RegistrosAMostrar");
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){

		   			$proces = $object->Create_Lista($query,$type, $cn);
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA


					include_once(VIEWS.DS.'caratula/Listar.php');




					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
					$table = ob_get_clean();	
					// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
					if($message != '')
					$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);
					// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				}else{
					// SI NO SE EJECUTA LA CONSULTA ENTONCES GENERA MENSAJE DE ERROR
		   			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	
				}
			}else{$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	}
			$this->view_page($pagina);
		}
		function copy_paste($query,$ruta,$tipo,$new_us){
			global $con;
			if ($con->NumRows($query)>0) {
				while ($col=$con->FetchAssoc($query)) {
					$filename=UPLOADS."/$new_us/";
					if (!file_exists($filename)) {
					    mkdir(UPLOADS."/$new_us", 0777);
					}
					$filename=UPLOADS."/$new_us/$tipo/";
					if (!file_exists($filename)) {
					    mkdir(UPLOADS."/$new_us/$tipo", 0777);
					}
					@copy(UPLOADS.DS.$_SESSION[usuario].DS.$tipo.DS.$col[$ruta], UPLOADS.DS.$new_us.DS.$tipo.DS.$col[$ruta]);
				}
			}				
		}
		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar($id=''){
			// RETORNAME LA PAGINA CARGADA		
			//CARGA EL TEMPLATE
			$object2 = new MPlantilla;
			$query2 = $object2->ListarPlantilla("WHERE user_id = '$_SESSION[usuario]'");	
			$object = new MCaratula;
			$folder = new MFolder;
			$pagina = $this->load_template('Crear Caratula');
			global $f;
			global $con;
			$query = $con->Query("SELECT * FROM juzgados where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$juzgados=$f->Create_Select($query,'nom','nom');
			$query = $con->Query("SELECT * FROM demandas where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$demandas=$f->Create_Select($query,'nom','nom');
			$query = $con->Query("SELECT * FROM folder where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$folders=$f->Create_Select($query,'id','nom',$_REQUEST[id]);
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			$query = $folder->ListarFolder("WHERE user_id='$_SESSION[usuario]' and id <> '$id'", 'order by fecha desc');
			$unique = $folder->ListarFolder("WHERE id = '$id'", 'order by fecha desc');	
			$unique = $folder->Create_List($unique);
		   	$result = $folder->Create_List($query);
			ob_start();
			include_once(VIEWS.DS.'caratula/FormInsertCaratula.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		function VistaInsertar_2($id=''){
			//CARGA EL TEMPLATE
			$object2 = new MPlantilla;
			$query2 = $object2->ListarPlantilla("WHERE user_id = '$_SESSION[usuario]'");	
			$object = new MCaratula;
			$folder = new MFolder;
			$pagina = $this->load_template('Crear Caratula');
			global $f;
			global $con;
			$query = $con->Query("SELECT * FROM juzgados where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$juzgados=$f->Create_Select($query,'nom','nom');
			$query = $con->Query("SELECT * FROM demandas where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$demandas=$f->Create_Select($query,'nom','nom');
			$query = $con->Query("SELECT * FROM folder where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$folder->CreateFolder("id", $id);
			$folders= $folder->GetNom();
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			$query = $folder->ListarFolder("WHERE user_id='$_SESSION[usuario]' and id <> '$id'", 'order by fecha desc');
			$unique = $folder->ListarFolder("WHERE id = '$id'", 'order by fecha desc');	
			$unique = $folder->Create_List($unique);
		   	$result = $folder->Create_List($query);
			ob_start();
			include_once(VIEWS.DS.'caratula/NewInsertCaratula.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template('Editar Caratula');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MCaratula;
			// LO CREAMOS 			
			$object->CreateCaratula('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'caratula/FormUpdateCaratula.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MCaratula;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Caratula');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarCaratula('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'caratula/Listar.php');	   			
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
		function Insertar(/*$user_id, $proceso_id, $tip_demanda, $juzgado, $rad, $dir_juz, $tel_juz, $email_juz, $est_proceso, $tit_demanda, $fec_pres, $val_demanda, $tipo_demandante, $fec_auto, $num_oficio, $contenido, $costas, $edit_juz, $tracking, $rad_completo, $fecha_creacion, $type_proceso, $usuario_registra*/){
			
			global $con;
			$proceso_id = $con->Query("SELECT * from caratula where user_id = '$_SESSION[usuario]' order by proceso_id desc limit 0,1");
			$proceso_id = $con->Result($proceso_id,0,'proceso_id') + 1 ;
			$str = "	INSERT into caratula
							(user_id, proceso_id, tip_demanda, juzgado, rad, dir_juz, tel_juz, email_juz, 
								est_proceso, tit_demanda, fec_pres, val_demanda, tipo_demandante, fec_auto, 
								num_oficio, contenido, costas, edit_juz, tracking, rad_completo, fecha_creacion, 
								type_proceso, usuario_registra, ciudad, departamento)
							values ('$_SESSION[usuario]','$proceso_id','$_POST[tip_demanda]','$_POST[juzgado]','$_POST[rad]','$_POST[dir_juz]','$_POST[tel_juz]','$_POST[email_juz]',
								'$_POST[est_proceso]','$_POST[tit_demanda]','$_POST[fec_pres]','$_POST[val_demanda]',
								'','$_POST[fec_auto]', '$_POST[num_oficio]','','','','','$_POST[rad_completo]','".date('Y-m-d')."', '',NULL,'$_POST[ciudad]','$_POST[departamento]')";
			$con->Query($str);
		
			$con->Query("	INSERT into folder_demanda (user_id,folder_id,proceso_id,fecha) values('$_SESSION[usuario]','$_POST[folder_id]','$proceso_id','".date('Y-m-d')."')");
			
			global $c;
			$c->Insert_Event(	$proceso_id,
								'Creación de Proceso',
								"Se ha creado un nuevo proceso: <a href=\'/caratula/opcion/$proceso_id/ver/\' class=\'link_event\'>$_POST[titulo]</a>",
								'1',
								'1');
			
				$con->Query("	INSERT into demandante_proceso_juridico
								(user_id, proceso_id, nom_entidad, nit_entidad, dir_entidad, ciu_entidad, 
								p_nom_repres, ciu_repres, email_repres,	telefonos, exp_identificacion)
								values ('$_SESSION[usuario]','$proceso_id','".$_POST[demj_nombre]."','".$_POST[demj_id]."','".$_POST[demj_direccion]."','".$_POST[demj_ciudad]."',
								'".$_POST[demj_nombrer]."','".$_POST[demj_ciur]."','".$_POST[demj_mail]."','".$_POST[demj_tel]."','".$_POST[demj_exp]."')");
			$id = $c->GetMaxIdTabla("caratula", "id");

			#echo "ok!";
			echo '<script> window.location.href = "'.HOMEDIR.'/caratula/opcion/'.$id.'/ver/'.'"</script>';
			# header("location:".");
			#$this->VistaListar($_POST[folder_id]);
			
			/*// DEFINIENDO EL OBJETO			
			$object = new MCaratula;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertCaratula($user_id, $proceso_id, $tip_demanda, $juzgado, $rad, $dir_juz, $tel_juz, $email_juz, $est_proceso, $tit_demanda, $fec_pres, $val_demanda, $tipo_demandante, $fec_auto, $num_oficio, $contenido, $costas, $edit_juz, $tracking, $rad_completo, $fecha_creacion, $type_proceso, $usuario_registra);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');	*/

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MCaratula;
			return $object->UpdateCaratula($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK					
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MCaratula;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteCaratula($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
		function Opcion($id){
			$object = new MCaratula;
			$folder = new MFolder;
			global $con;
			global $c;
			global $f;			
			$proceso=$con->Query("SELECT * from caratula where id = '$id'");
			if ($con->NumRows($proceso)>0) {

				$proceso_id=$con->Result($proceso,0,'proceso_id');
				$pid=$con->Result($proceso,0,'id');
				$user_id=$con->Result($proceso,0,'user_id');
				$compartir = $con->NumRows($con->Query("SELECT * from compartir where compartir = '$_SESSION[usuario]' and user_id = '$user_id' and proceso_id = '$proceso_id'"));

				if ($_SESSION[sadmin]==1 || $_SESSION["usuario"] != $user_id){
					$color = "1";
				}
				if ($_SESSION['folder'] != '') {
					$color = "2";
				}
				
				if ($_SESSION[usuario]==$user_id || $compartir > 0){
					$rand = md5(date('Y-m-d').rand().$_SESSION[usuario]);
					switch ($_REQUEST[cn]) {
						case 'editar':
							if (isset($_POST[tit_demanda])) {

/*
tit_demanda		juzgado 	dir_juz 	tel_juz 	email_juz 	tip_demanda 	rad_completo 	rad 	val_demanda
fec_pres 	fec_auto 	num_oficio 		est_proceso
*/	
								$tit_demanda 	= $c->sql_quote($_POST[tit_demanda]);
								$juzgado 		= $c->sql_quote($_POST[juzgado]);
								$dir_juz 		= $c->sql_quote($_POST[dir_juz]);
								$tel_juz 		= $c->sql_quote($_POST[tel_juz]);
								$email_juz 		= $c->sql_quote($_POST[email_juz]);
								$tip_demanda	= $c->sql_quote($_POST[tip_demanda]);
								$rad 			= $c->sql_quote($_POST[rad]);
								$rad_completo 	= $c->sql_quote($_POST[rad_completo]);
								$costas 		= $c->sql_quote($_POST[val_demanda]);
								$f_auto 		= $c->sql_quote($_POST[fec_auto]);
								$f_pres 		= $c->sql_quote($_POST[fec_pres]);
								$oficio 		= $c->sql_quote($_POST[num_oficio]);
								$est_proceso	= $c->sql_quote($_POST[est_proceso]);
								$ciudad 		= $c->sql_quote($_POST[ciudad]);
								$departamento	= $c->sql_quote($_POST[departamento]);

								$car = new MCaratula;
							    $car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$proceso_id."'");	
							#	$pid = $car->GetId();	

					
								$path = "";
				        		$change = false;
				        		if($car->GetTit_demanda() != $tit_demanda){
				        			$path .= "<li>Se edito el campo 'Titulo del Proceso' de '".$car->GetTit_demanda()."' por '$tit_demanda' </li>";
				        			$change = true;
				        		}
				        		if($car->GetJuzgado() != $juzgado){
				        			$path .= "<li>Se edito el campo 'Entidad' de '".$car->GetJuzgado()."' por '$juzgado' </li>";
				        			$change = true;
				        		}
				        		if($car->GetDir_juz() != $dir_juz){
				        			$path .= "<li>Se edito el campo 'Direccion de Entidad' de '".$car->GetDir_juz()."' por '$dir_juz' </li>";
				        			$change = true;
				        		}
				        		if($car->GetTel_juz() != $tel_juz){
				        			$path .= "<li>Se edito el campo 'Telefono de Entidad' de '".$car->GetTel_juz()."' por '$tel_juz' </li>";
				        			$change = true;
				        		}
				        		if($car->GetEmail_juz() != $email_juz){
				        			$path .= "<li>Se edito el campo 'Email del Entidad' de '".$car->GetEmail_juz()."' por '$email_juz' </li>";
				        			$change = true;
				        		}
				        		if($car->GetTip_demanda() != $tip_demanda){
				        			$path .= "<li>Se edito el campo 'Naturaleza del proceso de' ".$car->GetTip_demanda()."' por '$tip_demanda' </li>";
				        			$change = true;
				        		}
				        		if($car->GetRad() != $rad){
				        			$path .= "<li>Se edito el campo 'Radicado' de '".$car->GetRad()."' por '$rad' </li>";
				        			$change = true;
				        		}
				        		if($car->GetRad_completo() != $rad_completo){
				        			$path .= "<li>Se edito el campo 'Radicado Completo' de '".$car->GetRad_completo()."' por '$rad_completo' </li>";
				        			$change = true;
				        		}
				        		if($car->GetVal_demanda() != $costas){
				        			$path .= "<li>Se edito el campo 'Valor del Proceso' de '".$car->GetVal_demanda()."' por '$costas' </li>";
				        			$change = true;
				        		}
				        		if($car->GetFec_pres() != $f_pres){
				        			$path .= "<li>Se edito el campo 'Fecha de Presentación' de '".$car->GetFec_pres()."' por '$f_pres' </li>";
				        			$change = true;
				        		}
				        		if($car->GetFec_auto() != $f_auto){
				        			$path .= "<li>Se edito el campo 'Fecha de Auto' de '".$car->GetFec_auto()."' por '$f_auto' </li>";
				        			$change = true;
				        		}
				        		
				        		if($car->GetNum_oficio() != $oficio){
				        			$path .= "<li>Se edito el campo 'Numero de Oficio' de '".$car->GetNum_oficio()."' por '$oficio' </li>";
				        			$change = true;
				        		}
				        		if($car->GetEst_proceso() != $est_proceso){
				        			$path .= "<li>Se edito el campo 'Estado del Proceso' de '".$car->GetEst_proceso()."' por '$est_proceso' </li>";
				        			$change = true;
				        		}

				        		if($car->GetCiudad() != $ciudad){
				        			$path .= "<li>Se edito el campo 'ciudad' de '".$car->GetCiudad()."' por '$ciudad' </li>";
				        			$change = true;
				        		}
				        		if($car->GetDepartamento() != $departamento){
				        			$path .= "<li>Se edito el campo 'Departamento' de '".$car->GetDepartamento()."' por '$departamento' </li>";
				        			$change = true;
				        		}

	        					if($change){

	        						$ar2 = array(	'tit_demanda', 'juzgado', 'dir_juz', 'tel_juz', 'email_juz','tip_demanda', 'rad_completo', 'rad', 'val_demanda', 'fec_pres', 'fec_auto', 'num_oficio', 'est_proceso', 'fecha_actualizacion', 'ciudad', 'departamento');
									$ar1 = array(	$tit_demanda, $juzgado, $dir_juz, $tel_juz, $email_juz, $tip_demanda, $rad_completo, $rad, $costas, $f_pres, $f_auto, $oficio, $est_proceso, date("Y-m-d H:i:s"), $ciudad, $departamento);
									$output = array('registro actualizado', 'no se pudo actualizar'); 
									$constrain = "WHERE proceso_id = '$proceso_id' and user_id = '$user_id'";
									$msg=$this->Editar($constrain, $ar2, $ar1, $output);


									if ($compartir>0) {
										$c->Insert_Event(	$pid,
															'Edición de Proceso',
															"El usuario $_SESSION[usuario] ha editado <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>",
															'1',
															'1',
															$color, $user_id);

										$c->Insert_Event(	$pid,
															'Edición de Proceso',
															"Se ha editado <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>",
															'1',
															'1');
									}else{
										$c->Insert_Event(	$pid,
															'Edición de Proceso',
															"Se ha editado <ul>".$c->sql_quote($path)."</ul> En el proceso: <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>",
															'1',
															'1');
									}
								}
								$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha realizado una actualizacion en el proceso ".$con->Result($proceso,0,'tit_demanda')." <br></p>
													<p>Se ha actualizado <ul>".$c->sql_quote($path)."</ul></p>
													";


										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha realizado una actualizacion en el proceso ".$con->Result($proceso,0,'tit_demanda')." <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}

							}
							break;
						case 'documentos':
							if (isset($_POST[submit])) {
								if ($_POST[submit]=='Editar') {
									$con->Query("UPDATE memoriales set nombre='$_POST[nombre]',contenido='".htmlentities(str_replace("'", "\\'", $_POST[descripcion]))."',f_actualizacion='".date('Y-m-d H:i:s')."' where id='$_REQUEST[p1]'");
									
									$car = new MCaratula;
									$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$proceso_id."'");	
									$pid = $car->GetId();

									if ($compartir>0) {
										$c->Insert_Event(	$pid,
															'Edición de Documento',
															"El usuario $_SESSION[usuario] ha editado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1',
															$color, $user_id);

										$c->Insert_Event(	$pid,
															'Edición de Documento',
															"Se ha editado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1');
									}else{
										$c->Insert_Event(	$pid,
															'Edición de Documento',
															"Se ha editado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1');
									}
								}else{
									$con->Query("INSERT into memoriales (user_id,proceso_id,nombre,f_creacion,contenido) 
												values('$user_id','$proceso_id','$_POST[nombre]','".date('Y-m-d H:i:s')."','".htmlentities(str_replace("'", "\\'", "".$_POST[descripcion]))."')");
									
									if ($compartir>0) {
										$c->Insert_Event(	$pid,
															'Creación de Documento',
															"El usuario $_SESSION[usuario] ha creado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1',
															$color, $user_id);

										$c->Insert_Event(	$pid,
															'Creación de Documento',
															"Se ha creado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1');
									}else{
										$c->Insert_Event(	$pid,
															'Creación de Documento',
															"Se ha creado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1');
									}
									/*
									$c->Insert_Event(	$pid,
														'Creación de Documento',
														"Se ha creado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
														'1',
														'1');*/
								}

								$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha creado un documento oficial titulado: ".$_POST['nombre']." <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha creado un documento oficial titulado: ".$_POST['nombre']." <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
							}
							break;
						case 'subir_anexo':

							$us = new MUsuarios;
							$us->CreateUsuarios("user_id", $_SESSION['usuario']);

							$upfls = 0;
							if ($_SESSION['c_anexos'] == "0") {
								$upfls = 1;
							}elseif($us->GetTotalAnexos() < $_SESSION['c_anexos']){
								$upfls = 1;
							}else{
								$upfls = 0;
							}
				
							if ($upfls == "1") {

								$car = new MCaratula;
								$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$proceso_id."'");	

								$fol = $car->GetTotalAnexosProcesos($proceso_id);
								$fol += 1;
								$filename=UPLOADS.DS.$user_id.'/';
								if (!file_exists($filename)) {
								    mkdir(UPLOADS.DS . $user_id, 0777);
								}
								$filename=UPLOADS.DS.$user_id.'/anexos/';
								if (!file_exists($filename)) {
								    mkdir(UPLOADS.DS . $user_id.'/anexos', 0777);
								}
								if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
									if(move_uploaded_file($_FILES['upl']['tmp_name'], UPLOADS.DS.$user_id.'/anexos/'.$rand.'_'.$_FILES['upl']['name'])){
										$con->Query("INSERT into anexos (proceso_id,nom_palabra,nom_img,user_id, ip, fecha, hora, folio) values ('$proceso_id','".$_FILES['upl']['name']."','".$rand.'_'.$_FILES['upl']['name']."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."')");
										
										global $c;

	/*									$c->Insert_Event(	$id,
															'Carga de Anexo',
															"Se ha cargado un anexo en <a href=\'/caratula/opcion/$id/anexos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1', $color);
	*/
										if ($compartir>0) {
											$c->Insert_Event(	$pid,
																'Carga de Anexo',
																"El usuario $_SESSION[usuario] ha cargado un anexo en <a href=\'/caratula/opcion/$id/anexos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
																'1',
																'1',
																$color, $user_id);

											$c->Insert_Event(	$pid,
																'Carga de Anexo',
																"Se ha cargado un anexo en <a href=\'/caratula/opcion/$id/anexos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
																'1',
																'1');
										}else{
											$c->Insert_Event(	$pid,
																'Carga de Anexo',
																"Se ha cargado un anexo en <a href=\'/caratula/opcion/$id/anexos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
																'1',
																'1');
										}


									$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
									$st = $con->Query($strx);
	#								echo $strx;								
									while ($rst = $con->FetchAssoc($st)) {
										$em = explode(",", $rst["email_repres"]);
										for ($k=0; $k < count($em); $k++) { 
											$mail = new PHPMailer;
											$mail->Host = "Carpeta Ciudadana";
											$mail->From = $_SESSION["usuario"];
											$mail->FromName =  $_SESSION['nombre'];
											$mail->Subject = $subject;
											$mail->ConfirmReadingTo = $_SESSION["usuario"];

											$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
														<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
														<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
														<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

														<p> Sr./Sra. <br> Se han cargado anexos al proceso <br></p>";

											$mail->IsHTML(true);
											
											$bodymessage = $f->BodyMail($body);

											#echo $bodymessage;

											$mail->Body = $bodymessage;
											$mail->AddAddress($em[$k]);
											$mail->Send();
										}	

									}
									$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
									$st = $con->Query($strx);
	#								echo $strx;								
									while ($rst = $con->FetchAssoc($st)) {
										$em = explode(",", $rst["email"]);
										for ($k=0; $k < count($em); $k++) { 
											$mail = new PHPMailer;
											$mail->Host = "Carpeta Ciudadana";
											$mail->From = $_SESSION["usuario"];
											$mail->FromName =  $_SESSION['nombre'];
											$mail->Subject = $subject;
											$mail->ConfirmReadingTo = $_SESSION["usuario"];

											$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
														<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
														<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
														<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

														<p> Sr./Sra. <br> Se han cargado anexos al proceso <br></p>";

											$mail->IsHTML(true);
											
											$bodymessage = $f->BodyMail($body);

											#echo $bodymessage;

											$mail->Body = $bodymessage;
											$mail->AddAddress($em[$k]);
											$mail->Send();
										}	

									}

										exit;
									}
								}
							}
							break;
						case 'guardar_nota':
								global $c;
							if ($_POST[id_nota] == "") {
								$con->Query("INSERT into notas (user_id,proceso_id,titulo,descripcion,fecha_creacion)
										values ('$user_id',$proceso_id,'$_POST[title_nota]','".str_replace("'", "\\'", $_POST[summernote_nota])."','".date('Y-m-d H:i:s')."')");

								if ($compartir>0) {
									$c->Insert_Event(	$pid,
														'Nota Creada',
														"El usuario $_SESSION[usuario] ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1',
														$color, $user_id);

									$c->Insert_Event(	$pid,
														'Nota Creada',
														"Se ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1');
								}else{
									$c->Insert_Event(	$pid,
														'Nota Creada',
														"Se ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1');
								}
								echo "	<script>
											window.location.href = '".HOMEDIR."/caratula/opcion/".$id."/notas/';
										</script>";

							}else{
								$con->Query("UPDATE notas set titulo = '".$_POST[title_nota]."', descripcion = '".$c->sql_quote($_POST[summernote_nota])."' WHERE id = '".$_POST['id_nota']."'");
								/*$c->Insert_Event(	$id,
													'Nota Actualzada',
													"Se ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
													'1',
													'1');	*/

								if ($compartir>0) {
									$c->Insert_Event(	$pid,
														'Nota Actualzada',
														"El usuario $_SESSION[usuario] ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1',
														$color, $user_id);

									$c->Insert_Event(	$pid,
														'Nota Actualzada',
														"Se ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1');
								}else{
									$c->Insert_Event(	$pid,
														'Nota Actualzada',
														"Se ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1');
								}																				
							}
							echo "	<script>
										window.location.href = '".HOMEDIR."/caratula/opcion/".$id."/notas/';
									</script>";
							#header("location:".HOMEDIR."/caratula/opcion/$id/notas/");
							break;
						case 'guardar_abono':
							$con->Query("INSERT into abonos (user_id,proceso_id,motivo,valor,fecha)
									values ('$user_id',$proceso_id,'$_POST[motivo]','$_POST[valor])','$_POST[fecha]')");
							global $c;
							$car = new MCaratula;
							$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$proceso_id."'");	
							$pid = $car->GetId();

							if ($compartir>0) {
								$c->Insert_Event(	$pid,
													'Abono Guardado',
													"El usuario $_SESSION[usuario] ha guardado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
													'1',
													'1',
													$color, $user_id);

								$c->Insert_Event(	$pid,
													'Abono Guardado',
												"Se ha guardado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
													'1',
													'1');
							}else{
								$c->Insert_Event(	$pid,
													'Abono Guardado',
												"Se ha guardado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
													'1',
													'1');
							}			


								$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha registrado un abono en el proceso<br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha registrado un abono en el proceso<br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}

							echo "	<script>
									window.location.href = '".HOMEDIR."/caratula/opcion/".$id."/abonos/';
								</script>";
							#header("location:".HOMEDIR."/caratula/opcion/$id/abonos/");
							break;
						case 'subir_abono':
							$filename=UPLOADS.DS.$user_id.'/';
							if (!file_exists($filename)) {
							    mkdir(UPLOADS.DS . $user_id, 0777);
							}
							$filename=UPLOADS.DS.$user_id.'/abonos/';
							if (!file_exists($filename)) {
							    mkdir(UPLOADS.DS . $user_id.'/abonos', 0777);
							}
							if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
								if(move_uploaded_file($_FILES['upl']['tmp_name'], UPLOADS.DS.$user_id.'/abonos/'.$rand.'_'.$_FILES['upl']['name'])){
									$con->Query("INSERT into abonos_img (proceso_id,nom_palabra,nom_img,user_id) values ('$proceso_id','".$_FILES['upl']['name']."','".$rand.'_'.$_FILES['upl']['name']."','$user_id')");
									global $c;
									if ($compartir>0) {
										$c->Insert_Event(	$pid,
															'Abono Cargado',
															"El usuario $_SESSION[usuario] ha cargado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1',
															$color, $user_id);

										$c->Insert_Event(	$pid,
															'Abono Cargado',
															"Se ha cargado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1');
									}else{
										$c->Insert_Event(	$pid,
															'Abono Cargado',
															"Se ha cargado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1');
									}			


									$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado soportes de abonos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado soportes de abonos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}

									exit;
								}
							}
							break;
						case 'guardar_gasto':
							$con->Query("INSERT into gastos (user_id,proceso_id,motivo,valor,fecha)
									values ('$user_id',$proceso_id,'$_POST[motivo]','$_POST[valor])','$_POST[fecha]')");
							global $c;
			
								if ($compartir>0) {
									$c->Insert_Event(	$pid,
														'Gasto Guardado',
														"El usuario $_SESSION[usuario] ha guardado un gasto en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
														'1',
														'1',
														$color, $user_id);

									$c->Insert_Event(	$pid,
														'Gasto Guardado',
														"Se ha guardado un gasto en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
														'1',
														'1');
								}else{
									$c->Insert_Event(	$pid,
														'Gasto Guardado',
														"Se ha guardado un gasto en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
														'1',
														'1');
								}

								$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado gastos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado gastos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
							echo "	<script>
								window.location.href = '".HOMEDIR."/caratula/opcion/".$id."/gastos/';
							</script>";
							#header("location:".HOMEDIR."/caratula/opcion/$id/gastos/");
							break;
						case 'subir_gasto':
							$filename=UPLOADS.DS.$user_id.'/';
							if (!file_exists($filename)) {
							    mkdir(UPLOADS.DS . $user_id, 0777);
							}
							$filename=UPLOADS.DS.$user_id.'/gastos/';
							if (!file_exists($filename)) {
							    mkdir(UPLOADS.DS . $user_id.'/gastos', 0777);
							}
							if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
								if(move_uploaded_file($_FILES['upl']['tmp_name'], UPLOADS.DS.$user_id.'/gastos/'.$rand.'_'.$_FILES['upl']['name'])){
									$con->Query("INSERT into gastos_img (proceso_id,nom_palabra,nom_img,user_id) values ('$proceso_id','".$_FILES['upl']['name']."','".$rand.'_'.$_FILES['upl']['name']."','$user_id')");
									global $c;
									$car = new MCaratula;
									$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$proceso_id."'");	
									$pid = $car->GetId();

									if ($compartir>0) {
										$c->Insert_Event(	$pid,
															'Gasto Cargado',
												"El usuario $_SESSION[usuario] ha cargado un gasto en <a href=\'/caratula/opcion/$proceso_id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1',
															$color, $user_id);

										$c->Insert_Event(	$pid,
															'Gasto Cargado',
												"Se ha cargado un gasto en <a href=\'/caratula/opcion/$proceso_id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1');
									}else{
										$c->Insert_Event(	$pid,
															'Gasto Cargado',
												"Se ha cargado un gasto en <a href=\'/caratula/opcion/$proceso_id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1');
									}

										$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado soportes de gastos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado soportes de gastos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
									exit;
								}
							}
							break;
						case 'nom_anexo':
							$con->Query("UPDATE anexos set nom_palabra = '$_POST[name]' where id = '$_POST[id_anexo]'");
							exit;
							break;
						case 'get_nota':
							$query=$con->Query("SELECT * from notas where id = '$_POST[id_nota]'");
							$array[texto]=$con->Result($query,0,'descripcion');
							$array[title]=$con->Result($query,0,'titulo');
							$array[id]=$con->Result($query,0,'id');
							echo json_encode($array);
							exit;
							break;
						case 'actuaciones':
							global $c;
							global $f;
							if (isset($_POST[form-control])) {

								$car = new MCaratula;
								$car->CreateCaratula_by_Proceso("id = '".$_GET['id']."'");	
								$pid = $car->GetId();	

								$con->Query("INSERT into actuaciones (user_id,proceso_id,act,fecha,estado_actuacion)
												values ('".$car->GetUser_id()."','$pid','$_POST[form-control]','$_POST[fecha_act]','$_POST[alerta_act]')");

								$e = new MEvents;

								$alog = $c->consultarlog();
								$log = $c->GetFechaLog();
										
								$dif = $f->Diferencia($_POST['fecha_act'], $log);
								$dif = $dif + $alog;
								
								$date = $dif; 

								$descripcion = $c->sql_quote("En el proceso <a href='/caratula/opcion/".$pid."/actuaciones/' class='link_event'>".$con->Result($proceso,0,'tit_demanda')."</a> ".$_POST['form-control']);

								#$e->InsertEvents($_SESSION['usuario'],$date,"Se ha creado una actuacion",$descripcion, $c->consultarlog(), 0, 0, 0, date("H:i:s"), $pid, 0, $_POST[alerta_act], 0, 0, $date);
								
								if ($compartir>0) {
									$e->InsertEvents($_SESSION['usuario'],$date,"Se ha creado una actuacion",$descripcion, $c->consultarlog(), 0, 0, 0, date("H:i:s"), $pid, 0, $_POST[alerta_act], 0, 0, $date);
									$e->InsertEvents($user_id,			$date,"El usuario $_SESSION[usuario] ha creado una actuacion",$descripcion, $c->consultarlog(), 0, 1, 0, date("H:i:s"), $pid, 0, $_POST[alerta_act], 0, 0, $date);
									
								}else{
									$e->InsertEvents($_SESSION['usuario'],$date,"Se ha creado una actuacion",$descripcion, $c->consultarlog(), 0, 0, 0, date("H:i:s"), $pid, 0, $_POST[alerta_act], 0, 0, $date);
								}

								$this->SendMailGroup("Se ha creado una actuacion: ",$descripcion, "Se ha creado una actuación", $pid, $con->Result($proceso,0,'tit_demanda'));

						

							}							
							break;
						default:
							# code...
							break;
					}
					$unique = $con->Query("SELECT f.* from folder f, folder_demanda fd where f.id = fd.folder_id and fd.proceso_id = '$proceso_id' and fd.user_id = '$user_id'");
					$type = ($compartir>0)?1:0;
					$unique = $folder->Create_List($unique,$type);
			   		$query = $object->ListarCaratula("c,folder f,folder_demanda fd where fd.folder_id=f.id and fd.user_id = '$user_id' and c.proceso_id=fd.proceso_id and fd.user_id=c.user_id and fd.proceso_id='$proceso_id'",'order by fd.fecha desc');
					$proces = $object->Create_Lista($query);		   				   			
		   			$unique2 = $con->Query("SELECT f.* from folder f, folder_demanda fd where f.id = fd.folder_id and fd.proceso_id = '$proceso_id' and fd.user_id = '$user_id'");
		   			$id=$con->Result($unique2,0,'id');
		   			$procesos = ($compartir > 0)
		   			?$object->ListarCaratula("c,compartir fd where fd.compartir = '$_SESSION[usuario]' and c.proceso_id=fd.proceso_id and c.user_id=fd.user_id","order by fd.id") 
		   			:$object->ListarCaratula("c,folder f,folder_demanda fd where fd.folder_id=f.id and fd.user_id = '$_SESSION[usuario]' and c.proceso_id=fd.proceso_id and fd.user_id=c.user_id and f.id='$id'",'order by fd.fecha desc');
		   			$result = $folder->Create_List_Proces($procesos);
					ob_start();	
					$opc="opcion_".$_REQUEST['cn'];
					$proces.= $object->$opc($proceso_id,$user_id,$f,$msg);		   			
					include_once(VIEWS.DS.'caratula/Listar.php');	   					
					$table = ob_get_clean();
					$pagina = $this->load_template(ucwords($_REQUEST[cn]).' Proceso');													
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
					$this->view_page($pagina);
				}else
					exit;				
			}else
				exit;
		}
		function ExportarAnexo($id){
			global $con;
			$m = new MMemoriales;
			$m->CreateMemoriales("id", $id);


			$a = new MAnexos;
			$string = hash("sha256", $id.$_SESSION["usuario"].date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]); 
		#	include(APP.'plugins/mix_images/index.php');
			$timestamp = "<div><div style='font-size:8px; float:left; text-style:italic'>Firma digital y estampado cronológico que se encuentra en los documento oficiales de Carpeta Ciudadana. <br>Documento generado el dia ".date("Y-m-d")." a las ".date("H:i:s")." desde ".$_SERVER["REMOTE_ADDR"]." / Código del Documento: $string</div></div>"; 
			$foot = "<div><div style='font-size:8px; float:left'>Este documento  se encuentra firmado digital y electrónicamente. <br><br>Cuando este documento sea enviado electrónicamente como mensaje de datos generará una guía electrónica que  garantiza que es único e irrepetible.convirtiéndolo en un documento auténtico según la ley 527 de 1999.</div></div>";
			$fpath = '<html><head></head><body>'.$timestamp;
			$lpath = '<hr>'.$foot.'</body></html>';

			$html = utf8_decode($fpath.html_entity_decode($m->GetContenido()).$lpath);
			$dompdf = new DOMPDF();

			$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
			#$dompdf->set_paper('legal','');
			$dompdf->load_html($html);
			ini_set("memory_limit","32M"); 
			$dompdf->render();
			/*$dompdf->stream('my.pdf',array('Attachment'=>0));*/
			$pdf = $dompdf->output();

			file_put_contents(UPLOADS.DS . $m->GetUser_id().DS.'anexos'.DS.$name, $pdf);

			$car = new MCaratula;
			$fol = $car->GetTotalAnexosProcesos($m->GetProceso_id());
			$fol += 1;

			$a->InsertAnexos($m->GetProceso_id(), $m->GetNombre(), $name, $m->GetUser_id(), date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], $fol);

		}

		function ExportarAnexoWord($id){

			$m = new MMemoriales;
			$m->CreateMemoriales("id", $id);

			header('Content-type: application/vnd.ms-word; name="word"');
			header("Content-Disposition: attachment; filename=".$m->GetNombre().".docx");
			header("Pragma: no-cache");
			header("Expires: 0");

			echo htmlspecialchars_decode($m->GetContenido());
		}

		function UpdateDDO($id, $status){
			global $con;
			$exp = new MDemandado_proceso;
			$ar1 = array($status);
			$ar2 = array('notif_actuaciones');
			$output = array("Actualizado", "No se pudo Actualizar");
			$constrain = "WHERE id = '".$id."'";

			$out = $exp->UpdateDemandado_proceso($constrain, $ar2, $ar1, $output);

			echo $out;
		}
		function UpdateDDE($id, $status){
			global $con;
			$exp = new MDemandante_proceso_juridico;
			$ar1 = array($status);
			$ar2 = array('notif_actuaciones');
			$output = array("Actualizado", "No se pudo Actualizar");
			$constrain = "WHERE id = '".$id."'";

			$out = $exp->UpdateDemandante_proceso_juridico($constrain, $ar2, $ar1, $output);

			echo $out;
		}
		function Save_Demandante(){

			global $con;
			global $c;

			$exp = new MDemandante_proceso_juridico;
			$exp->CreateDemandante_proceso_juridico("id", $_REQUEST[id]);


			$path = "";
			$change = false;
			if($exp->GetNom_entidad() != $c->sql_quote($_POST[nom_entidad])){
				$path .= "<li>Se edito el campo 'Nombre' de '".$exp->GetNom_entidad()."' por '$c->sql_quote($_POST[nom_entidad])' </li>";
				$change = true;
			}
			if($exp->GetNit_entidad() != $c->sql_quote($_POST[nit_entidad])){
				$path .= "<li>Se edito el campo 'Identificación' de '".$exp->GetNit_entidad()."' por '$c->sql_quote($_POST[nit_entidad])' </li>";
				$change = true;
			}
			if($exp->GetDir_entidad() != $c->sql_quote($_POST[dir_entidad])){
				$path .= "<li>Se edito el campo 'Direccion' de '".$exp->GetDir_entidad()."' por '$c->sql_quote($_POST[dir_entidad])' </li>";
				$change = true;
			}
			if($exp->GetCiu_entidad() != $c->sql_quote($_POST[ciu_entidad])){
				$path .= "<li>Se edito el campo 'Ciudad' de '".$exp->GetCiu_entidad()."' por '$c->sql_quote($_POST[ciu_entidad])' </li>";
				$change = true;
			}
			if($exp->GetTelefonos() != $c->sql_quote($_POST[telefonos])){
				$path .= "<li>Se edito el campo 'Telefonos' de '".$exp->GetTelefonos()."' por '$c->sql_quote($_POST[telefonos])' </li>";
				$change = true;
			}
			if($exp->GetEmail_repres() != $c->sql_quote($_POST[email_repres])){
				$path .= "<li>Se edito el campo 'E-mail' ".$exp->GetEmail_repres()."' por '$c->sql_quote($_POST[email_repres])' </li>";
				$change = true;
			}
			if($exp->GetP_nom_repres() != $c->sql_quote($_POST[p_nom_repres])){
				$path .= "<li>Se edito el campo 'Representante Legal' de '".$exp->GetP_nom_repres()."' por '$c->sql_quote($_POST[p_nom_repres])' </li>";
				$change = true;
			}
			if($exp->GetCiu_repres() != $c->sql_quote($_POST[ciu_repres])){
				$path .= "<li>Se edito el campo 'Ciudad del Representante Legal' de '".$exp->GetCiu_repres()."' por '$c->sql_quote($_POST[ciu_repres])' </li>";
				$change = true;
			}
			
			if($change){

				$con->Query("UPDATE demandante_proceso_juridico set
								nom_entidad = '".$c->sql_quote($_POST[nom_entidad])."',
								nit_entidad = '".$c->sql_quote($_POST[nit_entidad])."',
								dir_entidad = '".$c->sql_quote($_POST[dir_entidad])."',
								ciu_entidad = '".$c->sql_quote($_POST[ciu_entidad])."',
								telefonos   = '".$c->sql_quote($_POST[email_repres])."',
								email_repres= '".$c->sql_quote($_POST[telefonos])."',
								p_nom_repres= '".$c->sql_quote($_POST[p_nom_repres])."',
								ciu_repres  = '".$c->sql_quote($_POST[ciu_repres])."'
								where id = '$_REQUEST[id]'");

				$ar2 = array('fecha_actualizacion');
				$ar1 = array(date("Y-m-d H:i:s"));
				$output = array('registro actualizado', 'no se pudo actualizar'); 
				$constrain = "WHERE proceso_id = '".$exp->GetProceso_id()."' and user_id = '".$_SESSION['usuario']."'";
				$msg=$this->Editar($constrain, $ar2, $ar1, $output);

	
				$car = new MCaratula;
				$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$exp->GetProceso_id()."'");	
				$pid = $car->GetId();	
				$id = $car->GetId();	

				if ($compartir>0) {
					$c->Insert_Event(	$pid, 'Edición de Proceso', "El usuario $_SESSION[usuario] ha editado informacion del cliente ".$exp->GetNom_entidad()." <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1', $color, $user_id);

					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion del cliente ".$exp->GetNom_entidad()." <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}else{
					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion del cliente ".$exp->GetNom_entidad()." <ul>".$c->sql_quote($path)."</ul> En el proceso: <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}
			}





			

		}
		function Save_demandado(){
			global $con;
			global $c;

			$exp = new MDemandado_proceso;
			$exp->CreateDemandado_proceso("id", $_REQUEST[id]);


			$path = "";
			$change = false;
			if($exp->GetP_nombre() != $c->sql_quote($_POST[nombre])){
				$path .= "<li>Se edito el campo 'Nombre' de '".$exp->GetP_nombre()."' por '$c->sql_quote($_POST[nombre])' </li>";
				$change = true;
			}
			if($exp->GetCedula() != $c->sql_quote($_POST[cedula])){
				$path .= "<li>Se edito el campo 'Identificación' de '".$exp->GetCedula()."' por '$c->sql_quote($_POST[cedula])' </li>";
				$change = true;
			}
			if($exp->GetDireccion() != $c->sql_quote($_POST[direccion])){
				$path .= "<li>Se edito el campo 'Direccion' de '".$exp->GetDireccion()."' por '$c->sql_quote($_POST[direccion])' </li>";
				$change = true;
			}
			if($exp->GetCiudad() != $c->sql_quote($_POST[ciudad])){
				$path .= "<li>Se edito el campo 'Ciudad' de '".$exp->GetCiudad()."' por '$c->sql_quote($_POST[ciudad])' </li>";
				$change = true;
			}
			if($exp->GetTelefonos() != $c->sql_quote($_POST[telefono])){
				$path .= "<li>Se edito el campo 'Telefonos' de '".$exp->GetTelefonos()."' por '$c->sql_quote($_POST[telefono])' </li>";
				$change = true;
			}
			if($exp->GetEmail() != $c->sql_quote($_POST[email])){
				$path .= "<li>Se edito el campo 'E-mail' ".$exp->GetEmail()."' por '$c->sql_quote($_POST[email])' </li>";
				$change = true;
			}
			if($exp->GetS_apellido() != $c->sql_quote($_POST[s_apellido])){
				$path .= "<li>Se edito el campo 'Representante Legal' de '".$exp->GetS_apellido()."' por '$c->sql_quote($_POST[s_apellido])' </li>";
				$change = true;
			}
			if($exp->GetDepartamento() != $c->sql_quote($_POST[departamento])){
				$path .= "<li>Se edito el campo 'Ciudad del Representante Legal' de '".$exp->GetDepartamento()."' por '$c->sql_quote($_POST[departamento])' </li>";
				$change = true;
			}
			
			if($change){

				$con->Query("UPDATE demandado_proceso set
								p_nombre 	= '".$c->sql_quote($_POST[nombre])."',
								cedula 		= '".$c->sql_quote($_POST[cedula])."',
								direccion 	= '".$c->sql_quote($_POST[direccion])."',
								ciudad 		= '".$c->sql_quote($_POST[ciudad])."',
								telefonos   = '".$c->sql_quote($_POST[telefono])."',
								email		= '".$c->sql_quote($_POST[email])."',
								s_apellido  = '".$c->sql_quote($_POST[s_apellido])."',
								departamento= '".$c->sql_quote($_POST[departamento])."'

								where id = '".$_REQUEST[id]."'");

				$ar2 = array('fecha_actualizacion');
				$ar1 = array(date("Y-m-d H:i:s"));
				$output = array('registro actualizado', 'no se pudo actualizar'); 
				$constrain = "WHERE proceso_id = '".$exp->GetProceso_id()."' and user_id = '".$_SESSION['usuario']."'";
				$msg=$this->Editar($constrain, $ar2, $ar1, $output);

				$car = new MCaratula;
				$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$exp->GetProceso_id()."'");	
				$pid = $car->GetId();	
				$id = $car->GetId();	

				if ($compartir>0) {
					$c->Insert_Event(	$pid, 'Edición de Proceso', "El usuario $_SESSION[usuario] ha editado la informacion de la contraparte ".$exp->GetP_nombre()."<ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1', $color, $user_id);

					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion de la contraparte ".$exp->GetP_nombre()." <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}else{
					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion de la contraparte ".$exp->GetP_nombre()." <ul>".$c->sql_quote($path)."</ul> En el proceso: <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}
			}
		}


		function Save_contacto(){

			global $con;
			global $c;

			$exp = new MContactos;
			$exp->CreateContactos("id", $_REQUEST[id]);

			$exp2 = new MContactos_direccion;
			$exp2->CreateContactos_direccion("id", $_REQUEST[id]);

			$exp3 = new MContactos_emails;
			$exp3->CreateContactos_emails("id", $_REQUEST[id]);

			$exp4 = new MContactos_telefonos;
			$exp4->CreateContactos_telefonos("id", $_REQUEST[id]);


			$path = "";
			$change = false;
			if($exp->GetNombre().' '.$exp->GetApellido() != $c->sql_quote($_POST[nombre])){
				$path .= "<li>Se edito el campo 'Nombre' de '".$exp->GetNombre().' '.$exp->GetApellido()."' por '$c->sql_quote($_POST[nombre])' </li>";
				$change = true;
			}
			if($exp->GetType() != $c->sql_quote($_POST[tipo])){
				$path .= "<li>Se edito el campo 'Tipo' de '".$exp->GetType()."' por '$c->sql_quote($_POST[tipo])' </li>";
				$change = true;
			}
			if($exp2->GetDireccion() != $c->sql_quote($_POST[direccion])){
				$path .= "<li>Se edito el campo 'Direccion' de '".$exp2->GetDireccion()."' por '$c->sql_quote($_POST[direccion])' </li>";
				$change = true;
			}

			if($exp3->GetEmail() != $c->sql_quote($_POST[email])){
				$path .= "<li>Se edito el campo 'Email' de '".$exp3->GetEmail()."' por '$c->sql_quote($_POST[email])' </li>";
				$change = true;
			}

			if($exp4->GetTelefono() != $c->sql_quote($_POST[telefono])){
				$path .= "<li>Se edito el campo 'Telefono' de '".$exp4->GetTelefono()."' por '$c->sql_quote($_POST[telefono])' </li>";
				$change = true;
			}


			if($change){

				$exp =  explode(' ', $c->sql_quote($_POST[nombre]));

				$con->Query("UPDATE contactos set nombre = '$exp[0]', apellido = '$exp[1]',type = '$c->sql_quote($_POST[tipo])'  WHERE id = '$_REQUEST[id]'");
				$con->Query("UPDATE contactos_direccion SET direccion = '$c->sql_quote($_POST[direccion])' WHERE id_contacto = '$_REQUEST[id]' ");
				$con->Query("UPDATE contactos_emails SET email = '$c->sql_quote($_POST[email])' WHERE contacto_id = '$_REQUEST[id]' ");
				$con->Query("UPDATE contactos_telefonos SET telefono = '$c->sql_quote($_POST[telefono])' WHERE contacto_id = '$_REQUEST[id]' ");


				$ar2 = array('fecha_actualizacion');
				$ar1 = array(date("Y-m-d H:i:s"));
				$output = array('registro actualizado', 'no se pudo actualizar'); 
				$constrain = "WHERE proceso_id = '".$exp->GetProceso_id()."' and user_id = '".$_SESSION['usuario']."'";
				$msg=$this->Editar($constrain, $ar2, $ar1, $output);

				$car = new MCaratula;
				$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$exp->GetProceso_id()."'");	
				$pid = $car->GetId();
				$id = $car->GetId();


				if ($compartir>0) {
					$c->Insert_Event(	$pid, 'Edición de Proceso', "El usuario $_SESSION[usuario] ha editado la informacion del contacto ".$exp->GetNombre().' '.$exp->GetApellido()."<ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1', $color, $user_id);

					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion del contacto ".$exp->GetP_nombre()." <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}else{
					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion del contacto ".$exp->GetP_nombre()." <ul>".$c->sql_quote($path)."</ul> En el proceso: <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}

			}

		}

		function delete_contacto($id){

			global $con;

			$str1 = "DELETE FROM contactos WHERE id = '$id'";
			$con->Query($str1);

			$str2 = "DELETE FROM contactos_direccion WHERE id_contacto = '$id'";
			$con->Query($str2);

			$str2 = "DELETE FROM contactos_emails WHERE contacto_id = '$id'";
			$con->Query($str2);

			$str2 = "DELETE FROM contactos_telefonos WHERE contacto_id = '$id'";
			$con->Query($str2);


		}

		function SendMailGroup($mailpath, $subject, $proceso_id, $titulo_proceso){

			global $con;
			global $f;
			global $c;
			$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";

			$st = $con->Query($strx);
#								echo $strx;								
			while ($rst = $con->FetchAssoc($st)) {
				$em = explode(",", $rst["email_repres"]);
				for ($k=0; $k < count($em); $k++) { 
					$mail = new PHPMailer;
					$mail->Host = "Carpeta Ciudadana";
					$mail->From = $_SESSION["usuario"];
					$mail->FromName =  $_SESSION['nombre'];
					$mail->Subject = $subject;
					$mail->ConfirmReadingTo = $_SESSION["usuario"];

					$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
								<p><b>Asunto: </b>".$subject."</p>
								<p><b>Demanda: </b> ".$titulo_proceso."</p>
								<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

								<p> Sr./Sra. <br> Se ha creado una actuacion en el proceso: '".$titulo_proceso."'</p>
								<p>".$mailpath."</p>";

					$mail->IsHTML(true);
					
					$bodymessage = $f->BodyMail($body);

					#echo $bodymessage;

					$mail->Body = $bodymessage;
					$mail->AddAddress($em[$k]);
					$mail->Send();
				}	

			}
			$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
			$st = $con->Query($strx);
			while ($rst = $con->FetchAssoc($st)) {
				$em = explode(",", $rst["email"]);
				for ($k=0; $k < count($em); $k++) { 
					$mail = new PHPMailer;
					$mail->Host = "Carpeta Ciudadana";
					$mail->From = $_SESSION["usuario"];
					$mail->FromName =  $_SESSION['nombre'];
					$mail->Subject = $subject;
					$mail->ConfirmReadingTo = $_SESSION["usuario"];

					$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
								<p><b>Asunto: </b>".$subject."</p>
								<p><b>Demanda: </b> ".$titulo_proceso."</p>
								<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

								<p> Sr./Sra. <br> Se ha creado una actuacion en el proceso: '".$titulo_proceso."'</p>
								<p>".$mailpath."</p>";

					$mail->IsHTML(true);
					
					$bodymessage = $f->BodyMail($body);

					#echo $bodymessage;

					$mail->Body = $bodymessage;
					$mail->AddAddress($em[$k]);
					$mail->Send();
				}	

			}


		}

		function CambiarCarpetaProceso($fl, $pid){
			global $con;
			global $f;
			global $c;
			$object = new MCaratula;

			$object->CreateCaratula("id", $pid);

			$strx  = "UPDATE folder_demanda SET folder_id = '$fl' where proceso_id = '".$object->GetProceso_id()."' and user_id = '".$_SESSION['usuario']."'";
			$st = $con->Query($strx);

			if ($st) {
				echo "El proceso ha sido cambiado de carpeta correctamente";
			}else{
				echo "No se puedo realizar la operacion";
			}

		}


		function TransferirCarpeta($id, $new_us){
			global $con;
			global $f;
			$m = new MCaratula;

			#FOLDER
			$con->Query("UPDATE folder 	set user_id = '$new_us' where id = '$id'");
			$con->Query("UPDATE folder_demandante_proceso 			set user_id = '$new_us' where id_folder = '$id'");
			$con->Query("UPDATE folder_demandante_proceso_juridico 	set user_id = '$new_us' where id_folder = '$id'");


				$query = $m->ListarCaratula("c,folder f,folder_demanda fd where fd.folder_id=f.id and fd.user_id = '$_SESSION[usuario]' and c.proceso_id=fd.proceso_id and fd.user_id=c.user_id and f.id='$id'",'order by fd.fecha desc');
	   			while ($row = $con->FetchAssoc($query)) {
	   				$p = $con->Result($con->Query("select id from caratula where user_id = '".$_SESSION['usuario']."' and proceso_id = '".$row['proceso_id']."'"), 0, 'id');
	   				echo "Transferir: ".$p." a $new_us <br>";
	   				$object = new MCaratula;
					$object->CreateCaratula("id", $p);
 					$new_id=$con->Result($con->Query("SELECT * from caratula where user_id = '$new_us' order by proceso_id desc limit 0,1"),0,'proceso_id')+1;
					$proceso_id = $p;
					$query=$con->Query("SELECT * from abonos_img where id = '$p'");
					$this->copy_paste($query,'nom_img','abonos',$new_us);
					$query=$con->Query("SELECT * from gastos_img where id = '$p'");
					$this->copy_paste($query,'nom_img','gastos',$new_us);

					$query=$con->Query("SELECT * from anexos where id = '$p' and estado = '1'");
					$this->copy_paste($query,'nom_img','anexos',$new_us);

					
					$con->Query("UPDATE folder_demanda 	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE caratula 		set user_id = '$new_us',proceso_id='$new_id' where id = '$p'");
					$con->Query("UPDATE abonos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE abonos_img 		set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE actuaciones 	set user_id = '$new_us', where proceso_id = '$p'");
					$con->Query("UPDATE anexos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE gastos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE gastos_img  	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE memoriales  	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE notas 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '$p'");
					$con->Query("UPDATE demandado_proceso 	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE demandante_proceso_juridico 	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					#$con->Query("INSERT into trasabilidad_transferencia (proceso,usuario_i,usuario_f,fecha) values('$p','$_SESSION[usuario]','$new_us','".date('Y-m-d H:i:s')."')");
					echo "<hr>";
					global $c;
					$c->Insert_Event(	$proceso_id,
										'Creación de Proceso',
										"Se ha creado un nuevo proceso: <a href=\'/caratula/opcion/$proceso_id/ver/\' class=\'link_event\'>$_POST[titulo]</a>",
										'1',
										'1');

					$c->Insert_Event(	$proceso_id,
										'Creación de Proceso',
										"Se ha creado un nuevo proceso: <a href=\'/caratula/opcion/$proceso_id/ver/\' class=\'link_event\'>$_POST[titulo]</a>",
										'1',
										'1');
					$q = $con->FetchAssoc($con->Query("select p_nombre, p_apellido from usuarios where user_id = '$new_us'"));
					$uq = $con->FetchAssoc($con->Query("select p_nombre, p_apellido from usuarios where user_id = '".$_SESSION['nombre']."'"));

					$mail = new PHPMailer;
					$mail->Host = "Carpeta Ciudadana";
					$mail->From = $_SESSION["usuario"];
					$mail->FromName =  $uq['p_nombre']." ".$uq['p_apellido'];
					$mail->Subject = "Se ha transferido un proceso a su cuenta";
					$mail->ConfirmReadingTo = $_SESSION["usuario"];

					$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
								<p>El usuario ".$uq['p_nombre']." ".$uq['p_apellido']." le ha transferido a su cuenta el proceso ".$object->GetTit_demanda()."</p>
								<p><b>Fecha de transferencia: </b>".date("d-m-Y h:i:s a")."</p>";
					$mail->IsHTML(true);
					
					$bodymessage = $f->BodyMail($body);
					$mail->Body = $bodymessage;
					$mail->AddAddress($new_us);
					$mail->Send();
	   				/*
					*/

	   			}
	   				echo "	<script>
								window.location.href = '".HOMEDIR."/proceso/';
							</script>";
/*
*/

		}
	}
?>		<?php
session_start();
date_default_timezone_set("America/Bogota");
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'FolderM.php');
	include_once(MODELS.DS.'CaratulaM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'AnexosM.php');
	include_once(MODELS.DS.'ActuacionesM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'MemorialesM.php');
	include_once(MODELS.DS.'EventsM.php');
	include_once(MODELS.DS.'CompartirM.php');
	include_once(MODELS.DS.'Demandado_procesoM.php');
	include_once(MODELS.DS.'Demandante_proceso_juridicoM.php');
	include_once(MODELS.DS.'PlantillaM.php');
	include_once(MODELS.DS.'ContactosM.php');
	include_once(MODELS.DS.'Contactos_direccionM.php');
	include_once(MODELS.DS.'Contactos_emailsM.php');
	include_once(MODELS.DS.'Contactos_telefonosM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(PLUGINS.DS.'dompdf/dompdf_config.inc.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CCaratula;
	$c = new Consultas;
	$f = new Funciones;
	$au = new MAlertas_usuarios;	
	$obj = new MCaratula;
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$_SESSION["helper"] = "caratula";
	$_SESSION["typefolder"] = "ACTIVO";

	
		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA
		if($c->sql_quote($_REQUEST['action']) == 'listar')
			$ob->VistaListar('');	
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	
			$ob->VistaInsertar_2($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'crear')	
			$ob->VistaInsertar_2($c->sql_quote($_REQUEST['id']));
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->Insertar(/*$c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["proceso_id"]), $c->sql_quote($_REQUEST["tip_demanda"]), $c->sql_quote($_REQUEST["juzgado"]), $c->sql_quote($_REQUEST["rad"]), $c->sql_quote($_REQUEST["dir_juz"]), $c->sql_quote($_REQUEST["tel_juz"]), $c->sql_quote($_REQUEST["email_juz"]), $c->sql_quote($_REQUEST["est_proceso"]), $c->sql_quote($_REQUEST["tit_demanda"]), $c->sql_quote($_REQUEST["fec_pres"]), $c->sql_quote($_REQUEST["val_demanda"]), $c->sql_quote($_REQUEST["tipo_demandante"]), $c->sql_quote($_REQUEST["fec_auto"]), $c->sql_quote($_REQUEST["num_oficio"]), $c->sql_quote($_REQUEST["contenido"]), $c->sql_quote($_REQUEST["costas"]), $c->sql_quote($_REQUEST["edit_juz"]), $c->sql_quote($_REQUEST["tracking"]), $c->sql_quote($_REQUEST["rad_completo"]), $c->sql_quote($_REQUEST["fecha_creacion"]), $c->sql_quote($_REQUEST["type_proceso"]), $c->sql_quote($_REQUEST["usuario_registra"])*/);
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		elseif ($c->sql_quote($_REQUEST['action']) == "transferircarpeta") 
			$ob->TransferirCarpeta($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['transferir']));		

		elseif($c->sql_quote($_REQUEST['action']) == 'ver'){
			$_SESSION['typefolder'] = $c->sql_quote($_REQUEST['cn']);
			$ob->VistaListar($c->sql_quote($_REQUEST['id']), '');
			
		}
		elseif($c->sql_quote($_REQUEST['action']) == 'opcion'){
			$opc="opcion_".$_REQUEST['cn'];
			$ob->Opcion($_REQUEST[id]);
		}elseif($c->sql_quote($_REQUEST['action']) == 'exportaranexo') {
			$ob->ExportarAnexo($c->sql_quote($_REQUEST['id']));
		}elseif($c->sql_quote($_REQUEST['action']) == 'exportaranexoword') {
			$ob->ExportarAnexoWord($c->sql_quote($_REQUEST['datos_a_enviar']));
		}elseif($c->sql_quote($_REQUEST['action']) == 'updateddo') {
			$ob->UpdateDDO($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}elseif($c->sql_quote($_REQUEST['action']) == 'updatedte') {
			$ob->UpdateDDE($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		}elseif($c->sql_quote($_REQUEST['action']) == 'save_demandante') {
			$ob->Save_Demandante();
		}elseif($c->sql_quote($_REQUEST['action']) == 'save_demandado') {
			$ob->Save_Demandado();
		}elseif($c->sql_quote($_REQUEST['action']) == 'save_contacto') {
			$ob->Save_contacto();
		}elseif($c->sql_quote($_REQUEST['action']) == 'delete_contacto') {

			$ob->delete_contacto($c->sql_quote($_REQUEST['id']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'mover') {
			$ob->CambiarCarpetaProceso($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));

		}elseif($c->sql_quote($_REQUEST['action']) == 'xee') {

			$st = "select * from folder";
			$q = $con->Query($st);

			while ($row = $con->FetchAssoc($q)) {
				$r = $con->Query("select a_i from usuarios where user_id = '".$row['user_id']."'");
				$rt = $con->FetchAssoc($r);
					
				$rt = $rt["a_i"];

				if($rt != ''){
					$pp = $f->zerofill($rt, 4);
					$fp = $f->zerofill($row['id'], 4);
					$un = $pp.$fp;
					$pw = $f->GenerarSmallId();
					$dc = md5($pw);
					$str = "UPDATE folder SET cod_ingreso = '".$un."', password =  '".$dc."', dec_pass='".$pw."' where id = '".$row['id']."'";
					
					/*
						$query = $con->Query($str);
						if (!$query) {
							echo "$row[id] ok!; <br>";
						}else{
							echo "$row[id] false!; <br>";
						}
					*/
				}
			}

		}
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CCaratula extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar($id='', $cn = "ACTIVO"){
			// CREANDO UN NUEVO MODELO			
			$object = new MCaratula;
			$folder = new MFolder;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			global $f; 
			global $c;
			$cn = $_SESSION['typefolder'];
			if (isset($_POST[submit])) {
				switch ($_POST[submit]) {
					case 'Transferir':
						$object->CreateCaratula("id", $_POST[proceso_id]);
						$new_us=$_POST[transferir];
						$new_id=$con->Result($con->Query("SELECT * from caratula where user_id = '$new_us' order by proceso_id desc limit 0,1"),0,'proceso_id')+1;
						$query=$con->Query("SELECT * from folder where nom='Procesos Transferidos' and user_id = '$new_us'");
						if($con->NumRows($query)>0){
							$new_folder=$con->Result($query,0,'id');
						}else{
							$new_folder=$con->Query("INSERT into folder(user_id,nom) values('$new_us','Procesos Transferidos')",'insert');
							$con->Query("INSERT into folder_demandante_proceso (user_id,p_nombre,id_folder) values('$new_us','Procesos Transferidos','$new_folder')");
						}
						$query=$con->Query("SELECT * from abonos_img where id = '$_POST[proceso_id]'");
						$this->copy_paste($query,'nom_img','abonos',$new_us);
						$query=$con->Query("SELECT * from gastos_img where id = '$_POST[proceso_id]'");
						$this->copy_paste($query,'nom_img','gastos',$new_us);
						$query=$con->Query("SELECT * from anexos where id = '$_POST[proceso_id]' and estado = '1'");
						$this->copy_paste($query,'nom_img','anexos',$new_us);
						$con->Query("UPDATE folder_demanda 	set user_id = '$new_us',proceso_id='$new_id',folder_id='$new_folder' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE caratula 		set user_id = '$new_us',proceso_id='$new_id' where id = '$_POST[proceso_id]'");
						$con->Query("UPDATE abonos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE abonos_img 		set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE actuaciones 	set user_id = '$new_us', where proceso_id = '$_POST[proceso_id]'");
						$con->Query("UPDATE anexos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE gastos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE gastos_img  	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE memoriales  	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
#						$con->Query("UPDATE notificaciones 	set user_id = '$new_us',proceso_id='$new_id' where id = '$_POST[proceso_id]'");
						$con->Query("UPDATE notas 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE demandado_proceso 	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
						$con->Query("UPDATE demandante_proceso_juridico 	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");

						$con->Query("INSERT into trasabilidad_transferencia (proceso,usuario_i,usuario_f,fecha) values('$_POST[proceso_id]','$_SESSION[usuario]','$new_us','".date('Y-m-d H:i:s')."')");
					
						global $c;
						$c->Insert_Event(	$proceso_id,
											'Tansferencia de Proceso',
											"Se ha transferido proceso: <a href=\'/caratula/opcion/$proceso_id/ver/\' class=\'link_event\'>$_POST[titulo]</a>",
											'1',
											'1');

						$c->Insert_Event(	$proceso_id,
											'Tansferencia de Proceso',
											"Se ha transferido proceso: <a href=\'/caratula/opcion/$proceso_id/ver/\' class=\'link_event\'>$_POST[titulo]</a>",
											'1',
											'1');

						$q = $con->FetchAssoc($con->Query("select p_nombre, p_apellido from usuarios where user_id = '$new_us'"));
						$uq = $con->FetchAssoc($con->Query("select p_nombre, p_apellido from usuarios where user_id = '".$_SESSION['nombre']."'"));

						$mail = new PHPMailer;
						$mail->Host = "Carpeta Ciudadana";
						$mail->From = $_SESSION["usuario"];
						$mail->FromName =  $uq['p_nombre']." ".$uq['p_apellido'];
						$mail->Subject = "Se ha transferido un proceso a su cuenta";
						$mail->ConfirmReadingTo = $_SESSION["usuario"];

						$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
									<p>El usuario ".$uq['p_nombre']." ".$uq['p_apellido']." le ha transferido a su cuenta el proceso ".$object->GetTit_demanda()."</p>
									<p><b>Fecha de transferencia: </b>".date("d-m-Y h:i:s a")."</p>";
						$mail->IsHTML(true);
						
						$bodymessage = $f->BodyMail($body);
						$mail->Body = $bodymessage;
						$mail->AddAddress($new_us);
						$mail->Send();

						break;
					
					default:
						# code...
						break;
				}
			}
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Caratula');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $folder->ListarFolder("WHERE user_id='$_SESSION[usuario]' and id <> '$id'", 'order by nom asc');
			$unique = $folder->ListarFolder("WHERE id = '$id'", 'order by fecha desc');
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			if($con->NumRows($query) <= 0 || $query !=''){
				
				# INICIO DE PAGINADOR 
				# DEFINICION DE RESULTADOS QUE SE MUESTRAN
				$RegistrosAMostrar = 20;
				if(isset($_GET['p1'])){
					$RegistrosAEmpezar=($_GET['p1']-1)*$RegistrosAMostrar;
					$PagAct=$_GET['p1'];
				//caso contrario los iniciamos
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
					
				}	
				#FIN DE DEFINICION DE PAGINAS	

				$type=($id==0)?1:0;
				$unique = $folder->Create_List($unique,$type);
		   		$result = $folder->Create_List($query);
		   		$query = ($id==0)
		   		?$object->ListarCaratula("c,compartir fd where fd.compartir = '$_SESSION[usuario]' and c.id=fd.pid and c.user_id=fd.user_id","order by fd.id", "limit $RegistrosAEmpezar, $RegistrosAMostrar")
		   		:$object->ListarCaratula("c,folder f,folder_demanda fd where fd.folder_id=f.id and fd.user_id = '$_SESSION[usuario]' and c.proceso_id=fd.proceso_id and fd.user_id=c.user_id and f.id='$id'",' order by fd.fecha desc', "limit $RegistrosAEmpezar, $RegistrosAMostrar");
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){

		   			$proces = $object->Create_Lista($query,$type, $cn);
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA


					include_once(VIEWS.DS.'caratula/Listar.php');




					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
					$table = ob_get_clean();	
					// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
					if($message != '')
					$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);
					// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				}else{
					// SI NO SE EJECUTA LA CONSULTA ENTONCES GENERA MENSAJE DE ERROR
		   			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	
				}
			}else{$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	}
			$this->view_page($pagina);
		}
		function copy_paste($query,$ruta,$tipo,$new_us){
			global $con;
			if ($con->NumRows($query)>0) {
				while ($col=$con->FetchAssoc($query)) {
					$filename=UPLOADS."/$new_us/";
					if (!file_exists($filename)) {
					    mkdir(UPLOADS."/$new_us", 0777);
					}
					$filename=UPLOADS."/$new_us/$tipo/";
					if (!file_exists($filename)) {
					    mkdir(UPLOADS."/$new_us/$tipo", 0777);
					}
					@copy(UPLOADS.DS.$_SESSION[usuario].DS.$tipo.DS.$col[$ruta], UPLOADS.DS.$new_us.DS.$tipo.DS.$col[$ruta]);
				}
			}				
		}
		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar($id=''){
			// RETORNAME LA PAGINA CARGADA		
			//CARGA EL TEMPLATE
			$object2 = new MPlantilla;
			$query2 = $object2->ListarPlantilla("WHERE user_id = '$_SESSION[usuario]'");	
			$object = new MCaratula;
			$folder = new MFolder;
			$pagina = $this->load_template('Crear Caratula');
			global $f;
			global $con;
			$query = $con->Query("SELECT * FROM juzgados where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$juzgados=$f->Create_Select($query,'nom','nom');
			$query = $con->Query("SELECT * FROM demandas where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$demandas=$f->Create_Select($query,'nom','nom');
			$query = $con->Query("SELECT * FROM folder where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$folders=$f->Create_Select($query,'id','nom',$_REQUEST[id]);
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			$query = $folder->ListarFolder("WHERE user_id='$_SESSION[usuario]' and id <> '$id'", 'order by fecha desc');
			$unique = $folder->ListarFolder("WHERE id = '$id'", 'order by fecha desc');	
			$unique = $folder->Create_List($unique);
		   	$result = $folder->Create_List($query);
			ob_start();
			include_once(VIEWS.DS.'caratula/FormInsertCaratula.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		function VistaInsertar_2($id=''){
			//CARGA EL TEMPLATE
			$object2 = new MPlantilla;
			$query2 = $object2->ListarPlantilla("WHERE user_id = '$_SESSION[usuario]'");	
			$object = new MCaratula;
			$folder = new MFolder;
			$pagina = $this->load_template('Crear Caratula');
			global $f;
			global $con;
			$query = $con->Query("SELECT * FROM juzgados where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$juzgados=$f->Create_Select($query,'nom','nom');
			$query = $con->Query("SELECT * FROM demandas where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$demandas=$f->Create_Select($query,'nom','nom');
			$query = $con->Query("SELECT * FROM folder where user_id='$_SESSION[usuario]' or user_id = 'DEFAULT'");
			$folder->CreateFolder("id", $id);
			$folders= $folder->GetNom();
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			$query = $folder->ListarFolder("WHERE user_id='$_SESSION[usuario]' and id <> '$id'", 'order by fecha desc');
			$unique = $folder->ListarFolder("WHERE id = '$id'", 'order by fecha desc');	
			$unique = $folder->Create_List($unique);
		   	$result = $folder->Create_List($query);
			ob_start();
			include_once(VIEWS.DS.'caratula/NewInsertCaratula.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template('Editar Caratula');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MCaratula;
			// LO CREAMOS 			
			$object->CreateCaratula('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'caratula/FormUpdateCaratula.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MCaratula;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Caratula');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarCaratula('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'caratula/Listar.php');	   			
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
		function Insertar(/*$user_id, $proceso_id, $tip_demanda, $juzgado, $rad, $dir_juz, $tel_juz, $email_juz, $est_proceso, $tit_demanda, $fec_pres, $val_demanda, $tipo_demandante, $fec_auto, $num_oficio, $contenido, $costas, $edit_juz, $tracking, $rad_completo, $fecha_creacion, $type_proceso, $usuario_registra*/){
			
			global $con;
			$proceso_id = $con->Query("SELECT * from caratula where user_id = '$_SESSION[usuario]' order by proceso_id desc limit 0,1");
			$proceso_id = $con->Result($proceso_id,0,'proceso_id') + 1 ;
			$str = "	INSERT into caratula
							(user_id, proceso_id, tip_demanda, juzgado, rad, dir_juz, tel_juz, email_juz, 
								est_proceso, tit_demanda, fec_pres, val_demanda, tipo_demandante, fec_auto, 
								num_oficio, contenido, costas, edit_juz, tracking, rad_completo, fecha_creacion, 
								type_proceso, usuario_registra, ciudad, departamento)
							values ('$_SESSION[usuario]','$proceso_id','$_POST[tip_demanda]','$_POST[juzgado]','$_POST[rad]','$_POST[dir_juz]','$_POST[tel_juz]','$_POST[email_juz]',
								'$_POST[est_proceso]','$_POST[tit_demanda]','$_POST[fec_pres]','$_POST[val_demanda]',
								'','$_POST[fec_auto]', '$_POST[num_oficio]','','','','','$_POST[rad_completo]','".date('Y-m-d')."', '',NULL,'$_POST[ciudad]','$_POST[departamento]')";
			$con->Query($str);
		
			$con->Query("	INSERT into folder_demanda (user_id,folder_id,proceso_id,fecha) values('$_SESSION[usuario]','$_POST[folder_id]','$proceso_id','".date('Y-m-d')."')");
			
			global $c;
			$c->Insert_Event(	$proceso_id,
								'Creación de Proceso',
								"Se ha creado un nuevo proceso: <a href=\'/caratula/opcion/$proceso_id/ver/\' class=\'link_event\'>$_POST[titulo]</a>",
								'1',
								'1');
			
				$con->Query("	INSERT into demandante_proceso_juridico
								(user_id, proceso_id, nom_entidad, nit_entidad, dir_entidad, ciu_entidad, 
								p_nom_repres, ciu_repres, email_repres,	telefonos, exp_identificacion)
								values ('$_SESSION[usuario]','$proceso_id','".$_POST[demj_nombre]."','".$_POST[demj_id]."','".$_POST[demj_direccion]."','".$_POST[demj_ciudad]."',
								'".$_POST[demj_nombrer]."','".$_POST[demj_ciur]."','".$_POST[demj_mail]."','".$_POST[demj_tel]."','".$_POST[demj_exp]."')");
			$id = $c->GetMaxIdTabla("caratula", "id");

			#echo "ok!";
			echo '<script> window.location.href = "'.HOMEDIR.'/caratula/opcion/'.$id.'/ver/'.'"</script>';
			# header("location:".");
			#$this->VistaListar($_POST[folder_id]);
			
			/*// DEFINIENDO EL OBJETO			
			$object = new MCaratula;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertCaratula($user_id, $proceso_id, $tip_demanda, $juzgado, $rad, $dir_juz, $tel_juz, $email_juz, $est_proceso, $tit_demanda, $fec_pres, $val_demanda, $tipo_demandante, $fec_auto, $num_oficio, $contenido, $costas, $edit_juz, $tracking, $rad_completo, $fecha_creacion, $type_proceso, $usuario_registra);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');	*/

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MCaratula;
			return $object->UpdateCaratula($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK					
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MCaratula;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteCaratula($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
		function Opcion($id){
			$object = new MCaratula;
			$folder = new MFolder;
			global $con;
			global $c;
			global $f;			
			$proceso=$con->Query("SELECT * from caratula where id = '$id'");
			if ($con->NumRows($proceso)>0) {

				$proceso_id=$con->Result($proceso,0,'proceso_id');
				$pid=$con->Result($proceso,0,'id');
				$user_id=$con->Result($proceso,0,'user_id');
				$compartir = $con->NumRows($con->Query("SELECT * from compartir where compartir = '$_SESSION[usuario]' and user_id = '$user_id' and proceso_id = '$proceso_id'"));

				if ($_SESSION[sadmin]==1 || $_SESSION["usuario"] != $user_id){
					$color = "1";
				}
				if ($_SESSION['folder'] != '') {
					$color = "2";
				}
				
				if ($_SESSION[usuario]==$user_id || $compartir > 0){
					$rand = md5(date('Y-m-d').rand().$_SESSION[usuario]);
					switch ($_REQUEST[cn]) {
						case 'editar':
							if (isset($_POST[tit_demanda])) {

/*
tit_demanda		juzgado 	dir_juz 	tel_juz 	email_juz 	tip_demanda 	rad_completo 	rad 	val_demanda
fec_pres 	fec_auto 	num_oficio 		est_proceso
*/	
								$tit_demanda 	= $c->sql_quote($_POST[tit_demanda]);
								$juzgado 		= $c->sql_quote($_POST[juzgado]);
								$dir_juz 		= $c->sql_quote($_POST[dir_juz]);
								$tel_juz 		= $c->sql_quote($_POST[tel_juz]);
								$email_juz 		= $c->sql_quote($_POST[email_juz]);
								$tip_demanda	= $c->sql_quote($_POST[tip_demanda]);
								$rad 			= $c->sql_quote($_POST[rad]);
								$rad_completo 	= $c->sql_quote($_POST[rad_completo]);
								$costas 		= $c->sql_quote($_POST[val_demanda]);
								$f_auto 		= $c->sql_quote($_POST[fec_auto]);
								$f_pres 		= $c->sql_quote($_POST[fec_pres]);
								$oficio 		= $c->sql_quote($_POST[num_oficio]);
								$est_proceso	= $c->sql_quote($_POST[est_proceso]);
								$ciudad 		= $c->sql_quote($_POST[ciudad]);
								$departamento	= $c->sql_quote($_POST[departamento]);

								$car = new MCaratula;
							    $car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$proceso_id."'");	
							#	$pid = $car->GetId();	

					
								$path = "";
				        		$change = false;
				        		if($car->GetTit_demanda() != $tit_demanda){
				        			$path .= "<li>Se edito el campo 'Titulo del Proceso' de '".$car->GetTit_demanda()."' por '$tit_demanda' </li>";
				        			$change = true;
				        		}
				        		if($car->GetJuzgado() != $juzgado){
				        			$path .= "<li>Se edito el campo 'Entidad' de '".$car->GetJuzgado()."' por '$juzgado' </li>";
				        			$change = true;
				        		}
				        		if($car->GetDir_juz() != $dir_juz){
				        			$path .= "<li>Se edito el campo 'Direccion de Entidad' de '".$car->GetDir_juz()."' por '$dir_juz' </li>";
				        			$change = true;
				        		}
				        		if($car->GetTel_juz() != $tel_juz){
				        			$path .= "<li>Se edito el campo 'Telefono de Entidad' de '".$car->GetTel_juz()."' por '$tel_juz' </li>";
				        			$change = true;
				        		}
				        		if($car->GetEmail_juz() != $email_juz){
				        			$path .= "<li>Se edito el campo 'Email del Entidad' de '".$car->GetEmail_juz()."' por '$email_juz' </li>";
				        			$change = true;
				        		}
				        		if($car->GetTip_demanda() != $tip_demanda){
				        			$path .= "<li>Se edito el campo 'Naturaleza del proceso de' ".$car->GetTip_demanda()."' por '$tip_demanda' </li>";
				        			$change = true;
				        		}
				        		if($car->GetRad() != $rad){
				        			$path .= "<li>Se edito el campo 'Radicado' de '".$car->GetRad()."' por '$rad' </li>";
				        			$change = true;
				        		}
				        		if($car->GetRad_completo() != $rad_completo){
				        			$path .= "<li>Se edito el campo 'Radicado Completo' de '".$car->GetRad_completo()."' por '$rad_completo' </li>";
				        			$change = true;
				        		}
				        		if($car->GetVal_demanda() != $costas){
				        			$path .= "<li>Se edito el campo 'Valor del Proceso' de '".$car->GetVal_demanda()."' por '$costas' </li>";
				        			$change = true;
				        		}
				        		if($car->GetFec_pres() != $f_pres){
				        			$path .= "<li>Se edito el campo 'Fecha de Presentación' de '".$car->GetFec_pres()."' por '$f_pres' </li>";
				        			$change = true;
				        		}
				        		if($car->GetFec_auto() != $f_auto){
				        			$path .= "<li>Se edito el campo 'Fecha de Auto' de '".$car->GetFec_auto()."' por '$f_auto' </li>";
				        			$change = true;
				        		}
				        		
				        		if($car->GetNum_oficio() != $oficio){
				        			$path .= "<li>Se edito el campo 'Numero de Oficio' de '".$car->GetNum_oficio()."' por '$oficio' </li>";
				        			$change = true;
				        		}
				        		if($car->GetEst_proceso() != $est_proceso){
				        			$path .= "<li>Se edito el campo 'Estado del Proceso' de '".$car->GetEst_proceso()."' por '$est_proceso' </li>";
				        			$change = true;
				        		}

				        		if($car->GetCiudad() != $ciudad){
				        			$path .= "<li>Se edito el campo 'ciudad' de '".$car->GetCiudad()."' por '$ciudad' </li>";
				        			$change = true;
				        		}
				        		if($car->GetDepartamento() != $departamento){
				        			$path .= "<li>Se edito el campo 'Departamento' de '".$car->GetDepartamento()."' por '$departamento' </li>";
				        			$change = true;
				        		}

	        					if($change){

	        						$ar2 = array(	'tit_demanda', 'juzgado', 'dir_juz', 'tel_juz', 'email_juz','tip_demanda', 'rad_completo', 'rad', 'val_demanda', 'fec_pres', 'fec_auto', 'num_oficio', 'est_proceso', 'fecha_actualizacion', 'ciudad', 'departamento');
									$ar1 = array(	$tit_demanda, $juzgado, $dir_juz, $tel_juz, $email_juz, $tip_demanda, $rad_completo, $rad, $costas, $f_pres, $f_auto, $oficio, $est_proceso, date("Y-m-d H:i:s"), $ciudad, $departamento);
									$output = array('registro actualizado', 'no se pudo actualizar'); 
									$constrain = "WHERE proceso_id = '$proceso_id' and user_id = '$user_id'";
									$msg=$this->Editar($constrain, $ar2, $ar1, $output);


									if ($compartir>0) {
										$c->Insert_Event(	$pid,
															'Edición de Proceso',
															"El usuario $_SESSION[usuario] ha editado <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>",
															'1',
															'1',
															$color, $user_id);

										$c->Insert_Event(	$pid,
															'Edición de Proceso',
															"Se ha editado <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>",
															'1',
															'1');
									}else{
										$c->Insert_Event(	$pid,
															'Edición de Proceso',
															"Se ha editado <ul>".$c->sql_quote($path)."</ul> En el proceso: <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>",
															'1',
															'1');
									}
								}
								$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha realizado una actualizacion en el proceso ".$con->Result($proceso,0,'tit_demanda')." <br></p>
													<p>Se ha actualizado <ul>".$c->sql_quote($path)."</ul></p>
													";


										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha realizado una actualizacion en el proceso ".$con->Result($proceso,0,'tit_demanda')." <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}

							}
							break;
						case 'documentos':
							if (isset($_POST[submit])) {
								if ($_POST[submit]=='Editar') {
									$con->Query("UPDATE memoriales set nombre='$_POST[nombre]',contenido='".htmlentities(str_replace("'", "\\'", $_POST[descripcion]))."',f_actualizacion='".date('Y-m-d H:i:s')."' where id='$_REQUEST[p1]'");
									
									$car = new MCaratula;
									$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$proceso_id."'");	
									$pid = $car->GetId();

									if ($compartir>0) {
										$c->Insert_Event(	$pid,
															'Edición de Documento',
															"El usuario $_SESSION[usuario] ha editado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1',
															$color, $user_id);

										$c->Insert_Event(	$pid,
															'Edición de Documento',
															"Se ha editado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1');
									}else{
										$c->Insert_Event(	$pid,
															'Edición de Documento',
															"Se ha editado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1');
									}
								}else{
									$con->Query("INSERT into memoriales (user_id,proceso_id,nombre,f_creacion,contenido) 
												values('$user_id','$proceso_id','$_POST[nombre]','".date('Y-m-d H:i:s')."','".htmlentities(str_replace("'", "\\'", "".$_POST[descripcion]))."')");
									
									if ($compartir>0) {
										$c->Insert_Event(	$pid,
															'Creación de Documento',
															"El usuario $_SESSION[usuario] ha creado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1',
															$color, $user_id);

										$c->Insert_Event(	$pid,
															'Creación de Documento',
															"Se ha creado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1');
									}else{
										$c->Insert_Event(	$pid,
															'Creación de Documento',
															"Se ha creado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
															'1',
															'1');
									}
									/*
									$c->Insert_Event(	$pid,
														'Creación de Documento',
														"Se ha creado un documento en <a href=\'/caratula/opcion/$id/documentos/\' class=\'link_event\'>$_POST[nombre]</a>",
														'1',
														'1');*/
								}

								$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha creado un documento oficial titulado: ".$_POST['nombre']." <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha creado un documento oficial titulado: ".$_POST['nombre']." <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
							}
							break;
						case 'subir_anexo':

							$us = new MUsuarios;
							$us->CreateUsuarios("user_id", $_SESSION['usuario']);

							$upfls = 0;
							if ($_SESSION['c_anexos'] == "0") {
								$upfls = 1;
							}elseif($us->GetTotalAnexos() < $_SESSION['c_anexos']){
								$upfls = 1;
							}else{
								$upfls = 0;
							}
				
							if ($upfls == "1") {

								$car = new MCaratula;
								$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$proceso_id."'");	

								$fol = $car->GetTotalAnexosProcesos($proceso_id);
								$fol += 1;
								$filename=UPLOADS.DS.$user_id.'/';
								if (!file_exists($filename)) {
								    mkdir(UPLOADS.DS . $user_id, 0777);
								}
								$filename=UPLOADS.DS.$user_id.'/anexos/';
								if (!file_exists($filename)) {
								    mkdir(UPLOADS.DS . $user_id.'/anexos', 0777);
								}
								if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
									if(move_uploaded_file($_FILES['upl']['tmp_name'], UPLOADS.DS.$user_id.'/anexos/'.$rand.'_'.$_FILES['upl']['name'])){
										$con->Query("INSERT into anexos (proceso_id,nom_palabra,nom_img,user_id, ip, fecha, hora, folio) values ('$proceso_id','".$_FILES['upl']['name']."','".$rand.'_'.$_FILES['upl']['name']."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."')");
										
										global $c;

	/*									$c->Insert_Event(	$id,
															'Carga de Anexo',
															"Se ha cargado un anexo en <a href=\'/caratula/opcion/$id/anexos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1', $color);
	*/
										if ($compartir>0) {
											$c->Insert_Event(	$pid,
																'Carga de Anexo',
																"El usuario $_SESSION[usuario] ha cargado un anexo en <a href=\'/caratula/opcion/$id/anexos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
																'1',
																'1',
																$color, $user_id);

											$c->Insert_Event(	$pid,
																'Carga de Anexo',
																"Se ha cargado un anexo en <a href=\'/caratula/opcion/$id/anexos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
																'1',
																'1');
										}else{
											$c->Insert_Event(	$pid,
																'Carga de Anexo',
																"Se ha cargado un anexo en <a href=\'/caratula/opcion/$id/anexos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
																'1',
																'1');
										}


									$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
									$st = $con->Query($strx);
	#								echo $strx;								
									while ($rst = $con->FetchAssoc($st)) {
										$em = explode(",", $rst["email_repres"]);
										for ($k=0; $k < count($em); $k++) { 
											$mail = new PHPMailer;
											$mail->Host = "Carpeta Ciudadana";
											$mail->From = $_SESSION["usuario"];
											$mail->FromName =  $_SESSION['nombre'];
											$mail->Subject = $subject;
											$mail->ConfirmReadingTo = $_SESSION["usuario"];

											$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
														<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
														<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
														<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

														<p> Sr./Sra. <br> Se han cargado anexos al proceso <br></p>";

											$mail->IsHTML(true);
											
											$bodymessage = $f->BodyMail($body);

											#echo $bodymessage;

											$mail->Body = $bodymessage;
											$mail->AddAddress($em[$k]);
											$mail->Send();
										}	

									}
									$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
									$st = $con->Query($strx);
	#								echo $strx;								
									while ($rst = $con->FetchAssoc($st)) {
										$em = explode(",", $rst["email"]);
										for ($k=0; $k < count($em); $k++) { 
											$mail = new PHPMailer;
											$mail->Host = "Carpeta Ciudadana";
											$mail->From = $_SESSION["usuario"];
											$mail->FromName =  $_SESSION['nombre'];
											$mail->Subject = $subject;
											$mail->ConfirmReadingTo = $_SESSION["usuario"];

											$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
														<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
														<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
														<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

														<p> Sr./Sra. <br> Se han cargado anexos al proceso <br></p>";

											$mail->IsHTML(true);
											
											$bodymessage = $f->BodyMail($body);

											#echo $bodymessage;

											$mail->Body = $bodymessage;
											$mail->AddAddress($em[$k]);
											$mail->Send();
										}	

									}

										exit;
									}
								}
							}
							break;
						case 'guardar_nota':
								global $c;
							if ($_POST[id_nota] == "") {
								$con->Query("INSERT into notas (user_id,proceso_id,titulo,descripcion,fecha_creacion)
										values ('$user_id',$proceso_id,'$_POST[title_nota]','".str_replace("'", "\\'", $_POST[summernote_nota])."','".date('Y-m-d H:i:s')."')");

								if ($compartir>0) {
									$c->Insert_Event(	$pid,
														'Nota Creada',
														"El usuario $_SESSION[usuario] ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1',
														$color, $user_id);

									$c->Insert_Event(	$pid,
														'Nota Creada',
														"Se ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1');
								}else{
									$c->Insert_Event(	$pid,
														'Nota Creada',
														"Se ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1');
								}
								echo "	<script>
											window.location.href = '".HOMEDIR."/caratula/opcion/".$id."/notas/';
										</script>";

							}else{
								$con->Query("UPDATE notas set titulo = '".$_POST[title_nota]."', descripcion = '".$c->sql_quote($_POST[summernote_nota])."' WHERE id = '".$_POST['id_nota']."'");
								/*$c->Insert_Event(	$id,
													'Nota Actualzada',
													"Se ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
													'1',
													'1');	*/

								if ($compartir>0) {
									$c->Insert_Event(	$pid,
														'Nota Actualzada',
														"El usuario $_SESSION[usuario] ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1',
														$color, $user_id);

									$c->Insert_Event(	$pid,
														'Nota Actualzada',
														"Se ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1');
								}else{
									$c->Insert_Event(	$pid,
														'Nota Actualzada',
														"Se ha creado una nota en <a href=\'/caratula/opcion/$id/notas/\' class=\'link_event\'>$_POST[title_nota]</a>",
														'1',
														'1');
								}																				
							}
							echo "	<script>
										window.location.href = '".HOMEDIR."/caratula/opcion/".$id."/notas/';
									</script>";
							#header("location:".HOMEDIR."/caratula/opcion/$id/notas/");
							break;
						case 'guardar_abono':
							$con->Query("INSERT into abonos (user_id,proceso_id,motivo,valor,fecha)
									values ('$user_id',$proceso_id,'$_POST[motivo]','$_POST[valor])','$_POST[fecha]')");
							global $c;
							$car = new MCaratula;
							$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$proceso_id."'");	
							$pid = $car->GetId();

							if ($compartir>0) {
								$c->Insert_Event(	$pid,
													'Abono Guardado',
													"El usuario $_SESSION[usuario] ha guardado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
													'1',
													'1',
													$color, $user_id);

								$c->Insert_Event(	$pid,
													'Abono Guardado',
												"Se ha guardado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
													'1',
													'1');
							}else{
								$c->Insert_Event(	$pid,
													'Abono Guardado',
												"Se ha guardado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
													'1',
													'1');
							}			


								$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha registrado un abono en el proceso<br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se ha registrado un abono en el proceso<br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}

							echo "	<script>
									window.location.href = '".HOMEDIR."/caratula/opcion/".$id."/abonos/';
								</script>";
							#header("location:".HOMEDIR."/caratula/opcion/$id/abonos/");
							break;
						case 'subir_abono':
							$filename=UPLOADS.DS.$user_id.'/';
							if (!file_exists($filename)) {
							    mkdir(UPLOADS.DS . $user_id, 0777);
							}
							$filename=UPLOADS.DS.$user_id.'/abonos/';
							if (!file_exists($filename)) {
							    mkdir(UPLOADS.DS . $user_id.'/abonos', 0777);
							}
							if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
								if(move_uploaded_file($_FILES['upl']['tmp_name'], UPLOADS.DS.$user_id.'/abonos/'.$rand.'_'.$_FILES['upl']['name'])){
									$con->Query("INSERT into abonos_img (proceso_id,nom_palabra,nom_img,user_id) values ('$proceso_id','".$_FILES['upl']['name']."','".$rand.'_'.$_FILES['upl']['name']."','$user_id')");
									global $c;
									if ($compartir>0) {
										$c->Insert_Event(	$pid,
															'Abono Cargado',
															"El usuario $_SESSION[usuario] ha cargado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1',
															$color, $user_id);

										$c->Insert_Event(	$pid,
															'Abono Cargado',
															"Se ha cargado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1');
									}else{
										$c->Insert_Event(	$pid,
															'Abono Cargado',
															"Se ha cargado un abono en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1');
									}			


									$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado soportes de abonos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado soportes de abonos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}

									exit;
								}
							}
							break;
						case 'guardar_gasto':
							$con->Query("INSERT into gastos (user_id,proceso_id,motivo,valor,fecha)
									values ('$user_id',$proceso_id,'$_POST[motivo]','$_POST[valor])','$_POST[fecha]')");
							global $c;
			
								if ($compartir>0) {
									$c->Insert_Event(	$pid,
														'Gasto Guardado',
														"El usuario $_SESSION[usuario] ha guardado un gasto en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
														'1',
														'1',
														$color, $user_id);

									$c->Insert_Event(	$pid,
														'Gasto Guardado',
														"Se ha guardado un gasto en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
														'1',
														'1');
								}else{
									$c->Insert_Event(	$pid,
														'Gasto Guardado',
														"Se ha guardado un gasto en <a href=\'/caratula/opcion/$id/abonos/\' class=\'link_event\'>$_POST[motivo]</a>",
														'1',
														'1');
								}

								$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado gastos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado gastos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
							echo "	<script>
								window.location.href = '".HOMEDIR."/caratula/opcion/".$id."/gastos/';
							</script>";
							#header("location:".HOMEDIR."/caratula/opcion/$id/gastos/");
							break;
						case 'subir_gasto':
							$filename=UPLOADS.DS.$user_id.'/';
							if (!file_exists($filename)) {
							    mkdir(UPLOADS.DS . $user_id, 0777);
							}
							$filename=UPLOADS.DS.$user_id.'/gastos/';
							if (!file_exists($filename)) {
							    mkdir(UPLOADS.DS . $user_id.'/gastos', 0777);
							}
							if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
								if(move_uploaded_file($_FILES['upl']['tmp_name'], UPLOADS.DS.$user_id.'/gastos/'.$rand.'_'.$_FILES['upl']['name'])){
									$con->Query("INSERT into gastos_img (proceso_id,nom_palabra,nom_img,user_id) values ('$proceso_id','".$_FILES['upl']['name']."','".$rand.'_'.$_FILES['upl']['name']."','$user_id')");
									global $c;
									$car = new MCaratula;
									$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$proceso_id."'");	
									$pid = $car->GetId();

									if ($compartir>0) {
										$c->Insert_Event(	$pid,
															'Gasto Cargado',
												"El usuario $_SESSION[usuario] ha cargado un gasto en <a href=\'/caratula/opcion/$proceso_id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1',
															$color, $user_id);

										$c->Insert_Event(	$pid,
															'Gasto Cargado',
												"Se ha cargado un gasto en <a href=\'/caratula/opcion/$proceso_id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1');
									}else{
										$c->Insert_Event(	$pid,
															'Gasto Cargado',
												"Se ha cargado un gasto en <a href=\'/caratula/opcion/$proceso_id/abonos/\' class=\'link_event\'>".$_FILES['upl']['name']."</a>",
															'1',
															'1');
									}

										$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email_repres"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado soportes de gastos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
								$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
								$st = $con->Query($strx);
#								echo $strx;								
								while ($rst = $con->FetchAssoc($st)) {
									$em = explode(",", $rst["email"]);
									for ($k=0; $k < count($em); $k++) { 
										$mail = new PHPMailer;
										$mail->Host = "Carpeta Ciudadana";
										$mail->From = $_SESSION["usuario"];
										$mail->FromName =  $_SESSION['nombre'];
										$mail->Subject = $subject;
										$mail->ConfirmReadingTo = $_SESSION["usuario"];

										$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
													<p><b>Asunto: </b>Se han realizado actuaciones en un proceso</p>
													<p><b>Demanda: </b> ".$con->Result($proceso,0,'tit_demanda')."</p>
													<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

													<p> Sr./Sra. <br> Se han cargado soportes de gastos al proceso <br></p>";

										$mail->IsHTML(true);
										
										$bodymessage = $f->BodyMail($body);

										#echo $bodymessage;

										$mail->Body = $bodymessage;
										$mail->AddAddress($em[$k]);
										$mail->Send();
									}	

								}
									exit;
								}
							}
							break;
						case 'nom_anexo':
							$con->Query("UPDATE anexos set nom_palabra = '$_POST[name]' where id = '$_POST[id_anexo]'");
							exit;
							break;
						case 'get_nota':
							$query=$con->Query("SELECT * from notas where id = '$_POST[id_nota]'");
							$array[texto]=$con->Result($query,0,'descripcion');
							$array[title]=$con->Result($query,0,'titulo');
							$array[id]=$con->Result($query,0,'id');
							echo json_encode($array);
							exit;
							break;
						case 'actuaciones':
							global $c;
							global $f;
							if (isset($_POST[form-control])) {

								$car = new MCaratula;
								$car->CreateCaratula_by_Proceso("id = '".$_GET['id']."'");	
								$pid = $car->GetId();	

								$con->Query("INSERT into actuaciones (user_id,proceso_id,act,fecha,estado_actuacion)
												values ('".$car->GetUser_id()."','$pid','$_POST[form-control]','$_POST[fecha_act]','$_POST[alerta_act]')");

								$e = new MEvents;

								$alog = $c->consultarlog();
								$log = $c->GetFechaLog();
										
								$dif = $f->Diferencia($_POST['fecha_act'], $log);
								$dif = $dif + $alog;
								
								$date = $dif; 

								$descripcion = $c->sql_quote("En el proceso <a href='/caratula/opcion/".$pid."/actuaciones/' class='link_event'>".$con->Result($proceso,0,'tit_demanda')."</a> ".$_POST['form-control']);

								#$e->InsertEvents($_SESSION['usuario'],$date,"Se ha creado una actuacion",$descripcion, $c->consultarlog(), 0, 0, 0, date("H:i:s"), $pid, 0, $_POST[alerta_act], 0, 0, $date);
								
								if ($compartir>0) {
									$e->InsertEvents($_SESSION['usuario'],$date,"Se ha creado una actuacion",$descripcion, $c->consultarlog(), 0, 0, 0, date("H:i:s"), $pid, 0, $_POST[alerta_act], 0, 0, $date);
									$e->InsertEvents($user_id,			$date,"El usuario $_SESSION[usuario] ha creado una actuacion",$descripcion, $c->consultarlog(), 0, 1, 0, date("H:i:s"), $pid, 0, $_POST[alerta_act], 0, 0, $date);
									
								}else{
									$e->InsertEvents($_SESSION['usuario'],$date,"Se ha creado una actuacion",$descripcion, $c->consultarlog(), 0, 0, 0, date("H:i:s"), $pid, 0, $_POST[alerta_act], 0, 0, $date);
								}

								$this->SendMailGroup("Se ha creado una actuacion: ",$descripcion, "Se ha creado una actuación", $pid, $con->Result($proceso,0,'tit_demanda'));

						

							}							
							break;
						default:
							# code...
							break;
					}
					$unique = $con->Query("SELECT f.* from folder f, folder_demanda fd where f.id = fd.folder_id and fd.proceso_id = '$proceso_id' and fd.user_id = '$user_id'");
					$type = ($compartir>0)?1:0;
					$unique = $folder->Create_List($unique,$type);
			   		$query = $object->ListarCaratula("c,folder f,folder_demanda fd where fd.folder_id=f.id and fd.user_id = '$user_id' and c.proceso_id=fd.proceso_id and fd.user_id=c.user_id and fd.proceso_id='$proceso_id'",'order by fd.fecha desc');
					$proces = $object->Create_Lista($query);		   				   			
		   			$unique2 = $con->Query("SELECT f.* from folder f, folder_demanda fd where f.id = fd.folder_id and fd.proceso_id = '$proceso_id' and fd.user_id = '$user_id'");
		   			$id=$con->Result($unique2,0,'id');
		   			$procesos = ($compartir > 0)
		   			?$object->ListarCaratula("c,compartir fd where fd.compartir = '$_SESSION[usuario]' and c.proceso_id=fd.proceso_id and c.user_id=fd.user_id","order by fd.id") 
		   			:$object->ListarCaratula("c,folder f,folder_demanda fd where fd.folder_id=f.id and fd.user_id = '$_SESSION[usuario]' and c.proceso_id=fd.proceso_id and fd.user_id=c.user_id and f.id='$id'",'order by fd.fecha desc');
		   			$result = $folder->Create_List_Proces($procesos);
					ob_start();	
					$opc="opcion_".$_REQUEST['cn'];
					$proces.= $object->$opc($proceso_id,$user_id,$f,$msg);		   			
					include_once(VIEWS.DS.'caratula/Listar.php');	   					
					$table = ob_get_clean();
					$pagina = $this->load_template(ucwords($_REQUEST[cn]).' Proceso');													
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
					$this->view_page($pagina);
				}else
					exit;				
			}else
				exit;
		}
		function ExportarAnexo($id){
			global $con;
			$m = new MMemoriales;
			$m->CreateMemoriales("id", $id);


			$a = new MAnexos;
			$string = hash("sha256", $id.$_SESSION["usuario"].date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]); 
		#	include(APP.'plugins/mix_images/index.php');
			$timestamp = "<div><div style='font-size:8px; float:left; text-style:italic'>Firma digital y estampado cronológico que se encuentra en los documento oficiales de Carpeta Ciudadana. <br>Documento generado el dia ".date("Y-m-d")." a las ".date("H:i:s")." desde ".$_SERVER["REMOTE_ADDR"]." / Código del Documento: $string</div></div>"; 
			$foot = "<div><div style='font-size:8px; float:left'>Este documento  se encuentra firmado digital y electrónicamente. <br><br>Cuando este documento sea enviado electrónicamente como mensaje de datos generará una guía electrónica que  garantiza que es único e irrepetible.convirtiéndolo en un documento auténtico según la ley 527 de 1999.</div></div>";
			$fpath = '<html><head></head><body>'.$timestamp;
			$lpath = '<hr>'.$foot.'</body></html>';

			$html = utf8_decode($fpath.html_entity_decode($m->GetContenido()).$lpath);
			$dompdf = new DOMPDF();

			$name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
			#$dompdf->set_paper('legal','');
			$dompdf->load_html($html);
			ini_set("memory_limit","32M"); 
			$dompdf->render();
			/*$dompdf->stream('my.pdf',array('Attachment'=>0));*/
			$pdf = $dompdf->output();

			file_put_contents(UPLOADS.DS . $m->GetUser_id().DS.'anexos'.DS.$name, $pdf);

			$car = new MCaratula;
			$fol = $car->GetTotalAnexosProcesos($m->GetProceso_id());
			$fol += 1;

			$a->InsertAnexos($m->GetProceso_id(), $m->GetNombre(), $name, $m->GetUser_id(), date("Y-m-d"), date("H:i:s"), $_SERVER['REMOTE_ADDR'], $fol);

		}

		function ExportarAnexoWord($id){

			$m = new MMemoriales;
			$m->CreateMemoriales("id", $id);

			header('Content-type: application/vnd.ms-word; name="word"');
			header("Content-Disposition: attachment; filename=".$m->GetNombre().".docx");
			header("Pragma: no-cache");
			header("Expires: 0");

			echo htmlspecialchars_decode($m->GetContenido());
		}

		function UpdateDDO($id, $status){
			global $con;
			$exp = new MDemandado_proceso;
			$ar1 = array($status);
			$ar2 = array('notif_actuaciones');
			$output = array("Actualizado", "No se pudo Actualizar");
			$constrain = "WHERE id = '".$id."'";

			$out = $exp->UpdateDemandado_proceso($constrain, $ar2, $ar1, $output);

			echo $out;
		}
		function UpdateDDE($id, $status){
			global $con;
			$exp = new MDemandante_proceso_juridico;
			$ar1 = array($status);
			$ar2 = array('notif_actuaciones');
			$output = array("Actualizado", "No se pudo Actualizar");
			$constrain = "WHERE id = '".$id."'";

			$out = $exp->UpdateDemandante_proceso_juridico($constrain, $ar2, $ar1, $output);

			echo $out;
		}
		function Save_Demandante(){

			global $con;
			global $c;

			$exp = new MDemandante_proceso_juridico;
			$exp->CreateDemandante_proceso_juridico("id", $_REQUEST[id]);


			$path = "";
			$change = false;
			if($exp->GetNom_entidad() != $c->sql_quote($_POST[nom_entidad])){
				$path .= "<li>Se edito el campo 'Nombre' de '".$exp->GetNom_entidad()."' por '$c->sql_quote($_POST[nom_entidad])' </li>";
				$change = true;
			}
			if($exp->GetNit_entidad() != $c->sql_quote($_POST[nit_entidad])){
				$path .= "<li>Se edito el campo 'Identificación' de '".$exp->GetNit_entidad()."' por '$c->sql_quote($_POST[nit_entidad])' </li>";
				$change = true;
			}
			if($exp->GetDir_entidad() != $c->sql_quote($_POST[dir_entidad])){
				$path .= "<li>Se edito el campo 'Direccion' de '".$exp->GetDir_entidad()."' por '$c->sql_quote($_POST[dir_entidad])' </li>";
				$change = true;
			}
			if($exp->GetCiu_entidad() != $c->sql_quote($_POST[ciu_entidad])){
				$path .= "<li>Se edito el campo 'Ciudad' de '".$exp->GetCiu_entidad()."' por '$c->sql_quote($_POST[ciu_entidad])' </li>";
				$change = true;
			}
			if($exp->GetTelefonos() != $c->sql_quote($_POST[telefonos])){
				$path .= "<li>Se edito el campo 'Telefonos' de '".$exp->GetTelefonos()."' por '$c->sql_quote($_POST[telefonos])' </li>";
				$change = true;
			}
			if($exp->GetEmail_repres() != $c->sql_quote($_POST[email_repres])){
				$path .= "<li>Se edito el campo 'E-mail' ".$exp->GetEmail_repres()."' por '$c->sql_quote($_POST[email_repres])' </li>";
				$change = true;
			}
			if($exp->GetP_nom_repres() != $c->sql_quote($_POST[p_nom_repres])){
				$path .= "<li>Se edito el campo 'Representante Legal' de '".$exp->GetP_nom_repres()."' por '$c->sql_quote($_POST[p_nom_repres])' </li>";
				$change = true;
			}
			if($exp->GetCiu_repres() != $c->sql_quote($_POST[ciu_repres])){
				$path .= "<li>Se edito el campo 'Ciudad del Representante Legal' de '".$exp->GetCiu_repres()."' por '$c->sql_quote($_POST[ciu_repres])' </li>";
				$change = true;
			}
			
			if($change){

				$con->Query("UPDATE demandante_proceso_juridico set
								nom_entidad = '".$c->sql_quote($_POST[nom_entidad])."',
								nit_entidad = '".$c->sql_quote($_POST[nit_entidad])."',
								dir_entidad = '".$c->sql_quote($_POST[dir_entidad])."',
								ciu_entidad = '".$c->sql_quote($_POST[ciu_entidad])."',
								telefonos   = '".$c->sql_quote($_POST[email_repres])."',
								email_repres= '".$c->sql_quote($_POST[telefonos])."',
								p_nom_repres= '".$c->sql_quote($_POST[p_nom_repres])."',
								ciu_repres  = '".$c->sql_quote($_POST[ciu_repres])."'
								where id = '$_REQUEST[id]'");

				$ar2 = array('fecha_actualizacion');
				$ar1 = array(date("Y-m-d H:i:s"));
				$output = array('registro actualizado', 'no se pudo actualizar'); 
				$constrain = "WHERE proceso_id = '".$exp->GetProceso_id()."' and user_id = '".$_SESSION['usuario']."'";
				$msg=$this->Editar($constrain, $ar2, $ar1, $output);

	
				$car = new MCaratula;
				$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$exp->GetProceso_id()."'");	
				$pid = $car->GetId();	
				$id = $car->GetId();	

				if ($compartir>0) {
					$c->Insert_Event(	$pid, 'Edición de Proceso', "El usuario $_SESSION[usuario] ha editado informacion del cliente ".$exp->GetNom_entidad()." <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1', $color, $user_id);

					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion del cliente ".$exp->GetNom_entidad()." <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}else{
					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion del cliente ".$exp->GetNom_entidad()." <ul>".$c->sql_quote($path)."</ul> En el proceso: <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}
			}





			

		}
		function Save_demandado(){
			global $con;
			global $c;

			$exp = new MDemandado_proceso;
			$exp->CreateDemandado_proceso("id", $_REQUEST[id]);


			$path = "";
			$change = false;
			if($exp->GetP_nombre() != $c->sql_quote($_POST[nombre])){
				$path .= "<li>Se edito el campo 'Nombre' de '".$exp->GetP_nombre()."' por '$c->sql_quote($_POST[nombre])' </li>";
				$change = true;
			}
			if($exp->GetCedula() != $c->sql_quote($_POST[cedula])){
				$path .= "<li>Se edito el campo 'Identificación' de '".$exp->GetCedula()."' por '$c->sql_quote($_POST[cedula])' </li>";
				$change = true;
			}
			if($exp->GetDireccion() != $c->sql_quote($_POST[direccion])){
				$path .= "<li>Se edito el campo 'Direccion' de '".$exp->GetDireccion()."' por '$c->sql_quote($_POST[direccion])' </li>";
				$change = true;
			}
			if($exp->GetCiudad() != $c->sql_quote($_POST[ciudad])){
				$path .= "<li>Se edito el campo 'Ciudad' de '".$exp->GetCiudad()."' por '$c->sql_quote($_POST[ciudad])' </li>";
				$change = true;
			}
			if($exp->GetTelefonos() != $c->sql_quote($_POST[telefono])){
				$path .= "<li>Se edito el campo 'Telefonos' de '".$exp->GetTelefonos()."' por '$c->sql_quote($_POST[telefono])' </li>";
				$change = true;
			}
			if($exp->GetEmail() != $c->sql_quote($_POST[email])){
				$path .= "<li>Se edito el campo 'E-mail' ".$exp->GetEmail()."' por '$c->sql_quote($_POST[email])' </li>";
				$change = true;
			}
			if($exp->GetS_apellido() != $c->sql_quote($_POST[s_apellido])){
				$path .= "<li>Se edito el campo 'Representante Legal' de '".$exp->GetS_apellido()."' por '$c->sql_quote($_POST[s_apellido])' </li>";
				$change = true;
			}
			if($exp->GetDepartamento() != $c->sql_quote($_POST[departamento])){
				$path .= "<li>Se edito el campo 'Ciudad del Representante Legal' de '".$exp->GetDepartamento()."' por '$c->sql_quote($_POST[departamento])' </li>";
				$change = true;
			}
			
			if($change){

				$con->Query("UPDATE demandado_proceso set
								p_nombre 	= '".$c->sql_quote($_POST[nombre])."',
								cedula 		= '".$c->sql_quote($_POST[cedula])."',
								direccion 	= '".$c->sql_quote($_POST[direccion])."',
								ciudad 		= '".$c->sql_quote($_POST[ciudad])."',
								telefonos   = '".$c->sql_quote($_POST[telefono])."',
								email		= '".$c->sql_quote($_POST[email])."',
								s_apellido  = '".$c->sql_quote($_POST[s_apellido])."',
								departamento= '".$c->sql_quote($_POST[departamento])."'

								where id = '".$_REQUEST[id]."'");

				$ar2 = array('fecha_actualizacion');
				$ar1 = array(date("Y-m-d H:i:s"));
				$output = array('registro actualizado', 'no se pudo actualizar'); 
				$constrain = "WHERE proceso_id = '".$exp->GetProceso_id()."' and user_id = '".$_SESSION['usuario']."'";
				$msg=$this->Editar($constrain, $ar2, $ar1, $output);

				$car = new MCaratula;
				$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$exp->GetProceso_id()."'");	
				$pid = $car->GetId();	
				$id = $car->GetId();	

				if ($compartir>0) {
					$c->Insert_Event(	$pid, 'Edición de Proceso', "El usuario $_SESSION[usuario] ha editado la informacion de la contraparte ".$exp->GetP_nombre()."<ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1', $color, $user_id);

					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion de la contraparte ".$exp->GetP_nombre()." <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}else{
					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion de la contraparte ".$exp->GetP_nombre()." <ul>".$c->sql_quote($path)."</ul> En el proceso: <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}
			}
		}


		function Save_contacto(){

			global $con;
			global $c;

			$exp = new MContactos;
			$exp->CreateContactos("id", $_REQUEST[id]);

			$exp2 = new MContactos_direccion;
			$exp2->CreateContactos_direccion("id", $_REQUEST[id]);

			$exp3 = new MContactos_emails;
			$exp3->CreateContactos_emails("id", $_REQUEST[id]);

			$exp4 = new MContactos_telefonos;
			$exp4->CreateContactos_telefonos("id", $_REQUEST[id]);


			$path = "";
			$change = false;
			if($exp->GetNombre().' '.$exp->GetApellido() != $c->sql_quote($_POST[nombre])){
				$path .= "<li>Se edito el campo 'Nombre' de '".$exp->GetNombre().' '.$exp->GetApellido()."' por '$c->sql_quote($_POST[nombre])' </li>";
				$change = true;
			}
			if($exp->GetType() != $c->sql_quote($_POST[tipo])){
				$path .= "<li>Se edito el campo 'Tipo' de '".$exp->GetType()."' por '$c->sql_quote($_POST[tipo])' </li>";
				$change = true;
			}
			if($exp2->GetDireccion() != $c->sql_quote($_POST[direccion])){
				$path .= "<li>Se edito el campo 'Direccion' de '".$exp2->GetDireccion()."' por '$c->sql_quote($_POST[direccion])' </li>";
				$change = true;
			}

			if($exp3->GetEmail() != $c->sql_quote($_POST[email])){
				$path .= "<li>Se edito el campo 'Email' de '".$exp3->GetEmail()."' por '$c->sql_quote($_POST[email])' </li>";
				$change = true;
			}

			if($exp4->GetTelefono() != $c->sql_quote($_POST[telefono])){
				$path .= "<li>Se edito el campo 'Telefono' de '".$exp4->GetTelefono()."' por '$c->sql_quote($_POST[telefono])' </li>";
				$change = true;
			}


			if($change){

				$exp =  explode(' ', $c->sql_quote($_POST[nombre]));

				$con->Query("UPDATE contactos set nombre = '$exp[0]', apellido = '$exp[1]',type = '$c->sql_quote($_POST[tipo])'  WHERE id = '$_REQUEST[id]'");
				$con->Query("UPDATE contactos_direccion SET direccion = '$c->sql_quote($_POST[direccion])' WHERE id_contacto = '$_REQUEST[id]' ");
				$con->Query("UPDATE contactos_emails SET email = '$c->sql_quote($_POST[email])' WHERE contacto_id = '$_REQUEST[id]' ");
				$con->Query("UPDATE contactos_telefonos SET telefono = '$c->sql_quote($_POST[telefono])' WHERE contacto_id = '$_REQUEST[id]' ");


				$ar2 = array('fecha_actualizacion');
				$ar1 = array(date("Y-m-d H:i:s"));
				$output = array('registro actualizado', 'no se pudo actualizar'); 
				$constrain = "WHERE proceso_id = '".$exp->GetProceso_id()."' and user_id = '".$_SESSION['usuario']."'";
				$msg=$this->Editar($constrain, $ar2, $ar1, $output);

				$car = new MCaratula;
				$car->CreateCaratula_by_Proceso("user_id = '".$_SESSION['usuario']."' AND proceso_id = '".$exp->GetProceso_id()."'");	
				$pid = $car->GetId();
				$id = $car->GetId();


				if ($compartir>0) {
					$c->Insert_Event(	$pid, 'Edición de Proceso', "El usuario $_SESSION[usuario] ha editado la informacion del contacto ".$exp->GetNombre().' '.$exp->GetApellido()."<ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1', $color, $user_id);

					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion del contacto ".$exp->GetP_nombre()." <ul>".$c->sql_quote($path)."</ul> En el proceso <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}else{
					$c->Insert_Event(	$pid, 'Edición de Proceso', "Se ha editado la informacion del contacto ".$exp->GetP_nombre()." <ul>".$c->sql_quote($path)."</ul> En el proceso: <a href=\'/caratula/opcion/$id/ver/\' class=\'link_event\'>".$car->GetTit_demanda()."</a>", '1', '1');
				}

			}

		}

		function delete_contacto($id){

			global $con;

			$str1 = "DELETE FROM contactos WHERE id = '$id'";
			$con->Query($str1);

			$str2 = "DELETE FROM contactos_direccion WHERE id_contacto = '$id'";
			$con->Query($str2);

			$str2 = "DELETE FROM contactos_emails WHERE contacto_id = '$id'";
			$con->Query($str2);

			$str2 = "DELETE FROM contactos_telefonos WHERE contacto_id = '$id'";
			$con->Query($str2);


		}

		function SendMailGroup($mailpath, $subject, $proceso_id, $titulo_proceso){

			global $con;
			global $f;
			global $c;
			$strx  = "select * from demandante_proceso_juridico where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";

			$st = $con->Query($strx);
#								echo $strx;								
			while ($rst = $con->FetchAssoc($st)) {
				$em = explode(",", $rst["email_repres"]);
				for ($k=0; $k < count($em); $k++) { 
					$mail = new PHPMailer;
					$mail->Host = "Carpeta Ciudadana";
					$mail->From = $_SESSION["usuario"];
					$mail->FromName =  $_SESSION['nombre'];
					$mail->Subject = $subject;
					$mail->ConfirmReadingTo = $_SESSION["usuario"];

					$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
								<p><b>Asunto: </b>".$subject."</p>
								<p><b>Demanda: </b> ".$titulo_proceso."</p>
								<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

								<p> Sr./Sra. <br> Se ha creado una actuacion en el proceso: '".$titulo_proceso."'</p>
								<p>".$mailpath."</p>";

					$mail->IsHTML(true);
					
					$bodymessage = $f->BodyMail($body);

					#echo $bodymessage;

					$mail->Body = $bodymessage;
					$mail->AddAddress($em[$k]);
					$mail->Send();
				}	

			}
			$strx  = "select * from demandado_proceso where proceso_id = '".$proceso_id."' and user_id = '".$_SESSION['usuario']."' and notif_actuaciones = '1'";
			$st = $con->Query($strx);
			while ($rst = $con->FetchAssoc($st)) {
				$em = explode(",", $rst["email"]);
				for ($k=0; $k < count($em); $k++) { 
					$mail = new PHPMailer;
					$mail->Host = "Carpeta Ciudadana";
					$mail->From = $_SESSION["usuario"];
					$mail->FromName =  $_SESSION['nombre'];
					$mail->Subject = $subject;
					$mail->ConfirmReadingTo = $_SESSION["usuario"];

					$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
								<p><b>Asunto: </b>".$subject."</p>
								<p><b>Demanda: </b> ".$titulo_proceso."</p>
								<p><b>Fecha: </b>".date("d-m-Y h:i:s a")."</p>

								<p> Sr./Sra. <br> Se ha creado una actuacion en el proceso: '".$titulo_proceso."'</p>
								<p>".$mailpath."</p>";

					$mail->IsHTML(true);
					
					$bodymessage = $f->BodyMail($body);

					#echo $bodymessage;

					$mail->Body = $bodymessage;
					$mail->AddAddress($em[$k]);
					$mail->Send();
				}	

			}


		}

		function CambiarCarpetaProceso($fl, $pid){
			global $con;
			global $f;
			global $c;
			$object = new MCaratula;

			$object->CreateCaratula("id", $pid);

			$strx  = "UPDATE folder_demanda SET folder_id = '$fl' where proceso_id = '".$object->GetProceso_id()."' and user_id = '".$_SESSION['usuario']."'";
			$st = $con->Query($strx);

			if ($st) {
				echo "El proceso ha sido cambiado de carpeta correctamente";
			}else{
				echo "No se puedo realizar la operacion";
			}

		}


		function TransferirCarpeta($id, $new_us){
			global $con;
			global $f;
			$m = new MCaratula;

			#FOLDER
			$con->Query("UPDATE folder 	set user_id = '$new_us' where id = '$id'");
			$con->Query("UPDATE folder_demandante_proceso 			set user_id = '$new_us' where id_folder = '$id'");
			$con->Query("UPDATE folder_demandante_proceso_juridico 	set user_id = '$new_us' where id_folder = '$id'");


				$query = $m->ListarCaratula("c,folder f,folder_demanda fd where fd.folder_id=f.id and fd.user_id = '$_SESSION[usuario]' and c.proceso_id=fd.proceso_id and fd.user_id=c.user_id and f.id='$id'",'order by fd.fecha desc');
	   			while ($row = $con->FetchAssoc($query)) {
	   				$p = $con->Result($con->Query("select id from caratula where user_id = '".$_SESSION['usuario']."' and proceso_id = '".$row['proceso_id']."'"), 0, 'id');
	   				echo "Transferir: ".$p." a $new_us <br>";
	   				$object = new MCaratula;
					$object->CreateCaratula("id", $p);
 					$new_id=$con->Result($con->Query("SELECT * from caratula where user_id = '$new_us' order by proceso_id desc limit 0,1"),0,'proceso_id')+1;
					$proceso_id = $p;
					$query=$con->Query("SELECT * from abonos_img where id = '$p'");
					$this->copy_paste($query,'nom_img','abonos',$new_us);
					$query=$con->Query("SELECT * from gastos_img where id = '$p'");
					$this->copy_paste($query,'nom_img','gastos',$new_us);

					$query=$con->Query("SELECT * from anexos where id = '$p' and estado = '1'");
					$this->copy_paste($query,'nom_img','anexos',$new_us);

					
					$con->Query("UPDATE folder_demanda 	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE caratula 		set user_id = '$new_us',proceso_id='$new_id' where id = '$p'");
					$con->Query("UPDATE abonos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE abonos_img 		set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE actuaciones 	set user_id = '$new_us', where proceso_id = '$p'");
					$con->Query("UPDATE anexos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE gastos 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE gastos_img  	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE memoriales  	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE notas 			set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '$p'");
					$con->Query("UPDATE demandado_proceso 	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE demandante_proceso_juridico 	set user_id = '$new_us',proceso_id='$new_id' where proceso_id = '".$object->GetProceso_id()."' and user_id = '$_SESSION[usuario]'");
					#$con->Query("INSERT into trasabilidad_transferencia (proceso,usuario_i,usuario_f,fecha) values('$p','$_SESSION[usuario]','$new_us','".date('Y-m-d H:i:s')."')");
					echo "<hr>";
					global $c;
					$c->Insert_Event(	$proceso_id,
										'Creación de Proceso',
										"Se ha creado un nuevo proceso: <a href=\'/caratula/opcion/$proceso_id/ver/\' class=\'link_event\'>$_POST[titulo]</a>",
										'1',
										'1');

					$c->Insert_Event(	$proceso_id,
										'Creación de Proceso',
										"Se ha creado un nuevo proceso: <a href=\'/caratula/opcion/$proceso_id/ver/\' class=\'link_event\'>$_POST[titulo]</a>",
										'1',
										'1');
					$q = $con->FetchAssoc($con->Query("select p_nombre, p_apellido from usuarios where user_id = '$new_us'"));
					$uq = $con->FetchAssoc($con->Query("select p_nombre, p_apellido from usuarios where user_id = '".$_SESSION['nombre']."'"));

					$mail = new PHPMailer;
					$mail->Host = "Carpeta Ciudadana";
					$mail->From = $_SESSION["usuario"];
					$mail->FromName =  $uq['p_nombre']." ".$uq['p_apellido'];
					$mail->Subject = "Se ha transferido un proceso a su cuenta";
					$mail->ConfirmReadingTo = $_SESSION["usuario"];

					$body = "	<p><b>Remitente: </b>Dr. ".$_SESSION['nombre']."</p>
								<p>El usuario ".$uq['p_nombre']." ".$uq['p_apellido']." le ha transferido a su cuenta el proceso ".$object->GetTit_demanda()."</p>
								<p><b>Fecha de transferencia: </b>".date("d-m-Y h:i:s a")."</p>";
					$mail->IsHTML(true);
					
					$bodymessage = $f->BodyMail($body);
					$mail->Body = $bodymessage;
					$mail->AddAddress($new_us);
					$mail->Send();
	   				/*
					*/

	   			}
	   				echo "	<script>
								window.location.href = '".HOMEDIR."/proceso/';
							</script>";
/*
*/

		}
	}
?>		