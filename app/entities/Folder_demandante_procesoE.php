<?
	// DEFINIMOS AL ENTIDAD
	class EFolder_demandante_proceso{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_folder;

		public $user_id;

		public $p_nombre;

		public $s_nombre;

		public $p_apellido;

		public $s_apellido;

		public $ciudad;

		public $direccion;

		public $cedula;

		public $email;

		public $telefonos;

		public $ciudad_expedicion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Folder_demandante_proceso()
		{
			$this->id=$this->SetId("");
			$this->id_folder=$this->SetId_folder("");
			$this->user_id=$this->SetUser_id("");
			$this->p_nombre=$this->SetP_nombre("");
			$this->s_nombre=$this->SetS_nombre("");
			$this->p_apellido=$this->SetP_apellido("");
			$this->s_apellido=$this->SetS_apellido("");
			$this->ciudad=$this->SetCiudad("");
			$this->direccion=$this->SetDireccion("");
			$this->cedula=$this->SetCedula("");
			$this->email=$this->SetEmail("");
			$this->telefonos=$this->SetTelefonos("");
			$this->ciudad_expedicion=$this->SetCiudad_expedicion("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_folder($some)
		{
			$this->id_folder=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
		}

		function SetP_nombre($some)
		{
			$this->p_nombre=$some;
		}

		function SetS_nombre($some)
		{
			$this->s_nombre=$some;
		}

		function SetP_apellido($some)
		{
			$this->p_apellido=$some;
		}

		function SetS_apellido($some)
		{
			$this->s_apellido=$some;
		}

		function SetCiudad($some)
		{
			$this->ciudad=$some;
		}

		function SetDireccion($some)
		{
			$this->direccion=$some;
		}

		function SetCedula($some)
		{
			$this->cedula=$some;
		}

		function SetEmail($some)
		{
			$this->email=$some;
		}

		function SetTelefonos($some)
		{
			$this->telefonos=$some;
		}

		function SetCiudad_expedicion($some)
		{
			$this->ciudad_expedicion=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_folder()
		{
			return $this->id_folder;
		}

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetP_nombre()
		{
			return $this->p_nombre;
		}

		function GetS_nombre()
		{
			return $this->s_nombre;
		}

		function GetP_apellido()
		{
			return $this->p_apellido;
		}

		function GetS_apellido()
		{
			return $this->s_apellido;
		}

		function GetCiudad()
		{
			return $this->ciudad;
		}

		function GetDireccion()
		{
			return $this->direccion;
		}

		function GetCedula()
		{
			return $this->cedula;
		}

		function GetEmail()
		{
			return $this->email;
		}

		function GetTelefonos()
		{
			return $this->telefonos;
		}

		function GetCiudad_expedicion()
		{
			return $this->ciudad_expedicion;
		}


	}	
	?>
