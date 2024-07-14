<?
	// DEFINIMOS AL ENTIDAD
	class EMailer_logins{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $nick;

		public $ip;

		public $date;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Mailer_logins()
		{
			$this->id=$this->SetId("");
			$this->nick=$this->SetNick("");
			$this->ip=$this->SetIp("");
			$this->date=$this->SetDate("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetNick($some)
		{
			$this->nick=$some;
		}

		function SetIp($some)
		{
			$this->ip=$some;
		}

		function SetDate($some)
		{
			$this->date=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetNick()
		{
			return $this->nick;
		}

		function GetIp()
		{
			return $this->ip;
		}

		function GetDate()
		{
			return $this->date;
		}


	}	
	?>
