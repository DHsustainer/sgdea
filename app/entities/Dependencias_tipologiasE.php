<?
	// DEFINIMOS AL ENTIDAD
	class EDependencias_tipologias{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;
		public $id_dependencia;
		public $usuario;
		public $fecha;
		public $tipologia;
		public $requiere_firma;
		public $inmaterial;
		public $obligatorio;
		public $entrada;
		public $es_publico ;
		public $observacion;
		public $formato;
		public $prioridad;
		public $dias_vencimiento;
		public $soporte;

		public $id_clon;
		public $id_asociada;
		public $web_default;
		public $orden;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Dependencias_tipologias()
		{
			$this->id=$this->SetId("");
			$this->id_dependencia=$this->SetId_dependencia("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->tipologia=$this->SetTipologia("");
			$this->requiere_firma=$this->SetRequiere_firma("");
			$this->inmaterial=$this->SetInmaterial("");
			$this->obligatorio=$this->SetObligatorio("");
			$this->entrada=$this->SetEntrada("");
			$this->es_publico= $this->SetEs_publico("");
			$this->observacion= $this->SetObservacion("");
			$this->formato= $this->SetFormato("");
			$this->prioridad= $this->SetPrioridad("");
			$this->dias_vencimiento= $this->SetDias_vencimiento("");
			$this->soporte= $this->SetSoporte("");
			$this->id_clon = $this->Setid_clon("");
			$this->id_asociada = $this->Setid_asociada("");
			$this->web_default = $this->Setweb_default("");
			$this->orden = $this->Setorden("");

		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_dependencia($some)
		{
			$this->id_dependencia=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetTipologia($some)
		{
			$this->tipologia=$some;
		}

		function SetRequiere_firma($some){
			$this->requiere_firma=$some;
		}

		function SetInmaterial($some){
			$this->inmaterial=$some;
		}
		function SetObligatorio($some){
			$this->obligatorio=$some;
		}
		function SetEntrada($some){
			$this->entrada=$some;
		}

		function SetEs_publico($some){
			$this->es_publico = $some;
		}
		function SetObservacion($some){
			$this->observacion = $some;
		}
		function SetFormato($some){
			$this->formato = $some;
		}

		function SetPrioridad($some){
			$this->prioridad = $some;	
		}
		function SetDias_vencimiento($some){
			$this->dias_vencimiento = $some;	
		}
		function SetSoporte($some){
			$this->soporte = $some;	
		}

		function Setid_clon($some){
			$this->id_clon = $some;
		}
		function Setid_asociada($some){
			$this->id_asociada = $some;
		}
		function Setweb_default($some){
			$this->web_default = $some;
		}
		function Setorden($some){
			$this->orden = $some;
		}		


		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_dependencia()
		{
			return $this->id_dependencia;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetTipologia()
		{
			return $this->tipologia;
		}

		function GetRequiere_firma(){
			return $this->requiere_firma;
		}

		function GetInmaterial(){
			return $this->inmaterial;
		}

		function GetObligatorio(){
			return $this->obligatorio;
		}

		function GetEntrada(){
			return $this->entrada;
		}

		function GetEs_publico(){
			return $this->es_publico;
		}
		function GetObservacion(){
			return $this->observacion;
		}
		function GetFormato(){
			return $this->formato;
		}

		function GetPrioridad(){
			return $this->prioridad;	
		}
		function GetDias_vencimiento(){
			return $this->dias_vencimiento;	
		}
		function GetSoporte(){
			return $this->soporte;	
		}
		function Getid_clon(){
			return $this->id_clon;
		}
		function Getid_asociada(){
			return $this->id_asociada;
		}
		function Getweb_default(){
			return $this->web_default;
		}
		function Getorden(){
			return $this->orden;
		}
	}	
?>