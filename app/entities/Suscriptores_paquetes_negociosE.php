<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_paquetes_negocios{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $nombre;

		public $valor_base;

		public $tipo_negocio;

		public $usuario;

		public $fecha;

		public $proyecto_id;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_paquetes_negocios()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->valor_base=$this->SetValor_base("");
			$this->tipo_negocio=$this->SetTipo_negocio("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->proyecto_id=$this->SetProyecto_id("");
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

		function SetValor_base($some)
		{
			$this->valor_base=$some;
		}

		function SetTipo_negocio($some)
		{
			$this->tipo_negocio=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetProyecto_id($some)
		{
			$this->proyecto_id=$some;
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

		function GetValor_base()
		{
			return $this->valor_base;
		}

		function GetTipo_negocio()
		{
			return $this->tipo_negocio;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetProyecto_id()
		{
			return $this->proyecto_id;
		}


	}	
	?>
