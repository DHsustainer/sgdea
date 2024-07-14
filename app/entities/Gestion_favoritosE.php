<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_favoritos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $gestion_id;

		public $tipo_user;

		public $fecha;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_favoritos()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->gestion_id=$this->SetGestion_id("");
			$this->tipo_user=$this->SetTipo_user("");
			$this->fecha=$this->SetFecha("");
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

		function SetGestion_id($some)
		{
			$this->gestion_id=$some;
		}

		function SetTipo_user($some)
		{
			$this->tipo_user=$some;
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

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetGestion_id()
		{
			return $this->gestion_id;
		}

		function GetTipo_user()
		{
			return $this->tipo_user;
		}

		function GetFecha()
		{
			return $this->fecha;
		}


	}	
	?>
