<?
	// DEFINIMOS AL ENTIDAD
	class EActuaciones{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $user_id;

		public $proceso_id;

		public $act;

		public $fecha;

		public $estado_actuacion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Actuaciones()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->act=$this->SetAct("");
			$this->fecha=$this->SetFecha("");
			$this->estado_actuacion=$this->SetEstado_actuacion("");
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

		function SetAct($some)
		{
			$this->act=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetEstado_actuacion($some)
		{
			$this->estado_actuacion=$some;
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

		function GetAct()
		{
			return $this->act;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetEstado_actuacion()
		{
			return $this->estado_actuacion;
		}


	}	
	?>
