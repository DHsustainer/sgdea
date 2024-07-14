<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_anexos_permisos_documentos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_documento;

		public $usuario_permiso;

		public $estado;

		public $fecha_solicitud;

		public $fecha_actualizacion;

		public $observacion;

		public $gestion_id;

		public $id_folder;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_anexos_permisos_documentos()
		{
			$this->id=$this->SetId("");
			$this->id_documento=$this->SetId_documento("");
			$this->usuario_permiso=$this->SetUsuario_permiso("");
			$this->estado=$this->SetEstado("");
			$this->fecha_solicitud=$this->SetFecha_solicitud("");
			$this->fecha_actualizacion=$this->SetFecha_actualizacion("");
			$this->observacion=$this->SetObservacion("");
			$this->gestion_id=$this->SetGestion_id("");
			$this->id_folder=$this->SetId_folder("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_documento($some)
		{
			$this->id_documento=$some;
		}

		function SetUsuario_permiso($some)
		{
			$this->usuario_permiso=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetFecha_solicitud($some)
		{
			$this->fecha_solicitud=$some;
		}

		function SetFecha_actualizacion($some)
		{
			$this->fecha_actualizacion=$some;
		}

		function SetObservacion($some)
		{
			$this->observacion=$some;
		}

		function SetGestion_id($some)
		{
			$this->gestion_id=$some;
		}

		function SetId_folder($some)
		{
			$this->id_folder=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_documento()
		{
			return $this->id_documento;
		}

		function GetUsuario_permiso()
		{
			return $this->usuario_permiso;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetFecha_solicitud()
		{
			return $this->fecha_solicitud;
		}

		function GetFecha_actualizacion()
		{
			return $this->fecha_actualizacion;
		}

		function GetObservacion()
		{
			return $this->observacion;
		}

		function GetGestion_id()
		{
			return $this->gestion_id;
		}

		function GetId_folder()
		{
			return $this->id_folder;
		}


	}	
	?>
