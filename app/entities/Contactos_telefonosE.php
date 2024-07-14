<?
	// DEFINIMOS AL ENTIDAD
	class EContactos_telefonos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $contacto_id;

		public $telefono;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Contactos_telefonos()
		{
			$this->id=$this->SetId("");
			$this->contacto_id=$this->SetContacto_id("");
			$this->telefono=$this->SetTelefono("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetContacto_id($some)
		{
			$this->contacto_id=$some;
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

		function GetContacto_id()
		{
			return $this->contacto_id;
		}

		function GetTelefono()
		{
			return $this->telefono;
		}


	}	
	?>
