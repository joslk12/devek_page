<?php
error_reporting(E_ALL ^ E_DEPRECATED);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/********************************************************************
Archivo     : connection.php
Fecha       : 27-05-2024
Descripcion : 
              a) Recibe informacion de formularios y la envia a la base de datos.
              
Autor       : ediisa.com.mx              

Formularios : la informacion proviene de los formularios: 
		  
        1. Contacto                - CW
        2. Servicio                - ST
        3. Catalogo                - CD
        4. Maquinaria de Empaque   - MIL
        5. Papeleria y Ferreteria  - PFL
        6. Productos de Empaque    - PIL

********************************************************************/

require('local_info.php');
//require('remote_info.php');

date_default_timezone_set('America/Mexico_City');



function addLead ( $tipo_form ) {

   $fecha = date('Y-m-d H:i');
   $fechat = date_create();
   $times = date_timestamp_get($fechat);

   $nueva = new Conecta();
   $conn  = $nueva->getConexion();
   
   $sql = "INSERT INTO leads (fecha_lead,epoc,tipo_lead)
           VALUES ('$fecha',$times,$tipo_form)";
   
   mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn));
     
   if ( mysqli_affected_rows($conn) > 0 ){
      $my_insert_id = mysqli_insert_id($conn);    
   }

   mysqli_close($conn);
     
   return $my_insert_id;
}

/*
  Contacto
*/

function addContacto ( $sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$pil,$mil,$pfl,$ref,$otro,$problema,$tipo_interes,$frecuencia,$necesidad,$url ) {

   $nueva = new Conecta();
   $conn  = $nueva->getConexion();
      
   
   $sql = "INSERT INTO contacto (id_contacto_lead,nombre_contacto,apellidos_contacto,email_contacto,telefono_contacto,empresa_contacto,
                                 estado_contacto,pil_contacto,mil_contacto,pfl_contacto,ref_contacto,
                                 otro_contacto,problema_contacto,tipo_interes_contacto,frecuencia_contacto,necesidad_contacto,url_contacto)
            VALUES ($sec_id,'$nombre','$apellido','$email','$telefono','$empresa','$estado',$pil,$mil,$pfl,$ref,$otro,'$problema','$tipo_interes','$frecuencia','$necesidad','$url')";
   
   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;
  
      
   $sql = "SELECT CONCAT(\"CW-\",leads.id_lead) AS folio,
   leads.fecha_lead,
   contacto.id_contacto, 
   contacto.id_contacto_lead, 
   contacto.nombre_contacto, 
   contacto.apellidos_contacto, 
   contacto.email_contacto, 
   contacto.telefono_contacto, 
   contacto.empresa_contacto, 
   contacto.estado_contacto, 
   IF(contacto.pil_contacto = 1,\"Si\",\"No\") as pil_contacto,  
   IF(contacto.mil_contacto = 1,\"Si\",\"No\") as mil_contacto,
   IF(contacto.pfl_contacto = 1,\"Si\",\"No\") as pfl_contacto,   
   IF(contacto.ref_contacto = 1,\"Si\",\"No\") as ref_contacto,   
   IF(contacto.otro_contacto = 1,\"Si\",\"No\") as otro_contacto,   
   contacto.problema_contacto, 
   contacto.tipo_interes_contacto, 
   contacto.frecuencia_contacto, 
   contacto.necesidad_contacto, 
   contacto.url_contacto 
   FROM leads 
   INNER JOIN contacto on leads.id_lead = contacto.id_contacto_lead 
   WHERE leads.id_lead = $sec_id"; 

   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;
   
   $fila = mysqli_fetch_row($result);   
   mysqli_free_result($result);
   mysqli_close($conn);
   
   
   return $fila;

}

/*
   Servicio
*/


function addServicio($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$interes,$necesidad,$url){
   
   $nueva = new Conecta();
   $conn  = $nueva->getConexion();
   
   $sql = "INSERT INTO servicio (id_servicio_lead,nombre_servicio,apellidos_servicio,email_servicio,telefono_servicio,empresa_servicio,
                                 estado_servicio,interes_servicio,necesidad_servicio,url_servicio)
            VALUES ($sec_id,'$nombre','$apellido','$email','$telefono','$empresa','$estado','$interes','$necesidad','$url')";
   
   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;
  
      
   $sql = "SELECT CONCAT(\"ST-\",leads.id_lead) AS folio,
   leads.fecha_lead ,
   servicio.id_servicio, 
   servicio.id_servicio_lead, 
   servicio.nombre_servicio, 
   servicio.apellidos_servicio, 
   servicio.email_servicio, 
   servicio.telefono_servicio, 
   servicio.empresa_servicio, 
   servicio.estado_servicio, 
   servicio.interes_servicio, 
   servicio.necesidad_servicio, 
   servicio.url_servicio
   FROM leads 
   INNER JOIN servicio on leads.id_lead = servicio.id_servicio_lead 
   WHERE leads.id_lead = $sec_id"; 

   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;
   
   $fila = mysqli_fetch_row($result);   
   mysqli_free_result($result);
   mysqli_close($conn);
   
   
   return $fila;

}

/*
   Catalogo
*/

function addCatalogo ($sec_id,$email,$telefono,$nombre,$actualizacion,$url) {

   $nueva = new Conecta();
   $conn  = $nueva->getConexion();
   
   $sql = "INSERT INTO catalogo (id_catalogo_lead,email_catalogo,telefono_catalogo,nombre_catalogo,
                                 actualizacion_catalogo,url_catalogo)
            VALUES ($sec_id,'$email','$telefono','$nombre',$actualizacion,'$url')";
   
      
   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;
   
   $sql = "SELECT CONCAT(\"CD-\",leads.id_lead) AS folio,
   leads.fecha_lead ,
   catalogo.id_catalogo, 
   catalogo.id_catalogo_lead, 
   catalogo.email_catalogo, 
   catalogo.telefono_catalogo, 
   catalogo.nombre_catalogo, 
   IF(catalogo.actualizacion_catalogo=1,\"Si\",\"No\") as actualizacion_catalogo, 
   catalogo.url_catalogo
   FROM leads 
   INNER JOIN catalogo on leads.id_lead = catalogo.id_catalogo_lead 
   WHERE leads.id_lead = $sec_id"; 

   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;

   $fila = mysqli_fetch_row($result);

   mysqli_free_result($result);
   mysqli_close($conn);
 

   return $fila;
   
 }

/*
   Maquinaria de Empaque   
*/



function addMaqEmpaque ($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$ayuda,$contacto,$necesidad,$url) {

   $nueva = new Conecta();
   $conn  = $nueva->getConexion();
   
   $sql = "INSERT INTO empaque (id_empaque_lead,nombre_empaque,apellidos_empaque,email_empaque,telefono_empaque,empresa_empaque,
                       estado_empaque, opcion_ayuda_empaque,contacto_empaque,necesidad_empaque,url_empaque)
            VALUES ($sec_id,'$nombre','$apellido','$email','$telefono','$empresa','$estado','$ayuda','$contacto','$necesidad','$url')";
   
      
   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;
   
   $sql = "SELECT CONCAT(\"MIL-\",leads.id_lead) AS folio,
   leads.fecha_lead ,
   empaque.id_empaque, 
   empaque.id_empaque_lead, 
   empaque.nombre_empaque, 
   empaque.apellidos_empaque,
   empaque.email_empaque, 
   empaque.telefono_empaque, 
   empaque.empresa_empaque,
   empaque.estado_empaque, 
   empaque.opcion_ayuda_empaque,
   empaque.contacto_empaque, 
   empaque.necesidad_empaque, 
   empaque.url_empaque
   FROM leads 
   INNER JOIN empaque on leads.id_lead = empaque.id_empaque_lead 
   WHERE leads.id_lead = $sec_id"; 

   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;

   $fila = mysqli_fetch_row($result);

   mysqli_free_result($result);
   mysqli_close($conn);
 

   return $fila;
   
 }


 /*
   Papeleria y Ferreteria

*/

function  addPfl($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$interes,$frecuencia,$contacto,$necesidad,$url){

   $nueva = new Conecta();
   $conn  = $nueva->getConexion();
   
   $sql = "INSERT INTO papelera (id_papelera_lead,nombre_papelera,apellidos_papelera,email_papelera,telefono_papelera,
                                 empresa_papelera,estado_papelera,interes_papelera,frecuencia_papelera,contacto_papelera,necesidad_papelera,url_papelera)
            VALUES ($sec_id,'$nombre','$apellido','$email','$telefono','$empresa','$estado','$interes','$frecuencia','$contacto','$necesidad','$url')";
   
      
   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;
   
   $sql = "SELECT CONCAT(\"PFL-\",leads.id_lead) AS folio,
   leads.fecha_lead ,
   papelera.id_papelera,
   papelera.id_papelera_lead,
   papelera.nombre_papelera,
   papelera.apellidos_papelera,
   papelera.email_papelera,
   papelera.telefono_papelera,
   papelera.empresa_papelera,
   papelera.estado_papelera,
   papelera.interes_papelera,
   papelera.frecuencia_papelera,
   papelera.contacto_papelera,
   papelera.necesidad_papelera,
   papelera.url_papelera
   FROM leads 
   INNER JOIN papelera on leads.id_lead = papelera.id_papelera_lead 
   WHERE leads.id_lead = $sec_id"; 

   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;

   $fila = mysqli_fetch_row($result);

   mysqli_free_result($result);
   mysqli_close($conn);
 

   return $fila;
   
 }


 /*
   Productos de Empaque

*/

function  addPil($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$interes,$frecuencia,$contacto,$necesidad,$url){

   $nueva = new Conecta();
   $conn  = $nueva->getConexion();
   
   $sql = "INSERT INTO pempaque (id_pempaque_lead,nombre_pempaque,apellidos_pempaque,email_pempaque,telefono_pempaque,
                                 empresa_pempaque,estado_pempaque,interes_pempaque,frecuencia_pempaque,contacto_pempaque,necesidad_pempaque,url_pempaque)
            VALUES ($sec_id,'$nombre','$apellido','$email','$telefono','$empresa','$estado','$interes','$frecuencia','$contacto','$necesidad','$url')";
   
      
   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;
   
   $sql = "SELECT CONCAT(\"PIL-\",leads.id_lead) AS folio,
   leads.fecha_lead ,
   pempaque.id_pempaque,
   pempaque.id_pempaque_lead,
   pempaque.nombre_pempaque,
   pempaque.apellidos_pempaque,
   pempaque.email_pempaque,
   pempaque.telefono_pempaque,
   pempaque.empresa_pempaque,
   pempaque.estado_pempaque,
   pempaque.interes_pempaque,
   pempaque.frecuencia_pempaque,
   pempaque.contacto_pempaque,
   pempaque.necesidad_pempaque,
   pempaque.url_pempaque
   FROM leads 
   INNER JOIN pempaque on leads.id_lead = pempaque.id_pempaque_lead 
   WHERE leads.id_lead = $sec_id"; 

   $result = mysqli_query($conn,$sql) or die("Error" . mysqli_error($conn)) ;

   $fila = mysqli_fetch_row($result);

   mysqli_free_result($result);
   mysqli_close($conn);
 

   return $fila;
   
 }





/**
 * Funciones para debuggear - 
 */

 function testContacto ( $sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$pil,$mil,$pfl,$ref,$otro,$problema,$tipo_interes,$frecuencia,$necesidad,$url_contacto ) {

    
   $sql = "INSERT INTO contacto (id_contacto_lead,nombre_contacto,apellidos_contacto,email_contacto,telefono_contacto,empresa_contacto,
                                 estado_contacto,pil_contacto,mil_contacto,pfl_contacto,ref_contacto,
                                 otro_contacto,problema_contacto,tipo_interes_contacto,frecuencia_contacto,necesidad_contacto,url_contacto)
           VALUES ($sec_id,'$nombre','$apellido','$email','$telefono','$empresa','$estado',$pil,$mil,$pfl,$ref,$otro,'$problema','$tipo_interes','$frecuencia','$necesidad','$url_contacto')";
   
   echo $sql;
   
 }

 function testServicio ($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$interes,$necesidad,$url){

    
   $sql = "INSERT INTO servicio (id_servicio_lead,nombre_servicio,apellidos_servicio,email_servicio,telefono_servicio,empresa_servicio,
                                 estado_servicio,interes_servicio,necesidad_servicio,url_servicio)
            VALUES ($sec_id,'$nombre','$apellido','$email','$telefono','$empresa','$estado','$interes','$necesidad','$url')";
   
   echo $sql;
   
 }

 function testCatalogo ($sec_id,$email,$telefono,$nombre,$actualizacion,$url) {
    
   $sql = "INSERT INTO catalogo (id_catalogo_lead,email_catalogo,telefono_catalogo,nombre_catalogo,
                                 actualizacion_catalogo,url_catalogo)
            VALUES ($sec_id,'$email','$telefono','$nombre',$actualizacion,'$url')";
   
   echo $sql;
   
 }


 function testMil($sec_id,$nombre,$apellido,$email,$telefono,$empresa,$estado,$ayuda,$contacto,$necesidad,$url){
   
   $sql = "INSERT INTO empaque (id_empaque_lead,nombre_empaque,apellidos_empaque,email_empaque,telefono_empaque,empresa_empaque,
                       estado_empaque, opcion_ayuda_empaque,contacto_empaque,necesidad_empaque,url_empaque)
            VALUES ($sec_id,'$nombre','$apellido','$email','$telefono','$empresa','$estado','$ayuda','$contacto','$necesidad','$url')";
   
   echo $sql;
 }










?>


