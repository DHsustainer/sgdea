<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_modulos_funciones{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $id_suscriptores_modulos;

		public $valor;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_modulos_funciones()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->id_suscriptores_modulos=$this->SetId_suscriptores_modulos("");
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

		function SetId_suscriptores_modulos($some)
		{
			$this->id_suscriptores_modulos=$some;
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

		function GetId_suscriptores_modulos()
		{
			return $this->id_suscriptores_modulos;
		}

		function GetValor()
		{
			return $this->valor;
		}


	}	
	?>
