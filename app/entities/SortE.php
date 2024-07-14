<?
	// DEFINIMOS AL ENTIDAD
	class ESort{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $code;

		public $url;

		public $fecha;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Sort()
		{
			$this->id=$this->SetId("");
			$this->code=$this->SetCode("");
			$this->url=$this->SetUrl("");
			$this->fecha=$this->SetFecha("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetCode($some)
		{
			$this->code=$some;
		}

		function SetUrl($some)
		{
			$this->url=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetCode()
		{
			return $this->code;
		}

		function GetUrl()
		{
			return $this->url;
		}

		function GetFecha()
		{
			return $this->fecha;
		}


	}	
	?>
