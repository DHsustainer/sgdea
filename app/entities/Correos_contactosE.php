<?
	// DEFINIMOS AL ENTIDAD
	class ECorreos_contactos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $mail;

		public $nombre;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Correos_contactos()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->mail=$this->SetMail("");
			$this->nombre=$this->SetNombre("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
		}

		function SetMail($some)
		{
			$this->mail=$some;
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

		function GetUser_id()
		{
			return $this->user_id;
		}

		function GetMail()
		{
			return $this->mail;
		}

		function GetNombre()
		{
			return $this->nombre;
		}


	}	
	?>
