<?
	// DEFINIMOS AL ENTIDAD
	class EAreas_dependencias{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_area;

		public $id_dependencia;

		public $usuario;

		public $fecha;

		public $id_dependencia_raiz;

		public $observacion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Areas_dependencias()
		{
			$this->id=$this->SetId("");
			$this->id_area=$this->SetId_area("");
			$this->id_dependencia=$this->SetId_dependencia("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->id_dependencia_raiz=$this->SetId_dependencia_raiz("");
			$this->observacion=$this->SetObservacion("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_area($some)
		{
			$this->id_area=$some;
		}

		function SetId_dependencia($some)
		{
			$this->id_dependencia=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetId_dependencia_raiz($some)
		{
			$this->id_dependencia_raiz=$some;
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

		function GetId_area()
		{
			return $this->id_area;
		}

		function GetId_dependencia()
		{
			return $this->id_dependencia;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetId_dependencia_raiz()
		{
			return $this->id_dependencia_raiz;
		}

		function GetObservacion()
		{
			return $this->observacion;
		}


	}	
	?>
