<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_contactos_direccion{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_contacto;

		public $direccion;

		public $ciudad;

		public $telefonos;

		public $email;

		public $subnombre;

		public $firma;

		public $natural_juridica;

		public $municipio;

		public $departamento;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_contactos_direccion()
		{
			$this->id=$this->SetId("");
			$this->id_contacto=$this->SetId_contacto("");
			$this->direccion=$this->SetDireccion("");
			$this->ciudad=$this->SetCiudad("");
			$this->telefonos=$this->SetTelefonos("");
			$this->email=$this->SetEmail("");
			$this->subnombre=$this->SetSubnombre("");
			$this->firma=$this->SetFirma("");
			$this->natural_juridica = $this->Setnatural_juridica("");
			$this->municipio = $this->Setmunicipio("");
			$this->departamento = $this->Setdepartamento("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_contacto($some)
		{
			$this->id_contacto=$some;
		}

		function SetDireccion($some)
		{
			$this->direccion=$some;
		}

		function SetCiudad($some)
		{
			$this->ciudad=$some;
		}

		function SetTelefonos($some)
		{
			$this->telefonos=$some;
		}

		function SetEmail($some)
		{
			$this->email=$some;
		}

		function SetSubnombre($some)
		{
			$this->subnombre=$some;
		}

		function SetFirma($some)
		{
			$this->firma=$some;
		}
		function Setnatural_juridica($some){
			$this->natural_juridica = $some;
		}
		function Setmunicipio($some){
			$this->municipio = $some;
		}
		function Setdepartamento($some){
			$this->departamento = $some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_contacto()
		{
			return $this->id_contacto;
		}

		function GetDireccion()
		{
			return $this->direccion;
		}

		function GetCiudad()
		{
			return $this->ciudad;
		}

		function GetTelefonos()
		{
			return $this->telefonos;
		}

		function GetEmail()
		{
			return $this->email;
		}

		function GetSubnombre()
		{
			return $this->subnombre;
		}

		function GetFirma()
		{
			return $this->firma;
		}
		function Getnatural_juridica(){
			return $this->natural_juridica;
		}
		function Getmunicipio(){
			return $this->municipio;
		}
		function Getdepartamento(){
			return $this->departamento;
		}


	}	
	?>
