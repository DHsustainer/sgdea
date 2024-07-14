<?
	// DEFINIMOS AL ENTIDAD
	class EDependencias{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $nombre;

		public $dependencia;

		public $usuario;

		public $fecha;

		public $estado;

		public $id_c;

		public $t_g;

		public $t_c;

		public $t_h;

		public $observacion;

		public $es_inmaterial;

		public $id_version; 

		public $no_s;

		public $dependencia_inversa;

		public $es_publico;

		public $titulo_publico;

		public $dias_vencimiento;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Dependencias()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->dependencia=$this->SetDependencia("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->estado=$this->SetEstado("");
			$this->id_c=$this->SetId_c("");
			$this->t_g=$this->SetT_g("");
			$this->t_c=$this->SetT_c("");
			$this->t_h=$this->SetT_h("");
			$this->observacion=$this->SetObservacion("");
			$this->es_inmaterial=$this->SetEs_inmaterial("");
			$this->id_version= $this->SetId_version("");
			$this->no_s = $this->SetNo_s("");
			$this->dependencia_inversa = $this->SetDependencia_inversa("");
			$this->es_publico = $this->SetEs_publico("");
			$this->titulo_publico = $this->SetTitulo_publico("");
			$this->dias_vencimiento = $this->SetDias_vencimiento("");
			
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetDependencia($some)
		{
			$this->dependencia=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetId_c($some)
		{
			$this->id_c=$some;
		}

		function SetT_g($some)
		{
			$this->t_g=$some;
		}

		function SetT_c($some)
		{
			$this->t_c=$some;
		}

		function SetT_h($some)
		{
			$this->t_h=$some;
		}

		function SetObservacion($some)
		{
			$this->observacion=$some;
		}

		function SetEs_inmaterial($some){
			$this->es_inmaterial=$some;
		}

		function SetId_version($some){
			$this->id_version = $some;
		}
		function SetNo_s($some){
			$this->no_s = $some;
		}

		function SetDependencia_inversa($some){
			$this->dependencia_inversa = $some;
		}

		function SetEs_publico($some){
			$this->es_publico = $some;
		}

		function SetTitulo_publico($some){
			$this->titulo_publico = $some;
		}

		function SetDias_vencimiento($some){
			$this->dias_vencimiento = $some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetDependencia()
		{
			return $this->dependencia;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetId_c()
		{
			return $this->id_c;
		}

		function GetT_g()
		{
			return $this->t_g;
		}

		function GetT_c()
		{
			return $this->t_c;
		}

		function GetT_h()
		{
			return $this->t_h;
		}

		function GetObservacion()
		{
			return $this->observacion;
		}

		function GetEs_inmaterial()
		{
			return $this->es_inmaterial;
		}
		function GetId_version(){
			return $this->id_version;
		}
		function GetNo_s(){
			return $this->no_s;
		}

		function GetDependencia_inversa(){
			return $this->dependencia_inversa;
		}

		function GetEs_publico(){
			return $this->es_publico;
		}

		function GetTitulo_publico(){
			return $this->titulo_publico;
		}

		function GetDias_vencimiento(){
			return $this->dias_vencimiento;
		}


	}	
	?>
