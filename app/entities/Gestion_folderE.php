<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_folder{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		public $folder_id;

		public $gestion_id;

		public $user_id;

		public $fecha;

		public $estado;

		public $tipo;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_folder()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->folder_id=$this->SetFolder_id("");
			$this->gestion_id=$this->SetGestion_id("");
			$this->user_id=$this->SetUser_id("");
			$this->fecha=$this->SetFecha("");
			$this->estado=$this->SetEstado("");
			$this->tipo=$this->SetTipo("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetFolder_id($some)
		{
			$this->folder_id=$some;
		}

		function SetGestion_id($some)
		{
			$this->gestion_id=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetTipo($some)
		{
			$this->tipo=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetFolder_id()
		{
			return $this->folder_id;
		}

		function GetGestion_id()
		{
			return $this->gestion_id;
		}

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetTipo()
		{
			return $this->tipo;
		}


	}	
	?>
