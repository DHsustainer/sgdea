<?
	// DEFINIMOS AL ENTIDAD
	class EMailer_attachments{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $message_id;

		public $filename;

		public $size;

		public $alt;

		public $type;

		public $title;

		public $at_id;

		public $folio;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Mailer_attachments()
		{
			$this->id=$this->SetId("");
			$this->message_id=$this->SetMessage_id("");
			$this->filename=$this->SetFilename("");
			$this->size=$this->SetSize("");
			$this->alt=$this->SetAlt("");
			$this->type=$this->SetType("");
			$this->title=$this->SetTitle("");
			$this->at_id=$this->SetAt_id("");
			$this->folio=$this->SetFolio("");
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

		function SetFilename($some)
		{
			$this->filename=$some;
		}

		function SetSize($some)
		{
			$this->size=$some;
		}

		function SetAlt($some)
		{
			$this->alt=$some;
		}

		function SetType($some)
		{
			$this->type=$some;
		}

		function SetTitle($some)
		{
			$this->title=$some;
		}

		function SetAt_id($some)
		{
			$this->at_id=$some;
		}

		function SetFolio($some)
		{
			$this->folio=$some;
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

		function GetFilename()
		{
			return $this->filename;
		}

		function GetSize()
		{
			return $this->size;
		}

		function GetAlt()
		{
			return $this->alt;
		}

		function GetType()
		{
			return $this->type;
		}

		function GetTitle()
		{
			return $this->title;
		}

		function GetAt_id()
		{
			return $this->at_id;
		}

		function GetFolio()
		{
			return $this->folio;
		}


	}	
	?>
