<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_anexos_firmas{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $gestion_id;

		public $anexo_id;

		public $tipologia_id;

		public $fecha_solicitud;

		public $usuario_solicita;

		public $usuario_firma;

		public $fecha_firma;

		public $codigo_firma;

		public $clave_primaria;

		public $estado_firma;

		public $repo_1;

		public $repo_2;

		public $firma_crt;

		public $ip;

		public $cod_alt;


		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_anexos_firmas()
		{
			$this->id=$this->SetId("");
			$this->gestion_id=$this->SetGestion_id("");
			$this->anexo_id=$this->SetAnexo_id("");
			$this->tipologia_id=$this->SetTipologia_id("");
			$this->fecha_solicitud=$this->SetFecha_solicitud("");
			$this->usuario_solicita=$this->SetUsuario_solicita("");
			$this->usuario_firma=$this->SetUsuario_firma("");
			$this->fecha_firma=$this->SetFecha_firma("");
			$this->codigo_firma=$this->SetCodigo_firma("");
			$this->clave_primaria=$this->SetClave_primaria("");
			$this->estado_firma=$this->SetEstado_firma("");
			$this->repo_1=$this->SetRepo_1("");
			$this->repo_2=$this->SetRepo_2("");
			$this->firma_crt=$this->Setfirma_crt("");
			$this->ip=$this->Setip("");
			$this->cod_alt=$this->Setcod_alt("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetGestion_id($some)
		{
			$this->gestion_id=$some;
		}

		function SetAnexo_id($some)
		{
			$this->anexo_id=$some;
		}

		function SetTipologia_id($some)
		{
			$this->tipologia_id=$some;
		}

		function SetFecha_solicitud($some)
		{
			$this->fecha_solicitud=$some;
		}

		function SetUsuario_solicita($some)
		{
			$this->usuario_solicita=$some;
		}

		function SetUsuario_firma($some)
		{
			$this->usuario_firma=$some;
		}

		function SetFecha_firma($some)
		{
			$this->fecha_firma=$some;
		}

		function SetCodigo_firma($some)
		{
			$this->codigo_firma=$some;
		}

		function SetClave_primaria($some)
		{
			$this->clave_primaria=$some;
		}

		function SetEstado_firma($some)
		{
			$this->estado_firma=$some;
		}

		function SetRepo_1($some)
		{
			$this->repo_1=$some;
		}

		function SetRepo_2($some)
		{
			$this->repo_2=$some;
		}

		function Setfirma_crt($some)
		{
			$this->firma_crt=$some;
		}
		function Setip($some)
		{
			$this->ip=$some;
		}
		function Setcod_alt($some)
		{
			$this->cod_alt=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetGestion_id()
		{
			return $this->gestion_id;
		}

		function GetAnexo_id()
		{
			return $this->anexo_id;
		}

		function GetTipologia_id()
		{
			return $this->tipologia_id;
		}

		function GetFecha_solicitud()
		{
			return $this->fecha_solicitud;
		}

		function GetUsuario_solicita()
		{
			return $this->usuario_solicita;
		}

		function GetUsuario_firma()
		{
			return $this->usuario_firma;
		}

		function GetFecha_firma()
		{
			return $this->fecha_firma;
		}

		function GetCodigo_firma()
		{
			return $this->codigo_firma;
		}

		function GetClave_primaria()
		{
			return $this->clave_primaria;
		}

		function GetEstado_firma()
		{
			return $this->estado_firma;
		}

		function GetRepo_1()
		{
			return $this->repo_1;
		}

		function GetRepo_2()
		{
			return $this->repo_2;
		}
		function Getfirma_crt(){
			return $this->firma_crt;
		}
		function Getip(){
			return $this->ip;
		}
		function Getcod_alt(){
			return $this->cod_alt;
		}


	}	
?>
