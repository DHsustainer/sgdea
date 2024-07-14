<?
	// DEFINIMOS AL ENTIDAD
	class EFolder_ciudadano{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $titulo;

		public $fecha;

		public $type;

		public $estado;

		public $user_2;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Folder_ciudadano()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->titulo=$this->SetTitulo("");
			$this->fecha=$this->SetFecha("");
			$this->type=$this->SetType("");
			$this->estado=$this->SetEstado("");
			$this->user_2=$this->SetUser_2("");
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

		function SetTitulo($some)
		{
			$this->titulo=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetType($some)
		{
			$this->type=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetUser_2($some)
		{
			$this->user_2=$some;
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

		function GetTitulo()
		{
			return $this->titulo;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetType()
		{
			return $this->type;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetUser_2()
		{
			return $this->user_2;
		}


	}	
	?>
