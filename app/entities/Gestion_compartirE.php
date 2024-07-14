<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_compartir{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $usuario_comparte;

		public $usuario_nuevo;

		public $gestion_id;

		public $fecha;

		public $observacion;

		public $type;

		public $fecha_caducidad;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_compartir()
		{
			$this->id=$this->SetId("");
			$this->usuario_comparte=$this->SetUsuario_comparte("");
			$this->usuario_nuevo=$this->SetUsuario_nuevo("");
			$this->gestion_id=$this->SetGestion_id("");
			$this->fecha=$this->SetFecha("");
			$this->observacion=$this->SetObservacion("");
			$this->type=$this->SetType("");
			$this->fecha_caducidad=$this->Setfecha_caducidad("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function Setfecha_caducidad($some)
		{
			$this->fecha_caducidad=$some;
		}
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUsuario_comparte($some)
		{
			$this->usuario_comparte=$some;
		}

		function SetUsuario_nuevo($some)
		{
			$this->usuario_nuevo=$some;
		}

		function SetGestion_id($some)
		{
			$this->gestion_id=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetObservacion($some)
		{
			$this->observacion=$some;
		}

		function SetType($some){
			$this->type = $some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function Getfecha_caducidad()
		{
			return $this->fecha_caducidad;
		}
		function GetId()
		{
			return $this->id;
		}

		function GetUsuario_comparte()
		{
			return $this->usuario_comparte;
		}

		function GetUsuario_nuevo()
		{
			return $this->usuario_nuevo;
		}

		function GetGestion_id()
		{
			return $this->gestion_id;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetObservacion()
		{
			return $this->observacion;
		}

		function GetType(){
			return $this->type;
		}
	}	
	?>
