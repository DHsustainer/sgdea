<?
	// DEFINIMOS AL ENTIDAD
	class EDocumentos_gestion{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $user_id;

		public $gestion_id;

		public $nombre;

		public $f_creacion;

		public $f_actualizacion;

		public $contenido;

		public $tipo_doc;

		public $tipologia;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Documentos_gestion()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->gestion_id=$this->SetGestion_id("");
			$this->nombre=$this->SetNombre("");
			$this->f_creacion=$this->SetF_creacion("");
			$this->f_actualizacion=$this->SetF_actualizacion("");
			$this->contenido=$this->SetContenido("");
			$this->tipo_doc=$this->SetTipo_doc("");
			$this->tipologia=$this->SetTipologia("");

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

		function SetGestion_id($some)
		{
			$this->gestion_id=$some;
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

		function SetTipo_doc($some){
			$this->tipo_doc=$some;	
		}
		function SetTipologia($some){
			$this->tipologia=$some;	
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

		function GetGestion_id()
		{
			return $this->gestion_id;
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

		function GetTipo_doc()
		{
			return $this->tipo_doc;
		}
		function GetTipologia()
		{
			return $this->tipologia;
		}
	}	
?>