<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_accesos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_suscriptor;

		public $dominio;

		public $keyUser;

		public $host;

		public $usuario;

		public $clave;

		public $db_nombre;

		public $url1;

		public $url2;

		public $url3;

		public $Host_correo;

		public $Puerto_correo;

		public $Usuario_correo;

		public $Clave_correo;

		public $Autenticacion_correo;

		public $Smtp_correo;

		public $Usuario_ftp;

		public $Clave_ftp;

		public $Puerto_ftp;

		public $Path_ftp;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_accesos()
		{
			$this->id=$this->SetId("");
			$this->id_suscriptor=$this->SetId_suscriptor("");
			$this->dominio=$this->SetDominio("");
			$this->keyUser=$this->SetkeyUser("");
			$this->host=$this->SetHost("");
			$this->usuario=$this->SetUsuario("");
			$this->clave=$this->SetClave("");
			$this->db_nombre=$this->SetDb_nombre("");
			$this->url1=$this->SetUrl1("");
			$this->url2=$this->SetUrl2("");
			$this->url3=$this->SetUrl3("");
			$this->Host_correo=$this->SetHost_correo("");
			$this->Puerto_correo=$this->SetPuerto_correo("");
			$this->Usuario_correo=$this->SetUsuario_correo("");
			$this->Clave_correo=$this->SetClave_correo("");
			$this->Autenticacion_correo=$this->SetAutenticacion_correo("");
			$this->Smtp_correo=$this->SetSmtp_correo("");
			$this->Usuario_ftp=$this->SetUsuario_ftp("");
			$this->Clave_ftp=$this->SetClave_ftp("");
			$this->Puerto_ftp=$this->SetPuerto_ftp("");
			$this->Path_ftp=$this->SetPath_ftp("");
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

		function SetDominio($some)
		{
			$this->dominio=$some;
		}

		function SetkeyUser($some)
		{
			$this->keyUser=$some;
		}

		function SetHost($some)
		{
			$this->host=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetClave($some)
		{
			$this->clave=$some;
		}

		function SetDb_nombre($some)
		{
			$this->db_nombre=$some;
		}

		function SetUrl1($some)
		{
			$this->url1=$some;
		}

		function SetUrl2($some)
		{
			$this->url2=$some;
		}

		function SetUrl3($some)
		{
			$this->url3=$some;
		}
		function SetHost_correo($some)
		{
			$this->Host_correo = $some;
		}
		function SetPuerto_correo($some)
		{
			$this->Puerto_correo = $some;
		}
		function SetUsuario_correo($some)
		{
			$this->Usuario_correo = $some;
		}
		function SetClave_correo($some)
		{
			$this->Clave_correo = $some;
		}
		function SetAutenticacion_correo($some)
		{
			$this->Autenticacion_correo = $some;
		}
		function SetSmtp_correo($some)
		{
			$this->Smtp_correo = $some;
		}
		function SetUsuario_ftp($some)
		{
			$this->Usuario_ftp = $some;
		}
		function SetClave_ftp($some)
		{
			$this->Clave_ftp = $some;
		}
		function SetPuerto_ftp($some)
		{
			$this->Puerto_ftp = $some;
		}
		function SetPath_ftp($some)
		{
			$this->Path_ftp = $some;
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

		function GetDominio()
		{
			return $this->dominio;
		}

		function GetkeyUser()
		{
			return $this->keyUser;
		}

		function GetHost()
		{
			return $this->host;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetClave()
		{
			return $this->clave;
		}

		function GetDb_nombre()
		{
			return $this->db_nombre;
		}

		function GetUrl1()
		{
			return $this->url1;
		}

		function GetUrl2()
		{
			return $this->url2;
		}

		function GetUrl3()
		{
			return $this->url3;
		}

		function GetHost_correo(){
			return $this->Host_correo;
		}
		function GetPuerto_correo(){
			return $this->Puerto_correo;
		}
		function GetUsuario_correo(){
			return $this->Usuario_correo;
		}
		function GetClave_correo(){
			return $this->Clave_correo;
		}
		function GetAutenticacion_correo(){
			return $this->Autenticacion_correo;
		}
		function GetSmtp_correo(){
			return $this->Smtp_correo;
		}
		function GetUsuario_ftp(){
			return $this->Usuario_ftp;
		}
		function GetClave_ftp(){
			return $this->Clave_ftp;
		}
		function GetPuerto_ftp(){
			return $this->Puerto_ftp;
		}
		function GetPath_ftp(){
			return $this->Path_ftp;
		}


	}	
	?>
