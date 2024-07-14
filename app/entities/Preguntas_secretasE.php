<?
	// DEFINIMOS AL ENTIDAD
	class EPreguntas_secretas{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $pregunta;

		public $tipo;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Preguntas_secretas()
		{
			$this->id=$this->SetId("");
			$this->pregunta=$this->SetPregunta("");
			$this->tipo=$this->SetTipo("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetPregunta($some)
		{
			$this->pregunta=$some;
		}

		function SetTipo($some)
		{
			$this->tipo=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetPregunta()
		{
			return $this->pregunta;
		}

		function GetTipo()
		{
			return $this->tipo;
		}


	}	
	?>
