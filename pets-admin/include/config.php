<?php
$servername = "localhost";
$username = "vxctoutc_doggtasticAdventures";
$password = "fEDf@hIbvL?d";

try {
  $conn = new PDO("mysql:host=$servername;dbname=vxctoutc_doggtastic", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>