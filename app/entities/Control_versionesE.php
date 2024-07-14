<?
	// DEFINIMOS AL ENTIDAD
	class EControl_versiones{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $tipo;

		public $nombre;

		public $archivos;

		public $estructura_db;

		public $datos_db;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Control_versiones()
		{
			$this->id=$this->SetId("");
			$this->tipo=$this->SetTipo("");
			$this->nombre=$this->SetNombre("");
			$this->archivos=$this->SetArchivos("");
			$this->estructura_db=$this->SetEstructura_db("");
			$this->datos_db=$this->SetDatos_db("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetTipo($some)
		{
			$this->tipo=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetArchivos($some)
		{
			$this->archivos=$some;
		}

		function SetEstructura_db($some)
		{
			$this->estructura_db=$some;
		}

		function SetDatos_db($some)
		{
			$this->datos_db=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetTipo()
		{
			return $this->tipo;
		}

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetArchivos()
		{
			return $this->archivos;
		}

		function GetEstructura_db()
		{
			return $this->estructura_db;
		}

		function GetDatos_db()
		{
			return $this->datos_db;
		}


	}	
	?>
