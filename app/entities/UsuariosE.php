<?
	// DEFINIMOS AL ENTIDAD
	class EUsuarios{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;
		public $user_id;
		public $p_nombre;
		public $s_nombre;
		public $p_apellido;
		public $s_apellido;
		public $password;
		public $direccion;
		public $telefono;
		public $email;
		public $ciudad;
		public $f_nacimiento;
		public $estado;
		public $sexo;
		public $cuenta;
		public $f_registro;
		public $t_profesional;
		public $t_cuenta;
		public $t_persona;
		public $universidad;
		public $f_caducidad;
		public $foto_perfil;
		public $auditoria;
		public $seccional;
		public $valor_cuota;
		public $regimen;
		public $cedula;
		public $celular;
		public $departamento;
		public $a_i;
		public $exp_cedula;
		public $firma;
		public $alt_text;
		public $logo;
		public $IsAdministrador;
		public $IsSuperAdministrador;
		public $id_empresa;
		public $notif_usuario;
		public $notif_admin;
		public $procesos;
		public $anexos;
		public $correos;
		public $id_carpeta_publica;
		public $base_file;
		public $clave_firma;
		public $estadochat;
		public $seccional_siamm;
		public $freemium;
		public $cupo;
		public $cupousuario;
		public $logo_correos;

		public $fecha_capacitacion;
		public $hora_capacitacion;


		public $smtp_host;
		public $smtp_puerto;
		public $smtp_user;
		public $smtp_pww;
		public $smtp_aut;
		public $smtp_es;
		public $smtp_helo;
		public $smtp_tls;

		public $updatepassword;
		public $sha2pww;

		function Usuarios()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->p_nombre=$this->SetP_nombre("");
			$this->s_nombre=$this->SetS_nombre("");
			$this->p_apellido=$this->SetP_apellido("");
			$this->s_apellido=$this->SetS_apellido("");
			$this->password=$this->SetPassword("");
			$this->direccion=$this->SetDireccion("");
			$this->telefono=$this->SetTelefono("");
			$this->email=$this->SetEmail("");
			$this->ciudad=$this->SetCiudad("");
			$this->f_nacimiento=$this->SetF_nacimiento("");
			$this->estado=$this->SetEstado("");
			$this->sexo=$this->SetSexo("");
			$this->cuenta=$this->SetCuenta("");
			$this->f_registro=$this->SetF_registro("");
			$this->t_profesional=$this->SetT_profesional("");
			$this->t_cuenta=$this->SetT_cuenta("");
			$this->t_persona=$this->SetT_persona("");
			$this->universidad=$this->SetUniversidad("");
			$this->f_caducidad=$this->SetF_caducidad("");
			$this->foto_perfil=$this->SetFoto_perfil("");
			$this->auditoria=$this->SetAuditoria("");
			$this->seccional=$this->SetSeccional("");
			$this->valor_cuota=$this->SetValor_cuota("");
			$this->regimen=$this->SetRegimen("");
			$this->cedula=$this->SetCedula("");
			$this->celular=$this->SetCelular("");
			$this->departamento=$this->SetDepartamento("");
			$this->a_i=$this->SetA_i("");
			$this->exp_cedula=$this->SetExp_cedula("");
			$this->firma=$this->SetFirma("");
			$this->alt_text=$this->SetAlt_text("");
			$this->logo=$this->SetLogo("");
			$this->IsAdministrador=$this->SetIsAdministrador("");
			$this->IsSuperAdministrador=$this->SetIsSuperAdministrador("");
			$this->id_empresa = $this->SetId_empresa();
			$this->notif_usuario=$this->SetNotif_usuario("");
			$this->notif_admin = $this->SetNotif_admin();
			$this->procesos=$this->SetProcesos("");
			$this->anexos = $this->SetAnexos("");
			$this->correos = $this->SetCorreos("");
			$this->id_carpeta_publica = $this->SetId_carpeta_publica("");
			$this->base_file = $this->Setbase_file("");
			$this->clave_firma = $this->Setclave_firma("");
			$this->estadochat = $this->SetEstadochat("");
			$this->seccional_siamm = $this->SetSeccional_siamm("");
			$this->freemium = $this->Setfreemium("");
			$this->cupo = $this->Setcupo("");
			$this->cupousuario = $this->Setcupousuario("");
			$this->logo_correos = $this->Setlogo_correos("");

			$this->fecha_capacitacion = $this->Setfecha_capacitacion("");
			$this->hora_capacitacion = $this->Sethora_capacitacion("");

			$this->smtp_host = $this->Setsmtp_host("");
			$this->smtp_puerto = $this->Setsmtp_puerto("");
			$this->smtp_user = $this->Setsmtp_user("");
			$this->smtp_pww = $this->Setsmtp_pww("");
			$this->smtp_aut = $this->Setsmtp_aut("");
			$this->smtp_es = $this->Setsmtp_es("");
			$this->smtp_helo = $this->Setsmtp_helo("");
			$this->smtp_tls = $this->Setsmtp_tls("");

			$this->updatepassword = $this->setupdatepassword("");
			$this->sha2pww = $this->setsha2pww("");
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
		function SetS_nombre($some)
		{
			$this->s_nombre=$some;
		}
		function SetP_apellido($some)
		{
			$this->p_apellido=$some;
		}
		function SetS_apellido($some)
		{
			$this->s_apellido=$some;
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
		function SetF_nacimiento($some)
		{
			$this->f_nacimiento=$some;
		}
		function SetEstado($some)
		{
			$this->estado=$some;
		}
		function SetSexo($some)
		{
			$this->sexo=$some;
		}
		function SetCuenta($some)
		{
			$this->cuenta=$some;
		}
		function SetF_registro($some)
		{
			$this->f_registro=$some;
		}
		function SetT_profesional($some)
		{
			$this->t_profesional=$some;
		}
		function SetT_cuenta($some)
		{
			$this->t_cuenta=$some;
		}
		function SetT_persona($some)
		{
			$this->t_persona=$some;
		}
		function SetUniversidad($some)
		{
			$this->universidad=$some;
		}
		function SetF_caducidad($some)
		{
			$this->f_caducidad=$some;
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
		function SetValor_cuota($some)
		{
			$this->valor_cuota=$some;
		}
		function SetRegimen($some)
		{
			$this->regimen=$some;
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
		function SetA_i($some)
		{
			$this->a_i=$some;
		}
		function SetExp_cedula($some)
		{
			$this->exp_cedula=$some;
		}
		function SetFirma($some)
		{
			$this->firma=$some;
		}
		function SetAlt_text($some)
		{
			$this->alt_text=$some;
		}
		function SetLogo($some)
		{
			$this->logo=$some;
		}
		function SetIsAdministrador ($some)
		{
			$this->IsAdministrador=$some;
		}
		function SetIsSuperAdministrador ($some)
		{
			$this->IsSuperAdministrador=$some;
		}
		function SetId_empresa($some){
			$this->id_empresa = $some;
		}
		function SetNotif_usuario($some)
		{
			$this->notif_usuario=$some;
		}
		function SetNotif_admin($some){
			$this->notif_admin = $some;
		}
		function SetProcesos($some){
			$this->procesos = $some;
		}
		function SetAnexos($some){
			$this->anexos = $some;
		}
		function SetCorreos($some){
			$this->correos = $some;
		}
		function SetId_carpeta_publica($some){
			$this->id_carpeta_publica = $some;
		}
		function Setbase_file($some){
			$this->base_file = $some;
		}
		function Setclave_firma	($some){
			$this->clave_firma	 = $some;
		}
		function SetEstadochat($some){
			$this->estadochat = $some;
		}
		function SetSeccional_siamm($some){
			$this->seccional_siamm = $some;
		}
		function Setfreemium($some){
			$this->freemium = $some;
		}
		function Setcupo($some){
			$this->cupo = $some;
		}
		function Setcupousuario($some){
			$this->cupousuario = $some;
		}
		function Setlogo_correos($some){
			$this->logo_correos = $some;
		}
		function Setfecha_capacitacion($some){
			$this->fecha_capacitacion = $some;

		}
		function Sethora_capacitacion($some){
			$this->hora_capacitacion = $some;

		}

		function Setsmtp_host($some){
			$this->smtp_host = $some;
		}
		function Setsmtp_puerto($some){
			$this->smtp_puerto = $some;
		}
		function Setsmtp_user($some){
			$this->smtp_user = $some;
		}
		function Setsmtp_pww($some){
			$this->smtp_pww = $some;
		}
		function Setsmtp_aut($some){
			$this->smtp_aut = $some;
		}
		function Setsmtp_es($some){
			$this->smtp_es = $some;
		}
		function Setsmtp_helo($some){
			$this->smtp_helo = $some;
		}	
		function Setsmtp_tls($some){
		    $this->smtp_tls = $some;
		}	

		function setupdatepassword($some){
			$this->updatepassword = $some;
		}
		function setsha2pww($some){
			$this->sha2pww = $some;
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
		function GetS_nombre()
		{
			return $this->s_nombre;
		}
		function GetP_apellido()
		{
			return $this->p_apellido;
		}
		function GetS_apellido()
		{
			return $this->s_apellido;
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
		function GetF_nacimiento()
		{
			return $this->f_nacimiento;
		}
		function GetEstado()
		{
			return $this->estado;
		}
		function GetSexo()
		{
			return $this->sexo;
		}
		function GetCuenta()
		{
			return $this->cuenta;
		}
		function GetF_registro()
		{
			return $this->f_registro;
		}
		function GetT_profesional()
		{
			return $this->t_profesional;
		}
		function GetT_cuenta()
		{
			return $this->t_cuenta;
		}
		function GetT_persona()
		{
			return $this->t_persona;
		}
		function GetUniversidad()
		{
			return $this->universidad;
		}
		function GetF_caducidad()
		{
			return $this->f_caducidad;
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
		function GetValor_cuota()
		{
			return $this->valor_cuota;
		}
		function GetRegimen()
		{
			return $this->regimen;
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
		function GetA_i()
		{
			return $this->a_i;
		}
		function GetExp_cedula()
		{
			return $this->exp_cedula;
		}
		function GetFirma()
		{
			return $this->firma;
		}
		function GetAlt_text()
		{
			return $this->alt_text;
		}
		function GetLogo()
		{
			return $this->logo;
		}
		function GetIsAdministrador()
		{
			return $this->IsAdministrador;
		}
		function GetIsSuperAdministrador()
		{
			return $this->IsSuperAdministrador;
		}
		function GetId_empresa()
		{
			return $this->id_empresa;
		}
		function GetNotif_usuario()
		{
			return $this->notif_usuario;
		}
		function GetNotif_admin()
		{
			return $this->notif_admin;
		}
		function GetProcesos(){
			return $this->procesos;	
		}
		function GetAnexos(){
			return $this->anexos;	
		}
		function GetCorreos(){
			return $this->correos;	
		}
		function GetId_carpeta_publica(){
			return $this->id_carpeta_publica;
		}
		function Getbase_file(){
			return $this->base_file;
		}
		function Getclave_firma(){
			return $this->clave_firma;
		}
		function GetEstadochat(){
			return $this->estadochat;
		}
		function GetSeccional_siamm(){
			return $this->seccional_siamm;
		}
		function Getfreemium(){
			return $this->freemium;
		}
		function Getcupo(){
			return $this->cupo;
		}
		function Getcupousuario(){
			return $this->cupousuario;
		}
		function Getlogo_correos(){
			return $this->logo_correos;
		}
		function Getfecha_capacitacion(){
			return $this->fecha_capacitacion;
		}
		function Gethora_capacitacion(){
			return $this->hora_capacitacion;
		}	

		function Getsmtp_host(){
			return $this->smtp_host;
		}
		function Getsmtp_puerto(){
			return $this->smtp_puerto;
		}
		function Getsmtp_user(){
			return $this->smtp_user;
		}
		function Getsmtp_pww(){
			return $this->smtp_pww;
		}
		function Getsmtp_aut(){
			return $this->smtp_aut;
		}
		function Getsmtp_es(){
			return $this->smtp_es;
		}
		function Getsmtp_helo(){
			return $this->smtp_helo;
		}
		function Getsmtp_tls(){
			return $this->smtp_tls;
		}

		function getupdatepassword(){
			return $this->updatepassword;
		}
		function getsha2pww(){
			return $this->sha2pww;
		}

	}	
?>