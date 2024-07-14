<?
	// DEFINIMOS AL ENTIDAD
	class EDependencias_permisos_documento{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_documento;

		public $id_dependencia;

		public $usuario_permiso;

		public $fecha;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Dependencias_permisos_documento()
		{
			$this->id=$this->SetId("");
			$this->id_documento=$this->SetId_documento("");
			$this->id_dependencia=$this->SetId_dependencia("");
			$this->usuario_permiso=$this->SetUsuario_permiso("");
			$this->fecha=$this->SetFecha("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_documento($some)
		{
			$this->id_documento=$some;
		}

		function SetId_dependencia($some)
		{
			$this->id_dependencia=$some;
		}

		function SetUsuario_permiso($some)
		{
			$this->usuario_permiso=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_documento()
		{
			return $this->id_documento;
		}

		function GetId_dependencia()
		{
			return $this->id_dependencia;
		}

		function GetUsuario_permiso()
		{
			return $this->usuario_permiso;
		}

		function GetFecha()
		{
			return $this->fecha;
		}


	}	
	?>
