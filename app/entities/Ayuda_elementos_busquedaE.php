<?
	// DEFINIMOS AL ENTIDAD
	class EAyuda_elementos_busqueda{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $titulo;

		public $pista;

		public $texto;

		public $fecha_registro;

		public $fecha_actualizacion;

		public $libro_id;

		public $categoria;

		public $error;

		public $error_descripcion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Ayuda_elementos_busqueda()
		{
			$this->id=$this->SetId("");
			$this->titulo=$this->SetTitulo("");
			$this->pista=$this->SetPista("");
			$this->texto=$this->SetTexto("");
			$this->fecha_registro=$this->SetFecha_registro("");
			$this->fecha_actualizacion=$this->SetFecha_actualizacion("");
			$this->libro_id=$this->SetLibro_id("");
			$this->categoria=$this->SetCategoria("");
			$this->error=$this->SetError("");
			$this->error_descripcion=$this->SetError_descripcion("");
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

		function SetPista($some)
		{
			$this->pista=$some;
		}

		function SetTexto($some)
		{
			$this->texto=$some;
		}

		function SetFecha_registro($some)
		{
			$this->fecha_registro=$some;
		}

		function SetFecha_actualizacion($some)
		{
			$this->fecha_actualizacion=$some;
		}

		function SetLibro_id($some)
		{
			$this->libro_id=$some;
		}

		function SetCategoria($some)
		{
			$this->categoria=$some;
		}

		function SetError($some)
		{
			$this->error=$some;
		}

		function SetError_descripcion($some)
		{
			$this->error_descripcion=$some;
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

		function GetPista()
		{
			return $this->pista;
		}

		function GetTexto()
		{
			return $this->texto;
		}

		function GetFecha_registro()
		{
			return $this->fecha_registro;
		}

		function GetFecha_actualizacion()
		{
			return $this->fecha_actualizacion;
		}

		function GetLibro_id()
		{
			return $this->libro_id;
		}

		function GetCategoria()
		{
			return $this->categoria;
		}

		function GetError()
		{
			return $this->error;
		}

		function GetError_descripcion()
		{
			return $this->error_descripcion;
		}


	}	
	?>
