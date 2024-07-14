<?
	// DEFINIMOS AL ENTIDAD
	class EWf_gestion_mapas_elementos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_mapa;

		public $id_elemento;

		public $titulo;

		public $fecha;

		public $usuario;

		public $id_evento;

		public $id_dependencia;

		public $id_mapas_elementos;

		public $estado;

		public $titulo_conector;

		public $id_elemento_mapa_elemento;

		

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Wf_gestion_mapas_elementos()
		{
			$this->id=$this->SetId("");
			$this->id_mapa=$this->SetId_mapa("");
			$this->id_elemento=$this->SetId_elemento("");
			$this->titulo=$this->SetTitulo("");
			$this->fecha=$this->SetFecha("");
			$this->usuario=$this->SetUsuario("");
			$this->id_evento=$this->SetId_evento("");
			$this->id_dependencia=$this->SetId_dependencia("");
			$this->id_mapas_elementos=$this->SetId_mapas_elementos("");
			$this->estado=$this->SetEstado("");
			$this->titulo_conector=$this->SetTitulo_conector("");
			$this->SetId_elemento_mapa_elemento = $this->SetId_elemento_mapa_elemento("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_mapa($some)
		{
			$this->id_mapa=$some;
		}

		function SetId_elemento($some)
		{
			$this->id_elemento=$some;
		}

		function SetTitulo($some)
		{
			$this->titulo=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetUsuario($some)
		{
			$this->usuario=$some;
		}

		function SetId_evento($some)
		{
			$this->id_evento=$some;
		}

		function SetId_dependencia($some)
		{
			$this->id_dependencia=$some;
		}

		function SetId_mapas_elementos($some)
		{
			$this->id_mapas_elementos=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetTitulo_conector($some)
		{
			$this->titulo_conector=$some;
		}

		function SetId_elemento_mapa_elemento($some){
			$this->id_elemento_mapa_elemento = $some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_mapa()
		{
			return $this->id_mapa;
		}

		function GetId_elemento()
		{
			return $this->id_elemento;
		}

		function GetTitulo()
		{
			return $this->titulo;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetUsuario()
		{
			return $this->usuario;
		}

		function GetId_evento()
		{
			return $this->id_evento;
		}

		function GetId_dependencia()
		{
			return $this->id_dependencia;
		}

		function GetId_mapas_elementos()
		{
			return $this->id_mapas_elementos;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetTitulo_conector()
		{
			return $this->titulo_conector;
		}

		function GetId_elemento_mapa_elemento(){
			return $this->id_elemento_mapa_elemento;
		}


	}	
	?>
