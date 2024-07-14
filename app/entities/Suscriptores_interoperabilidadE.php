<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_interoperabilidad{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $suscriptor_origen;

		public $suscriptor_destino;

		public $key_set;

		public $key_get;

		public $key_add;

		public $estado;

		public $FechaActualizacion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_interoperabilidad()
		{
			$this->id=$this->SetId("");
			$this->suscriptor_origen=$this->SetSuscriptor_origen("");
			$this->suscriptor_destino=$this->SetSuscriptor_destino("");
			$this->key_set=$this->SetKey_set("");
			$this->key_get=$this->SetKey_get("");
			$this->key_add=$this->SetKey_add("");
			$this->estado=$this->SetEstado("");
			$this->FechaActualizacion=$this->SetFechaActualizacion("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetSuscriptor_origen($some)
		{
			$this->suscriptor_origen=$some;
		}

		function SetSuscriptor_destino($some)
		{
			$this->suscriptor_destino=$some;
		}

		function SetKey_set($some)
		{
			$this->key_set=$some;
		}

		function SetKey_get($some)
		{
			$this->key_get=$some;
		}

		function SetKey_add($some)
		{
			$this->key_add=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetFechaActualizacion($some)
		{
			$this->FechaActualizacion=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetSuscriptor_origen()
		{
			return $this->suscriptor_origen;
		}

		function GetSuscriptor_destino()
		{
			return $this->suscriptor_destino;
		}

		function GetKey_set()
		{
			return $this->key_set;
		}

		function GetKey_get()
		{
			return $this->key_get;
		}

		function GetKey_add()
		{
			return $this->key_add;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetFechaActualizacion()
		{
			return $this->FechaActualizacion;
		}


	}	
	?>
