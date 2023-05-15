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
      header("Location: index.php");
    } else {
      echo "Contraseña incorrecta.";
    }
  } else {
    echo "Usuario no encontrado.";
  }

  $conn->close();
}

?>

<h2>Iniciar Sesión</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  Email: <input type="email" name="email" required><br>
  Contraseña: <input type="password" name="contraseña" required><br>
  <input type="submit" value="Iniciar Sesión">
</form>

