<?
	// DEFINIMOS AL ENTIDAD
	class EPlantilla_documento_configuracion{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $ultima_modificacion;

		public $tipo;

		public $m_t;

		public $m_r;

		public $m_b;

		public $m_l;

		public $m_e_t;

		public $m_e_b;

		public $m_p_t;

		public $m_p_b;

		public $fuente;

		public $tamano;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Plantilla_documento_configuracion()
		{
			$this->id=$this->SetId("");
			$this->ultima_modificacion=$this->SetUltima_modificacion("");
			$this->tipo=$this->SetTipo("");
			$this->m_t=$this->SetM_t("");
			$this->m_r=$this->SetM_r("");
			$this->m_b=$this->SetM_b("");
			$this->m_l=$this->SetM_l("");
			$this->m_e_t=$this->SetM_e_t("");
			$this->m_e_b=$this->SetM_e_b("");
			$this->m_p_t=$this->SetM_p_t("");
			$this->m_p_b=$this->SetM_p_b("");
			$this->fuente=$this->SetFuente("");
			$this->tamano=$this->SetTamano("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUltima_modificacion($some)
		{
			$this->ultima_modificacion=$some;
		}

		function SetTipo($some)
		{
			$this->tipo=$some;
		}

		function SetM_t($some)
		{
			$this->m_t=$some;
		}

		function SetM_r($some)
		{
			$this->m_r=$some;
		}

		function SetM_b($some)
		{
			$this->m_b=$some;
		}

		function SetM_l($some)
		{
			$this->m_l=$some;
		}

		function SetM_e_t($some)
		{
			$this->m_e_t=$some;
		}

		function SetM_e_b($some)
		{
			$this->m_e_b=$some;
		}

		function SetM_p_t($some)
		{
			$this->m_p_t=$some;
		}

		function SetM_p_b($some)
		{
			$this->m_p_b=$some;
		}

		function SetFuente($some)
		{
			$this->fuente=$some;
		}

		function SetTamano($some)
		{
			$this->tamano=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetUltima_modificacion()
		{
			return $this->ultima_modificacion;
		}

		function GetTipo()
		{
			return $this->tipo;
		}

		function GetM_t()
		{
			return $this->m_t;
		}

		function GetM_r()
		{
			return $this->m_r;
		}

		function GetM_b()
		{
			return $this->m_b;
		}

		function GetM_l()
		{
			return $this->m_l;
		}

		function GetM_e_t()
		{
			return $this->m_e_t;
		}

		function GetM_e_b()
		{
			return $this->m_e_b;
		}

		function GetM_p_t()
		{
			return $this->m_p_t;
		}

		function GetM_p_b()
		{
			return $this->m_p_b;
		}

		function GetFuente()
		{
			return $this->fuente;
		}

		function GetTamano()
		{
			return $this->tamano;
		}


	}	
	?>
