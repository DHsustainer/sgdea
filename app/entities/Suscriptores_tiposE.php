<?
	// DEFINIMOS AL ENTIDAD
	class ESuscriptores_tipos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $nombre;

		public $es_web;
		public $correspondencia;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Suscriptores_tipos()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->es_web=$this->SetEs_web("");
			$this->es_web=$this->SetCorrespondencia("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetNombre($some)
		{
			$this->nombre=$some;
		}

		function SetEs_web($some)
		{
			$this->es_web=$some;
		}
		function SetCorrespondencia($some)
		{
			$this->correspondencia=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetNombre()
		{
			return $this->nombre;
		}

		function GetEs_web()
		{
			return $this->es_web;
		}

		function GetCorrespondencia()
		{
			return $this->correspondencia;
		}


	}	
?>