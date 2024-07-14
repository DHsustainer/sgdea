<?
	// DEFINIMOS AL ENTIDAD
	class EEstadosx{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		public $valor;

		public $tipo;

		public $estado;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Estadosx()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->valor=$this->SetValor("");
			$this->tipo=$this->SetTipo("");
			$this->estado=$this->SetEstado("");
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

		function SetTipo($some)
		{
			$this->tipo=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
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

		function GetTipo()
		{
			return $this->tipo;
		}

		function GetEstado()
		{
			return $this->estado;
		}


	}	
	?>
