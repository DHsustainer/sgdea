<?
	// DEFINIMOS AL ENTIDAD
	class EWf_elementos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $titulo;

		public $descripcion;

		public $tipo_elemento;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Wf_elementos()
		{
			$this->id=$this->SetId("");
			$this->titulo=$this->SetTitulo("");
			$this->descripcion=$this->SetDescripcion("");
			$this->tipo_elemento=$this->SetTipo_elemento("");
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

		function SetDescripcion($some)
		{
			$this->descripcion=$some;
		}

		function SetTipo_elemento($some)
		{
			$this->tipo_elemento=$some;
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

		function GetDescripcion()
		{
			return $this->descripcion;
		}

		function GetTipo_elemento()
		{
			return $this->tipo_elemento;
		}


	}	
	?>
