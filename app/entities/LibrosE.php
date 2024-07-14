<?
	// DEFINIMOS AL ENTIDAD
	class ELibros{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $titulo;

		public $cover;

		public $descripcion;

		public $autor;

		public $precio;

		public $usuario_registra;

		public $sigla;

		public $raiz;

		public $XML;

		public $estado;

		public $fecha_actualizacion;


		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Libros()
		{
			$this->id=$this->SetId("");
			$this->titulo=$this->SetTitulo("");
			$this->cover=$this->SetCover("");
			$this->descripcion=$this->SetDescripcion("");
			$this->autor=$this->SetAutor("");
			$this->precio=$this->SetPrecio("");
			$this->usuario_registra=$this->SetUsuario_registra("");
			$this->sigla=$this->SetSigla("");
			$this->raiz=$this->SetRaiz("");
			$this->XML=$this->SetXML("");
			$this->estado=$this->SetEstado("");
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

		function SetCover($some)
		{
			$this->cover=$some;
		}

		function SetDescripcion($some)
		{
			$this->descripcion=$some;
		}

		function SetAutor($some)
		{
			$this->autor=$some;
		}

		function SetPrecio($some)
		{
			$this->precio=$some;
		}

		function SetUsuario_registra($some)
		{
			$this->usuario_registra=$some;
		}

		function SetSigla($some)
		{
			$this->sigla=$some;
		}

		function SetRaiz($some)
		{
			$this->raiz=$some;
		}

		function SetXML($some)
		{
			$this->XML=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetFecha_actualizacion($some)
		{
			$this->fecha_actualizacion=$some;
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

		function GetCover()
		{
			return $this->cover;
		}

		function GetDescripcion()
		{
			return $this->descripcion;
		}

		function GetAutor()
		{
			return $this->autor;
		}

		function GetPrecio()
		{
			return $this->precio;
		}

		function GetUsuario_registra()
		{
			return $this->usuario_registra;
		}

		function GetSigla()
		{
			return $this->sigla;
		}

		function GetRaiz()
		{
			return $this->raiz;
		}

		function GetXML()
		{
			return $this->XML;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetFecha_actualizacion()
		{
			return $this->fecha_actualizacion;
		}

	}	
	?>
