<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_suscriptores{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_gestion;

		public $id_suscriptor;

		public $usuario_id;

		public $estado;

		public $type;

		public $fecha;

		public $aviso;
		public $fecha_aviso;
		public $observacion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_suscriptores()
		{
			$this->id=$this->SetId("");
			$this->id_gestion=$this->SetId_gestion("");
			$this->id_suscriptor=$this->SetId_suscriptor("");
			$this->usuario_id=$this->SetUsuario_id("");
			$this->estado=$this->SetEstado("");
			$this->type=$this->SetType("");
			$this->fecha=$this->SetFecha("");
			$this->aviso = $this->Setaviso("");
			$this->fecha_aviso = $this->Setfecha_aviso("");
			$this->observacion = $this->Setobservacion("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_gestion($some)
		{
			$this->id_gestion=$some;
		}

		function SetId_suscriptor($some)
		{
			$this->id_suscriptor=$some;
		}

		function SetUsuario_id($some)
		{
			$this->usuario_id=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetType($some)
		{
			$this->type=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function Setaviso($some){
			$this->aviso = $some;
		}
		function Setfecha_aviso($some){
			$this->fecha_aviso = $some;
		}
		function Setobservacion($some){
			$this->observacion = $some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_gestion()
		{
			return $this->id_gestion;
		}

		function GetId_suscriptor()
		{
			return $this->id_suscriptor;
		}

		function GetUsuario_id()
		{
			return $this->usuario_id;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetType()
		{
			return $this->type;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function Getaviso(){
			return $this->aviso;
		}
		function Getfecha_aviso(){
			return $this->fecha_aviso;
		}
		function Getobservacion(){
			return $this->observacion;
		}		


	}	
	?>
