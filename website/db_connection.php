<?php
function OpenCon() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "RNXNRngu7898";
    $db = "prototype";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    
    return $conn;
 }
 
function CloseCon($conn) {
    $conn -> close();
}
   
?>