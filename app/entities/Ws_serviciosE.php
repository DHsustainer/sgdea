<?
	// DEFINIMOS AL ENTIDAD
	class EWs_servicios{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		public $url;

		public $descripcion;

		public $estado;

		public $usuario;

		public $publicacion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Ws_servicios()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->url=$this->SetUrl("");
			$this->descripcion=$this->SetDescripcion("");
			$this->estado=$this->SetEstado("");
			$this->usuario=$this->SetUsuario("");
			$this->publicacion=$this->SetPublicacion("");
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

		function SetUrl($some)
		{
			$this->url=$some;
		}

		function SetDescripcion($some)
		{
			$this->descripcion=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetPublicacion($some)
		{
			$this->publicacion=$some;
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

		function GetUrl()
		{
			return $this->url;
		}

		function GetDescripcion()
		{
			return $this->descripcion;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetPublicacion()
		{
			return $this->publicacion;
		}


	}	
	?>
