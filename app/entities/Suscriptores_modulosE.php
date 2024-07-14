<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_modulos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $estado;

		public $nombre;

		public $key_code;

		public $descripcion;

		public $link;

		public $tipo;

		public $icono;

		public $imagen;

		public $usuario;

		public $fecha;

		public $id_proyecto;

		public $tipo_elemento;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_modulos()
		{
			$this->id=$this->SetId("");
			$this->estado=$this->SetEstado("");
			$this->nombre=$this->SetNombre("");
			$this->key_code=$this->SetKey_code("");
			$this->descripcion=$this->SetDescripcion("");
			$this->link=$this->SetLink("");
			$this->tipo=$this->SetTipo("");
			$this->icono=$this->SetIcono("");
			$this->imagen=$this->SetImagen("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->id_proyecto=$this->SetId_proyecto("");
			$this->tipo_elemento=$this->SetTipo_elemento("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetKey_code($some)
		{
			$this->key_code=$some;
		}

		function SetDescripcion($some)
		{
			$this->descripcion=$some;
		}

		function SetLink($some)
		{
			$this->link=$some;
		}

		function SetTipo($some)
		{
			$this->tipo=$some;
		}

		function SetIcono($some)
		{
			$this->icono=$some;
		}

		function SetImagen($some)
		{
			$this->imagen=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetId_proyecto($some)
		{
			$this->id_proyecto=$some;
		}

		function SetTipo_elemento($some)
		{
			$this->tipo_elemento=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetKey_code()
		{
			return $this->key_code;
		}

		function GetDescripcion()
		{
			return $this->descripcion;
		}

		function GetLink()
		{
			return $this->link;
		}

		function GetTipo()
		{
			return $this->tipo;
		}

		function GetIcono()
		{
			return $this->icono;
		}

		function GetImagen()
		{
			return $this->imagen;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetId_proyecto()
		{
			return $this->id_proyecto;
		}

		function GetTipo_elemento()
		{
			return $this->tipo_elemento;
		}


	}	
?>