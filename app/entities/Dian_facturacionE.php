<?
	// DEFINIMOS AL ENTIDAD
	class EDian_facturacion{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		public $nit;

		public $num_resolucion;

		public $fecha_resolucion;

		public $prefijo;

		public $rango_desde;

		public $rango_hasta;

		public $clave_tecnica;

		public $fecha_vigencia_desde;

		public $fecha_vigencia_hasta;

		public $software_id;

		public $pin;

		public $nombre_software;

		public $fecha_registro;

		public $estado;

		public $url;

		public $usuario;

		public $clave;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Dian_facturacion()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->nit=$this->SetNit("");
			$this->num_resolucion=$this->SetNum_resolucion("");
			$this->fecha_resolucion=$this->SetFecha_resolucion("");
			$this->prefijo=$this->SetPrefijo("");
			$this->rango_desde=$this->SetRango_desde("");
			$this->rango_hasta=$this->SetRango_hasta("");
			$this->clave_tecnica=$this->SetClave_tecnica("");
			$this->fecha_vigencia_desde=$this->SetFecha_vigencia_desde("");
			$this->fecha_vigencia_hasta=$this->SetFecha_vigencia_hasta("");
			$this->software_id=$this->SetSoftware_id("");
			$this->pin=$this->SetPin("");
			$this->nombre_software=$this->SetNombre_software("");
			$this->fecha_registro=$this->SetFecha_registro("");
			$this->estado=$this->SetEstado("");
			$this->url=$this->SetUrl("");
			$this->usuario=$this->SetUsuario("");
			$this->clave=$this->SetClave("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetNit($some)
		{
			$this->nit=$some;
		}

		function SetNum_resolucion($some)
		{
			$this->num_resolucion=$some;
		}

		function SetFecha_resolucion($some)
		{
			$this->fecha_resolucion=$some;
		}

		function SetPrefijo($some)
		{
			$this->prefijo=$some;
		}

		function SetRango_desde($some)
		{
			$this->rango_desde=$some;
		}

		function SetRango_hasta($some)
		{
			$this->rango_hasta=$some;
		}

		function SetClave_tecnica($some)
		{
			$this->clave_tecnica=$some;
		}

		function SetFecha_vigencia_desde($some)
		{
			$this->fecha_vigencia_desde=$some;
		}

		function SetFecha_vigencia_hasta($some)
		{
			$this->fecha_vigencia_hasta=$some;
		}

		function SetSoftware_id($some)
		{
			$this->software_id=$some;
		}

		function SetPin($some)
		{
			$this->pin=$some;
		}

		function SetNombre_software($some)
		{
			$this->nombre_software=$some;
		}

		function SetFecha_registro($some)
		{
			$this->fecha_registro=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetUrl($some)
		{
			$this->url=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetClave($some)
		{
			$this->clave=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetNit()
		{
			return $this->nit;
		}

		function GetNum_resolucion()
		{
			return $this->num_resolucion;
		}

		function GetFecha_resolucion()
		{
			return $this->fecha_resolucion;
		}

		function GetPrefijo()
		{
			return $this->prefijo;
		}

		function GetRango_desde()
		{
			return $this->rango_desde;
		}

		function GetRango_hasta()
		{
			return $this->rango_hasta;
		}

		function GetClave_tecnica()
		{
			return $this->clave_tecnica;
		}

		function GetFecha_vigencia_desde()
		{
			return $this->fecha_vigencia_desde;
		}

		function GetFecha_vigencia_hasta()
		{
			return $this->fecha_vigencia_hasta;
		}

		function GetSoftware_id()
		{
			return $this->software_id;
		}

		function GetPin()
		{
			return $this->pin;
		}

		function GetNombre_software()
		{
			return $this->nombre_software;
		}

		function GetFecha_registro()
		{
			return $this->fecha_registro;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetUrl()
		{
			return $this->url;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetClave()
		{
			return $this->clave;
		}


	}	
	?>
