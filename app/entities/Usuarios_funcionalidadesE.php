<?
	// DEFINIMOS AL ENTIDAD
	class EUsuarios_funcionalidades{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $id_funcionalidad;

		public $valor;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Usuarios_funcionalidades()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->id_funcionalidad=$this->SetId_funcionalidad("");
			$this->valor=$this->SetValor("");
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

		function SetId_funcionalidad($some)
		{
			$this->id_funcionalidad=$some;
		}

		function SetValor($some)
		{
			$this->valor=$some;
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

		function GetId_funcionalidad()
		{
			return $this->id_funcionalidad;
		}

		function GetValor()
		{
			return $this->valor;
		}


	}	
	?>
