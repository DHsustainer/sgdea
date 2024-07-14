<?
// LLAMAMOS A LA ENTIDAD DEL OBJETO
include_once(ENTITIES.DS.'Dependencias_alertasE.php');

// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD
	class MDependencias_alertas extends EDependencias_alertas{
		
		// CREAMOS EL CONSTRUCTOR DE LA CLASE
		function __construct()
		{				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId("");
				parent::SetId_dependencia("");
				parent::SetUsuario("");
				parent::SetFecha("");
				parent::SetNombre("");
				parent::SetDias_alerta("");
				parent::SetDescripcion("");
				parent::SetDias_antes("");
				parent::SetAutomatica("");
				parent::SetEs_publico("");
				parent::Setdependencia_alerta("");
	}
		
		// CREAMOS EL DESTRUCTOR DE LA CLASE
		function __destruct(){
		}

		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 
		function CreateDependencias_alertas($selector = 'id', $id)
		{
			global $con;
			
			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 

			$q_str= "select * from dependencias_alertas where $selector = '".$id."'";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str);
			//OBTENEMOS EL RESULTADO DE LA CONSULTA
			$row = $con->FetchAssoc($query);

				// ASIGNAMOS LOS VALORES AL OBJETO
				parent::SetId($row['id']);
				parent::SetId_dependencia($row['id_dependencia']);
				parent::SetUsuario($row['usuario']);
				parent::SetFecha($row['fecha']);
				parent::SetNombre($row['nombre']);
				parent::SetDias_alerta($row['dias_alerta']);
				parent::SetDescripcion($row['descripcion']);
				parent::SetDias_antes($row['dias_antes']);
				parent::SetAutomatica($row['automatica']);
				parent::SetEs_publico($row['es_publico']);
				parent::Setdependencia_alerta($row['dependencia_alerta']);
		}

		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS
		function DeleteDependencias_alertas($id)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA
			$q_str= 'delete from dependencias_alertas where id = '.$id;
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
		function InsertDependencias_alertas($id_dependencia, $usuario, $fecha, $nombre, $dias_alerta, $descripcion, $dias_antes, $automatica, $es_publico, $dependencia)
		{
			global $con; 

			// DEFINIMOS LA CONSULTA		
			$q_str = "INSERT INTO dependencias_alertas (id_dependencia, usuario, fecha, nombre, dias_alerta, descripcion, dias_antes, automatica, es_publico, dependencia_alerta) VALUES ('$id_dependencia', '$usuario', '$fecha', '$nombre', '$dias_alerta', '$descripcion', '$dias_antes', '$automatica', '$es_publico', '$dependencia')";
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 
	
			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
			if (!$query) {
				echo 'Invalid query: '.$con->Error($query);
			}else{
				echo '1';
			}
		} 

		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS

		function UpdateDependencias_alertas($constrain, $fields, $updates, $output)
		{
			global $con;

			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA
			$str = "UPDATE dependencias_alertas SET ";
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
		function ListarDependencias_alertas($constrain = '', $order = 'order by id',   $limit = 'limit 1000')
		{
			global $con;

			// DEFINIMOS LA CONSULTA
			$q_str = "SELECT * FROM dependencias_alertas $path $constrain $order $limit"; 
			// EJECUTAMOS LA CONSULTA
			$query = $con->Query($q_str); 

			
			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE
				if (!$query) {
				return 'Invalid query: '.$con->Error($query);
			}else{
				return $query;
			}
		}

		function GetDependientes($id_dependencia, $dependencia_alerta, $separador){
			global $con;

			$q_str = $con->Query("Select * from dependencias_alertas where id_dependencia = '$id_dependencia'  and dependencia_alerta = '$dependencia_alerta'");

			while ($row = $con->FetchAssoc($q_str)) {
				
				echo "<option value = '".$row['id']."'>".$separador." ".$row['nombre']."</option>";
				$this->GetDependientes($id_dependencia, $row['id'], $separador.$separador);
			}
		}

		function GetDependientesListado($id_dependencia, $dependencia_alerta, $separador){
			global $con;

			$q_str = $con->Query("Select * from dependencias_alertas where id_dependencia = '$id_dependencia'  and dependencia_alerta = '$dependencia_alerta'");

			while ($row = $con->FetchAssoc($q_str)) {
				
				echo '
						<!--<li class="dd-item" data-id="1">
				            <div class="dd-handle"> Item 1 </div>
				        </li>-->
				<li  style="cursor:pointer" data-id="'.$row['orden'].'" data-role="'.$row['id'].'" class="dd-item" id="rcampo'.$row['id'].'" onclick="EditarMeta_referencias_campos(\''.$row['id'].'\')"">
							<div class="dd-handle">
								<div class="row">
									<div class="col-md-8">'.
										$row['nombre']."
									</div>
									<div class='col-md-4'>
					    				<span class='pull-right' onclick='EditarDependencias_alertas(\"".$row['id']."\")'>
											<span class='btn btn-info m-r-10 btn-sm  btn-circle mdi mdi-pencil' title='editar'></span>
										</span>
										<span class='pull-right' onclick='EliminarDependencias_alertas(\"".$row['id']."\")'>
						                    <span class='btn btn-warning  m-r-10 btn-sm btn-circle mdi mdi-delete' title='eliminar'></span>
						                </span>".'
					                </div>
					            </div>
							</div>';

				$q = $con->Query("Select count(*) as t from dependencias_alertas where id_dependencia = '".$id_dependencia."'  and dependencia_alerta = '".$row['id']."' ");
				$r = $con->FetchAssoc($q);
				if ($r['t'] > 0) {
					echo '<ol class="dd-list" style="">';
						$this->GetDependientesListado($id_dependencia, $row['id'], $separador.$separador);
					echo '</ol>';
					
				}
				echo '</li>';
			}
		}

	}	
?>