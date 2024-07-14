<?
	// DEFINIMOS AL ENTIDAD
	class EAyuda_dependencias_elementos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $libro_id;

		public $elemento_padre_id;

		public $elemento_dependencia_id;

		public $orden;

		public $mostrar;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Ayuda_dependencias_elementos()
		{
			$this->id=$this->SetId("");
			$this->libro_id=$this->SetLibro_id("");
			$this->elemento_padre_id=$this->SetElemento_padre_id("");
			$this->elemento_dependencia_id=$this->SetElemento_dependencia_id("");
			$this->orden=$this->SetOrden("");
			$this->mostrar=$this->SetMostrar("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetLibro_id($some)
		{
			$this->libro_id=$some;
		}

		function SetElemento_padre_id($some)
		{
			$this->elemento_padre_id=$some;
		}

		function SetElemento_dependencia_id($some)
		{
			$this->elemento_dependencia_id=$some;
		}

		function SetOrden($some)
		{
			$this->orden=$some;
		}

		function SetMostrar($some)
		{
			$this->mostrar=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetLibro_id()
		{
			return $this->libro_id;
		}

		function GetElemento_padre_id()
		{
			return $this->elemento_padre_id;
		}

		function GetElemento_dependencia_id()
		{
			return $this->elemento_dependencia_id;
		}

		function GetOrden()
		{
			return $this->orden;
		}

		function GetMostrar()
		{
			return $this->mostrar;
		}


	}	
	?>
