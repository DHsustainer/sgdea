<?
	// DEFINIMOS AL ENTIDAD
	class EEvents_gestion{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $user_id;

		public $gestion_id;

		public $fecha;

		public $title;

		public $description;

		public $added;

		public $status;

		public $time;

		public $alerted;

		public $avisar_a;

		public $type_event;

		public $fecha_vencimiento;

		public $id_generico;

		public $seccional;

		public $oficina;

		public $area;

		public $grupo;

		public $elm_type;

		public $id_ext;

		public $realizadopor;

		public $fecha_realizado;

		public $es_publico;

		public $es_recordatorio;

		public $tipoalerta;


		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Events_gestion()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->gestion_id=$this->SetGestion_id("");
			$this->fecha=$this->SetFecha("");
			$this->title=$this->SetTitle("");
			$this->description=$this->SetDescription("");
			$this->added=$this->SetAdded("");
			$this->status=$this->SetStatus("");
			$this->time=$this->SetTime("");
			$this->alerted=$this->SetAlerted("");
			$this->avisar_a=$this->SetAvisar_a("");
			$this->type_event=$this->SetType_event("");
			$this->fecha_vencimiento=$this->SetFecha_vencimiento("");
			$this->id_generico=$this->Setid_generico("");
			$this->seccional=$this->Setseccional("");
			$this->oficina=$this->Setoficina("");
			$this->area=$this->Setarea("");
			$this->grupo=$this->Setgrupo("");
			$this->elm_type=$this->Setelm_type("");
			$this->id_ext=$this->Setid_ext("");
			$this->realizadopor = $this->Setrealizadopor("");
			$this->fecha_realizado = $this->Setfecha_realizado("");			
			$this->es_publico = $this->SetEs_publico("");	
			$this->es_recordatorio = $this->Setes_recordatorio("");
			$this->tipoalerta = $this->Settipoalerta("");
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

		function SetGestion_id($some)
		{
			$this->gestion_id=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetTitle($some)
		{
			$this->title=$some;
		}

		function SetDescription($some)
		{
			$this->description=$some;
		}

		function SetAdded($some)
		{
			$this->added=$some;
		}

		function SetStatus($some)
		{
			$this->status=$some;
		}

		function SetTime($some)
		{
			$this->time=$some;
		}

		function SetAlerted($some)
		{
			$this->alerted=$some;
		}

		function SetAvisar_a($some)
		{
			$this->avisar_a=$some;
		}

		function SetType_event($some)
		{
			$this->type_event=$some;
		}

		function SetFecha_vencimiento($some)
		{
			$this->fecha_vencimiento=$some;
		}

		function Setid_generico($some)
		{
			$this->id_generico= $some;
		}
		function Setseccional($some)
		{
			$this->seccional= $some;
		}
		function Setoficina($some)
		{
			$this->oficina= $some;
		}
		function Setarea($some)
		{
			$this->area= $some;
		}
		function Setgrupo($some)
		{
			$this->grupo= $some;
		}
	
		function Setelm_type($some){
			$this->elm_type = $some;
		}

		function Setid_ext($some){
			$this->id_ext = $some;
		}

		function Setrealizadopor($some){
			$this->realizadopor = $some;
		}
		function Setfecha_realizado($some){
			$this->fecha_realizado = $some;
		}
		function SetEs_publico($some){
			$this->es_publico = $some;
		}
		function Seteses_recordatorio($some){
			$this->es_recordatorio = $some;

		}
		function Settipoalerta($some){
			$this->tipoalerta = $some;

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

		function GetGestion_id()
		{
			return $this->gestion_id;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetTitle()
		{
			return $this->title;
		}

		function GetDescription()
		{
			return $this->description;
		}

		function GetAdded()
		{
			return $this->added;
		}

		function GetStatus()
		{
			return $this->status;
		}

		function GetTime()
		{
			return $this->time;
		}

		function GetAlerted()
		{
			return $this->alerted;
		}

		function GetAvisar_a()
		{
			return $this->avisar_a;
		}

		function GetType_event()
		{
			return $this->type_event;
		}

		function GetFecha_vencimiento()
		{
			return $this->fecha_vencimiento;
		}

		function Getid_generico()
		{
			return $this->id_generico;
		}
		function Getseccional()
		{
			return $this->seccional;
		}
		function Getoficina()
		{
			return $this->oficina;
		}
		function Getarea()
		{
			return $this->area;
		}
		function Getgrupo()
		{
			return $this->grupo;
		}

		function Getelm_type(){
			return $this->elm_type;
		}
		function Getid_ext(){
			return $this->id_ext;
		}

		function Getrealizadopor(){
			return $this->realizadopor;
		}
		function Getfecha_realizado(){
			return $this->fecha_realizado;
		}
		function GetEs_publico(){
			return $this->es_publico;
		}
		function Getes_recordatorio(){
			return $this->es_recordatorio;
		}
		function Gettipoalerta(){
			return $this->tipoalerta;
		}
	}	
?>