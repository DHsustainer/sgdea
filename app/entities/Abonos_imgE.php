<?
	// DEFINIMOS AL ENTIDAD
	class EAbonos_img{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $proceso_id;

		public $nom_palabra;

		public $nom_img;

		public $user_id;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Abonos_img()
		{
			$this->id=$this->SetId("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->nom_palabra=$this->SetNom_palabra("");
			$this->nom_img=$this->SetNom_img("");
			$this->user_id=$this->SetUser_id("");
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

		function SetNom_palabra($some)
		{
			$this->nom_palabra=$some;
		}

		function SetNom_img($some)
		{
			$this->nom_img=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
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

		function GetNom_palabra()
		{
			return $this->nom_palabra;
		}

		function GetNom_img()
		{
			return $this->nom_img;
		}

		function GetUser_id()
		{
			return $this->user_id;
		}


	}	
	?>
