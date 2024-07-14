<?
	// DEFINIMOS AL ENTIDAD
	class EMeta_listas_valores{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_lista;

		public $titulo;

		public $valor;

		public $dependencia;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Meta_listas_valores()
		{
			$this->id=$this->SetId("");
			$this->id_lista=$this->SetId_lista("");
			$this->titulo=$this->SetTitulo("");
			$this->valor=$this->SetValor("");
			$this->dependencia=$this->SetDependencia("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_lista($some)
		{
			$this->id_lista=$some;
		}

		function SetTitulo($some)
		{
			$this->titulo=$some;
		}

		function SetValor($some)
		{
			$this->valor=$some;
		}
		function SetDependencia($some)
		{
			$this->dependencia=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_lista()
		{
			return $this->id_lista;
		}

		function GetTitulo()
		{
			return $this->titulo;
		}

		function GetValor()
		{
			return $this->valor;
		}

		function GetDependencia()
		{
			return $this->dependencia;
		}


	}	
	?>
