<?php

/***********************************************************************************************

Archivo     : forms.php
Fecha       : 24-05-2024
Descripcion : Recibe informacion de formulario y envia correo.
Autor       : ediisa.com.mx              

Formularios : Se pueden agregar mas formularios si es requerido 

		1. Contacto                - CW
		2. Servicio                - ST
		3. Catalogo                - CD
		4. Maquinaria de Empaque   - MIL
		5. Papeleria y Ferreteria  - PFL
		6. Productos de Empaque    - PIL
        7. Quejas y sugerencias    - QYS
        8. Por definir

************************************************************************************************/

/*------------------------------------------------------------------------------------------------------------------
Datos estaticos.   
------------------------------------------------------------------------------------------------------------------*/

error_reporting(E_ERROR);	
require_once('phpmailer/class.phpmailer.php');
include("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
include ("db/connection.php");


// Tipo de form

$tipo = $_POST['tipo'];
//$tipo =1;

$mail  = new PHPMailer();
//$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.ediisa.com.mx"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                           // 1 = errors and messages
                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "secure323.sgcpanel.com"; // sets the SMTP server
$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
$mail->Username   = "clientes@ediisa.com.mx"; // SMTP account username
$mail->Password   = "Ediisa2020.20";        // SMTP account password

$mail->IsHTML(true);
$mail->CharSet = "UTF-8";
//$mail->Body;
$mail->SetFrom('clientes@ediisa.com.mx', 'Contacto Web',0);
$mail->AddReplyTo("clientes@ediisa.com.mx", "Contacto Web");
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$address = "u2.360x@gmail.com";
$mail->AddAddress($address, "Contacto Web");
#$address = "aneel.leon@ediisa.com.mx";

#$address = $email


$mail->AddCC("devek@devek.mx");

#$mail->addBCC("clientes@ediisa.com.mx");
#$mail->addBCC("aneel.leon@ediisa.com.mx");
#$mail->addBCC("contacto@visiontrade.com.mx");
#$mail->addBCC("u2.360x@gmail.com");




switch ($tipo){

// Contacto
   case 1:
	
	$nombre     = $_POST['nombre'];
	$apellido   = empty_field($_POST['apellido']);
	$email      = $_POST['email'];
	$telefono   = $_POST['telefono'];
	$empresa    = empty_field($_POST['empresa']);
	$estado     = (isset($_POST['estado'])) ? tr_estado($_POST['estado']) : "No capturado" ;
	//$estado     = tr_estado($_POST['estado']);
  

	
	if ( !isset( $_POST['producto_interes'] ) ){
    
		$pil        = 0;
		$mil        = 0;
    	$pfl        = 0;
		$ref        = 0;
		$otro       = 0;

	}else{
    
		$pil        = interes ("Productos de Empaque",$_POST['producto_interes']);
		$mil        = interes ("Maquinaria de Empaque",$_POST['producto_interes']);
    	$pfl        = interes ("Papelera y Ferretera",$_POST['producto_interes']);
		$ref        = interes ("Refacciones y servicio técnico",$_POST['producto_interes']);
		$otro       = interes ("Otro",$_POST['producto_interes']);

	}

	//$problema       =  empty_field($_POST['problema']);
	//$tipo_interes   =  empty_field($_POST['interes']);
	//$frecuencia     =  empty_field($_POST['frecuencia']);
	$problema       =  (isset($_POST['problema'])) ? empty_field($_POST['problema']) : "No capturado" ;
	$tipo_interes   =  (isset($_POST['tipo_interes'])) ? empty_field($_POST['tipo_interes']) : "No capturado" ;
	$frecuencia     =  (isset($_POST['frecuencia'])) ? empty_field($_POST['frecuencia']) : "No capturado" ;
  
  	$necesidad      =  empty_field($_POST['necesidad']);
	$url_contacto   = $_SERVER['HTTP_REFERER'];
	
	$sec_id = addLead ($tipo);
  
  
	$record = addContacto($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$pil,$mil,$pfl,$ref,$otro,$problema,$tipo_interes,$frecuencia,$necesidad,$url_contacto);
	

	$body   = "ID : ". $record[0] ."<br>";
	$body  .= "Fecha : ". $record[1] ."<br>";
	$body  .= "Nombre : ". $record[4] ."<br>";
	$body  .= "Apellidos : ". $record[5] ."<br>";
	$body  .= "email : ". $record[6] ."<br>";
	$body  .= "Teléfono : ". $record[7] ."<br>";
	$body  .= "Empresa : ". $record[8] ."<br>";
	$body  .= "Estado : ". $record[9] ."<br>";
	$body  .= "Productos en los que estoy interesado : " ."<br>";
	$body  .= "Productos de Empaque : ". $record[10] ."<br>";
	$body  .= "Maquinaria de Empaque : ". $record[11] ."<br>";
	$body  .= "Papeleria y Ferretera : ". $record[12] ."<br>";
	$body  .= "Refacciones y servicio técnico : ". $record[13] ."<br>";
	$body  .= "Problema : ". $record[15] ."<br>";
	$body  .= "Tipo de interés : ". $record[16] ."<br>";
	$body  .= "Cada cuanto compro este producto : ". $record[17] ."<br>";
	$body  .= "Necesidad : ". $record[18] ."<br>";
	$body  .= "Url de procedencia : ". $record[19] ."<br>";

	$mail->Subject = "Contacto Web";
	$mail->MsgHTML($body);
	

	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {   
		echo "1";
	}
	

	
	break;  
	
	// Servicio

   case 2:

	$nombre         = $_POST['nombre'];
	$apellido       = empty_field($_POST['apellidos']);
	$email          = $_POST['email'];
	$telefono       = $_POST['telefono'];
	$empresa        = empty_field($_POST['empresa']);
	$estado         = (isset($_POST['estado'])) ? tr_estado($_POST['estado']) : "No capturado" ;
	$interes        = (isset($_POST['interes'])) ? empty_field($_POST['interes']) : "No capturado" ;
	$necesidad      = empty_field($_POST['necesidad']);		
	$url_servicio   = $_SERVER['HTTP_REFERER'];
	
	$sec_id = addLead ($tipo);
		
	$record = addServicio($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$interes,$necesidad,$url_servicio);
	//testServicio($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$interes,$necesidad,$url_servicio);
	
	$body   = "ID : ". $record[0] ."<br>";
	$body  .= "Fecha : ". $record[1] ."<br>";
	$body  .= "Nombre : ". $record[4] ."<br>";
	$body  .= "Apellidos : ". $record[5] ."<br>";
	$body  .= "email : ". $record[6] ."<br>";
	$body  .= "Teléfono : ". $record[7] ."<br>";
	$body  .= "Empresa : ". $record[8] ."<br>";
	$body  .= "Estado : ". $record[9] ."<br>";
	$body  .= "Me interesa recibir asistencia en: : ". $record[10] ."<br>";
	$body  .= "Necesidad : ". $record[11] ."<br>";	
	$body  .= "Url de procedencia : ". $record[12] ."<br>";

	$mail->Subject = "Contacto Web Servicio";
	$mail->MsgHTML($body);
	

	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {   
		echo "1";
	}




   break;

	// Catalogo

   case 3:

      $email          = $_POST['demail'];
      $telefono       = $_POST['whatsapp'];
      $nombre         = $_POST['dnombre'];
      $actualizacion  = (isset($_POST['actualizaciones'])) ? (($_POST['actualizaciones'] == "on") ? 1 :0) : 0 ;
      $url_catalogo   = $_SERVER['HTTP_REFERER'];
      
      $sec_id = addLead ($tipo);
         
      $record = addCatalogo($sec_id,$email,$telefono,$nombre,$actualizacion,$url_catalogo);
      //testCatalogo($sec_id,$email,$telefono,$nombre,$actualizacion,$url_catalogo);
      
      $body   = "ID : ". $record[0] ."<br>";
      $body  .= "Fecha : ". $record[1] ."<br>";
      $body  .= "Email : ". $record[4] ."<br>";
      $body  .= "Teléfono : ". $record[5] ."<br>";
      $body  .= "Nombre : ". $record[6] ."<br>";
      $body  .= "Me gustaría recibir actualizaciones periódicas : ". $record[7] ."<br>";
      $body  .= "URL : " . $record[8] ."<br>";


      $mail->Subject = "Leads - Descarga Catalogo";
      $mail->MsgHTML($body);
      
      if(!$mail->Send()) {
         echo "Mailer Error: " . $mail->ErrorInfo;
      } else {   
         echo "1";
      }   
      
	break;
	
	// Maquinaria de Empaque

	case 4:

		
	$nombre         = $_POST['nombre'];
	$apellido       = empty_field($_POST['apellidos']);
	$email          = $_POST['email'];
	$telefono       = $_POST['telefono'];
	$empresa        = empty_field($_POST['empresa']);
	$estado         = (isset($_POST['estado'])) ? tr_estado($_POST['estado']) : "No capturado" ;
	$ayuda          = (isset($_POST['ayudar'])) ? empty_field($_POST['ayudar']) : "No capturado" ;
	$contacto       = (isset($_POST['encontrar'])) ? empty_field($_POST['encontrar']) : "No capturado" ;
	$necesidad      = empty_field($_POST['necesidad']);		
	$url_mil        = $_SERVER['HTTP_REFERER'];
	
	$sec_id = addLead ($tipo);
		
	$record = addMaqEmpaque($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$ayuda,$contacto,$necesidad,$url_mil);
	//testMil($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$ayuda,$contacto,$necesidad,$url_mil);
	//var_dump($record);
	
	$body   = "ID : ". $record[0] ."<br>";
	$body  .= "Fecha : ". $record[1] ."<br>";
	$body  .= "Nombre : ". $record[4] ."<br>";
	$body  .= "Apellidos : ". $record[5] ."<br>";
	$body  .= "email : ". $record[6] ."<br>";
	$body  .= "Teléfono : ". $record[7] ."<br>";
	$body  .= "Empresa : ". $record[8] ."<br>";
	$body  .= "Estado : ". $record[9] ."<br>";
	$body  .= "¿Cómo podemos ayudarte? : ". $record[10] ."<br>";
	$body  .= "¿Cómo nos encontraste? : ". $record[11] ."<br>";	
  $body  .= "Necesidad : ". $record[12] ."<br>";
	$body  .= "Url de procedencia : ". $record[13] ."<br>";

	$mail->Subject = "Contacto Web MIL";
    $mail->MsgHTML($body);
      
    if(!$mail->Send()) {
   	    echo "Mailer Error: " . $mail->ErrorInfo;
    } else {   
        echo "1";
    }   
	   
break;

   
// Papeleria y Ferreteria

case 5:

		
	$nombre         = $_POST['nombre'];
	$apellido       = empty_field($_POST['apellidos']);
	$email          = $_POST['email'];
	$telefono       = $_POST['telefono'];
	$empresa        = empty_field($_POST['empresa']);
	$estado         = (isset($_POST['estado'])) ? tr_estado($_POST['estado']) : "No capturado" ;
	$interes        = (isset($_POST['interes'])) ? empty_field($_POST['interes']) : "No capturado" ;
	$frecuencia     =  (isset($_POST['frecuencia'])) ? empty_field($_POST['frecuencia']) : "No capturado" ;
	$contacto       = (isset($_POST['encontraste'])) ? empty_field($_POST['encontraste']) : "No capturado" ;
	$necesidad      = empty_field($_POST['necesidad']);		
	$url_pfl        = $_SERVER['HTTP_REFERER'];
	
	$sec_id = addLead ($tipo);
		
	$record = addPfl($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$interes,$frecuencia,$contacto,$necesidad,$url_pfl);
	//testMil($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$ayuda,$contacto,$necesidad,$url_mil);
	//var_dump($record);
	$body   = "ID : ". $record[0] ."<br>";
	$body  .= "Fecha : ". $record[1] ."<br>";
	$body  .= "Nombre : ". $record[4] ."<br>";
	$body  .= "Apellidos : ". $record[5] ."<br>";
	$body  .= "email : ". $record[6] ."<br>";
	$body  .= "Teléfono : ". $record[7] ."<br>";
	$body  .= "Empresa : ". $record[8] ."<br>";
	$body  .= "Estado : ". $record[9] ."<br>";
	$body  .= "Tipo de interés : ". $record[10] ."<br>";
	$body  .= "¿Cada cuánto compro este producto? : ". $record[11] ."<br>";
	$body  .= "¿Cómo nos encontraste? : ". $record[12] ."<br>";
	$body  .= "Necesidad : ". $record[13] ."<br>";
	$body  .= "Url de procedencia : ". $record[14] ."<br>";

	$mail->Subject = "Leads Papeleria y Ferreteria";
	$mail->MsgHTML($body);
	

	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {   
		echo "1";
	}
	
break;

case 6:

		
	$nombre         = $_POST['nombre'];
	$apellido       = empty_field($_POST['apellidos']);
	$email          = $_POST['email'];
	$telefono       = $_POST['telefono'];
	$empresa        = empty_field($_POST['empresa']);
	$estado         = (isset($_POST['estado'])) ? tr_estado($_POST['estado']) : "No capturado" ;
	$interes        = (isset($_POST['interes'])) ? empty_field($_POST['interes']) : "No capturado" ;
	$frecuencia     =  (isset($_POST['frecuencia'])) ? empty_field($_POST['frecuencia']) : "No capturado" ;
	$contacto       = (isset($_POST['encontraste'])) ? empty_field($_POST['encontraste']) : "No capturado" ;
	$necesidad      = empty_field($_POST['necesidad']);		
	$url_pil        = $_SERVER['HTTP_REFERER'];
	
	$sec_id = addLead ($tipo);
		
	$record = addPil($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$interes,$frecuencia,$contacto,$necesidad,$url_pil);
	//testMil($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$ayuda,$contacto,$necesidad,$url_mil);

	$body   = "ID : ". $record[0] ."<br>";
	$body  .= "Fecha : ". $record[1] ."<br>";
	$body  .= "Nombre : ". $record[4] ."<br>";
	$body  .= "Apellidos : ". $record[5] ."<br>";
	$body  .= "email : ". $record[6] ."<br>";
	$body  .= "Teléfono : ". $record[7] ."<br>";
	$body  .= "Empresa : ". $record[8] ."<br>";
	$body  .= "Estado : ". $record[9] ."<br>";
	$body  .= "Tipo de interés : ". $record[10] ."<br>";
	$body  .= "¿Cada cuánto compro este producto? : ". $record[11] ."<br>";
	$body  .= "¿Cómo nos encontraste? : ". $record[12] ."<br>";
	$body  .= "Necesidad : ". $record[13] ."<br>";
	$body  .= "Url de procedencia : ". $record[14] ."<br>";

	$mail->Subject = "Contacto Web PIL";
	$mail->MsgHTML($body);
	

	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {   
		echo "1";
	}



break;


default:
  echo "0";

break;


} //switch

function empty_field ( $field ) {
	$field = ($field == "") ? "No capturado" : $field;
	return $field;
}

function interes ($category,$array) {
	$interes_exist = (in_array($category,$array)) ? 1 : 0;
	return $interes_exist;
}

function tr_estado ($field){

	$estados = [

		"Aguascalientes"      =>   "AGS",
		"Baja California"     =>   "BCN",
		"Baja California Sur" =>   "BCS",
		"Campeche"            =>   "CAM",
		"Chiapas"             =>   "CHP",
		"Chihuahua"           =>   "CHI",
		"Ciudad de México"    =>   "CDMX",
		"Coahuila"            =>   "COA",
		"Colima"              =>   "COL",
		"Durango"             =>   "DUR",
		"Guanajuato"          =>   "GTO",
		"Guerrero"            =>   "GRO",
		"Hidalgo"             =>   "HGO",
		"Jalisco"             =>   "JAL",
		"Estado de México"    =>   "MEX",
		"Michoacán"           =>   "MIC",
		"Morelos"             =>   "MOR",
		"Nayarit"             =>   "NAY",
		"Nuevo León"          =>   "NLE",
		"Oaxaca"              =>   "OAX",
		"Puebla"              =>   "PUE",
		"Querétato"           =>   "QRO",
		"Quintana Roo"        =>   "ROO",
		"San Luis Potosí"     =>   "SLP",
		"Sinaloa"             =>   "SIN",
		"Sonora"              =>   "SON",
		"Tabasco"             =>   "TAB",
		"Tamaulipas"          =>   "TAM",
		"Tlaxcala"            =>   "TLX",
		"Veracruz"            =>   "VER",
		"Yucatán"             =>   "YUC",
		"Zacatecas"           =>   "ZAC",
		"No capturado"        =>   "",
		
	];
	
	$result = array_search($field,$estados);

	return $result;

}     





?>