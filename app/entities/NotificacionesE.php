<?
// DEFINIMOS AL ENTIDAD
class ENotificaciones{ 
		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		
	public $id;

	public $user_id;

	public $proceso_id;

	public $id_demandado;

	public $tipo_notificacion;

	public $id_postal;

	public $f_citacion;

	public $todos;

	public $nom_archivo;

	public $direccion;

	public $num_dias;

	public $is_certificada;

	public $guia_id;

	public $destinatario;

	public $nombre_postal;

	public $hora;

	public $valor;

	public $suscriptor;

	public $observacion;

	public $telefono;

	public $sms_leido;

	public $sms_usar;

	public $fecha_lectura_sms;

	public $reply_ip;

	public $country;

	public $state;

	public $city;

	public $latitude;

	public $longitude;

	public $sms_enviado;

	public $notificado;

	public $interesado;


	// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO
	function Notificaciones()
	{
		$this->id=$this->SetId("");
		$this->user_id=$this->SetUser_id("");
		$this->proceso_id=$this->SetProceso_id("");
		$this->id_demandado=$this->SetId_demandado("");
		$this->tipo_notificacion=$this->SetTipo_notificacion("");
		$this->id_postal=$this->SetId_postal("");
		$this->f_citacion=$this->SetF_citacion("");
		$this->todos=$this->SetTodos("");
		$this->nom_archivo=$this->SetNom_archivo("");
		$this->direccion=$this->SetDireccion("");
		$this->num_dias=$this->SetNum_dias("");
		$this->is_certificada=$this->SetIs_certificada("");
		$this->guia_id=$this->SetGuia_id("");
		$this->destinatario=$this->SetDestinatario("");
		$this->nombre_postal=$this->Setnombre_postal("");
		$this->hora=$this->Sethora("");
		$this->valor=$this->Setvalor("");
		$this->suscriptor=$this->Setsuscriptor("");
		$this->observacion=$this->Setobservacion("");
		$this->telefono=$this->Settelefono("");
		$this->sms_leido=$this->Setsms_leido("");
		$this->sms_usar=$this->Setsms_usar("");
		$this->fecha_lectura_sms=$this->Setfecha_lectura_sms("");
		$this->reply_ip=$this->Setreply_ip("");
		$this->country=$this->Setcountry("");
		$this->state=$this->Setstate("");
		$this->city=$this->Setcity("");
		$this->latitude=$this->Setlatitude("");
		$this->longitude=$this->Setlongitude("");
		$this->sms_enviado=$this->Setsms_enviado("");
		$this->notificado=$this->Setnotificado("");
		$this->interesado=$this->Setinteresado("");
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

	function SetProceso_id($some)
	{
		$this->proceso_id=$some;
	}

	function SetId_demandado($some)
	{
		$this->id_demandado=$some;
	}

	function SetTipo_notificacion($some)
	{
		$this->tipo_notificacion=$some;
	}

	function SetId_postal($some)
	{
		$this->id_postal=$some;
	}

	function SetF_citacion($some)
	{
		$this->f_citacion=$some;
	}

	function SetTodos($some)
	{
		$this->todos=$some;
	}

	function SetNom_archivo($some)
	{
		$this->nom_archivo=$some;
	}

	function SetDireccion($some)
	{
		$this->direccion=$some;
	}

	function SetNum_dias($some)
	{
		$this->num_dias=$some;
	}

	function SetIs_certificada($some)
	{
		$this->is_certificada=$some;
	}

	function SetGuia_id($some)
	{
		$this->guia_id=$some;
	}

	function SetDestinatario($some){
		$this->destinatario=$some;	
	}

	function Setnombre_postal($some){
		$this->nombre_postal = $some;
	}
	function Sethora($some){
		$this->hora = $some;
	}
	function Setvalor($some){
		$this->valor = $some;
	}
	function Setsuscriptor($some){
		$this->suscriptor = $some;
	}
	function Setobservacion($some){
		$this->observacion = $some;
	}
	function Settelefono($some){
		$this->telefono = $some;
	}
	function Setsms_leido($some){
		$this->sms_leido = $some;
	}
	function Setsms_usar($some){
		$this->sms_usar = $some;
	}
	function Setfecha_lectura_sms($some){
		$this->fecha_lectura_sms = $some;
	}
	function Setreply_ip($some){
		$this->reply_ip = $some;
	}
	function Setcountry($some){
		$this->country = $some;
	}
	function Setstate($some){
		$this->state = $some;
	}
	function Setcity($some){
		$this->city = $some;
	}
	function Setlatitude($some){
		$this->latitude = $some;
	}
	function Setlongitude($some){
		$this->longitude = $some;
	}
	function Setsms_enviado($some){
		$this->sms_enviado = $some;
	}
	function Setnotificado($some){
		$this->notificado = $some;
	}

	function Setinteresado($some){
		$this->interesado = $some;
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

	function GetProceso_id()
	{
		return $this->proceso_id;
	}

	function GetId_demandado()
	{
		return $this->id_demandado;
	}

	function GetTipo_notificacion()
	{
		return $this->tipo_notificacion;
	}

	function GetId_postal()
	{
		return $this->id_postal;
	}

	function GetF_citacion()
	{
		return $this->f_citacion;
	}

	function GetTodos()
	{
		return $this->todos;
	}

	function GetNom_archivo()
	{
		return $this->nom_archivo;
	}

	function GetDireccion()
	{
		return $this->direccion;
	}

	function GetNum_dias()
	{
		return $this->num_dias;
	}

	function GetIs_certificada()
	{
		return $this->is_certificada;
	}

	function GetGuia_id()
	{
		return $this->guia_id;
	}

	function GetDestinatario()
	{
		return $this->destinatario;
	}

	function Getnombre_postal(){
		return $this->nombre_postal;
	}
	function Gethora(){
		return $this->hora;
	}
	function Getvalor(){
		return $this->valor;
	}
	function Getsuscriptor(){
		return $this->suscriptor;
	}
	function Getobservacion(){
		return $this->observacion;
	}
	function Gettelefono(){
		return $this->telefono;
	}
	function Getsms_leido(){
		return $this->sms_leido;
	}
	function Getsms_usar(){
		return $this->sms_usar;
	}
	function Getfecha_lectura_sms(){
		return $this->fecha_lectura_sms;
	}
	function Getreply_ip(){
		return $this->reply_ip;
	}
	function Getcountry(){
		return $this->country;
	}
	function Getstate(){
		return $this->state;
	}
	function Getcity(){
		return $this->city;
	}
	function Getlatitude(){
		return $this->latitude;
	}
	function Getlongitude(){
		return $this->longitude;
	}
	function Getsms_enviado(){
		return $this->sms_enviado;
	}
	function GetNotificado(){
		return $this->notificado;
	}
	function Getinteresado(){
		return $this->interesado;
	}
}	
?>