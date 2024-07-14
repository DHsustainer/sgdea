<?
	// DEFINIMOS AL ENTIDAD
	class EFolder{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $nom;

		public $fecha;

		public $cod_ingreso;

		public $password;

		public $estado;

		public $dec_pass;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Folder()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->nom=$this->SetNom("");
			$this->fecha=$this->SetFecha("");
			$this->cod_ingreso=$this->SetCod_ingreso("");
			$this->password=$this->SetPassword("");
			$this->estado=$this->SetEstado("");
			$this->dec_pass= $this->SetDec_pass("");
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

		function SetNom($some)
		{
			$this->nom=$some;
		}

		function SetFecha($some)
		{
			$this->fecha=$some;
		}

		function SetCod_ingreso($some)
		{
			$this->cod_ingreso=$some;
		}

		function SetPassword($some)
		{
			$this->password=$some;
		}

		function SetEstado($some)
		{
			$this->estado=$some;
		}

		function SetDec_pass($some)
		{
			$this->dec_pass=$some;
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

		function GetNom()
		{
			return $this->nom;
		}

		function GetFecha()
		{
			return $this->fecha;
		}

		function GetCod_ingreso()
		{
			return $this->cod_ingreso;
		}

		function GetPassword()
		{
			return $this->password;
		}

		function GetEstado()
		{
			return $this->estado;
		}

		function GetDec_pass()
		{
			return $this->dec_pass;
		}


	}	
	?>
