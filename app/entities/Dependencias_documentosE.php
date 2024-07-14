<?
	// DEFINIMOS AL ENTIDAD
	class EDependencias_documentos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_dependencia;

		public $usuario;

		public $fecha;

		public $nombre;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Dependencias_documentos()
		{
			$this->id=$this->SetId("");
			$this->id_dependencia=$this->SetId_dependencia("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->nombre=$this->SetNombre("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_dependencia($some)
		{
			$this->id_dependencia=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_dependencia()
		{
			return $this->id_dependencia;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetNombre()
		{
			return $this->nombre;
		}


	}	
	?>
