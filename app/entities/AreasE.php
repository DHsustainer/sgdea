<?
	// DEFINIMOS AL ENTIDAD
	class EAreas{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $user_id;

		public $nombre;

		public $prefijo;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Areas()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->nombre=$this->SetNombre("");
			$this->prefijo=$this->SetPrefijo("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetPrefijo($some)
		{
			$this->prefijo=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetPrefijo()
		{
			return $this->prefijo;
		}


	}	
	?>
