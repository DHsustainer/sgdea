<?
	// DEFINIMOS AL ENTIDAD
	class ESolicitudes_documentos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $usuario_solicita;

		public $usuario_destino;

		public $fecha_solicitud;

		public $fecha_respuesta;

		public $fecha_caducidad;

		public $gestion_id;

		public $observacion;

		public $estado;

		public $respuesta;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Solicitudes_documentos()
		{
			$this->id=$this->SetId("");
			$this->usuario_solicita=$this->SetUsuario_solicita("");
			$this->usuario_destino=$this->SetUsuario_destino("");
			$this->fecha_solicitud=$this->SetFecha_solicitud("");
			$this->fecha_respuesta=$this->SetFecha_respuesta("");
			$this->fecha_caducidad=$this->SetFecha_caducidad("");
			$this->gestion_id=$this->SetGestion_id("");
			$this->observacion=$this->SetObservacion("");
			$this->estado=$this->SetEstado("");
			$this->respuesta=$this->SetRespuesta("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUsuario_solicita($some)
		{
			$this->usuario_solicita=$some;
		}

		function SetUsuario_destino($some)
		{
			$this->usuario_destino=$some;
		}

		function SetFecha_solicitud($some)
		{
			$this->fecha_solicitud=$some;
		}

		function SetFecha_respuesta($some)
		{
			$this->fecha_respuesta=$some;
		}

		function SetFecha_caducidad($some)
		{
			$this->fecha_caducidad=$some;
		}

		function SetGestion_id($some)
		{
			$this->gestion_id=$some;
		}

		function SetObservacion($some)
		{
			$this->observacion=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetRespuesta($some)
		{
			$this->respuesta=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetUsuario_solicita()
		{
			return $this->usuario_solicita;
		}

		function GetUsuario_destino()
		{
			return $this->usuario_destino;
		}

		function GetFecha_solicitud()
		{
			return $this->fecha_solicitud;
		}

		function GetFecha_respuesta()
		{
			return $this->fecha_respuesta;
		}

		function GetFecha_caducidad()
		{
			return $this->fecha_caducidad;
		}

		function GetGestion_id()
		{
			return $this->gestion_id;
		}

		function GetObservacion()
		{
			return $this->observacion;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetRespuesta()
		{
			return $this->respuesta;
		}


	}	
	?>
