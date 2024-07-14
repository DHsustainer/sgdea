<?
	// DEFINIMOS AL ENTIDAD
	class EGestion_anexos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;
		public $gestion_id;
		public $nombre;
		public $url;
		public $user_id;
		public $fecha;
		public $hora;
		public $ip;
		public $timest;
		public $estado;
		public $folio;
		public $folder_id;		
		public $tipologia;
		public $is_publico;
		public $folio_final;
		public $cantidad;
		public $orden;
		public $origen;
		public $hash;
		public $base_file;
		public $typefile;
		public $peso;
		public $indice;
		public $in_out;
		public $soporte;
		public $observacion;
		public $productor;
		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Gestion_anexos()
		{
			$this->id=$this->SetId("");
			$this->gestion_id=$this->SetGestion_id("");
			$this->nombre=$this->SetNombre("");
			$this->url=$this->SetUrl("");
			$this->user_id=$this->SetUser_id("");
			$this->fecha=$this->SetFecha("");
			$this->hora=$this->SetHora("");
			$this->ip=$this->SetIp("");
			$this->timest=$this->SetTimest("");
			$this->estado=$this->SetEstado("");
			$this->folio=$this->SetFolio("");
			$this->folder_id=$this->SetFolder_id("");
			$this->tipologia=$this->SetTipologia("");
			$this->is_publico= $this->SetIs_publico("");
			$this->folio_final= $this->SetFolio_final("");
			$this->cantidad=$this->Setcantidad("");
			$this->orden= $this->Setorden("");
			$this->origen= $this->Setorigen("");
			$this->hash= $this->Sethash("");
			$this->base_file= $this->Setbase_file("");
			$this->typefile= $this->SetTypefile("");
			$this->peso= $this->SetPeso("");
			$this->indice= $this->SetIndice("");
			$this->in_out= $this->SetIn_out("");
			$this->soporte= $this->SetSoporte("");
			$this->observacion= $this->SetObservacion("");
			$this->productor= $this->SetProductor("");
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
		function SetNombre($some)
		{
			$this->nombre=$some;
		}
		function SetUrl($some)
		{
			$this->url=$some;
		}
		function SetUser_id($some)
		{
			$this->user_id=$some;
		}
		function SetFecha($some)
		{
			$this->fecha=$some;
		}
		function SetHora($some)
		{
			$this->hora=$some;
		}
		function SetIp($some)
		{
			$this->ip=$some;
		}
		function SetTimest($some)
		{
			$this->timest=$some;
		}
		function SetEstado($some)
		{
			$this->estado=$some;
		}
		function SetFolio($some)
		{
			$this->folio=$some;
		}
		function SetFolder_id($some){
			$this->folder_id = $some;
		}
		function SetTipologia($some){
			$this->tipologia = $some;
		}
		function SetIs_publico($some){
			$this->is_publico = $some;
		}
		function SetFolio_final($some){
			$this->folio_final = $some;
		}
		function Setcantidad($some){
			$this->cantidad=$some;
		}
		function Setorden($some){
			$this->orden=$some;
		}
		function Setorigen($some){
			$this->origen=$some;
		}
		function Sethash($some)
		{
			$this->hash=$some;
		}
		function Setbase_file($some)
		{
			$this->base_file=$some;
		}
		function SetTypefile($some)
		{
			$this->typefile=$some;
		}
		function SetPeso($some)
		{
			$this->peso=$some;
		}
		function SetIndice($some)
		{
			$this->indice=$some;
		}

		function SetIn_out($some)
		{
			$this->in_out=$some;
		}
		function SetSoporte($some)
		{
			$this->soporte=$some;
		}
		function SetObservacion($some)
		{
			$this->observacion=$some;
		}
		function SetProductor($some)
		{
			$this->productor=$some;
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
		function GetNombre()
		{
			return $this->nombre;
		}
		function GetUrl()
		{
			return $this->url;
		}
		function GetUser_id()
		{
			return $this->user_id;
		}
		function GetFecha()
		{
			return $this->fecha;
		}
		function GetHora()
		{
			return $this->hora;
		}
		function GetIp()
		{
			return $this->ip;
		}
		function GetTimest()
		{
			return $this->timest;
		}
		function GetEstado()
		{
			return $this->estado;
		}
		function GetFolio()
		{
			return $this->folio;
		}
		function GetFolder_id(){
			return $this->folder_id;
		}
		function GetTipologia(){
			return $this->tipologia;
		}
		function GetIs_publico(){
			return $this->is_publico;
		}
		function GetFolio_final(){
			return $this->folio_final;
		}
		function Getcantidad(){
			return $this->cantidad;
		}
		function Getorden(){
			return $this->orden;
		}
		function Getorigen(){
			return $this->origen;
		}
		function Gethash(){
			return $this->hash;
		}
		function Getbase_file(){
			return $this->base_file;
		}
		function GetTypefile(){
			return $this->typefile;
		}
		function GetPeso(){
			return $this->peso;
		}
		function GetIndice(){
			return $this->indice;
		}
		function GetIn_out(){
			return $this->in_out;
		}
		function GetSoporte(){
			return $this->soporte;
		}
		function GetObservacion(){
			return $this->observacion;
		}
		function GetProductor(){
			return $this->productor;
		}
	}	
	?>