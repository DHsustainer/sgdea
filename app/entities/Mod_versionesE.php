<?
	// DEFINIMOS AL ENTIDAD
	class EMod_versiones{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_modulo;

		public $titulo;

		public $fecha;

		public $autor;

		public $url_instalacion;

		public $url_actualizacion;

		public $url_sql;

		public $notas;

		public $estado;

		public $requerimientos;

		public $tipo_version;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Mod_versiones()
		{
			$this->id=$this->SetId("");
			$this->id_modulo=$this->SetId_modulo("");
			$this->titulo=$this->SetTitulo("");
			$this->fecha=$this->SetFecha("");
			$this->autor=$this->SetAutor("");
			$this->url_instalacion=$this->SetUrl_instalacion("");
			$this->url_actualizacion=$this->SetUrl_actualizacion("");
			$this->url_sql=$this->SetUrl_sql("");
			$this->notas=$this->SetNotas("");
			$this->estado=$this->SetEstado("");
			$this->requerimientos=$this->SetRequerimientos("");
			$this->tipo_version=$this->SetTipo_version("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_modulo($some)
		{
			$this->id_modulo=$some;
		}

		function SetTitulo($some)
		{
			$this->titulo=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetAutor($some)
		{
			$this->autor=$some;
		}

		function SetUrl_instalacion($some)
		{
			$this->url_instalacion=$some;
		}

		function SetUrl_actualizacion($some)
		{
			$this->url_actualizacion=$some;
		}

		function SetUrl_sql($some)
		{
			$this->url_sql=$some;
		}

		function SetNotas($some)
		{
			$this->notas=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetRequerimientos($some)
		{
			$this->requerimientos=$some;
		}

		function SetTipo_version($some)
		{
			$this->tipo_version=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_modulo()
		{
			return $this->id_modulo;
		}

		function GetTitulo()
		{
			return $this->titulo;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetAutor()
		{
			return $this->autor;
		}

		function GetUrl_instalacion()
		{
			return $this->url_instalacion;
		}

		function GetUrl_actualizacion()
		{
			return $this->url_actualizacion;
		}

		function GetUrl_sql()
		{
			return $this->url_sql;
		}

		function GetNotas()
		{
			return $this->notas;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetRequerimientos()
		{
			return $this->requerimientos;
		}

		function GetTipo_version()
		{
			return $this->tipo_version;
		}


	}	
	?>
