<?
	// DEFINIMOS AL ENTIDAD
	class EMailer_message{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $message_id;

		public $sID;

		public $user_ID;

		public $ip;

		public $date;

		public $size;

		public $from_nom;

		public $subject;

		public $message;

		public $exp_day;

		public $p_id;

		public $name;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Mailer_message()
		{
			$this->id=$this->SetId("");
			$this->message_id=$this->SetMessage_id("");
			$this->sID=$this->SetSID("");
			$this->user_ID=$this->SetUser_ID("");
			$this->ip=$this->SetIp("");
			$this->date=$this->SetDate("");
			$this->size=$this->SetSize("");
			$this->from_nom=$this->SetFrom_nom("");
			$this->subject=$this->SetSubject("");
			$this->message=$this->SetMessage("");
			$this->exp_day=$this->SetExp_day("");
			$this->p_id=$this->SetP_id("");
			$this->name=$this->SetName("");
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

		function SetSID($some)
		{
			$this->sID=$some;
		}

		function SetUser_ID($some)
		{
			$this->user_ID=$some;
		}

		function SetIp($some)
		{
			$this->ip=$some;
		}

		function SetDate($some)
		{
			$this->date=$some;
		}

		function SetSize($some)
		{
			$this->size=$some;
		}

		function SetFrom_nom($some)
		{
			$this->from_nom=$some;
		}

		function SetSubject($some)
		{
			$this->subject=$some;
		}

		function SetMessage($some)
		{
			$this->message=$some;
		}

		function SetExp_day($some)
		{
			$this->exp_day=$some;
		}

		function SetP_id($some)
		{
			$this->p_id=$some;
		}

		function SetName($some)
		{
			$this->name=$some;
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

		function GetSID()
		{
			return $this->sID;
		}

		function GetUser_ID()
		{
			return $this->user_ID;
		}

		function GetIp()
		{
			return $this->ip;
		}

		function GetDate()
		{
			return $this->date;
		}

		function GetSize()
		{
			return $this->size;
		}

		function GetFrom_nom()
		{
			return $this->from_nom;
		}

		function GetSubject()
		{
			return $this->subject;
		}

		function GetMessage()
		{
			return $this->message;
		}

		function GetExp_day()
		{
			return $this->exp_day;
		}

		function GetP_id()
		{
			return $this->p_id;
		}

		function GetName()
		{
			return $this->name;
		}


	}	
	?>
