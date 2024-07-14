<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_seguimiento{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_gestion;

		public $user_id;

		public $fecha_solicitud;

		public $estado_solicitud;

		public $id_seguimiento;

		public $observacion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_seguimiento()
		{
			$this->id=$this->SetId("");
			$this->id_gestion=$this->SetId_gestion("");
			$this->user_id=$this->SetUser_id("");
			$this->fecha_solicitud=$this->SetFecha_solicitud("");
			$this->estado_solicitud=$this->SetEstado_solicitud("");
			$this->id_seguimiento=$this->SetId_seguimiento("");
			$this->observacion->$this->SetObservacion("");
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

		function SetUser_id($some)
		{
			$this->user_id=$some;
		}

		function SetFecha_solicitud($some)
		{
			$this->fecha_solicitud=$some;
		}

		function SetEstado_solicitud($some)
		{
			$this->estado_solicitud=$some;
		}

		function SetId_seguimiento($some)
		{
			$this->id_seguimiento=$some;
		}

		function SetObservacion($some)
		{
			$this->observacion=$some;
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

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetFecha_solicitud()
		{
			return $this->fecha_solicitud;
		}

		function GetEstado_solicitud()
		{
			return $this->estado_solicitud;
		}

		function GetId_seguimiento()
		{
			return $this->id_seguimiento;
		}

		function GetObservacion()
		{
			return $this->observacion;
		}


	}	
	?>
