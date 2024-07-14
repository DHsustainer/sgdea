<?
	// DEFINIMOS AL ENTIDAD
	class EMailer_from_message{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $message_id;

		public $message_code;

		public $sID;

		public $token_ID;

		public $user_ID;

		public $email;

		public $size;

		public $message;

		public $clean_message;

		public $type_message;

		public $name;

		public $dns;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Mailer_from_message()
		{
			$this->id=$this->SetId("");
			$this->message_id=$this->SetMessage_id("");
			$this->message_code=$this->SetMessage_code("");
			$this->sID=$this->SetSID("");
			$this->token_ID=$this->SetToken_ID("");
			$this->user_ID=$this->SetUser_ID("");
			$this->email=$this->SetEmail("");
			$this->size=$this->SetSize("");
			$this->message=$this->SetMessage("");
			$this->clean_message=$this->SetClean_message("");
			$this->type_message=$this->SetType_message("");
			$this->name=$this->SetName("");
			$this->dns=$this->SetDns("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetMessage_id($some)
		{
			$this->message_id=$some;
		}

		function SetMessage_code($some)
		{
			$this->message_code=$some;
		}

		function SetSID($some)
		{
			$this->sID=$some;
		}

		function SetToken_ID($some)
		{
			$this->token_ID=$some;
		}

		function SetUser_ID($some)
		{
			$this->user_ID=$some;
		}

		function SetEmail($some)
		{
			$this->email=$some;
		}

		function SetSize($some)
		{
			$this->size=$some;
		}

		function SetMessage($some)
		{
			$this->message=$some;
		}

		function SetClean_message($some)
		{
			$this->clean_message=$some;
		}

		function SetType_message($some)
		{
			$this->type_message=$some;
		}

		function SetName($some)
		{
			$this->name=$some;
		}

		function SetDns($some)
		{
			$this->dns=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetMessage_id()
		{
			return $this->message_id;
		}

		function GetMessage_code()
		{
			return $this->message_code;
		}

		function GetSID()
		{
			return $this->sID;
		}

		function GetToken_ID()
		{
			return $this->token_ID;
		}

		function GetUser_ID()
		{
			return $this->user_ID;
		}

		function GetEmail()
		{
			return $this->email;
		}

		function GetSize()
		{
			return $this->size;
		}

		function GetMessage()
		{
			return $this->message;
		}

		function GetClean_message()
		{
			return $this->clean_message;
		}

		function GetType_message()
		{
			return $this->type_message;
		}

		function GetName()
		{
			return $this->name;
		}

		function GetDns()
		{
			return $this->dns;
		}


	}	
	?>
