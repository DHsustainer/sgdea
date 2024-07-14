<?
	// DEFINIMOS AL ENTIDAD
	class EPreguntas_usuarios{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_pregunta;

		public $respuesta;

		public $fecha;

		public $username;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Preguntas_usuarios()
		{
			$this->id=$this->SetId("");
			$this->id_pregunta=$this->SetId_pregunta("");
			$this->respuesta=$this->SetRespuesta("");
			$this->fecha=$this->SetFecha("");
			$this->username=$this->SetUsername("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_pregunta($some)
		{
			$this->id_pregunta=$some;
		}

		function SetRespuesta($some)
		{
			$this->respuesta=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetUsername($some)
		{
			$this->username=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_pregunta()
		{
			return $this->id_pregunta;
		}

		function GetRespuesta()
		{
			return $this->respuesta;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetUsername()
		{
			return $this->username;
		}


	}	
	?>
