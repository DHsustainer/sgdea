<?
	// DEFINIMOS AL ENTIDAD
	class EDemandado_proceso{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $proceso_id;

		public $cedula;

		public $p_nombre;

		public $s_nombre;

		public $p_apellido;

		public $s_apellido;

		public $direccion;

		public $departamento;

		public $ciudad;

		public $tipo;

		public $email;

		public $pais;

		public $telefonos;

		public $exp_identificacion;

		public $notif_actuaciones;
		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Demandado_proceso()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->cedula=$this->SetCedula("");
			$this->p_nombre=$this->SetP_nombre("");
			$this->s_nombre=$this->SetS_nombre("");
			$this->p_apellido=$this->SetP_apellido("");
			$this->s_apellido=$this->SetS_apellido("");
			$this->direccion=$this->SetDireccion("");
			$this->departamento=$this->SetDepartamento("");
			$this->ciudad=$this->SetCiudad("");
			$this->tipo=$this->SetTipo("");
			$this->email=$this->SetEmail("");
			$this->pais=$this->SetPais("");
			$this->telefonos=$this->SetTelefonos("");
			$this->exp_identificacion=$this->SetExp_identificacion("");
			$this->notif_actuaciones=$this->SetNotif_actuaciones("");
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

		function SetProceso_id($some)
		{
			$this->proceso_id=$some;
		}

		function SetCedula($some)
		{
			$this->cedula=$some;
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

		function SetDireccion($some)
		{
			$this->direccion=$some;
		}

		function SetDepartamento($some)
		{
			$this->departamento=$some;
		}

		function SetCiudad($some)
		{
			$this->ciudad=$some;
		}

		function SetTipo($some)
		{
			$this->tipo=$some;
		}

		function SetEmail($some)
		{
			$this->email=$some;
		}

		function SetPais($some)
		{
			$this->pais=$some;
		}

		function SetTelefonos($some)
		{
			$this->telefonos=$some;
		}

		function SetExp_identificacion($some)
		{
			$this->exp_identificacion=$some;
		}
		function SetNotif_actuaciones($some)
		{
			$this->notif_actuaciones=$some;
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

		function GetProceso_id()
		{
			return $this->proceso_id;
		}

		function GetCedula()
		{
			return $this->cedula;
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

		function GetDireccion()
		{
			return $this->direccion;
		}

		function GetDepartamento()
		{
			return $this->departamento;
		}

		function GetCiudad()
		{
			return $this->ciudad;
		}

		function GetTipo()
		{
			return $this->tipo;
		}

		function GetEmail()
		{
			return $this->email;
		}

		function GetPais()
		{
			return $this->pais;
		}

		function GetTelefonos()
		{
			return $this->telefonos;
		}

		function GetExp_identificacion()
		{
			return $this->exp_identificacion;
		}
		function GetNotif_actuaciones($some)
		{
			return $this->notif_actuaciones;
		}

	}	
	?>
