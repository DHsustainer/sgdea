<?
	// DEFINIMOS AL ENTIDAD
	class EAnexos_carpeta{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $folder_id;

		public $nombre;

		public $url;

		public $user_id;

		public $fecha;

		public $hora;

		public $ip;

		public $timest;

		public $estado;

		public $folio;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Anexos_carpeta()
		{
			$this->id=$this->SetId("");
			$this->folder_id=$this->SetFolder_id("");
			$this->nombre=$this->SetNombre("");
			$this->url=$this->SetUrl("");
			$this->user_id=$this->SetUser_id("");
			$this->fecha=$this->SetFecha("");
			$this->hora=$this->SetHora("");
			$this->ip=$this->SetIp("");
			$this->timest=$this->SetTimest("");
			$this->estado=$this->SetEstado("");
			$this->folio=$this->SetFolio("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetFolder_id($some)
		{
			$this->folder_id=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetUrl($some)
		{
			$this->url=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetHora($some)
		{
			$this->hora=$some;
		}

		function SetIp($some)
		{
			$this->ip=$some;
		}

		function SetTimest($some)
		{
			$this->timest=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetFolio($some)
		{
			$this->folio=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetFolder_id()
		{
			return $this->folder_id;
		}

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetUrl()
		{
			return $this->url;
		}

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetHora()
		{
			return $this->hora;
		}

		function GetIp()
		{
			return $this->ip;
		}

		function GetTimest()
		{
			return $this->timest;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetFolio()
		{
			return $this->folio;
		}


	}	
	?>
