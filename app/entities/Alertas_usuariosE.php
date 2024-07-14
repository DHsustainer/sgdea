<?
	// DEFINIMOS AL ENTIDAD
	class EAlertas_usuarios{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $dias;

		public $titulo;

		public $type;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Alertas_usuarios()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->dias=$this->SetDias("");
			$this->titulo=$this->SetTitulo("");
			$this->type=$this->SetType("");
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

		function SetDias($some)
		{
			$this->dias=$some;
		}

		function SetTitulo($some)
		{
			$this->titulo=$some;
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

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetDias()
		{
			return $this->dias;
		}

		function GetTitulo()
		{
			return $this->titulo;
		}

		function GetType()
		{
			return $this->type;
		}


	}	
	?>
