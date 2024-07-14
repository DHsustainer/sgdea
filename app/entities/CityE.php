<?
	// DEFINIMOS AL ENTIDAD
	class ECity{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $Name;

		public $Country;

		public $Province;

		public $code;

		public $type;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function City()
		{
			$this->id=$this->SetId("");
			$this->Name=$this->SetName("");
			$this->Country=$this->SetCountry("");
			$this->Province=$this->SetProvince("");
			$this->code=$this->SetCode("");
			$this->type=$this->SetType("");
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

		function SetProvince($some)
		{
			$this->Province=$some;
		}

		function SetCode($some)
		{
			$this->code=$some;
		}

		function SetType($some)
		{
			$this->type=$some;
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

		function GetProvince()
		{
			return $this->Province;
		}

		function GetCode()
		{
			return $this->code;
		}

		function GetType()
		{
			return $this->type;
		}


	}	
	?>
