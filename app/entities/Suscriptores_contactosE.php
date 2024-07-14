<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_contactos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $identificacion;

		public $nombre;

		public $type;

		public $user_id;

		public $fecha;

		public $cod_ingreso; 

		public $password;

		public $estado; 

		public $dec_pass;

		public $dependencia;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_contactos()
		{
			$this->id=$this->SetId("");
			$this->identificacion=$this->SetIdentificacion("");
			$this->nombre=$this->SetNombre("");
			$this->type=$this->SetType("");
			$this->user_id=$this->SetUser_id("");
			$this->fecha=$this->SetFecha("");

			$this->cod_ingreso=$this->Setcod_ingreso("");
			$this->password=$this->Setpassword("");
			$this->estado=$this->Setestado("");
			$this->dec_pass=$this->Setdec_pass("");
			$this->dependencia=$this->Setdependencia("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetIdentificacion($some)
		{
			$this->identificacion=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetType($some)
		{
			$this->type=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function Setcod_ingreso($some){
			$this->cod_ingreso = $some;
		}

		function Setpassword($some){
			$this->password = $some;
		}

		function Setestado($some){
			$this->estado = $some;
		}

		function Setdec_pass($some){
			$this->dec_pass = $some;
		}
		function Setdependencia($some){
			$this->dependencia = $some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetIdentificacion()
		{
			return $this->identificacion;
		}

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetType()
		{
			return $this->type;
		}

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function Getcod_ingreso(){
			return $this->cod_ingreso;
		}

		function Getpassword(){
			return $this->password;
		}

		function Getestado(){
			return $this->estado;
		}

		function Getdec_pass(){
			return $this->dec_pass;
		}
		function Getdependencia(){
			return $this->dependencia;
		}


	}	
	?>
