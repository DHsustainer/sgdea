<?
// DEFINIMOS AL ENTIDAD
class EMeta_big_data{ 
	// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
	public $id;

	public $type_id;

	public $ref_id;

	public $campo_id;

	public $valor;

	public $grupo_id;

	public $tipo_form;
	public $fecha_registro;
	public $modif_usuario;

	// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
	function Meta_big_data()
	{
		$this->id=$this->SetId("");
		$this->type_id=$this->SetType_id("");
		$this->ref_id=$this->SetRef_id("");
		$this->campo_id=$this->SetCampo_id("");
		$this->valor=$this->SetValor("");
		$this->grupo_id=$this->SetGrupo_id("");
		$this->tipo_form=$this->SetTipo_form("");

		$this->fecha_registro=$this->SetFecha_registro("");
		$this->modif_usuario=$this->SetModif_usuario("");
	}

	// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
	function SetId($some)
	{
		$this->id=$some;
	}

	function SetType_id($some)
	{
		$this->type_id=$some;
	}

	function SetRef_id($some)
	{
		$this->ref_id=$some;
	}

	function SetCampo_id($some)
	{
		$this->campo_id=$some;
	}

	function SetValor($some)
	{
		$this->valor=$some;
	}

	function SetGrupo_id($some){
		$this->grupo_id=$some;	
	}

	function SetTipo_form($some){
		$this->tipo_form=$some;	
	}

	function SetModif_usuario($some){
		$this->modif_usuario=$some;	
	}
	function SetFecha_registro($some){
		$this->fecha_registro=$some;	
	}

	// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
	function GetId()
	{
		return $this->id;
	}

	function GetType_id()
	{
		return $this->type_id;
	}

	function GetRef_id()
	{
		return $this->ref_id;
	}

	function GetCampo_id()
	{
		return $this->campo_id;
	}

	function GetValor()
	{
		return $this->valor;
	}

	function GetGrupo_id()
	{
		return $this->grupo_id;
	}

	function GetTipo_form()
	{
		return $this->tipo_form;
	}

	function GetFecha_registro()
	{
		return $this->fecha_registro;
	}
	function GetModif_usuario()
	{
		return $this->modif_usuario;
	}
}
?>