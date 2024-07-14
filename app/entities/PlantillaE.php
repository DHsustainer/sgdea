<?
	// DEFINIMOS AL ENTIDAD
	class EPlantilla{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $nombre;

		public $f_creacion;

		public $f_actualizacion;

		public $contenido;

		public $t_plantilla;

		public $def;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Plantilla()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->nombre=$this->SetNombre("");
			$this->f_creacion=$this->SetF_creacion("");
			$this->f_actualizacion=$this->SetF_actualizacion("");
			$this->contenido=$this->SetContenido("");
			$this->t_plantilla=$this->SetT_plantilla("");
			$this->def=$this->SetDef("");
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

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetF_creacion($some)
		{
			$this->f_creacion=$some;
		}

		function SetF_actualizacion($some)
		{
			$this->f_actualizacion=$some;
		}

		function SetContenido($some)
		{
			$this->contenido=$some;
		}

		function SetT_plantilla($some)
		{
			$this->t_plantilla=$some;
		}

		function SetDef($some)
		{
			$this->def=$some;
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

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetF_creacion()
		{
			return $this->f_creacion;
		}

		function GetF_actualizacion()
		{
			return $this->f_actualizacion;
		}

		function GetContenido()
		{
			return $this->contenido;
		}

		function GetT_plantilla()
		{
			return $this->t_plantilla;
		}

		function GetDef()
		{
			return $this->def;
		}


	}	
	?>
