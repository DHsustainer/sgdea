<?
	// DEFINIMOS AL ENTIDAD
	class EKeywords{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
 		public $id;
		public $termino;
		public $p_clave;
		public $codeword;
		public $mostrar;
		public $f_update;
		public $username;
		public $ayuda;
		public $tipo;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Keywords()
		{
			$this->id=$this->SetId("");
			$this->termino=$this->SetTermino("");
			$this->p_clave=$this->SetP_clave("");
			$this->mostrar=$this->SetMostrar("");
			$this->f_update=$this->SetF_update("");
			$this->username=$this->SetUsername("");
			$this->ayuda=$this->SetAyuda("");
			$this->tipo=$this->SetTipo("");
			$this->codeword=$this->SetCodeword("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetTermino($some)
		{
			$this->termino=$some;
		}

		function SetP_clave($some)
		{
			$this->p_clave=$some;
		}

		function SetMostrar($some)
		{
			$this->mostrar=$some;
		}

		function SetF_update($some)
		{
			$this->f_update=$some;
		}

		function SetUsername($some)
		{
			$this->username=$some;
		}
		function SetAyuda($some)
		{
			$this->ayuda=$some;
		}
		function SetTipo($some)
		{
			$this->tipo=$some;
		}
		function SetCodeword($some)
		{
			$this->codeword=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetTermino()
		{
			return $this->termino;
		}

		function GetP_clave()
		{
			return $this->p_clave;
		}

		function GetMostrar()
		{
			return $this->mostrar;
		}

		function GetF_update()
		{
			return $this->f_update;
		}

		function GetUsername()
		{
			return $this->username;
		}

		function GetAyuda()
		{
			return $this->ayuda;
		}
		function GetTipo()
		{
			return $this->tipo;
		}
		function GetCodeword()
		{
			return $this->codeword;
		}


	}	
	?>
