<?
	// DEFINIMOS AL ENTIDAD
	class EFolder_demandante_proceso_juridico{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;

		public $id_folder;

		public $user_id;

		public $nom_entidad;

		public $nit_entidad;

		public $dir_entidad;

		public $ciu_entidad;

		public $p_nom_repres;

		public $s_nom_repres;

		public $p_ape_repres;

		public $s_ape_repres;

		public $ciu_repres;

		public $email;

		public $telefonos;

		public $ciudad_expedicion;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Folder_demandante_proceso_juridico()
		{
			$this->id=$this->SetId("");
			$this->id_folder=$this->SetId_folder("");
			$this->user_id=$this->SetUser_id("");
			$this->nom_entidad=$this->SetNom_entidad("");
			$this->nit_entidad=$this->SetNit_entidad("");
			$this->dir_entidad=$this->SetDir_entidad("");
			$this->ciu_entidad=$this->SetCiu_entidad("");
			$this->p_nom_repres=$this->SetP_nom_repres("");
			$this->s_nom_repres=$this->SetS_nom_repres("");
			$this->p_ape_repres=$this->SetP_ape_repres("");
			$this->s_ape_repres=$this->SetS_ape_repres("");
			$this->ciu_repres=$this->SetCiu_repres("");
			$this->email=$this->SetEmail("");
			$this->telefonos=$this->SetTelefonos("");
			$this->ciudad_expedicion=$this->SetCiudad_expedicion("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetId_folder($some)
		{
			$this->id_folder=$some;
		}

		function SetUser_id($some)
		{
			$this->user_id=$some;
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

		function SetEmail($some)
		{
			$this->email=$some;
		}

		function SetTelefonos($some)
		{
			$this->telefonos=$some;
		}

		function SetCiudad_expedicion($some)
		{
			$this->ciudad_expedicion=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetId_folder()
		{
			return $this->id_folder;
		}

		function GetUser_id()
		{
			return $this->user_id;
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

		function GetEmail()
		{
			return $this->email;
		}

		function GetTelefonos()
		{
			return $this->telefonos;
		}

		function GetCiudad_expedicion()
		{
			return $this->ciudad_expedicion;
		}


	}	
	?>
