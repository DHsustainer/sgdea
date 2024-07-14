<?
	// DEFINIMOS AL ENTIDAD
	class EEvents{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $date;

		public $title;

		public $description;

		public $added;

		public $status;

		public $deadline;

		public $dayevent;

		public $time;

		public $proceso_id;

		public $alerted;

		public $avisar_a;

		public $echo;

		public $type_event;

		public $fecha_vencimiento;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Events()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->date=$this->SetDate("");
			$this->title=$this->SetTitle("");
			$this->description=$this->SetDescription("");
			$this->added=$this->SetAdded("");
			$this->status=$this->SetStatus("");
			$this->deadline=$this->SetDeadline("");
			$this->dayevent=$this->SetDayevent("");
			$this->time=$this->SetTime("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->alerted=$this->SetAlerted("");
			$this->avisar_a=$this->SetAvisar_a("");
			$this->echo=$this->SetEcho("");
			$this->type_event=$this->SetType_event("");
			$this->fecha_vencimiento=$this->SetFecha_vencimiento("");
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

		function SetDate($some)
		{
			$this->date=$some;
		}

		function SetTitle($some)
		{
			$this->title=$some;
		}

		function SetDescription($some)
		{
			$this->description=$some;
		}

		function SetAdded($some)
		{
			$this->added=$some;
		}

		function SetStatus($some)
		{
			$this->status=$some;
		}

		function SetDeadline($some)
		{
			$this->deadline=$some;
		}

		function SetDayevent($some)
		{
			$this->dayevent=$some;
		}

		function SetTime($some)
		{
			$this->time=$some;
		}

		function SetProceso_id($some)
		{
			$this->proceso_id=$some;
		}

		function SetAlerted($some)
		{
			$this->alerted=$some;
		}

		function SetAvisar_a($some)
		{
			$this->avisar_a=$some;
		}

		function SetEcho($some)
		{
			$this->echo=$some;
		}

		function SetType_event($some)
		{
			$this->type_event=$some;
		}

		function SetFecha_vencimiento($some)
		{
			$this->fecha_vencimiento=$some;
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

		function GetDate()
		{
			return $this->date;
		}

		function GetTitle()
		{
			return $this->title;
		}

		function GetDescription()
		{
			return $this->description;
		}

		function GetAdded()
		{
			return $this->added;
		}

		function GetStatus()
		{
			return $this->status;
		}

		function GetDeadline()
		{
			return $this->deadline;
		}

		function GetDayevent()
		{
			return $this->dayevent;
		}

		function GetTime()
		{
			return $this->time;
		}

		function GetProceso_id()
		{
			return $this->proceso_id;
		}

		function GetAlerted()
		{
			return $this->alerted;
		}

		function GetAvisar_a()
		{
			return $this->avisar_a;
		}

		function GetEcho()
		{
			return $this->echo;
		}

		function GetType_event()
		{
			return $this->type_event;
		}

		function GetFecha_vencimiento()
		{
			return $this->fecha_vencimiento;
		}


	}	
	?>
