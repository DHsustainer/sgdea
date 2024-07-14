<?
	// DEFINIMOS AL ENTIDAD
	class EDemandante_proceso_juridico{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $proceso_id;

		public $nom_entidad;

		public $nit_entidad;

		public $dir_entidad;

		public $ciu_entidad;

		public $p_nom_repres;

		public $s_nom_repres;

		public $p_ape_repres;

		public $s_ape_repres;

		public $ciu_repres;

		public $email_repres;

		public $telefonos;

		public $exp_identificacion;

		public $notif_actuaciones;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Demandante_proceso_juridico()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->nom_entidad=$this->SetNom_entidad("");
			$this->nit_entidad=$this->SetNit_entidad("");
			$this->dir_entidad=$this->SetDir_entidad("");
			$this->ciu_entidad=$this->SetCiu_entidad("");
			$this->p_nom_repres=$this->SetP_nom_repres("");
			$this->s_nom_repres=$this->SetS_nom_repres("");
			$this->p_ape_repres=$this->SetP_ape_repres("");
			$this->s_ape_repres=$this->SetS_ape_repres("");
			$this->ciu_repres=$this->SetCiu_repres("");
			$this->email_repres=$this->SetEmail_repres("");
			$this->telefonos=$this->SetTelefonos("");
			$this->exp_identificacion=$this->SetExp_identificacion("");
			$this->notif_actuaciones=$this->SetNotif_actuaciones("");
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

		function SetProceso_id($some)
		{
			$this->proceso_id=$some;
		}

		function SetNom_entidad($some)
		{
			$this->nom_entidad=$some;
		}

		function SetNit_entidad($some)
		{
			$this->nit_entidad=$some;
		}

		function SetDir_entidad($some)
		{
			$this->dir_entidad=$some;
		}

		function SetCiu_entidad($some)
		{
			$this->ciu_entidad=$some;
		}

		function SetP_nom_repres($some)
		{
			$this->p_nom_repres=$some;
		}

		function SetS_nom_repres($some)
		{
			$this->s_nom_repres=$some;
		}

		function SetP_ape_repres($some)
		{
			$this->p_ape_repres=$some;
		}

		function SetS_ape_repres($some)
		{
			$this->s_ape_repres=$some;
		}

		function SetCiu_repres($some)
		{
			$this->ciu_repres=$some;
		}

		function SetEmail_repres($some)
		{
			$this->email_repres=$some;
		}

		function SetTelefonos($some)
		{
			$this->telefonos=$some;
		}

		function SetExp_identificacion($some)
		{
			$this->exp_identificacion=$some;
		}

		function SetNotif_actuaciones($some)
		{
			$this->notif_actuaciones=$some;
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

		function GetProceso_id()
		{
			return $this->proceso_id;
		}

		function GetNom_entidad()
		{
			return $this->nom_entidad;
		}

		function GetNit_entidad()
		{
			return $this->nit_entidad;
		}

		function GetDir_entidad()
		{
			return $this->dir_entidad;
		}

		function GetCiu_entidad()
		{
			return $this->ciu_entidad;
		}

		function GetP_nom_repres()
		{
			return $this->p_nom_repres;
		}

		function GetS_nom_repres()
		{
			return $this->s_nom_repres;
		}

		function GetP_ape_repres()
		{
			return $this->p_ape_repres;
		}

		function GetS_ape_repres()
		{
			return $this->s_ape_repres;
		}

		function GetCiu_repres()
		{
			return $this->ciu_repres;
		}

		function GetEmail_repres()
		{
			return $this->email_repres;
		}

		function GetTelefonos()
		{
			return $this->telefonos;
		}

		function GetExp_identificacion()
		{
			return $this->exp_identificacion;
		}

		function GetNotif_actuaciones()
		{
			return $this->notif_actuaciones;
		}


	}	
	?>
