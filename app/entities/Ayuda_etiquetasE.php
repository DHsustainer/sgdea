<?
	// DEFINIMOS AL ENTIDAD
	class EAyuda_etiquetas{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Ayuda_etiquetas()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
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

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetNombre()
		{
			return $this->nombre;
		}


	}	
	?>
