<?
	// DEFINIMOS AL ENTIDAD
	class EUsuarios_configurar_accesos{ 
 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;

		public $user_id;

		public $tabla;

		public $id_tabla;

		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
		function Usuarios_configurar_accesos()
		{
			$this->id=$this->SetId("");
			$this->user_id=$this->SetUser_id("");
			$this->tabla=$this->SetTabla("");
			$this->id_tabla=$this->SetId_tabla("");
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

		function SetTabla($some)
		{
			$this->tabla=$some;
		}

		function SetId_tabla($some)
		{
			$this->id_tabla=$some;
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

		function GetTabla()
		{
			return $this->tabla;
		}

		function GetId_tabla()
		{
			return $this->id_tabla;
		}


	}	
	?>
