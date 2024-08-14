<?php

Class Conecta{

var $user = "uhrakvkfj7e6b";
var $pass = "ga4dl3aq40vb";


   function getConexion(){
      $conn = mysqli_connect('localhost', $this->user, $this->pass,'dbk59im0bqmagc');
 
     if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
      
      return $conn;
   }

}


?>