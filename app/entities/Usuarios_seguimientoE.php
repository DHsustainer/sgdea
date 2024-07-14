<?
	// DEFINIMOS AL ENTIDAD
	class EUsuarios_seguimiento{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $usuario_seguimiento;

		public $username;

		public $observacion;

		public $fecha;

		public $tipo_seguimiento;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Usuarios_seguimiento()
		{
			$this->id=$this->SetId("");
			$this->usuario_seguimiento=$this->SetUsuario_seguimiento("");
			$this->username=$this->SetUsername("");
			$this->observacion=$this->SetObservacion("");
			$this->fecha=$this->SetFecha("");
			$this->tipo_seguimiento=$this->SetTipo_seguimiento("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUsuario_seguimiento($some)
		{
			$this->usuario_seguimiento=$some;
		}

		function SetUsername($some)
		{
			$this->username=$some;
		}

		function SetObservacion($some)
		{
			$this->observacion=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetTipo_seguimiento($some)
		{
			$this->tipo_seguimiento=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetUsuario_seguimiento()
		{
			return $this->usuario_seguimiento;
		}

		function GetUsername()
		{
			return $this->username;
		}

		function GetObservacion()
		{
			return $this->observacion;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetTipo_seguimiento()
		{
			return $this->tipo_seguimiento;
		}


	}	
	?>
