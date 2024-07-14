<?

// LLAMAMOS A LA ENTIDAD DEL OBJETO

include_once(ENTITIES.DS.'Meta_big_dataE.php');



// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD

	class MMeta_big_data extends EMeta_big_data{

		

		// CREAMOS EL CONSTRUCTOR DE LA CLASE

		function __construct()

		{				// ASIGNAMOS LOS VALORES AL OBJETO

				parent::SetId("");

				parent::SetType_id("");

				parent::SetRef_id("");

				parent::SetCampo_id("");

				parent::SetValor("");

				parent::SetGrupo_id("");

				parent::SetTipo_form("");

				parent::SetFecha_registro("");

				parent::SetModif_usuario("");

		}

		

		// CREAMOS EL DESTRUCTOR DE LA CLASE

		function __destruct(){

		}



		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 

		function CreateMeta_big_data($selector = 'id', $id)

		{

			global $con;

			

			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 



			$q_str= "select * from meta_big_data where $selector = '".$id."'";

			// EJECUTAMOS LA CONSULTA

			$query = $con->Query($q_str);

			//OBTENEMOS EL RESULTADO DE LA CONSULTA

			$row = $con->FetchAssoc($query);



				// ASIGNAMOS LOS VALORES AL OBJETO

				parent::SetId($row['id']);

				parent::SetType_id($row['type_id']);

				parent::SetRef_id($row['ref_id']);

				parent::SetCampo_id($row['campo_id']);

				parent::SetValor($row['valor']);

				parent::SetGrupo_id($row['grupo_id']);

				parent::SetTipo_form($row['tipo_form']);

				parent::SetFecha_registro($row['fecha_registro']);

				parent::SetModif_usuario($row['modif_usuario']);

		}



		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS

		function DeleteMeta_big_data($id)

		{

			global $con; 



			// DEFINIMOS LA CONSULTA

			$q_str= 'delete from meta_big_data where id = '.$id;

			// EJECUTAMOS LA CONSULTA

			$query = $con->Query($q_str); 



			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE

			if (!$query) {

				echo 'Invalid query: '.$con->Error($query);

			}else{

				return '1';

			}

		}



		// FUNCION QUE INSERTA UN REGISTRO EN LA BASE DE DATOS

		function InsertMeta_big_data($type_id, $ref_id, $campo_id, $valor, $grupo_id, $tipo_form = "1")

		{

			global $con; 



			// DEFINIMOS LA CONSULTA		

			$q_str = "INSERT INTO meta_big_data (type_id, ref_id, campo_id, valor, grupo_id, tipo_form) VALUES ('$type_id', '$ref_id', '$campo_id', '$valor', '$grupo_id', '$tipo_form')";

			// EJECUTAMOS LA CONSULTA

			$query = $con->Query($q_str); 

	

			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE

			if (!$query) {

				return 'Invalid query: '.$con->Error($query);

			}else{

				return '1';

			}

		} 



		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS



		function UpdateMeta_big_data($constrain, $fields, $updates, $output)

		{

			global $con;



			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA

			$str = "UPDATE meta_big_data SET ";

			//HACEMOS UN FOR QUE RECORRA LOS VECTORES DE LOS CAMPOS Y LAS ACTUALIZACIONES PARA ARMAR LA CONSULTA CON CAMPOS FLEXIBLES

			for($i = 0; $i < count($fields); $i++){

				if($i+1 < count($fields)){

					$str .= $fields[$i]. " = '".$updates[$i]."', ";

				}else{

					$str .= $fields[$i]. " = '".$updates[$i]."' ";

				}

			}

			// INGRESAMOS LA CONDICION DE CONSTRAIN (CUIDADO CON ESTO YA QUE NO DEBE IR VACIO NUNCA)

			$str .= " $constrain"; 

			// EJECUTAMOS LA CONSULTA UNA VEZ ESTE CONSTRUIDA

			$query = $con->Query($str); 

 

		

			//VERIFICAMOS SI SE EJECUTO CORRECTAMENTE	

			if (!$query) {

				return 'Invalid query: '.$con->Error($query);

			}else{

				return $query[1];

			}

		}



		// FUNCION PARA LISTAR REGISTROS 

		function ListarMeta_big_data($constrain = '', $order = 'order by orden',   $limit = 'limit 1000')

		{

			global $con;



			// DEFINIMOS LA CONSULTA

			$q_str = "SELECT * FROM meta_big_data $constrain $order"; 

			// EJECUTAMOS LA CONSULTA

			$query = $con->Query($q_str); 



			

			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE

				if (!$query) {

				return 'Invalid query: '.$con->Error($query);

			}else{

				return $query;

			}

		}



		function ObjectBigData($grupo_id){



			global $con; 



			$object = array();



			$q = $con->Query("select * from meta_big_data inner join meta_referencias_campos on meta_referencias_campos.id = meta_big_data.campo_id where grupo_id = '".$grupo_id."'");



			while($row = $con->FetchAssoc($q)){

				$object[$row['titulo_campo']]['value'] = $row['valor'];

				$object[$row['titulo_campo']]['type'] = $row['tipo_elemento'];

				$object[$row['titulo_campo']]['visible'] = $row['visible'];

				$object[$row['titulo_campo']]['title'] = $row['titulo_campo'];

				$object[$row['titulo_campo']]['id'] = $row['id'];

				#$object[$row['titulo_campo']]['lista'] = $row['id_lista'];

				#$object[$row['titulo_campo']]['observacion'] = $row['observacion'];

			}



			return $object;



		}



		function GetValorGenerico($valor, $current){

			global $con;

			global $c;

			global $f;



			$object = new MGestion;

			$object->CreateGestion("id", parent::GetType_id());

		    $u = new MUsuarios;

            $u->CreateUsuarios("a_i", $object -> Getnombre_destino());

            $nombreresponsable = $u->GetP_nombre()." ".$u->GetP_apellido();



			$retorno = "";

			switch ($valor) {

				case 'rad_externo':

					$retorno = $object->GetRadicado();

					break;

				

				case 'rad_completo':

					$retorno = $object->GetNum_oficio_respuesta();

					break;

				

				case 'rad_rapido':

					$retorno = $object->GetMin_rad();

					break;

				

				case 'suscriptor':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);

					$retorno = $s->GetNombre();

					break;

				case 'suscriptor_id':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);

					$retorno = $s->GetIdentificacion();

					break;

				case 's_dep_id':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $dep = new Msuscriptores_contactos;

                    $dep->CreateSuscriptores_contactos("id", $s->Getdependencia());



                    $depc = new Msuscriptores_contactos_direccion;

                    $depc->CreateSuscriptores_contactos_direccion("id_contacto", $dep->GetId());

					$retorno = $dep->GetIdentificacion();

					break;

				case 'suscriptor_cat':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);

					$retorno = $s->GetType();

					break;

				case 'suscriptor_dir':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $sc = new Msuscriptores_contactos_direccion;

                    $sc->CreateSuscriptores_contactos_direccion("id_contacto", $s->GetId());



					$retorno = $sc->GetDireccion();

					break;

				case 'suscriptor_ciu':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $sc = new Msuscriptores_contactos_direccion;

                    $sc->CreateSuscriptores_contactos_direccion("id_contacto", $s->GetId());



					$retorno = $sc->GetCiudad();

					break;

				case 'suscriptor_tel':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $sc = new Msuscriptores_contactos_direccion;

                    $sc->CreateSuscriptores_contactos_direccion("id_contacto", $s->GetId());



					$retorno = $sc->GetTelefonos();

					break;

				case 'suscriptor_mail':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $sc = new Msuscriptores_contactos_direccion;

                    $sc->CreateSuscriptores_contactos_direccion("id_contacto", $s->GetId());



					$retorno = $sc->GetEmail();

					break;	

				case 'suscriptor_sub':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $sc = new Msuscriptores_contactos_direccion;

                    $sc->CreateSuscriptores_contactos_direccion("id_contacto", $s->GetId());



					$retorno = $sc->GetSubnombre();

					break;		



				case 's_dep':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $dep = new Msuscriptores_contactos;

                    $dep->CreateSuscriptores_contactos("id", $s->Getdependencia());



                    $depc = new Msuscriptores_contactos_direccion;

                    $depc->CreateSuscriptores_contactos_direccion("id_contacto", $dep->GetId());

					$retorno = $dep->GetNombre();

					break;



				

				case 's_dep_cat':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $dep = new Msuscriptores_contactos;

                    $dep->CreateSuscriptores_contactos("id", $s->Getdependencia());



                    $depc = new Msuscriptores_contactos_direccion;

                    $depc->CreateSuscriptores_contactos_direccion("id_contacto", $dep->GetId());

					$retorno = $dep->GetType();

					break;							

				case 's_dep_dir':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $dep = new Msuscriptores_contactos;

                    $dep->CreateSuscriptores_contactos("id", $s->Getdependencia());



                    $depc = new Msuscriptores_contactos_direccion;

                    $depc->CreateSuscriptores_contactos_direccion("id_contacto", $dep->GetId());

					$retorno = $depc->GetDireccion();

					break;				

				case 's_dep_ciu':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $dep = new Msuscriptores_contactos;

                    $dep->CreateSuscriptores_contactos("id", $s->Getdependencia());



                    $depc = new Msuscriptores_contactos_direccion;

                    $depc->CreateSuscriptores_contactos_direccion("id_contacto", $dep->GetId());

					$retorno = $depc->GetCiudad();

					break;

				case 's_dep_tel':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $dep = new Msuscriptores_contactos;

                    $dep->CreateSuscriptores_contactos("id", $s->Getdependencia());



                    $depc = new Msuscriptores_contactos_direccion;

                    $depc->CreateSuscriptores_contactos_direccion("id_contacto", $dep->GetId());

					$retorno = $depc->GetTelefonos();

					break;							

				case 's_dep_mail':

					if ($_SESSION['suscriptor_id'] == "") {

						$susid = $object -> Getsuscriptor_id();

					}else{

						if ($_SESSION['ssubid'] == "") {

							$susid = $_SESSION['suscriptor_id'];

						}else{

							$susid = $_SESSION['ssubid'];

						}

					}

					$s = new Msuscriptores_contactos;

                    $s->CreateSuscriptores_contactos("id", $susid);



                    $dep = new Msuscriptores_contactos;

                    $dep->CreateSuscriptores_contactos("id", $s->Getdependencia());



                    $depc = new Msuscriptores_contactos_direccion;

                    $depc->CreateSuscriptores_contactos_direccion("id_contacto", $dep->GetId());

					$retorno = $depc->GetEmail();

					break;		



				case 'estado':

					$retorno = $object->GetEstado_respuesta();

					break;

				

				case 'fecha_registro':

					$retorno = $object->GetF_recibido();

					break;

				

				case 'tipo_documento':

					$d = new MDependencias();

		            $d->CreateDependencias("id", $object -> Gettipo_documento());



					$retorno = $d->GetNombre();

					break;

				

				case 'fecha_vence':

					$retorno = $object->GetFecha_vencimiento();

					break;

				

				case 'Resuelto':

					$retorno = $object->GetEstado_respuesta();

					break;

								

				case 'folios':

					$retorno = $object->Getfolio();

					break;

				

/*				case 'departamento':

					$retorno = "";

					break;

				

				case 'ciudad':

					$retorno = "";

					break;

				

				case 'oficina':

					$retorno = "";

					break;

*/				

				case 'area':

					$area = new MAreas;

                    $area->CreateAreas("id", $object->GetDependencia_destino());

                    $retorno = $area->GetNombre();

					break;

				

				case 'responsable':

					$retorno = $nombreresponsable;

					break;

				

				case 'serie':

					$d = new MDependencias();

	            	$d->CreateDependencias("id", $object -> GetId_dependencia_raiz());

					$retorno = $d->GetNombre();

					break;

				

				case 'sub_Serie':

					$d = new MDependencias();

		            $d->CreateDependencias("id", $object -> Gettipo_documento());



					$retorno = $d->GetNombre();

					break;

				

				case 'titulo':

					$retorno = $object->GetObservacion();

					break;

				

				case 'ubicacion':

					$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", 

								"-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", 

								"-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", 

								"-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");

					$retorno = $ar2[$object -> Getestado_archivo()];

					break;

				case '%CAMPOT1%':

					$retorno = $object->GetCampot1();

					break;

				case '%CAMPOT2%':

					$retorno = $object->GetCampot2();

					break;

				case '%CAMPOT3%':

					$retorno = $object->GetCampot3();

					break;

				case '%CAMPOT4%':

					$retorno = $object->GetCampot4();

					break;

				case '%CAMPOT5%':

					$retorno = $object->GetCampot5();

					break;

				case '%CAMPOT6%':

					$retorno = $object->GetCampot6();

					break;

				case '%CAMPOT7%':

					$retorno = $object->GetCampot7();

					break;

				case '%CAMPOT8%':

					$retorno = $object->GetCampot8();

					break;

				case '%CAMPOT9%':

					$retorno = $object->GetCampot9();

					break;

				case '%CAMPOT10%':

					$retorno = $object->GetCampot10();

					break;

				case '%CAMPOT11%':

					$retorno = $object->GetCampot11();

					break;

				case '%CAMPOT12%':

					$retorno = $object->GetCampot12();

					break;

				case '%CAMPOT13%':

					$retorno = $object->GetCampot13();

					break;

				case '%CAMPOT14%':

					$retorno = $object->GetCampot14();

					break;

				case '%CAMPOT15%':

					$retorno = $object->GetCampot15();

					break;	



				



				default:

					$idc = parent::GetCampo_id();

					$rf = new MMeta_referencias_campos;

					$rf->CreateMeta_referencias_campos("id", $idc);

#					if ($rf->GetTipo_elemento() == "16") {



						if ($current == "") {

							# code...

							$xc = $con->Query("Select valor_generico from meta_referencias_campos where id = '".$rf->GetId()."'");

							$t = $con->Result($xc, 0, "valor_generico");

							if (is_numeric($t)) {
								$tx = $t+1;
							}else{
								$tx = $t;
							}

							$con->Query("update meta_referencias_campos set valor_generico  = '$tx' where id = '".$rf->GetId()."'");

							if (is_numeric($t)) {

								$retorno = $t + 1; 	

							}else{

								$retorno = $t; 	

							}

						}else{

							$retorno = $current;

						}

#					}else{

#						$retorno = $t + 1; 	

#					}

					

					break;

			}

			if (parent::GetModif_usuario() == "0") {

				$this->UpdateMeta_big_data("WHERE id = '".parent::GetId()."'", array("valor"), array($retorno), array("", ""));

				return $retorno;

			}else{

				return $current;

			}











			



		}



	}	

?>