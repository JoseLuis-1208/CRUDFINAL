<!DOCTYPE html>
<html>

<head>
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

  <div class="container mt-5">
    <h2>Iniciar Sesión</h2>

    <?php
    require_once("db.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST["email"];
      $contraseña = $_POST["contraseña"];

      $sql = "SELECT * FROM usuarios WHERE email='$email'";
      $result = $conn->query($sql);

      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row["contraseña"])) {
            $_SESSION["usuario"] = $row["nombre"];
            $query = "UPDATE usuarios SET estado = true WHERE email='$email'"; // Actualiza el estado del usuario a conectado
            $conn->query($query);
          header("Location: index.php");
        } else {
          echo '<div class="alert alert-danger">Contraseña incorrecta.</div>';
        }
      } else {
        echo '<div class="alert alert-danger">Usuario no encontrado.</div>';
      }

      $conn->close();
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <div class="form-group">
        <label for="contraseña">Contraseña:</label>
        <input type="password" class="form-control" name="contraseña" required>
      </div>
      <input type="submit" class="btn btn-primary" value="Iniciar Sesión">
      <a href="register.php" class="btn btn-secondary">Registrarse</a>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>