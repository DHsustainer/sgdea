<?
	// DEFINIMOS AL ENTIDAD
	class EContactos_direccion{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $id_contacto;

		public $direccion;

		public $telefono;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Contactos_direccion()
		{
			$this->id=$this->SetId("");
			$this->id_contacto=$this->SetId_contacto("");
			$this->direccion=$this->SetDireccion("");
			$this->telefono=$this->SetTelefono("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_contacto($some)
		{
			$this->id_contacto=$some;
		}

		function SetDireccion($some)
		{
			$this->direccion=$some;
		}

		function SetTelefono($some)
		{
			$this->telefono=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_contacto()
		{
			return $this->id_contacto;
		}

		function GetDireccion()
		{
			return $this->direccion;
		}

		function GetTelefono()
		{
			return $this->telefono;
		}


	}	
	?>
