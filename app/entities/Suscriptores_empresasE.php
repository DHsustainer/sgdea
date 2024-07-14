<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_empresas{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_suscriptor;

		public $id_suscriptores_accesos;

		public $id_suscriptores_modulos_funciones;

		public $nombre_empresa;

		public $dominio;

		public $d_key;

		public $db;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_empresas()
		{
			$this->id=$this->SetId("");
			$this->id_suscriptor=$this->SetId_suscriptor("");
			$this->id_suscriptores_accesos=$this->SetId_suscriptores_accesos("");
			$this->id_suscriptores_modulos_funciones=$this->SetId_suscriptores_modulos_funciones("");
			$this->nombre_empresa=$this->SetNombre_empresa("");
			$this->dominio=$this->SetDominio("");
			$this->d_key=$this->SetD_key("");
			$this->db=$this->SetDb("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_suscriptor($some)
		{
			$this->id_suscriptor=$some;
		}

		function SetId_suscriptores_accesos($some)
		{
			$this->id_suscriptores_accesos=$some;
		}

		function SetId_suscriptores_modulos_funciones($some)
		{
			$this->id_suscriptores_modulos_funciones=$some;
		}

		function SetNombre_empresa($some)
		{
			$this->nombre_empresa=$some;
		}

		function SetDominio($some)
		{
			$this->dominio=$some;
		}

		function SetD_key($some)
		{
			$this->d_key=$some;
		}

		function SetDb($some)
		{
			$this->db=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_suscriptor()
		{
			return $this->id_suscriptor;
		}

		function GetId_suscriptores_accesos()
		{
			return $this->id_suscriptores_accesos;
		}

		function GetId_suscriptores_modulos_funciones()
		{
			return $this->id_suscriptores_modulos_funciones;
		}

		function GetNombre_empresa()
		{
			return $this->nombre_empresa;
		}

		function GetDominio()
		{
			return $this->dominio;
		}

		function GetD_key()
		{
			return $this->d_key;
		}

		function GetDb()
		{
			return $this->db;
		}


	}	
	?>
