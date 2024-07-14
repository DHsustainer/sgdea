<?
	// DEFINIMOS AL ENTIDAD
	class EWf_elementos_conexion{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_inicial;

		public $id_final;

		public $titulo;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Wf_elementos_conexion()
		{
			$this->id=$this->SetId("");
			$this->id_inicial=$this->SetId_inicial("");
			$this->id_final=$this->SetId_final("");
			$this->titulo=$this->SetTitulo("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_inicial($some)
		{
			$this->id_inicial=$some;
		}

		function SetId_final($some)
		{
			$this->id_final=$some;
		}

		function SetTitulo($some)
		{
			$this->titulo=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_inicial()
		{
			return $this->id_inicial;
		}

		function GetId_final()
		{
			return $this->id_final;
		}

		function GetTitulo()
		{
			return $this->titulo;
		}


	}	
	?>
