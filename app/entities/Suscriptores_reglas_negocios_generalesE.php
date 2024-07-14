<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_reglas_negocios_generales{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_paquete;

		public $forma_pago;

		public $valor;

		public $tipo_cobro;

		public $cantidad;

		public $tipo_regla;

		public $observacion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_reglas_negocios_generales()
		{
			$this->id=$this->SetId("");
			$this->id_paquete=$this->SetId_paquete("");
			$this->forma_pago=$this->SetForma_pago("");
			$this->valor=$this->SetValor("");
			$this->tipo_cobro=$this->SetTipo_cobro("");
			$this->cantidad=$this->SetCantidad("");
			$this->tipo_regla=$this->SetTipo_regla("");
			$this->observacion=$this->SetObservacion("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_paquete($some)
		{
			$this->id_paquete=$some;
		}

		function SetForma_pago($some)
		{
			$this->forma_pago=$some;
		}

		function SetValor($some)
		{
			$this->valor=$some;
		}

		function SetTipo_cobro($some)
		{
			$this->tipo_cobro=$some;
		}

		function SetCantidad($some)
		{
			$this->cantidad=$some;
		}

		function SetTipo_regla($some)
		{
			$this->tipo_regla=$some;
		}
		function SetObservacion($some)
		{
			$this->observacion=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_paquete()
		{
			return $this->id_paquete;
		}

		function GetForma_pago()
		{
			return $this->forma_pago;
		}

		function GetValor()
		{
			return $this->valor;
		}

		function GetTipo_cobro()
		{
			return $this->tipo_cobro;
		}

		function GetCantidad()
		{
			return $this->cantidad;
		}

		function GetTipo_regla()
		{
			return $this->tipo_regla;
		}

		function GetObservacion()
		{
			return $this->observacion;
		}


	}	
	?>
