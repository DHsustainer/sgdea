<?
	// DEFINIMOS AL ENTIDAD
	class EDependencias_alertas{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_dependencia;

		public $usuario;

		public $fecha;

		public $nombre;

		public $dias_alerta;

		public $descripcion;

		public $dias_antes;

		public $automatica;

		public $es_publico;

		public $dependencia_alerta;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Dependencias_alertas()
		{
			$this->id=$this->SetId("");
			$this->id_dependencia=$this->SetId_dependencia("");
			$this->usuario=$this->SetUsuario("");
			$this->fecha=$this->SetFecha("");
			$this->nombre=$this->SetNombre("");
			$this->dias_alerta=$this->SetDias_alerta("");
			$this->descripcion=$this->SetDescripcion("");
			$this->dias_antes=$this->SetDias_antes("");
			$this->automatica=$this->SetAutomatica("");
			$this->es_publico=$this->SetEs_publico("");
			$this->dependencia_alerta=$this->Setdependencia_alerta("");
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

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetDias_alerta($some)
		{
			$this->dias_alerta=$some;
		}

		function SetDescripcion($some){
			$this->descripcion=$some;
		}

		function SetDias_antes($some)
		{
			$this->dias_antes=$some;	
		}

		function SetAutomatica($some){
			$this->automatica=$some;
		}

		function SetEs_publico($some){
			$this->es_publico=$some;
		}	

		function setdependencia_alerta($some){
			$this->dependencia_alerta = $some;
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

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetDias_alerta()
		{
			return $this->dias_alerta;
		}

		function GetDescripcion(){
			return $this->descripcion;
		}
		function GetDias_antes()
		{
			return $this->dias_antes;	
		}

		function GetAutomatica(){
			return $this->automatica;
		}

		function GetEs_publico(){
			return $this->es_publico;
		}

		function Getdependencia_alerta(){
			return $this->dependencia_alerta;
		}
	}	
?>