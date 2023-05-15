<!DOCTYPE html>
<html>
<head>
  <title>Agregar Platillo</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h1>Agregar Platillo</h1>

  <?php
  require_once("db.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];

    $imagen = $_FILES["imagen"]["name"];
    $imagen_temporal = $_FILES["imagen"]["tmp_name"];
    $carpeta_destino = "imagenes"; 
   
    move_uploaded_file($imagen_temporal, $carpeta_destino . '/' . $imagen);

    $sql = "INSERT INTO platillos (nombre, descripcion, precio, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$imagen')";

    if ($conn->query($sql) === TRUE) {
      echo '<div class="alert alert-success">Platillo agregado correctamente.</div>';
    } else {
      echo '<div class="alert alert-danger">Error al agregar el platillo: ' . $conn->error . '</div>';
    }

    $conn->close();
  }
  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nombre">Nombre:</label>
      <input type="text" class="form-control" name="nombre" required>
    </div>
    <div class="form-group">
      <label for="descripcion">Descripción:</label>
      <textarea class="form-control" name="descripcion" required></textarea>
    </div>
    <div class="form-group">
      <label for="precio">Precio:</label>
      <input type="text" class="form-control" name="precio" required>
    </div>
    <div class="form-group">
      <label for="imagen">Imagen:</label>
      <input type="file" class="form-control-file" name="imagen" required>
    </div>
    <input type="submit" class="btn btn-primary" value="Agregar">
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
