<?
	// DEFINIMOS AL ENTIDAD
	class EWs_keys{ 

 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		public $id;



		public $llave;



		public $estado;



		public $fecha;



		public $departamento;



		public $ciudad;



		public $oficina;



		public $area;



		public $usuario_destino;



		public $serie;



		public $subserie;



		public $ipkey;



		public $tipokey;



		public $usuario;



		public $nombre;

		public $formulario;



		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO

		function Ws_keys()

		{

			$this->id=$this->SetId("");

			$this->llave=$this->SetLlave("");

			$this->estado=$this->SetEstado("");

			$this->fecha=$this->SetFecha("");

			$this->departamento=$this->Setdepartamento("");

			$this->ciudad=$this->SetCiudad("");

			$this->oficina=$this->SetOficina("");

			$this->area=$this->SetArea("");

			$this->usuario_destino=$this->SetUsuario_destino("");

			$this->serie=$this->SetSerie("");

			$this->subserie=$this->SetSubserie("");

			$this->ipkey=$this->SetIpkey("");

			$this->tipokey=$this->SetTipokey("");

			$this->usuario=$this->SetUsuario("");

			$this->nombre=$this->SetNombre("");

			$this->formulario=$this->SetFormulario("");

		}



		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 

		function SetId($some)

		{

			$this->id=$some;

		}



		function SetLlave($some)

		{

			$this->llave=$some;

		}



		function SetEstado($some)

		{

			$this->estado=$some;

		}



		function SetFecha($some)

		{

			$this->fecha=$some;

		}



		function Setdepartamento($some)

		{

			$this->departamento=$some;

		}



		function SetCiudad($some)

		{

			$this->ciudad=$some;

		}



		function SetOficina($some)

		{

			$this->oficina=$some;

		}



		function SetArea($some)

		{

			$this->area=$some;

		}



		function SetUsuario_destino($some)

		{

			$this->usuario_destino=$some;

		}



		function SetSerie($some)

		{

			$this->serie=$some;

		}



		function SetSubserie($some)

		{

			$this->subserie=$some;

		}



		function SetIpkey($some)

		{

			$this->ipkey=$some;

		}



		function SetTipokey($some)

		{

			$this->tipokey=$some;

		}



		function SetUsuario($some)

		{

			$this->usuario=$some;

		}



		function SetNombre($some)

		{

			$this->nombre=$some;

		}

		function SetFormulario($some)

		{

			$this->formulario=$some;

		}



		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO

		function GetId()

		{

			return $this->id;

		}



		function GetLlave()

		{

			return $this->llave;

		}



		function GetEstado()

		{

			return $this->estado;

		}



		function GetFecha()

		{

			return $this->fecha;

		}



		function Getdepartamento()

		{

			return $this->departamento;

		}



		function GetCiudad()

		{

			return $this->ciudad;

		}



		function GetOficina()

		{

			return $this->oficina;

		}



		function GetArea()

		{

			return $this->area;

		}



		function GetUsuario_destino()

		{

			return $this->usuario_destino;

		}



		function GetSerie()

		{

			return $this->serie;

		}



		function GetSubserie()

		{

			return $this->subserie;

		}



		function GetIpkey()

		{

			return $this->ipkey;

		}



		function GetTipokey()

		{

			return $this->tipokey;

		}



		function GetUsuario()

		{

			return $this->usuario;

		}



		function GetNombre()

		{

			return $this->nombre;

		}

		function GetFormulario()

		{

			return $this->formulario;

		}





	}	

	?>