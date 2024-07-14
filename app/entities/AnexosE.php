<?
	// DEFINIMOS AL ENTIDAD
	class EAnexos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $proceso_id;

		public $nom_palabra;

		public $nom_img;

		public $user_id;

		public $fecha;
		
		public $hora;
	
		public $ip;
	
		public $timest;
	
		public $estado;
	
		public $folio;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Anexos()
		{
			$this->id=$this->SetId("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->nom_palabra=$this->SetNom_palabra("");
			$this->nom_img=$this->SetNom_img("");
			$this->user_id=$this->SetUser_id("");
			$this->fecha=$this->SetFecha();
			$this->hora=$this->SetHora();
			$this->ip=$this->SetIp();
			$this->timest=$this->SetTimest();
			$this->estado=$this->SetEstado();
			$this->folio=$this->SetFolio();
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetProceso_id($some)
		{
			$this->proceso_id=$some;
		}

		function SetNom_palabra($some)
		{
			$this->nom_palabra=$some;
		}

		function SetNom_img($some)
		{
			$this->nom_img=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
		}

		function SetFecha($some){
			$this->fecha = $some;
		}
		function SetHora($some){
			$this->hora = $some;
		}
		function SetIp($some){
			$this->ip = $some;
		}
		function SetTimest($some){
			$this->timest = $some;
		}
		function SetEstado($some){
			$this->estado = $some;
		}
		function SetFolio($some){
			$this->folio = $some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetProceso_id()
		{
			return $this->proceso_id;
		}

		function GetNom_palabra()
		{
			return $this->nom_palabra;
		}

		function GetNom_img()
		{
			return $this->nom_img;
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
	}	
?>
