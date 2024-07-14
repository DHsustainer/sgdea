<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_tipos_proyectos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		public $estado;

		public $tipo_proyecto;

		public $fecha;

		public $usuario;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_tipos_proyectos()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->estado=$this->SetEstado("");
			$this->tipo_proyecto=$this->SetTipo_proyecto("");
			$this->fecha=$this->SetFecha("");
			$this->usuario=$this->SetUsuario("");
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

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetTipo_proyecto($some)
		{
			$this->tipo_proyecto=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
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

		function GetEstado()
		{
			return $this->estado;
		}

		function GetTipo_proyecto()
		{
			return $this->tipo_proyecto;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}


	}	
	?>
