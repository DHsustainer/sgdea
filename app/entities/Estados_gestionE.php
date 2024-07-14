<?
	// DEFINIMOS AL ENTIDAD
	class EEstados_gestion{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;
		public $nombre;
		public $dependencia;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Estados_gestion()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->dependencia=$this->SetDependencia("");
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
		function SetDependencia($some)
		{
			$this->dependencia=$some;
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
		function GetDependencia()
		{
			return $this->dependencia;
		}



	}	
	?>
