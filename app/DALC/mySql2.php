<?
include('configuration.inc.php');
	class ConexionBaseDatos{
		
		  var $hostBD; 		// 1. Host de la Base de datos
		  var $nombreBD; 	// 2. Nombre de la Base de datos
		  var $usuario; 		// 3. Usuario para la conexi�n de la BD
		  var $clave; 		// 4. Clave para la conexi�n con la BD
		  var $mysqli;
		  
		  // 1. Funciones para obtener los datos de un objeto conexi�n
		 function obtenerHost(){
				return $this->hostBD;
		  }
		  function obtenerNombreBD(){
				return $this->nombreBD;
		  }
		  function obtenerUsuario(){
				return $this->usuario;
		  }
		  function obtenerClave(){
				return $this->clave;
		  }
		  function establecerHost($hostBD){
				$this->hostBD = $hostBD;
		  }
		  function establecerNombreBD($nombreBD){
				$this->nombreBD = $nombreBD;
		  }
		  function establecerUsuario($usuario){
				$this->usuario = $usuario;
		  }
		  function establecerClave($clave){
				$this->clave = $clave;
		  }  
		  function Connect($conexion, $db = ""){
				$conexion->establecerHost(DB_SERVER);							
				
				$conexion->establecerNombreBD(DB_NAME);
				
				$conexion->establecerUsuario(DB_USER);
				
				$conexion->establecerClave(DB_PASS);
			   
				$hostBD = $conexion->obtenerHost();
				$nombreBD = $conexion->obtenerNombreBD();
				$usuario = $conexion->obtenerUsuario();
				$clave = $conexion->obtenerClave();

				$this->mysqli = new mysqli($hostBD, $usuario, $clave, $nombreBD);
				
				if ($this->mysqli->connect_errno) {
				    echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
				}else{
					echo "Conectado Correctamente al servidor!";
				}
#				echo $mysqli->host_info . "\n";
/*
			
				if (!($link=mysql_connect($hostBD,$usuario,$clave))){
				  echo 'Error conectando a la base de datos.';
				  exit();
				}else{
					echo "Conectado correctamente a la base de datos <br>";
				}
				
				if (!mysql_select_db($nombreBD,$link)){
				  echo 'Error seleccionando la base de datos.';
				  exit();
				}else{
					echo "Base de datos conectada <br>";
				}
				*/
				echo "<hr>";
				
				return $this->mysqli;
		  }
		  //Funcion que se desconecta de la base de datos
		  function Disconnect($link){

				return mysql_close($link);
		  }
		  //Funcion que ejecuta una consulta y retorna el recordset
		  function Query($query,$type=''){
		  		
		  		$consQ = $this->mysqli->query($query);
		  		if ($type=='insert') {
		  			return $this->mysqli->insert_id;
		  		}
				$this->mysqli->query("SET NAMES 'utf8'");
				if(!$consQ){
					echo $this->mysqli->error;
				}
				
		  		return $consQ;
		  }
		  //Funcion para usar el MySQLFetchRows
		  function RowsRestults($query){
		  		return $query->fetch_row();
		  }
		  //Funcion para usar el MySQLFetchAssoc
		  function FetchAssoc($query){
		  		return $query->fetch_assoc();
		  }
		  function FetchArray($query){
		  		return $query->fetch_array();
		  }
		  //Funcion que retorna el numero de registros de una consulta
		  function NumRows($query){
		  		return @$query->num_rows;
		  }
		  //Funcion que retorna el resultado de una consulta en una posicion X
		  function Result($query, $num, $field){

		  		$query->data_seek($num); 
    			$datarow = $query->fetch_array(); 
    			return $datarow[$field];


		  		#return @mysql_result($query, $num, $field);
		  }
		  //Funcion que retorna errores de mysql
		  function Error($query){
		  		return $query->error;
		  }

	}	
?>