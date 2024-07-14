<?
	// DEFINIMOS AL ENTIDAD
	class ESeccional{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		public $direccion;

		public $telefono;

		public $principal;

		public $ciudad;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Seccional()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->direccion=$this->SetDireccion("");
			$this->telefono=$this->SetTelefono("");
			$this->principal=$this->SetPrincipal("");
			$this->ciudad=$this->SetCiudad("");
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

		function SetDireccion($some)
		{
			$this->direccion=$some;
		}

		function SetTelefono($some)
		{
			$this->telefono=$some;
		}

		function SetPrincipal($some)
		{
			$this->principal=$some;
		}

		function SetCiudad($some)
		{
			$this->ciudad=$some;
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

		function GetDireccion()
		{
			return $this->direccion;
		}

		function GetTelefono()
		{
			return $this->telefono;
		}

		function GetPrincipal()
		{
			return $this->principal;
		}

		function GetCiudad()
		{
			return $this->ciudad;
		}


	}	
	?>
