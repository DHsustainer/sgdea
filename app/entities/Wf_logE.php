<?
	// DEFINIMOS AL ENTIDAD
	class EWf_log{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $usuario;

		public $fecha;

		public $actividad;

		public $id_mapa;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Wf_log()
		{
			$this->id=$this->SetId("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->actividad=$this->SetActividad("");
			$this->id_mapa=$this->SetId_mapa("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetActividad($some)
		{
			$this->actividad=$some;
		}

		function SetId_mapa($some)
		{
			$this->id_mapa=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetActividad()
		{
			return $this->actividad;
		}

		function GetId_mapa()
		{
			return $this->id_mapa;
		}


	}	
	?>
