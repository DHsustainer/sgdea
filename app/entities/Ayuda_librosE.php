<?
	// DEFINIMOS AL ENTIDAD
	class EAyuda_libros{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $titulo;

		public $descripcion;

		public $usuario_registra;

		public $estado;

		public $fecha_registro;

		public $fecha_actualizacion;

		public $video;

		public $tipo;

		public $dependencia;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Ayuda_libros()
		{
			$this->id=$this->SetId("");
			$this->titulo=$this->SetTitulo("");
			$this->descripcion=$this->SetDescripcion("");
			$this->usuario_registra=$this->SetUsuario_registra("");
			$this->estado=$this->SetEstado("");
			$this->fecha_registro=$this->SetFecha_registro("");
			$this->fecha_actualizacion=$this->SetFecha_actualizacion("");
			$this->video=$this->SetVideo("");
			$this->tipo=$this->SetTipo("");
			$this->dependencia=$this->SetDependencia("");
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

		function SetUsuario_registra($some)
		{
			$this->usuario_registra=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetFecha_registro($some)
		{
			$this->fecha_registro=$some;
		}

		function SetFecha_actualizacion($some)
		{
			$this->fecha_actualizacion=$some;
		}

		function SetVideo($some)
		{
			$this->video=$some;
		}

		function SetTipo($some)
		{
			$this->tipo=$some;
		}

		function SetDependencia($some)
		{
			$this->dependencia=$some;
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

		function GetUsuario_registra()
		{
			return $this->usuario_registra;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetFecha_registro()
		{
			return $this->fecha_registro;
		}

		function GetFecha_actualizacion()
		{
			return $this->fecha_actualizacion;
		}

		function GetVideo()
		{
			return $this->video;
		}

		function GetTipo()
		{
			return $this->tipo;
		}

		function GetDependencia()
		{
			return $this->dependencia;
		}


	}	
	?>
