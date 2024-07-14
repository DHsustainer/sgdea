<?
// DEFINIMOS AL ENTIDAD
class EPlantillas_email{ 
	// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
	public $id;
	public $tipo;
	public $nombre;
	public $contenido;
	public $fecha;
	public $ayuda;

	// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
	function Plantillas_email()
	{
		$this->id=$this->SetId("");
		$this->tipo=$this->SetTipo("");
		$this->nombre=$this->SetNombre("");
		$this->contenido=$this->SetContenido("");
		$this->fecha=$this->SetFecha("");
		$this->ayuda=$this->SetAyuda("");
	}

	// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
	function SetId($some)
	{
		$this->id=$some;
	}

	function SetTipo($some)
	{
		$this->tipo=$some;
	}

	function SetNombre($some)
	{
		$this->nombre=$some;
	}

	function SetContenido($some)
	{
		$this->contenido=$some;
	}

	function SetFecha($some)
	{
		$this->fecha=$some;
	}

	function SetAyuda($some)
	{
		$this->ayuda=$some;
	}

	// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
	function GetId()
	{
		return $this->id;
	}

	function GetTipo()
	{
		return $this->tipo;
	}

	function GetNombre()
	{
		return $this->nombre;
	}

	function GetContenido()
	{
		return $this->contenido;
	}

	function GetFecha()
	{
		return $this->fecha;
	}
	function GetAyuda()
	{
		return $this->ayuda;
	}


}	
?>