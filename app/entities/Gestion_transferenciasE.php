<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_transferencias{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $gestion_id;

		public $user_transfiere;

		public $user_recibe;

		public $fecha_transferencia;

		public $fecha_aceptacion;

		public $observaciona;

		public $observacionb;

		public $estado;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_transferencias()
		{
			$this->id=$this->SetId("");
			$this->gestion_id=$this->SetGestion_id("");
			$this->user_transfiere=$this->SetUser_transfiere("");
			$this->user_recibe=$this->SetUser_recibe("");
			$this->fecha_transferencia=$this->SetFecha_transferencia("");
			$this->fecha_aceptacion=$this->SetFecha_aceptacion("");
			$this->observaciona=$this->SetObservaciona("");
			$this->observacionb=$this->SetObservacionb("");
			$this->estado=$this->SetEstado("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetGestion_id($some)
		{
			$this->gestion_id=$some;
		}

		function SetUser_transfiere($some)
		{
			$this->user_transfiere=$some;
		}

		function SetUser_recibe($some)
		{
			$this->user_recibe=$some;
		}

		function SetFecha_transferencia($some)
		{
			$this->fecha_transferencia=$some;
		}

		function SetFecha_aceptacion($some)
		{
			$this->fecha_aceptacion=$some;
		}

		function SetObservaciona($some)
		{
			$this->observaciona=$some;
		}

		function SetObservacionb($some)
		{
			$this->observacionb=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetGestion_id()
		{
			return $this->gestion_id;
		}

		function GetUser_transfiere()
		{
			return $this->user_transfiere;
		}

		function GetUser_recibe()
		{
			return $this->user_recibe;
		}

		function GetFecha_transferencia()
		{
			return $this->fecha_transferencia;
		}

		function GetFecha_aceptacion()
		{
			return $this->fecha_aceptacion;
		}

		function GetObservaciona()
		{
			return $this->observaciona;
		}

		function GetObservacionb()
		{
			return $this->observacionb;
		}

		function GetEstado()
		{
			return $this->estado;
		}


	}	
	?>
