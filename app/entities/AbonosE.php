<?
	// DEFINIMOS AL ENTIDAD
	class EAbonos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $proceso_id;

		public $motivo;

		public $fecha;

		public $valor;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Abonos()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->motivo=$this->SetMotivo("");
			$this->fecha=$this->SetFecha("");
			$this->valor=$this->SetValor("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
		}

		function SetProceso_id($some)
		{
			$this->proceso_id=$some;
		}

		function SetMotivo($some)
		{
			$this->motivo=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetValor($some)
		{
			$this->valor=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetProceso_id()
		{
			return $this->proceso_id;
		}

		function GetMotivo()
		{
			return $this->motivo;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetValor()
		{
			return $this->valor;
		}


	}	
	?>
