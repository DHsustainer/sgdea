<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_movimiento{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_seguimiento;

		public $usuario;

		public $fecha;

		public $movimiento;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_movimiento()
		{
			$this->id=$this->SetId("");
			$this->id_seguimiento=$this->SetId_seguimiento("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->movimiento=$this->SetMovimiento("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_seguimiento($some)
		{
			$this->id_seguimiento=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetMovimiento($some)
		{
			$this->movimiento=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_seguimiento()
		{
			return $this->id_seguimiento;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetMovimiento()
		{
			return $this->movimiento;
		}


	}	
	?>
