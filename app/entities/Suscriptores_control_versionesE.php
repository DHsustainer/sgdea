<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_control_versiones{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_version;

		public $id_suscriptor;

		public $fecha;

		public $estado;

		public $activo;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_control_versiones()
		{
			$this->id=$this->SetId("");
			$this->id_version=$this->SetId_version("");
			$this->id_suscriptor=$this->SetId_suscriptor("");
			$this->fecha=$this->SetFecha("");
			$this->estado=$this->SetEstado("");
			$this->activo=$this->SetActivo("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_version($some)
		{
			$this->id_version=$some;
		}

		function SetId_suscriptor($some)
		{
			$this->id_suscriptor=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetActivo($some)
		{
			$this->activo=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_version()
		{
			return $this->id_version;
		}

		function GetId_suscriptor()
		{
			return $this->id_suscriptor;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetActivo()
		{
			return $this->activo;
		}


	}	
	?>
