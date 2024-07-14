<?
	// DEFINIMOS AL ENTIDAD
	class EWf_gestion_mapas{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $titulo;

		public $descripcion;

		public $usuario;

		public $fecha;

		public $id_dependencia;

		public $id_gestion;

		public $tipo_dependencia;

		public $id_mapa;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Wf_gestion_mapas()
		{
			$this->id=$this->SetId("");
			$this->titulo=$this->SetTitulo("");
			$this->descripcion=$this->SetDescripcion("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->id_dependencia=$this->SetId_dependencia("");
			$this->id_gestion=$this->SetId_gestion("");
			$this->tipo_dependencia=$this->SetTipo_dependencia("");
			$this->id_mapa=$this->SetId_mapa("");
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

		function SetId_gestion($some)
		{
			$this->id_gestion=$some;
		}

		function SetTipo_dependencia($some)
		{
			$this->tipo_dependencia=$some;
		}

		function SetId_mapa($some)
		{
			$this->id_mapa=$some;
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

		function GetId_gestion()
		{
			return $this->id_gestion;
		}

		function GetTipo_dependencia()
		{
			return $this->tipo_dependencia;
		}

		function GetId_mapa()
		{
			return $this->id_mapa;
		}


	}	
	?>
