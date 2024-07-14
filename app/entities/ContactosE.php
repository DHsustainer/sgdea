<?
	// DEFINIMOS AL ENTIDAD
	class EContactos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $proceso_id;

		public $nombre;

		public $apellido;

		public $type;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Contactos()
		{
			$this->id=$this->SetId("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->nombre=$this->SetNombre("");
			$this->apellido=$this->SetApellido("");
			$this->type=$this->SetType("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetProceso_id($some)
		{
			$this->proceso_id=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetApellido($some)
		{
			$this->apellido=$some;
		}

		function SetType($some)
		{
			$this->type=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetProceso_id()
		{
			return $this->proceso_id;
		}

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetApellido()
		{
			return $this->apellido;
		}

		function GetType()
		{
			return $this->type;
		}


	}	
	?>
