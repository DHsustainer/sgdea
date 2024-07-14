<?
	// DEFINIMOS AL ENTIDAD
	class EUsuarios_configurar_firma_digital{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $campo1;

		public $campo2;

		public $campo3;

		public $campo4;

		public $campo5;

		public $campo6;

		public $campo7;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Usuarios_configurar_firma_digital()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->campo1=$this->SetCampo1("");
			$this->campo2=$this->SetCampo2("");
			$this->campo3=$this->SetCampo3("");
			$this->campo4=$this->SetCampo4("");
			$this->campo5=$this->SetCampo5("");
			$this->campo6=$this->SetCampo6("");
			$this->campo7=$this->SetCampo7("");
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

		function SetCampo1($some)
		{
			$this->campo1=$some;
		}

		function SetCampo2($some)
		{
			$this->campo2=$some;
		}

		function SetCampo3($some)
		{
			$this->campo3=$some;
		}

		function SetCampo4($some)
		{
			$this->campo4=$some;
		}

		function SetCampo5($some)
		{
			$this->campo5=$some;
		}

		function SetCampo6($some)
		{
			$this->campo6=$some;
		}

		function SetCampo7($some)
		{
			$this->campo7=$some;
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

		function GetCampo1()
		{
			return $this->campo1;
		}

		function GetCampo2()
		{
			return $this->campo2;
		}

		function GetCampo3()
		{
			return $this->campo3;
		}

		function GetCampo4()
		{
			return $this->campo4;
		}

		function GetCampo5()
		{
			return $this->campo5;
		}

		function GetCampo6()
		{
			return $this->campo6;
		}

		function GetCampo7()
		{
			return $this->campo7;
		}


	}	
	?>
