<?
	// DEFINIMOS AL ENTIDAD
	class EUsuarios_compras{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $username;

		public $estado;

		public $descripcion;

		public $total;

		public $registro_saldo;

		public $fecha_pago;

		public $medio_pago;

		public $medio_pago_comprobante;

		public $medio_pago_imagen;

		public $codigoAutorizacion;

		public $numeroTransaccion;

		public $FechaActualizacion;

		public $referente_pago;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Usuarios_compras()
		{
			$this->id=$this->SetId("");
			$this->username=$this->SetUsername("");
			$this->estado=$this->SetEstado("");
			$this->descripcion=$this->SetDescripcion("");
			$this->total=$this->SetTotal("");
			$this->registro_saldo=$this->SetRegistro_saldo("");
			$this->fecha_pago=$this->SetFecha_pago("");
			$this->medio_pago=$this->SetMedio_pago("");
			$this->medio_pago_comprobante=$this->SetMedio_pago_comprobante("");
			$this->medio_pago_imagen=$this->SetMedio_pago_imagen("");
			$this->codigoAutorizacion=$this->SetCodigoAutorizacion("");
			$this->numeroTransaccion=$this->SetNumeroTransaccion("");
			$this->FechaActualizacion=$this->SetFechaActualizacion("");
			$this->referente_pago=$this->SetReferente_pago("");
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

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetDescripcion($some)
		{
			$this->descripcion=$some;
		}

		function SetTotal($some)
		{
			$this->total=$some;
		}

		function SetRegistro_saldo($some)
		{
			$this->registro_saldo=$some;
		}

		function SetFecha_pago($some)
		{
			$this->fecha_pago=$some;
		}

		function SetMedio_pago($some)
		{
			$this->medio_pago=$some;
		}

		function SetMedio_pago_comprobante($some)
		{
			$this->medio_pago_comprobante=$some;
		}

		function SetMedio_pago_imagen($some)
		{
			$this->medio_pago_imagen=$some;
		}

		function SetCodigoAutorizacion($some)
		{
			$this->codigoAutorizacion=$some;
		}

		function SetNumeroTransaccion($some)
		{
			$this->numeroTransaccion=$some;
		}

		function SetFechaActualizacion($some)
		{
			$this->FechaActualizacion=$some;
		}

		function SetReferente_pago($some)
		{
			$this->referente_pago=$some;
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

		function GetEstado()
		{
			return $this->estado;
		}

		function GetDescripcion()
		{
			return $this->descripcion;
		}

		function GetTotal()
		{
			return $this->total;
		}

		function GetRegistro_saldo()
		{
			return $this->registro_saldo;
		}

		function GetFecha_pago()
		{
			return $this->fecha_pago;
		}

		function GetMedio_pago()
		{
			return $this->medio_pago;
		}

		function GetMedio_pago_comprobante()
		{
			return $this->medio_pago_comprobante;
		}

		function GetMedio_pago_imagen()
		{
			return $this->medio_pago_imagen;
		}

		function GetCodigoAutorizacion()
		{
			return $this->codigoAutorizacion;
		}

		function GetNumeroTransaccion()
		{
			return $this->numeroTransaccion;
		}

		function GetFechaActualizacion()
		{
			return $this->FechaActualizacion;
		}

		function GetReferente_pago()
		{
			return $this->referente_pago;
		}


	}	
	?>
