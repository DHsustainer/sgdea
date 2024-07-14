<?
	// DEFINIMOS AL ENTIDAD
	class EMeta_referencias_titulos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $titulo;

		public $tipo;

		public $es_generico;

		public $id_s;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Meta_referencias_titulos()
		{
			$this->id=$this->SetId("");
			$this->titulo=$this->SetTitulo("");
			$this->tipo=$this->SetTipo("");
			$this->es_generico=$this->SetEs_generico("");
			$this->id_s=$this->SetId_s("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetTitulo($some)
		{
			$this->titulo=$some;
		}

		function SetTipo($some)
		{
			$this->tipo=$some;
		}

		function SetEs_generico($some)
		{
			$this->es_generico=$some;
		}

		function SetId_s($some)
		{
			$this->id_s=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetTitulo()
		{
			return $this->titulo;
		}

		function GetTipo()
		{
			return $this->tipo;
		}

		function GetEs_generico()
		{
			return $this->es_generico;
		}

		function GetId_s()
		{
			return $this->id_s;
		}


	}	
	?>
