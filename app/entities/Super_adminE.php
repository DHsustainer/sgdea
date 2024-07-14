<?
	// DEFINIMOS AL ENTIDAD
	class ESuper_admin{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $user_id;

		public $p_nombre;

		public $f_caducidad;

		public $password;

		public $direccion;

		public $telefono;

		public $email;

		public $ciudad;

		public $estado;

		public $sexo;

		public $f_registro;

		public $foto_perfil;

		public $auditoria;

		public $seccional;

		public $cedula;

		public $celular;

		public $departamento;

		public $nombre_representante;

		public $cedula_representante;

		public $expedicion_cedula;

		public $ciudad_residencia;

		public $expedicion_identificacion;

		public $cupos;

		public $encabezado;

		public $pie_pagina;

		public $id_version;

		public $prefijo;

		public $dias_eliminacion;

		public $formato_r;

		public $imajotipo;

		public $estilo;

		public $logo_white;

		public $image_white;

		public $tipo_radicacion;

		public $cupo_cuenta;
		public $cupo_negocio;

		public $logo_courrier;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Super_admin()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->p_nombre=$this->SetP_nombre("");
			$this->f_caducidad=$this->SetF_caducidad("");
			$this->password=$this->SetPassword("");
			$this->direccion=$this->SetDireccion("");
			$this->telefono=$this->SetTelefono("");
			$this->email=$this->SetEmail("");
			$this->ciudad=$this->SetCiudad("");
			$this->estado=$this->SetEstado("");
			$this->sexo=$this->SetSexo("");
			$this->f_registro=$this->SetF_registro("");
			$this->foto_perfil=$this->SetFoto_perfil("");
			$this->auditoria=$this->SetAuditoria("");
			$this->seccional=$this->SetSeccional("");
			$this->cedula=$this->SetCedula("");
			$this->celular=$this->SetCelular("");
			$this->departamento=$this->SetDepartamento("");
			$this->nombre_representante=$this->SetNombre_representante("");
			$this->cedula_representante=$this->SetCedula_representante("");
			$this->expedicion_cedula=$this->SetExpedicion_cedula("");
			$this->ciudad_residencia=$this->SetCiudad_residencia("");
			$this->expedicion_identificacion=$this->SetExpedicion_identificacion("");
			$this->cupos=$this->SetCupos("");
			$this->encabezado=$this->SetEncabezado("");
			$this->pie_pagina=$this->SetPie_pagina("");
			$this->id_version=$this->Setid_version("");
			$this->prefijo=$this->Setprefijo("");
			$this->dias_eliminacion=$this->SetDias_eliminacion("");

			$this->formato_r = $this->Setformato_r("");
			$this->imajotipo = $this->Setimajotipo("");
			$this->estilo = $this->Setestilo("");
			$this->logo_white = $this->Setlogo_white("");
			$this->image_white = $this->Setimage_white("");
			$this->tipo_radicacion = $this->Settipo_radicacion("");
			$this->cupo_negocio = $this->Setcupo_negocio("");
			$this->cupo_cuenta = $this->Setcupo_cuenta("");
			$this->logo_courrier = $this->Setlogo_courrier("");
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

		function SetP_nombre($some)
		{
			$this->p_nombre=$some;
		}

		function SetF_caducidad($some)
		{
			$this->f_caducidad=$some;
		}

		function SetPassword($some)
		{
			$this->password=$some;
		}

		function SetDireccion($some)
		{
			$this->direccion=$some;
		}

		function SetTelefono($some)
		{
			$this->telefono=$some;
		}

		function SetEmail($some)
		{
			$this->email=$some;
		}

		function SetCiudad($some)
		{
			$this->ciudad=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetSexo($some)
		{
			$this->sexo=$some;
		}

		function SetF_registro($some)
		{
			$this->f_registro=$some;
		}

		function SetFoto_perfil($some)
		{
			$this->foto_perfil=$some;
		}

		function SetAuditoria($some)
		{
			$this->auditoria=$some;
		}

		function SetSeccional($some)
		{
			$this->seccional=$some;
		}

		function SetCedula($some)
		{
			$this->cedula=$some;
		}

		function SetCelular($some)
		{
			$this->celular=$some;
		}

		function SetDepartamento($some)
		{
			$this->departamento=$some;
		}

		function SetNombre_representante($some)
		{
			$this->nombre_representante=$some;
		}

		function SetCedula_representante($some)
		{
			$this->cedula_representante=$some;
		}

		function SetExpedicion_cedula($some)
		{
			$this->expedicion_cedula=$some;
		}

		function SetCiudad_residencia($some)
		{
			$this->ciudad_residencia=$some;
		}

		function SetExpedicion_identificacion($some)
		{
			$this->expedicion_identificacion=$some;
		}

		function SetCupos($some)
		{
			$this->cupos=$some;
		}

		function SetEncabezado($some){
			$this->encabezado= $some;
		}
		function SetPie_pagina($some){
			$this->pie_pagina= $some;
		}
		function Setid_version($some){
			$this->id_version= $some;
		}
		function Setprefijo($some){
			$this->prefijo= $some;
		}
		function SetDias_eliminacion($some){
			$this->dias_eliminacion= $some;
		}

		function Setformato_r($some){
			$this->formato_r = $some;
		}
		function Setimajotipo($some){
			$this->imajotipo = $some;
		}
		function Setestilo($some){
			$this->estilo = $some;
		}
		function Setlogo_white($some){
			$this->logo_white = $some;
		}
		function Setimage_white($some){
			$this->image_white = $some;
		}
		function Settipo_radicacion($some){
			$this->tipo_radicacion = $some;
		}

		function Setcupo_negocio($some){
			$this->cupo_negocio = $some;
		}
		function Setcupo_cuenta($some){
			$this->cupo_cuenta = $some;
		}
		function Setlogo_courrier($some){
			$this->logo_courrier = $some;
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

		function GetP_nombre()
		{
			return $this->p_nombre;
		}

		function GetF_caducidad()
		{
			return $this->f_caducidad;
		}

		function GetPassword()
		{
			return $this->password;
		}

		function GetDireccion()
		{
			return $this->direccion;
		}

		function GetTelefono()
		{
			return $this->telefono;
		}

		function GetEmail()
		{
			return $this->email;
		}

		function GetCiudad()
		{
			return $this->ciudad;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetSexo()
		{
			return $this->sexo;
		}

		function GetF_registro()
		{
			return $this->f_registro;
		}

		function GetFoto_perfil()
		{
			return $this->foto_perfil;
		}

		function GetAuditoria()
		{
			return $this->auditoria;
		}

		function GetSeccional()
		{
			return $this->seccional;
		}

		function GetCedula()
		{
			return $this->cedula;
		}

		function GetCelular()
		{
			return $this->celular;
		}

		function GetDepartamento()
		{
			return $this->departamento;
		}

		function GetNombre_representante()
		{
			return $this->nombre_representante;
		}

		function GetCedula_representante()
		{
			return $this->cedula_representante;
		}

		function GetExpedicion_cedula()
		{
			return $this->expedicion_cedula;
		}

		function GetCiudad_residencia()
		{
			return $this->ciudad_residencia;
		}

		function GetExpedicion_identificacion()
		{
			return $this->expedicion_identificacion;
		}

		function GetCupos()
		{
			return $this->cupos;
		}
		function GetEncabezado(){
			return $this->encabezado;
		}
		function GetPie_pagina(){
			return $this->pie_pagina;
		}
		function Getid_version(){
			return $this->id_version;
		}
		function Getprefijo(){
			return $this->prefijo;
		}
		function GetDias_eliminacion(){
			return $this->dias_eliminacion;
		}

		function Getformato_r(){
			return $this->formato_r;
		}
		function Getimajotipo(){
			return $this->imajotipo;
		}
		function Getestilo(){
			return $this->estilo;
		}
		function Getlogo_white(){
			return $this->logo_white;
		}
		function Getimage_white(){
			return $this->image_white;
		}
		function Gettipo_radicacion(){
			return $this->tipo_radicacion;
		}

		function Getcupo_cuenta(){
			return $this->cupo_cuenta;
		}
		function Getcupo_negocio(){
			return $this->cupo_negocio;
		}

		function Getlogo_courrier(){
			return $this->logo_courrier;
		}

	}	
	?>