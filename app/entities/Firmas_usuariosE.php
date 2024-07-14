<?
	// DEFINIMOS AL ENTIDAD
	class EFirmas_usuarios{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $username;

		public $SID;

		public $fecha_firma;

		public $fecha_expiracion;

		public $firma;

		public $estado_firma;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Firmas_usuarios()
		{
			$this->id=$this->SetId("");
			$this->username=$this->SetUsername("");
			$this->SID=$this->SetSID("");
			$this->fecha_firma=$this->SetFecha_firma("");
			$this->fecha_expiracion=$this->SetFecha_expiracion("");
			$this->firma=$this->SetFirma("");
			$this->estado_firma=$this->SetEstado_firma("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUsername($some)
		{
			$this->username=$some;
		}

		function SetSID($some)
		{
			$this->SID=$some;
		}

		function SetFecha_firma($some)
		{
			$this->fecha_firma=$some;
		}

		function SetFecha_expiracion($some)
		{
			$this->fecha_expiracion=$some;
		}

		function SetFirma($some)
		{
			$this->firma=$some;
		}

		function SetEstado_firma($some)
		{
			$this->estado_firma=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetUsername()
		{
			return $this->username;
		}

		function GetSID()
		{
			return $this->SID;
		}

		function GetFecha_firma()
		{
			return $this->fecha_firma;
		}

		function GetFecha_expiracion()
		{
			return $this->fecha_expiracion;
		}

		function GetFirma()
		{
			return $this->firma;
		}

		function GetEstado_firma()
		{
			return $this->estado_firma;
		}


	}	
	?>
