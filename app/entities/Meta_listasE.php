<?
	// DEFINIMOS AL ENTIDAD
	class EMeta_listas{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;
		public $titulo;
		public $tipo;
		public $dependencia;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Meta_listas()
		{
			$this->id=$this->SetId("");
			$this->titulo=$this->SetTitulo("");
			$this->tipo=$this->SetTipo("");
			$this->dependencia=$this->SetDependencia("");
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
		function SetDependencia($some)
		{
			$this->dependencia=$some;
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
		function GetDependencia()
		{
			return $this->dependencia;
		}


	}	
	?>
