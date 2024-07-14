<?

	// DEFINIMOS AL ENTIDAD

	class EGestion{ 

 		// DEFINIMOS LAS VARIABLES DE LA ENTIDAD		

 		public $id;



		public $radicado;



		public $f_recibido;



		public $nombre_radica;



		public $folio;



		public $tipo_documento;



		public $dependencia_destino;



		public $nombre_destino;



		public $fecha_vencimiento;



		public $estado_respuesta;



		public $num_oficio_respuesta;



		public $fecha_respuesta;



		public $observacion;



		public $prioridad;



		public $estado_solicitud;



		public $suscriptor_id;



		public $ciudad;



		public $usuario_registra;



		public $estado_archivo;



		public $oficina;



		public $id_dependencia_raiz;



		public $fecha_registro;



		public $min_rad;



		public $documento_salida;

		public $uri;

		public $ts;

		public $observacion2;

		public $transferencia;

		public $rweb;

		public $version;
		public $tipo_almacen;
		public $ubicacion_fisica;
		public $estado_personalizado;
		
		public $campot1;
		public $campot2;
		public $campot3;
		public $campot4;
		public $campot5;

		public $campot6;
		public $campot7;
		public $campot8;
		public $campot9;
		public $campot10;

		public $campot11;
		public $campot12;
		public $campot13;
		public $campot14;
		public $campot15;

		public $es_publico;
		public $suscriptor_leido;
		public $usuario_leido;
		public $suscriptor_updated;
		public $usuario_updated;



		// INICIALIZAMOS EL OBJETO CON LAS VARIABLES EN VACIO

		function Gestion()

		{

			$this->id=$this->SetId("");

			$this->radicado=$this->SetRadicado("");

			$this->f_recibido=$this->SetF_recibido("");

			$this->nombre_radica=$this->SetNombre_radica("");

			$this->folio=$this->SetFolio("");

			$this->tipo_documento=$this->SetTipo_documento("");

			$this->dependencia_destino=$this->SetDependencia_destino("");

			$this->nombre_destino=$this->SetNombre_destino("");

			$this->fecha_vencimiento=$this->SetFecha_vencimiento("");

			$this->estado_respuesta=$this->SetEstado_respuesta("");

			$this->num_oficio_respuesta=$this->SetNum_oficio_respuesta("");

			$this->fecha_respuesta=$this->SetFecha_respuesta("");

			$this->observacion=$this->SetObservacion("");

			$this->prioridad=$this->SetPrioridad("");

			$this->estado_solicitud=$this->SetEstado_solicitud("");

			$this->suscriptor_id=$this->SetSuscriptor_id("");

			$this->ciudad=$this->SetCiudad("");

			$this->usuario_registra=$this->SetUsuario_registra("");

			$this->estado_archivo=$this->SetEstado_archivo("");

			$this->oficina=$this->SetOficina("");

			$this->id_dependencia_raiz=$this->SetId_dependencia_raiz("");



			$this->fecha_registro=$this->SetFecha_registro("");

			$this->min_rad=$this->SetMin_rad("");

			$this->documento_salida=$this->SetDocumento_salida("");

			$this->uri=$this->SetUri("");

			$this->ts=$this->SetTs("");
			$this->observacion2=$this->SetObservacion2("");
			$this->transferencia=$this->SetTransferencia("");
			$this->rweb=$this->SetRweb("");

			$this->version=$this->SetVersion("");
			$this->tipo_almacen=$this->SetTipo_almacen("");
			$this->ubicacion_fisica=$this->SetUbicacion_fisica("");
			$this->estado_personalizado=$this->SetEstado_personalizado("");

			$this->campot1=$this->SetCampot1("");
			$this->campot2=$this->SetCampot2("");
			$this->campot3=$this->SetCampot3("");
			$this->campot4=$this->SetCampot4("");
			$this->campot5=$this->SetCampot5("");

			$this->campot6=$this->SetCampot6("");
			$this->campot7=$this->SetCampot7("");
			$this->campot8=$this->SetCampot8("");
			$this->campot9=$this->SetCampot9("");
			$this->campot10=$this->SetCampot10("");

			$this->campot11=$this->SetCampot11("");
			$this->campot12=$this->SetCampot12("");
			$this->campot13=$this->SetCampot13("");
			$this->campot14=$this->SetCampot14("");
			$this->campot15=$this->SetCampot15("");

			$this->es_publico = $this->Setes_publico("");
			$this->suscriptor_leido = $this->Setsuscriptor_leido("");
			$this->usuario_leido = $this->Setusuario_leido("");
			$this->suscriptor_updated = $this->Setsuscriptor_updated("");
			$this->usuario_updated = $this->Setusuario_updated("");

		}



		// CREACION DE SETTERS PARA PODER ASIGNARLE VALORES A LAS VARIABLES DEL OBJETO 

		function SetId($some)

		{

			$this->id=$some;

		}



		function SetRadicado($some)

		{

			$this->radicado=$some;

		}



		function SetF_recibido($some)

		{

			$this->f_recibido=$some;

		}



		function SetNombre_radica($some)

		{

			$this->nombre_radica=$some;

		}



		function SetFolio($some)

		{

			$this->folio=$some;

		}



		function SetTipo_documento($some)

		{

			$this->tipo_documento=$some;

		}



		function SetDependencia_destino($some)

		{

			$this->dependencia_destino=$some;

		}



		function SetNombre_destino($some)

		{

			$this->nombre_destino=$some;

		}



		function SetFecha_vencimiento($some)

		{

			$this->fecha_vencimiento=$some;

		}



		function SetEstado_respuesta($some)

		{

			$this->estado_respuesta=$some;

		}



		function SetNum_oficio_respuesta($some)

		{

			$this->num_oficio_respuesta=$some;

		}



		function SetFecha_respuesta($some)

		{

			$this->fecha_respuesta=$some;

		}



		function SetObservacion($some)

		{

			$this->observacion=$some;

		}



		function SetPrioridad($some)

		{

			$this->prioridad=$some;

		}



		function SetEstado_solicitud($some)

		{

			$this->estado_solicitud=$some;

		}



		function SetSuscriptor_id($some)

		{

			$this->suscriptor_id=$some;

		}



		function SetCiudad($some)

		{

			$this->ciudad=$some;

		}



		function SetUsuario_registra($some)

		{

			$this->usuario_registra=$some;

		}



		function SetEstado_archivo($some)

		{

			$this->estado_archivo=$some;

		}



		function SetOficina($some)

		{

			$this->oficina = $some;

		}



		function SetId_dependencia_raiz($some)

		{

			$this->id_dependencia_raiz = $some;

		}



		function SetFecha_registro($some){

			$this->fecha_registro = $some;

		}

		function SetMin_rad($some){

			$this->min_rad = $some;

		}

		function SetDocumento_salida($some){

			$this->documento_salida = $some;

		}


		function SetUri($some){

			$this->uri = $some;

		}

		function SetTs($some){

			$this->ts = $some;

		}

		function SetObservacion2($some)

		{

			$this->observacion2=$some;

		}	

		function SetTransferencia($some){
			$this->transferencia=$some;			
		}	

		function SetRweb($some){
			$this->rweb=$some;			
		}	

		function SetVersion($some){
			$this->version = $some;
		}
		function SetTipo_almacen($some){
			$this->tipo_almacen = $some;
		}
		function SetUbicacion_fisica($some){
			$this->ubicacion_fisica = $some;
		}
		function SetEstado_personalizado($some){
			$this->estado_personalizado = $some;
		}
		function SetCampot1($some){
			$this->campot1 = $some;
		}
		function SetCampot2($some){
			$this->campot2 = $some;
		}
		function SetCampot3($some){
			$this->campot3 = $some;
		}
		function SetCampot4($some){
			$this->campot4 = $some;
		}
		function SetCampot5($some){
			$this->campot5 = $some;
		}

		function SetCampot6($some){
			$this->campot6 = $some;
		}
		function SetCampot7($some){
			$this->campot7 = $some;
		}
		function SetCampot8($some){
			$this->campot8 = $some;
		}
		function SetCampot9($some){
			$this->campot9 = $some;
		}
		function SetCampot10($some){
			$this->campot10 = $some;
		}

		function SetCampot11($some){
			$this->campot11 = $some;
		}
		function SetCampot12($some){
			$this->campot12 = $some;
		}
		function SetCampot13($some){
			$this->campot13 = $some;
		}
		function SetCampot14($some){
			$this->campot14 = $some;
		}
		function SetCampot15($some){
			$this->campot15 = $some;
		}

		function Setes_publico($some){
			$this->es_publico = $some;
		}
		function Setsuscriptor_leido($some){
			$this->suscriptor_leido = $some;
		}
		function Setusuario_leido($some){
			$this->usuario_leido = $some;
		}
		function Setsuscriptor_updated($some){
			$this->suscriptor_updated = $some;
		}
		function Setusuario_updated($some){
			$this->usuario_updated = $some;
		}
		



		// CREACION DE GETTERS PARA PODER OBTENER LOS VALORES DE LAS VARIABLES DEL OBJETO

		function GetId()

		{

			return $this->id;

		}



		function GetRadicado()

		{

			return $this->radicado;

		}



		function GetF_recibido()

		{

			return $this->f_recibido;

		}



		function GetNombre_radica()

		{

			return $this->nombre_radica;

		}



		function GetFolio()

		{

			return $this->folio;

		}



		function GetTipo_documento()

		{

			return $this->tipo_documento;

		}



		function GetDependencia_destino()

		{

			return $this->dependencia_destino;

		}



		function GetNombre_destino()

		{

			return $this->nombre_destino;

		}



		function GetFecha_vencimiento()

		{

			return $this->fecha_vencimiento;

		}



		function GetEstado_respuesta()

		{

			return $this->estado_respuesta;

		}



		function GetNum_oficio_respuesta()

		{

			return $this->num_oficio_respuesta;

		}



		function GetFecha_respuesta()

		{

			return $this->fecha_respuesta;

		}



		function GetObservacion()

		{

			return $this->observacion;

		}



		function GetPrioridad()

		{

			return $this->prioridad;

		}



		function GetEstado_solicitud()

		{

			return $this->estado_solicitud;

		}



		function GetSuscriptor_id()

		{

			return $this->suscriptor_id;

		}



		function GetCiudad()

		{

			return $this->ciudad;

		}



		function GetUsuario_registra()

		{

			return $this->usuario_registra;

		}



		function GetEstado_archivo()

		{

			return $this->estado_archivo;

		}



		function GetOficina()

		{

			return $this->oficina;

		}

		function GetId_dependencia_raiz()

		{

			return $this->id_dependencia_raiz;

		}

		function GetFecha_registro()

		{

			return $this->fecha_registro;

		}

		function GetMin_rad()

		{

			return $this->min_rad;

		}

		function GetDocumento_salida()

		{

			return $this->documento_salida;

		}

		function GetUri()

		{

			return $this->uri;

		}

		function GetTs()

		{

			return $this->ts;

		}

		function GetObservacion2()

		{

			return $this->observacion2;

		}

		function GetTransferencia(){
			return $this->transferencia;			
		}	

		function GetRweb(){
			return $this->rweb;			
		}	

		function GetVersion(){
			return $this->version;
		}
		function GetTipo_almacen(){
			return $this->tipo_almacen;
		}
		function GetUbicacion_fisica(){
			return $this->ubicacion_fisica;
		}
		function GetEstado_personalizado(){
			return $this->estado_personalizado;
		}

		function GetCampot1(){
			return $this->campot1;
		}
		function GetCampot2(){
			return $this->campot2;
		}
		function GetCampot3(){
			return $this->campot3;
		}
		function GetCampot4(){
			return $this->campot4;
		}
		function GetCampot5(){
			return $this->campot5;
		}
		function GetCampot6(){
			return $this->campot6;
		}
		function GetCampot7(){
			return $this->campot7;
		}
		function GetCampot8(){
			return $this->campot8;
		}
		function GetCampot9(){
			return $this->campot9;
		}
		function GetCampot10(){
			return $this->campot10;
		}
		function GetCampot11(){
			return $this->campot11;
		}
		function GetCampot12(){
			return $this->campot12;
		}
		function GetCampot13(){
			return $this->campot13;
		}
		function GetCampot14(){
			return $this->campot14;
		}
		function GetCampot15(){
			return $this->campot15;
		}
		function Getes_publico(){
			return $this->es_publico;
		}
		function Getsuscriptor_leido(){
			return $this->suscriptor_leido;
		}
		function Getusuario_leido(){
			return $this->usuario_leido;
		}
		function Getsuscriptor_updated(){
			return $this->suscriptor_updated;
		}
		function Getusuario_updated(){
			return $this->usuario_updated;
		}
	}	
?>