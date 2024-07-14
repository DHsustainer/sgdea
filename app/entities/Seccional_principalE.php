<?
	// DEFINIMOS AL ENTIDAD
	class ESeccional_principal{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		public $sigla;

		public $ciudad_origen;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Seccional_principal()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->sigla=$this->SetSigla("");
			$this->ciudad_origen=$this->SetCiudad_origen("");
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

		function SetSigla($some)
		{
			$this->sigla=$some;
		}

		function SetCiudad_origen($some)
		{
			$this->ciudad_origen=$some;
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

		function GetSigla()
		{
			return $this->sigla;
		}

		function GetCiudad_origen()
		{
			return $this->ciudad_origen;
		}


	}	
	?>
