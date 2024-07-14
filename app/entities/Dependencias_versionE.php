<?
	// DEFINIMOS AL ENTIDAD
	class EDependencias_version{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		public $estado;

		public $fecha_inicio;

		public $fecha_fin;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Dependencias_version()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->estado=$this->SetEstado("");
			$this->fecha_inicio=$this->SetFecha_inicio("");
			$this->fecha_fin=$this->SetFecha_fin("");
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

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetFecha_inicio($some)
		{
			$this->fecha_inicio=$some;
		}

		function SetFecha_fin($some)
		{
			$this->fecha_fin=$some;
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

		function GetEstado()
		{
			return $this->estado;
		}

		function GetFecha_inicio()
		{
			return $this->fecha_inicio;
		}

		function GetFecha_fin()
		{
			return $this->fecha_fin;
		}


	}	
	?>
