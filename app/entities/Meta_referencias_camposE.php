<?
// DEFINIMOS AL ENTIDAD
class EMeta_referencias_campos{ 
		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
		public $id;

	public $id_referencia;

	public $titulo_campo;

	public $tipo_elemento;

	public $observacion;

	public $visible;

	public $es_obligatorio;

	public $id_lista;

	public $placeholder;

	public $columnas;

	public $orden;

	public $slug;

	public $valor_generico;

	public $validar;

	// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
	function Meta_referencias_campos()
	{
		$this->id=$this->SetId("");
		$this->id_referencia=$this->SetId_referencia("");
		$this->titulo_campo=$this->SetTitulo_campo("");
		$this->tipo_elemento=$this->SetTipo_elemento("");
		$this->observacion=$this->SetObservacion("");
		$this->visible=$this->SetVisible("");
		$this->es_obligatorio=$this->SetEs_obligatorio("");
		$this->id_lista=$this->SetId_lista("");
		$this->placeholder=$this->SetPlaceholder("");
		$this->columnas=$this->SetColumnas("");
		$this->orden=$this->SetOrden("");
		$this->slug=$this->SetSlug("");
		$this->valor_generico=$this->SetValor_generico("");
		$this->validar=$this->SetValidar("");
	}

	// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 
	function SetId($some)
	{
		$this->id=$some;
	}

	function SetId_referencia($some)
	{
		$this->id_referencia=$some;
	}

	function SetTitulo_campo($some)
	{
		$this->titulo_campo=$some;
	}

	function SetTipo_elemento($some)
	{
		$this->tipo_elemento=$some;
	}

	function SetObservacion($some)
	{
		$this->observacion=$some;
	}

	function SetVisible($some)
	{
		$this->visible=$some;
	}

	function SetEs_obligatorio($some)
	{
		$this->es_obligatorio=$some;
	}

	function SetId_lista($some){
		$this->id_lista=$some;
	}

	function SetPlaceholder($some){
		$this->placeholder=$some;
	}

	function SetColumnas($some){
		$this->columnas=$some;
	}

	function SetOrden($some){
		$this->orden=$some;
	}

	function SetSlug($some){
		$this->slug=$some;
	}

	function SetValor_generico($some){
		$this->valor_generico=$some;
	}

	function SetValidar($some){
		$this->validar=$some;
	}

	// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO
	function GetId()
	{
		return $this->id;
	}

	function GetId_referencia()
	{
		return $this->id_referencia;
	}

	function GetTitulo_campo()
	{
		return $this->titulo_campo;
	}

	function GetTipo_elemento()
	{
		return $this->tipo_elemento;
	}

	function GetObservacion()
	{
		return $this->observacion;
	}

	function GetVisible()
	{
		return $this->visible;
	}

	function GetEs_obligatorio()
	{
		return $this->es_obligatorio;
	}

	function GetId_lista()
	{
		return $this->id_lista;
	}

	function GetPlaceholder()
	{
		return $this->placeholder;
	}

	function GetColumnas()
	{
		return $this->columnas;
	}

	function GetOrden()
	{
		return $this->orden;
	}

	function GetSlug()
	{
		return $this->slug;
	}

	function GetValor_generico()
	{
		return $this->valor_generico;
	}

	function GetValidar()
	{
		return $this->validar;
	}
}	
?>