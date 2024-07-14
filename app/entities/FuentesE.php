<?
	// DEFINIMOS AL ENTIDAD
	class EFuentes{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		public $url;

		public $fecha;

		public $usuario;

		public $estado;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Fuentes()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->url=$this->SetUrl("");
			$this->fecha=$this->SetFecha("");
			$this->usuario=$this->SetUsuario("");
			$this->estado=$this->SetEstado("");
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

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
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

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetEstado()
		{
			return $this->estado;
		}


	}	
	?>
