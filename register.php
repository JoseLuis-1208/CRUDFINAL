<?php

require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $email = $_POST["email"];
  $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

  $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";

  if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso. Ahora puedes iniciar sesión.";
  } else {
    echo "Error al registrar el usuario: " . $conn->error;
  }
  echo "<a href='index.php?id="  . "'>REGRESAR</a>";

  $conn->close();
}

?>

<h2>Registro de Usuario</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  Nombre: <input type="text" name="nombre" required><br>
  Email: <input type="email" name="email" required><br>
  Contraseña: <input type="password" name="contraseña" required><br>
  <input type="submit" value="Registrar">
</form>
