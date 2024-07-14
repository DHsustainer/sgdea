<?
	// DEFINIMOS AL ENTIDAD
	class EAyuda_etiquetas_elementos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_elemento;

		public $id_etiqueta;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Ayuda_etiquetas_elementos()
		{
			$this->id=$this->SetId("");
			$this->id_elemento=$this->SetId_elemento("");
			$this->id_etiqueta=$this->SetId_etiqueta("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_elemento($some)
		{
			$this->id_elemento=$some;
		}

		function SetId_etiqueta($some)
		{
			$this->id_etiqueta=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_elemento()
		{
			return $this->id_elemento;
		}

		function GetId_etiqueta()
		{
			return $this->id_etiqueta;
		}


	}	
	?>
