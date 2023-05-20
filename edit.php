<!DOCTYPE html>
<html>
<head>
  <title>Actualizar Platillo</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h1>Actualizar Platillo</h1>

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
      echo '<div class="alert alert-success">Platillo actualizado correctamente.</div>';
    } else {
      echo '<div class="alert alert-danger">Error al actualizar el platillo: ' . $conn->error . '</div>';
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
      echo '<div class="alert alert-danger">Error: No se encontró el platillo.</div>';
    }

    $conn->close();
  }
  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id";?>">
    <div class="form-group">
      <label for="nombre">Nombre:</label>
      <input type="text" class="form-control" name="nombre" value="<?php echo $nombre;?>" required>
    </div>
    <div class="form-group">
      <label for="descripcion">Descripción:</label>
      <textarea class="form-control" name="descripcion" required><?php echo $descripcion;?></textarea>
    </div>
    <div class="form-group">
      <label for="precio">Precio:</label>
      <input type="text" class="form-control" name="precio" value="<?php echo $precio;?>" required>
    </div>
    <div class="form-group">
      <label for="imagen">Imagen:</label>
      <input type="text" class="form-control" name="imagen" value="<?php echo $imagen;?>" required>
    </div>
    
    <input type="submit" class="btn btn-primary" value="Actualizar">
    <a href="index.php" class="btn btn-success ">Regresar</a>

  </form> 
  
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
