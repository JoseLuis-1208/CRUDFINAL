<?php

require_once("db.php");

$id = $_GET["id"];

$sql = "DELETE FROM platillos WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  echo "Platillo eliminado correctamente.";
  
  echo "<a href='index.php?id="  . "'>REGRESAR</a>";

} else {
  echo "Error al eliminar el platillo: " . $conn->error;

}

$conn->close();

?>
