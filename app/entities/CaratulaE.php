<?
	// DEFINIMOS AL ENTIDAD
	class ECaratula{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $user_id;

		public $proceso_id;

		public $tip_demanda;

		public $juzgado;

		public $rad;

		public $dir_juz;

		public $tel_juz;

		public $email_juz;

		public $est_proceso;

		public $tit_demanda;

		public $fec_pres;

		public $val_demanda;

		public $tipo_demandante;

		public $fec_auto;

		public $num_oficio;

		public $contenido;

		public $costas;

		public $edit_juz;

		public $tracking;

		public $rad_completo;

		public $fecha_creacion;

		public $type_proceso;

		public $usuario_registra;

		public $folder_id;

		public $fecha_actualizacion;

		public $ciudad;

		public $departamento;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Caratula()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->tip_demanda=$this->SetTip_demanda("");
			$this->juzgado=$this->SetJuzgado("");
			$this->rad=$this->SetRad("");
			$this->dir_juz=$this->SetDir_juz("");
			$this->tel_juz=$this->SetTel_juz("");
			$this->email_juz=$this->SetEmail_juz("");
			$this->est_proceso=$this->SetEst_proceso("");
			$this->tit_demanda=$this->SetTit_demanda("");
			$this->fec_pres=$this->SetFec_pres("");
			$this->val_demanda=$this->SetVal_demanda("");
			$this->tipo_demandante=$this->SetTipo_demandante("");
			$this->fec_auto=$this->SetFec_auto("");
			$this->num_oficio=$this->SetNum_oficio("");
			$this->contenido=$this->SetContenido("");
			$this->costas=$this->SetCostas("");
			$this->edit_juz=$this->SetEdit_juz("");
			$this->tracking=$this->SetTracking("");
			$this->rad_completo=$this->SetRad_completo("");
			$this->fecha_creacion=$this->SetFecha_creacion("");
			$this->type_proceso=$this->SetType_proceso("");
			$this->usuario_registra=$this->SetUsuario_registra("");
			$this->folder_id=$this->SetFolder_id("");
			$this->fecha_actualizacion=$this->SetFecha_actualizacion("");
			$this->ciudad=$this->SetCiudad("");
			$this->departamento=$this->SetDepartamento("");
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

		function SetProceso_id($some)
		{
			$this->proceso_id=$some;
		}

		function SetTip_demanda($some)
		{
			$this->tip_demanda=$some;
		}

		function SetJuzgado($some)
		{
			$this->juzgado=$some;
		}

		function SetRad($some)
		{
			$this->rad=$some;
		}

		function SetDir_juz($some)
		{
			$this->dir_juz=$some;
		}

		function SetTel_juz($some)
		{
			$this->tel_juz=$some;
		}

		function SetEmail_juz($some)
		{
			$this->email_juz=$some;
		}

		function SetEst_proceso($some)
		{
			$this->est_proceso=$some;
		}

		function SetTit_demanda($some)
		{
			$this->tit_demanda=$some;
		}

		function SetFec_pres($some)
		{
			$this->fec_pres=$some;
		}

		function SetVal_demanda($some)
		{
			$this->val_demanda=$some;
		}

		function SetTipo_demandante($some)
		{
			$this->tipo_demandante=$some;
		}

		function SetFec_auto($some)
		{
			$this->fec_auto=$some;
		}

		function SetNum_oficio($some)
		{
			$this->num_oficio=$some;
		}

		function SetContenido($some)
		{
			$this->contenido=$some;
		}

		function SetCostas($some)
		{
			$this->costas=$some;
		}

		function SetEdit_juz($some)
		{
			$this->edit_juz=$some;
		}

		function SetTracking($some)
		{
			$this->tracking=$some;
		}

		function SetRad_completo($some)
		{
			$this->rad_completo=$some;
		}

		function SetFecha_creacion($some)
		{
			$this->fecha_creacion=$some;
		}

		function SetType_proceso($some)
		{
			$this->type_proceso=$some;
		}

		function SetUsuario_registra($some)
		{
			$this->usuario_registra=$some;
		}

		function SetFolder_id($some)
		{
			$this->folder_id=$some;
		}

		function SetFecha_actualizacion($some){
			$this->fecha_actualizacion = $some;
		}

		function SetCiudad($some){
			$this->ciudad = $some;
		}

		function SetDepartamento($some){
			$this->departamento = $some;
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

		function GetProceso_id()
		{
			return $this->proceso_id;
		}

		function GetTip_demanda()
		{
			return $this->tip_demanda;
		}

		function GetJuzgado()
		{
			return $this->juzgado;
		}

		function GetRad()
		{
			return $this->rad;
		}

		function GetDir_juz()
		{
			return $this->dir_juz;
		}

		function GetTel_juz()
		{
			return $this->tel_juz;
		}

		function GetEmail_juz()
		{
			return $this->email_juz;
		}

		function GetEst_proceso()
		{
			return $this->est_proceso;
		}

		function GetTit_demanda()
		{
			return $this->tit_demanda;
		}

		function GetFec_pres()
		{
			return $this->fec_pres;
		}

		function GetVal_demanda()
		{
			return $this->val_demanda;
		}

		function GetTipo_demandante()
		{
			return $this->tipo_demandante;
		}

		function GetFec_auto()
		{
			return $this->fec_auto;
		}

		function GetNum_oficio()
		{
			return $this->num_oficio;
		}

		function GetContenido()
		{
			return $this->contenido;
		}

		function GetCostas()
		{
			return $this->costas;
		}

		function GetEdit_juz()
		{
			return $this->edit_juz;
		}

		function GetTracking()
		{
			return $this->tracking;
		}

		function GetRad_completo()
		{
			return $this->rad_completo;
		}

		function GetFecha_creacion()
		{
			return $this->fecha_creacion;
		}

		function GetType_proceso()
		{
			return $this->type_proceso;
		}

		function GetUsuario_registra()
		{
			return $this->usuario_registra;
		}

		function GetFolder_id()
		{
			return $this->folder_id;
		}

		function GetFecha_actualizacion(){
			return $this->fecha_actualizacion;
		}

		function GetCiudad(){
			return $this->ciudad;
		}

		function GetDepartamento(){
			return $this->departamento;
		}


	}	
	?>
