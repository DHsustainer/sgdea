<?
	// DEFINIMOS AL ENTIDAD
	class EContactos_emails{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $contacto_id;

		public $email;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Contactos_emails()
		{
			$this->id=$this->SetId("");
			$this->contacto_id=$this->SetContacto_id("");
			$this->email=$this->SetEmail("");
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

		function SetEmail($some)
		{
			$this->email=$some;
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

		function GetEmail()
		{
			return $this->email;
		}


	}	
	?>
