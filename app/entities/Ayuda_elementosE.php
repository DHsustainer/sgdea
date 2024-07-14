<?
	// DEFINIMOS AL ENTIDAD
	class EAyuda_elementos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $titulo;

		public $texto;
		public $detalle;

		public $fecha_registro;

		public $fecha_actualizacion;

		public $libro_id;

		public $posicion;
		public $estado;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Ayuda_elementos()
		{
			$this->id=$this->SetId("");
			$this->titulo=$this->SetTitulo("");
			$this->texto=$this->SetTexto("");
			$this->detalle=$this->SetDetalle("");
			$this->fecha_registro=$this->SetFecha_registro("");
			$this->fecha_actualizacion=$this->SetFecha_actualizacion("");
			$this->libro_id=$this->SetLibro_id("");
			$this->posicion=$this->SetPosicion("");
			$this->estado=$this->SetEstado("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetTitulo($some)
		{
			$this->titulo=$some;
		}

		function SetTexto($some)
		{
			$this->texto=$some;
		}
		function SetDetalle($some)
		{
			$this->detalle=$some;
		}

		function SetFecha_registro($some)
		{
			$this->fecha_registro=$some;
		}

		function SetFecha_actualizacion($some)
		{
			$this->fecha_actualizacion=$some;
		}

		function SetLibro_id($some)
		{
			$this->libro_id=$some;
		}

		function SetPosicion($some)
		{
			$this->posicion=$some;
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

		function GetTitulo()
		{
			return $this->titulo;
		}

		function GetTexto()
		{
			return $this->texto;
		}

		function GetDetalle()
		{
			return $this->detalle;
		}

		function GetFecha_registro()
		{
			return $this->fecha_registro;
		}

		function GetFecha_actualizacion()
		{
			return $this->fecha_actualizacion;
		}

		function GetLibro_id()
		{
			return $this->libro_id;
		}

		function GetPosicion()
		{
			return $this->posicion;
		}
		function GetEstado()
		{
			return $this->estado;
		}


	}	
	?>
