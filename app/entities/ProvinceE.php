<?
	// DEFINIMOS AL ENTIDAD
	class EProvince{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $Name;

		public $Country;

		public $code;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Province()
		{
			$this->id=$this->SetId("");
			$this->Name=$this->SetName("");
			$this->Country=$this->SetCountry("");
			$this->code=$this->SetCode("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetName($some)
		{
			$this->Name=$some;
		}

		function SetCountry($some)
		{
			$this->Country=$some;
		}

		function SetCode($some)
		{
			$this->code=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetName()
		{
			return $this->Name;
		}

		function GetCountry()
		{
			return $this->Country;
		}

		function GetCode()
		{
			return $this->code;
		}


	}	
	?>
