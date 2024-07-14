<?
	// DEFINIMOS AL ENTIDAD
	class EAlertas_suscriptor{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $suscriptor_id;

		public $alerta;

		public $id_gestion;

		public $fechahora;

		public $estado;

		public $type;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Alertas_suscriptor()
		{
			$this->id=$this->SetId("");
			$this->suscriptor_id=$this->SetSuscriptor_id("");
			$this->alerta=$this->SetAlerta("");
			$this->id_gestion=$this->SetId_gestion("");
			$this->fechahora=$this->SetFechahora("");
			$this->estado=$this->SetEstado("");
			$this->type=$this->SetType("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetSuscriptor_id($some)
		{
			$this->suscriptor_id=$some;
		}

		function SetAlerta($some)
		{
			$this->alerta=$some;
		}

		function SetId_gestion($some)
		{
			$this->id_gestion=$some;
		}

		function SetFechahora($some)
		{
			$this->fechahora=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetType($some)
		{
			$this->type=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetSuscriptor_id()
		{
			return $this->suscriptor_id;
		}

		function GetAlerta()
		{
			return $this->alerta;
		}

		function GetId_gestion()
		{
			return $this->id_gestion;
		}

		function GetFechahora()
		{
			return $this->fechahora;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetType()
		{
			return $this->type;
		}


	}	
	?>
