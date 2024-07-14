<?
	// DEFINIMOS AL ENTIDAD
	class EMailer_replys{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $receiver_id;

		public $message_id;

		public $receiver_token;

		public $message_status;

		public $reply_datetime;

		public $reply_ip;

		public $sesionID;

		public $details;

		public $subject;

		public $readed;

		public $dns;

		public $hostname;

		public $isp;

		public $organization;

		public $country;

		public $state;

		public $city;

		public $latitude;

		public $longitude;

		public $lt;

		public $lg;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Mailer_replys()
		{
			$this->id=$this->SetId("");
			$this->receiver_id=$this->SetReceiver_id("");
			$this->message_id=$this->SetMessage_id("");
			$this->receiver_token=$this->SetReceiver_token("");
			$this->message_status=$this->SetMessage_status("");
			$this->reply_datetime=$this->SetReply_datetime("");
			$this->reply_ip=$this->SetReply_ip("");
			$this->sesionID=$this->SetSesionID("");
			$this->details=$this->SetDetails("");
			$this->subject=$this->SetSubject("");
			$this->readed=$this->SetReaded("");
			$this->dns=$this->SetDns("");
			$this->hostname=$this->SetHostname("");
			$this->isp=$this->SetIsp("");
			$this->organization=$this->SetOrganization("");
			$this->country=$this->SetCountry("");
			$this->state=$this->SetState("");
			$this->city=$this->SetCity("");
			$this->latitude=$this->SetLatitude("");
			$this->longitude=$this->SetLongitude("");
			$this->lt=$this->SetLt("");
			$this->lg=$this->SetLg("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetReceiver_id($some)
		{
			$this->receiver_id=$some;
		}

		function SetMessage_id($some)
		{
			$this->message_id=$some;
		}

		function SetReceiver_token($some)
		{
			$this->receiver_token=$some;
		}

		function SetMessage_status($some)
		{
			$this->message_status=$some;
		}

		function SetReply_datetime($some)
		{
			$this->reply_datetime=$some;
		}

		function SetReply_ip($some)
		{
			$this->reply_ip=$some;
		}

		function SetSesionID($some)
		{
			$this->sesionID=$some;
		}

		function SetDetails($some)
		{
			$this->details=$some;
		}

		function SetSubject($some)
		{
			$this->subject=$some;
		}

		function SetReaded($some)
		{
			$this->readed=$some;
		}

		function SetDns($some)
		{
			$this->dns=$some;
		}

		function SetHostname($some)
		{
			$this->hostname=$some;
		}

		function SetIsp($some)
		{
			$this->isp=$some;
		}

		function SetOrganization($some)
		{
			$this->organization=$some;
		}

		function SetCountry($some)
		{
			$this->country=$some;
		}

		function SetState($some)
		{
			$this->state=$some;
		}

		function SetCity($some)
		{
			$this->city=$some;
		}

		function SetLatitude($some)
		{
			$this->latitude=$some;
		}

		function SetLongitude($some)
		{
			$this->longitude=$some;
		}

		function SetLt($some)
		{
			$this->lt=$some;
		}

		function SetLg($some)
		{
			$this->lg=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetReceiver_id()
		{
			return $this->receiver_id;
		}

		function GetMessage_id()
		{
			return $this->message_id;
		}

		function GetReceiver_token()
		{
			return $this->receiver_token;
		}

		function GetMessage_status()
		{
			return $this->message_status;
		}

		function GetReply_datetime()
		{
			return $this->reply_datetime;
		}

		function GetReply_ip()
		{
			return $this->reply_ip;
		}

		function GetSesionID()
		{
			return $this->sesionID;
		}

		function GetDetails()
		{
			return $this->details;
		}

		function GetSubject()
		{
			return $this->subject;
		}

		function GetReaded()
		{
			return $this->readed;
		}

		function GetDns()
		{
			return $this->dns;
		}

		function GetHostname()
		{
			return $this->hostname;
		}

		function GetIsp()
		{
			return $this->isp;
		}

		function GetOrganization()
		{
			return $this->organization;
		}

		function GetCountry()
		{
			return $this->country;
		}

		function GetState()
		{
			return $this->state;
		}

		function GetCity()
		{
			return $this->city;
		}

		function GetLatitude()
		{
			return $this->latitude;
		}

		function GetLongitude()
		{
			return $this->longitude;
		}

		function GetLt()
		{
			return $this->lt;
		}

		function GetLg()
		{
			return $this->lg;
		}


	}	
	?>
