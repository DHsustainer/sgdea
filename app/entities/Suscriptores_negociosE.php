<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_negocios{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_suscriptor;

		public $id_negocio;

		public $fecha_registro;

		public $usuario;

		public $codigo;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_negocios()
		{
			$this->id=$this->SetId("");
			$this->id_suscriptor=$this->SetId_suscriptor("");
			$this->id_negocio=$this->SetId_negocio("");
			$this->fecha_registro=$this->SetFecha_registro("");
			$this->usuario=$this->SetUsuario("");
			$this->codigo=$this->SetCodigo("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_suscriptor($some)
		{
			$this->id_suscriptor=$some;
		}

		function SetId_negocio($some)
		{
			$this->id_negocio=$some;
		}

		function SetFecha_registro($some)
		{
			$this->fecha_registro=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetCodigo($some)
		{
			$this->codigo=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_suscriptor()
		{
			return $this->id_suscriptor;
		}

		function GetId_negocio()
		{
			return $this->id_negocio;
		}

		function GetFecha_registro()
		{
			return $this->fecha_registro;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetCodigo()
		{
			return $this->codigo;
		}


	}	
	?>
