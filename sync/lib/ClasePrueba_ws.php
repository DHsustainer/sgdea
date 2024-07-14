<?
session_start(); 

	class Prueba_ws{ 
 		var $id;

		var $cedula;

		var $nit_suscriptor;

		var $nombre_suscriptor;

		var $tipo_suscriptor;

		var $Direccion_suscriptor;

		var $Telefonos_suscriptor;

		var $Email_suscriptor;

		var $radicado;

		var $dependencia_destino;

		var $observacion;

		var $archivo;

		var $como_enviar_expediente;

		function Prueba_ws()
		{
			$this->id=$this->SetId("");
			$this->cedula=$this->SetCedula("");
			$this->nit_suscriptor=$this->SetNit_suscriptor("");
			$this->nombre_suscriptor=$this->SetNombre_suscriptor("");
			$this->tipo_suscriptor=$this->SetTipo_suscriptor("");
			$this->Direccion_suscriptor=$this->SetDireccion_suscriptor("");
			$this->Telefonos_suscriptor=$this->SetTelefonos_suscriptor("");
			$this->Email_suscriptor=$this->SetEmail_suscriptor("");
			$this->radicado=$this->SetRadicado("");
			$this->dependencia_destino=$this->SetDependencia_destino("");
			$this->observacion=$this->SetObservacion("");
			$this->archivo=$this->SetArchivo("");
			$this->como_enviar_expediente=$this->SetComo_enviar_expediente("");
		}

		function SetId($some)
		{
			$this->id=$some;
		}

		function SetCedula($some)
		{
			$this->cedula=$some;
		}

		function SetNit_suscriptor($some)
		{
			$this->nit_suscriptor=$some;
		}

		function SetNombre_suscriptor($some)
		{
			$this->nombre_suscriptor=$some;
		}

		function SetTipo_suscriptor($some)
		{
			$this->tipo_suscriptor=$some;
		}

		function SetDireccion_suscriptor($some)
		{
			$this->Direccion_suscriptor=$some;
		}

		function SetTelefonos_suscriptor($some)
		{
			$this->Telefonos_suscriptor=$some;
		}

		function SetEmail_suscriptor($some)
		{
			$this->Email_suscriptor=$some;
		}

		function SetRadicado($some)
		{
			$this->radicado=$some;
		}

		function SetDependencia_destino($some)
		{
			$this->dependencia_destino=$some;
		}

		function SetObservacion($some)
		{
			$this->observacion=$some;
		}

		function SetArchivo($some)
		{
			$this->archivo=$some;
		}

		function SetComo_enviar_expediente($some)
		{
			$this->como_enviar_expediente=$some;
		}

		function GetId()
		{
			return $this->id;
		}

		function GetCedula()
		{
			return $this->cedula;
		}

		function GetNit_suscriptor()
		{
			return $this->nit_suscriptor;
		}

		function GetNombre_suscriptor()
		{
			return $this->nombre_suscriptor;
		}

		function GetTipo_suscriptor()
		{
			return $this->tipo_suscriptor;
		}

		function GetDireccion_suscriptor()
		{
			return $this->Direccion_suscriptor;
		}

		function GetTelefonos_suscriptor()
		{
			return $this->Telefonos_suscriptor;
		}

		function GetEmail_suscriptor()
		{
			return $this->Email_suscriptor;
		}

		function GetRadicado()
		{
			return $this->radicado;
		}

		function GetDependencia_destino()
		{
			return $this->dependencia_destino;
		}

		function GetObservacion()
		{
			return $this->observacion;
		}

		function GetArchivo()
		{
			return $this->archivo;
		}

		function GetComo_enviar_expediente()
		{
			return $this->como_enviar_expediente;
		}

		function CreatePrueba_ws($id)
		{

			$q_str= 'select * from prueba_ws where id = '.$id;
			$query = mysql_query($q_str);
			$row = mysql_fetch_assoc($query);

				$this->id=$row['id'];
				$this->cedula=$row['cedula'];
				$this->nit_suscriptor=$row['nit_suscriptor'];
				$this->nombre_suscriptor=$row['nombre_suscriptor'];
				$this->tipo_suscriptor=$row['tipo_suscriptor'];
				$this->Direccion_suscriptor=$row['Direccion_suscriptor'];
				$this->Telefonos_suscriptor=$row['Telefonos_suscriptor'];
				$this->Email_suscriptor=$row['Email_suscriptor'];
				$this->radicado=$row['radicado'];
				$this->dependencia_destino=$row['dependencia_destino'];
				$this->observacion=$row['observacion'];
				$this->archivo=$row['archivo'];
				$this->como_enviar_expediente=$row['como_enviar_expediente'];
		}

		function CreatePrueba_wsBusqueda($id)
		{

			$q_str= 'select * from prueba_ws where id = '.$id;
			$query = mysql_query($q_str);
			$row = mysql_fetch_assoc($query);

				$this->id=$row['id'];
				$this->cedula=$row['cedula'];
				$this->nit_suscriptor=$row['nit_suscriptor'];
				$this->nombre_suscriptor=$row['nombre_suscriptor'];
				$this->tipo_suscriptor=$row['tipo_suscriptor'];
				$this->Direccion_suscriptor=$row['Direccion_suscriptor'];
				$this->Telefonos_suscriptor=$row['Telefonos_suscriptor'];
				$this->Email_suscriptor=$row['Email_suscriptor'];
				$this->radicado=$row['radicado'];
				$this->dependencia_destino=$row['dependencia_destino'];
				$this->observacion=$row['observacion'];
				$this->archivo=$row['archivo'];
				$this->como_enviar_expediente=$row['como_enviar_expediente'];
		}

		function DeletePrueba_ws($id)
		{

			$q_str= 'delete from prueba_ws where id = '.$id;
			$query = mysql_query($q_str);

			if (!$query) {
				echo 'Invalid query: '.mysql_error();
			}else{
				echo 'suceed';
			}
		}

		function InsertPrueba_ws($cedula, $nit_suscriptor, $nombre_suscriptor, $tipo_suscriptor, $Direccion_suscriptor, $Telefonos_suscriptor, $Email_suscriptor, $radicado, $dependencia_destino, $observacion, $archivo, $como_enviar_expediente)
		{

			$q_str = "INSERT INTO prueba_ws (cedula, nit_suscriptor, nombre_suscriptor, tipo_suscriptor, Direccion_suscriptor, Telefonos_suscriptor, Email_suscriptor, radicado, dependencia_destino, observacion, archivo, como_enviar_expediente) VALUES ('$cedula', '$nit_suscriptor', '$nombre_suscriptor', '$tipo_suscriptor', '$Direccion_suscriptor', '$Telefonos_suscriptor', '$Email_suscriptor', '$radicado', '$dependencia_destino', '$observacion', '$archivo', '$como_enviar_expediente')";
		
			$query = mysql_query($q_str); 
	
			if (!$query) {
				echo 'Invalid query: '.mysql_error();
			}else{
				echo 'succed';
			}
		} 

		function UpdatePrueba_ws($id, $cedula, $nit_suscriptor, $nombre_suscriptor, $tipo_suscriptor, $Direccion_suscriptor, $Telefonos_suscriptor, $Email_suscriptor, $radicado, $dependencia_destino, $observacion, $archivo, $como_enviar_expediente)
		{

			$q_str = "UPDATE prueba_ws SET cedula = '$cedula', nit_suscriptor = '$nit_suscriptor', nombre_suscriptor = '$nombre_suscriptor', tipo_suscriptor = '$tipo_suscriptor', Direccion_suscriptor = '$Direccion_suscriptor', Telefonos_suscriptor = '$Telefonos_suscriptor', Email_suscriptor = '$Email_suscriptor', radicado = '$radicado', dependencia_destino = '$dependencia_destino', observacion = '$observacion', archivo = '$archivo', como_enviar_expediente = '$como_enviar_expediente' WHERE id = ".$id;
	
			$query = mysql_query($q_str); 

			if (!$query) {
					echo 'Invalid query: '.mysql_error();
			}else{
				echo 'succed';
			}
		}

		function ListPrueba_ws()
		{

			$q_str = "SELECT * FROM prueba_ws";
	
			$query = mysql_query($q_str); 

			if (!$query) {
					echo 'Invalid query: '.mysql_error();
			}else{
				return $query;
			}
		}

	}	
	?>
