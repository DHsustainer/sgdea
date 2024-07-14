<?
	// DEFINIMOS AL ENTIDAD
	class EWf_mapas{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $titulo;

		public $descripcion;

		public $usuario;

		public $fecha;

		public $id_dependencia;

		public $tipo_dependencia;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Wf_mapas()
		{
			$this->id=$this->SetId("");
			$this->titulo=$this->SetTitulo("");
			$this->descripcion=$this->SetDescripcion("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->id_dependencia=$this->SetId_dependencia("");
			$this->tipo_dependencia=$this->SetTipo_dependencia("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetTitulo($some)
		{
			$this->titulo=$some;
		}

		function SetDescripcion($some)
		{
			$this->descripcion=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetId_dependencia($some)
		{
			$this->id_dependencia=$some;
		}

		function SetTipo_dependencia($some)
		{
			$this->tipo_dependencia=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetTitulo()
		{
			return $this->titulo;
		}

		function GetDescripcion()
		{
			return $this->descripcion;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetId_dependencia()
		{
			return $this->id_dependencia;
		}

		function GetTipo_dependencia()
		{
			return $this->tipo_dependencia;
		}


	}	
	?>
