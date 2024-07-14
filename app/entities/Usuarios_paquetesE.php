<?
	// DEFINIMOS AL ENTIDAD
	class EUsuarios_paquetes{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $nombre;

		public $valor;

		public $fecha;

		public $usuario;

		public $tipo;

		public $extra;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Usuarios_paquetes()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->valor=$this->SetValor("");
			$this->fecha=$this->SetFecha("");
			$this->usuario=$this->SetUsuario("");
			$this->tipo=$this->SetTipo("");
			$this->extra=$this->SetExtra("");
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

		function SetValor($some)
		{
			$this->valor=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetTipo($some)
		{
			$this->tipo=$some;
		}

		function SetExtra($some)
		{
			$this->extra=$some;
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

		function GetValor()
		{
			return $this->valor;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetTipo()
		{
			return $this->tipo;
		}

		function GetExtra()
		{
			return $this->extra;
		}


	}	
	?>
