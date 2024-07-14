<?
	// DEFINIMOS AL ENTIDAD
	class ENotas{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $user_id;

		public $proceso_id;

		public $titulo;

		public $descripcion;

		public $fecha_creacion;

		public $fecha_actualizacion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Notas()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->titulo=$this->SetTitulo("");
			$this->descripcion=$this->SetDescripcion("");
			$this->fecha_creacion=$this->SetFecha_creacion("");
			$this->fecha_actualizacion=$this->SetFecha_actualizacion("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
		}

		function SetProceso_id($some)
		{
			$this->proceso_id=$some;
		}

		function SetTitulo($some)
		{
			$this->titulo=$some;
		}

		function SetDescripcion($some)
		{
			$this->descripcion=$some;
		}

		function SetFecha_creacion($some)
		{
			$this->fecha_creacion=$some;
		}

		function SetFecha_actualizacion($some)
		{
			$this->fecha_actualizacion=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetProceso_id()
		{
			return $this->proceso_id;
		}

		function GetTitulo()
		{
			return $this->titulo;
		}

		function GetDescripcion()
		{
			return $this->descripcion;
		}

		function GetFecha_creacion()
		{
			return $this->fecha_creacion;
		}

		function GetFecha_actualizacion()
		{
			return $this->fecha_actualizacion;
		}


	}	
	?>
