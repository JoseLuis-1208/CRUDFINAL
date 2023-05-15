<!DOCTYPE html>
<html>
<head>
  <title>Registro de Usuario</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2>Registro de Usuario</h2>

  <?php
  require_once("db.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";

    if ($conn->query($sql) === TRUE) {
      echo '<div class="alert alert-success">Registro exitoso. Ahora puedes iniciar sesión.</div>';
    } else {
      echo '<div class="alert alert-danger">Error al registrar el usuario: ' . $conn->error . '</div>';
    }
    echo '<a href="index.php?id=" class="btn btn-primary mt-3">REGRESAR</a>';

    $conn->close();
  }
  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
      <label for="nombre">Nombre:</label>
      <input type="text" class="form-control" name="nombre" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
      <label for="contraseña">Contraseña:</label>
      <input type="password" class="form-control" name="contraseña" required>
    </div>
    <input type="submit" class="btn btn-primary" value="Registrar">
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
