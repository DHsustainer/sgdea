<?
	// DEFINIMOS AL ENTIDAD
	class EMeta_tipos_elementos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nombre;

		public $tipo_lista;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Meta_tipos_elementos()
		{
			$this->id=$this->SetId("");
			$this->nombre=$this->SetNombre("");
			$this->tipo_lista=$this->SetTipo_lista("");
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

		function SetTipo_lista($some)
		{
			$this->tipo_lista=$some;
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

		function GetTipo_lista()
		{
			return $this->tipo_lista;
		}


	}	
	?>
