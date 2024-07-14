<?
	// DEFINIMOS AL ENTIDAD
	class EBig_data{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $username;

		public $proceso_id;

		public $ref_tables_id;

		public $col_1;

		public $col_2;

		public $col_3;

		public $col_4;

		public $col_5;

		public $col_6;

		public $col_7;

		public $col_8;

		public $col_9;

		public $col_10;

		public $col_11;

		public $col_12;

		public $col_13;

		public $col_14;

		public $col_15;

		public $col_16;

		public $col_17;

		public $col_18;

		public $col_19;

		public $col_20;

		public $col_21;

		public $col_22;

		public $col_23;

		public $col_24;

		public $col_25;

		public $col_26;

		public $col_27;

		public $col_28;

		public $col_29;

		public $col_30;

		public $combinar;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Big_data()
		{
			$this->id=$this->SetId("");
			$this->username=$this->SetUsername("");
			$this->proceso_id=$this->SetProceso_id("");
			$this->ref_tables_id=$this->SetRef_tables_id("");
			$this->col_1=$this->SetCol_1("");
			$this->col_2=$this->SetCol_2("");
			$this->col_3=$this->SetCol_3("");
			$this->col_4=$this->SetCol_4("");
			$this->col_5=$this->SetCol_5("");
			$this->col_6=$this->SetCol_6("");
			$this->col_7=$this->SetCol_7("");
			$this->col_8=$this->SetCol_8("");
			$this->col_9=$this->SetCol_9("");
			$this->col_10=$this->SetCol_10("");
			$this->col_11=$this->SetCol_11("");
			$this->col_12=$this->SetCol_12("");
			$this->col_13=$this->SetCol_13("");
			$this->col_14=$this->SetCol_14("");
			$this->col_15=$this->SetCol_15("");
			$this->col_16=$this->SetCol_16("");
			$this->col_17=$this->SetCol_17("");
			$this->col_18=$this->SetCol_18("");
			$this->col_19=$this->SetCol_19("");
			$this->col_20=$this->SetCol_20("");
			$this->col_21=$this->SetCol_21("");
			$this->col_22=$this->SetCol_22("");
			$this->col_23=$this->SetCol_23("");
			$this->col_24=$this->SetCol_24("");
			$this->col_25=$this->SetCol_25("");
			$this->col_26=$this->SetCol_26("");
			$this->col_27=$this->SetCol_27("");
			$this->col_28=$this->SetCol_28("");
			$this->col_29=$this->SetCol_29("");
			$this->col_30=$this->SetCol_30("");
			$this->combinar=$this->SetCombinar("");
		}

		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
		function SetId($some)
		{
			$this->id=$some;
		}

		function SetUsername($some)
		{
			$this->username=$some;
		}

		function SetProceso_id($some)
		{
			$this->proceso_id=$some;
		}

		function SetRef_tables_id($some)
		{
			$this->ref_tables_id=$some;
		}

		function SetCol_1($some)
		{
			$this->col_1=$some;
		}

		function SetCol_2($some)
		{
			$this->col_2=$some;
		}

		function SetCol_3($some)
		{
			$this->col_3=$some;
		}

		function SetCol_4($some)
		{
			$this->col_4=$some;
		}

		function SetCol_5($some)
		{
			$this->col_5=$some;
		}

		function SetCol_6($some)
		{
			$this->col_6=$some;
		}

		function SetCol_7($some)
		{
			$this->col_7=$some;
		}

		function SetCol_8($some)
		{
			$this->col_8=$some;
		}

		function SetCol_9($some)
		{
			$this->col_9=$some;
		}

		function SetCol_10($some)
		{
			$this->col_10=$some;
		}

		function SetCol_11($some)
		{
			$this->col_11=$some;
		}

		function SetCol_12($some)
		{
			$this->col_12=$some;
		}

		function SetCol_13($some)
		{
			$this->col_13=$some;
		}

		function SetCol_14($some)
		{
			$this->col_14=$some;
		}

		function SetCol_15($some)
		{
			$this->col_15=$some;
		}

		function SetCol_16($some)
		{
			$this->col_16=$some;
		}

		function SetCol_17($some)
		{
			$this->col_17=$some;
		}

		function SetCol_18($some)
		{
			$this->col_18=$some;
		}

		function SetCol_19($some)
		{
			$this->col_19=$some;
		}

		function SetCol_20($some)
		{
			$this->col_20=$some;
		}

		function SetCol_21($some)
		{
			$this->col_21=$some;
		}

		function SetCol_22($some)
		{
			$this->col_22=$some;
		}

		function SetCol_23($some)
		{
			$this->col_23=$some;
		}

		function SetCol_24($some)
		{
			$this->col_24=$some;
		}

		function SetCol_25($some)
		{
			$this->col_25=$some;
		}

		function SetCol_26($some)
		{
			$this->col_26=$some;
		}

		function SetCol_27($some)
		{
			$this->col_27=$some;
		}

		function SetCol_28($some)
		{
			$this->col_28=$some;
		}

		function SetCol_29($some)
		{
			$this->col_29=$some;
		}

		function SetCol_30($some)
		{
			$this->col_30=$some;
		}

		function SetCombinar($some)
		{
			$this->combinar=$some;
		}

		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
		function GetId()
		{
			return $this->id;
		}

		function GetUsername()
		{
			return $this->username;
		}

		function GetProceso_id()
		{
			return $this->proceso_id;
		}

		function GetRef_tables_id()
		{
			return $this->ref_tables_id;
		}

		function GetCol_1()
		{
			return $this->col_1;
		}

		function GetCol_2()
		{
			return $this->col_2;
		}

		function GetCol_3()
		{
			return $this->col_3;
		}

		function GetCol_4()
		{
			return $this->col_4;
		}

		function GetCol_5()
		{
			return $this->col_5;
		}

		function GetCol_6()
		{
			return $this->col_6;
		}

		function GetCol_7()
		{
			return $this->col_7;
		}

		function GetCol_8()
		{
			return $this->col_8;
		}

		function GetCol_9()
		{
			return $this->col_9;
		}

		function GetCol_10()
		{
			return $this->col_10;
		}

		function GetCol_11()
		{
			return $this->col_11;
		}

		function GetCol_12()
		{
			return $this->col_12;
		}

		function GetCol_13()
		{
			return $this->col_13;
		}

		function GetCol_14()
		{
			return $this->col_14;
		}

		function GetCol_15()
		{
			return $this->col_15;
		}

		function GetCol_16()
		{
			return $this->col_16;
		}

		function GetCol_17()
		{
			return $this->col_17;
		}

		function GetCol_18()
		{
			return $this->col_18;
		}

		function GetCol_19()
		{
			return $this->col_19;
		}

		function GetCol_20()
		{
			return $this->col_20;
		}

		function GetCol_21()
		{
			return $this->col_21;
		}

		function GetCol_22()
		{
			return $this->col_22;
		}

		function GetCol_23()
		{
			return $this->col_23;
		}

		function GetCol_24()
		{
			return $this->col_24;
		}

		function GetCol_25()
		{
			return $this->col_25;
		}

		function GetCol_26()
		{
			return $this->col_26;
		}

		function GetCol_27()
		{
			return $this->col_27;
		}

		function GetCol_28()
		{
			return $this->col_28;
		}

		function GetCol_29()
		{
			return $this->col_29;
		}

		function GetCol_30()
		{
			return $this->col_30;
		}

		function GetCombinar()
		{
			return $this->combinar;
		}


	}	
	?>
