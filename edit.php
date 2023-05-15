  <?php

  require_once("db.php");

  $id = $_GET["id"];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $imagen = $_POST["imagen"];

    $sql = "UPDATE platillos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', imagen='$imagen' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
      echo "Platillo actualizado correctamente.";
    } else {
      echo "Error al actualizar el platillo: " . $conn->error;
    }

    $conn->close();
  } else {
    $sql = "SELECT * FROM platillos WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();

      $nombre = $row["nombre"];
      $descripcion = $row["descripcion"];
      $precio = $row["precio"];
      $imagen = $row["imagen"];
    } else {
      echo "Error: No se encontró el platillo.";
    }

    $conn->close();
  }

  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id";?>">
    Nombre: <input type="text" name="nombre" value="<?php echo $nombre;?>"><br>
    Descripción: <textarea name="descripcion"><?php echo $descripcion;?></textarea><br>
    Precio: <input type="text" name="precio" value="<?php echo $precio;?>"><br>
    Imagen: <input type="text" name="imagen" value="<?php echo $imagen;?>"><br>
    <input type="submit" value="Actualizar">
  </form>
