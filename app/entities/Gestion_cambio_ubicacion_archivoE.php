<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_cambio_ubicacion_archivo{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_gestion;

		public $nombre_destino;

		public $estado_archivo_origen;

		public $estado_archivo_destino;

		public $estado;

		public $fecha;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_cambio_ubicacion_archivo()
		{
			$this->id=$this->SetId("");
			$this->id_gestion=$this->SetId_gestion("");
			$this->nombre_destino=$this->SetNombre_destino("");
			$this->estado_archivo_origen=$this->SetEstado_archivo_origen("");
			$this->estado_archivo_destino=$this->SetEstado_archivo_destino("");
			$this->estado=$this->SetEstado("");
			$this->fecha=$this->SetFecha("");
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

		function SetNombre_destino($some)
		{
			$this->nombre_destino=$some;
		}

		function SetEstado_archivo_origen($some)
		{
			$this->estado_archivo_origen=$some;
		}

		function SetEstado_archivo_destino($some)
		{
			$this->estado_archivo_destino=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
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

		function GetNombre_destino()
		{
			return $this->nombre_destino;
		}

		function GetEstado_archivo_origen()
		{
			return $this->estado_archivo_origen;
		}

		function GetEstado_archivo_destino()
		{
			return $this->estado_archivo_destino;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetFecha()
		{
			return $this->fecha;
		}


	}	
	?>
