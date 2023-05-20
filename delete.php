<!DOCTYPE html>
<html>
<head>
  <title>Eliminar Platillo</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script>
    function confirmarEliminacion() {
      return confirm("¿Estás seguro de que deseas eliminar este producto?");
    }
  </script>
</head>
<body>

<div class="container mt-5">
  <h1>Eliminar Platillo</h1>

  <?php
  require_once("db.php");

  $id = $_GET["id"];

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["confirmacion"]) && $_POST["confirmacion"] === "yes") {
      $sql = "DELETE FROM platillos WHERE id='$id'";

      if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success">Platillo eliminado correctamente.</div>';
      } else {
        echo '<div class="alert alert-danger">Error al eliminar el platillo: ' . $conn->error . '</div>';
      }

      $conn->close();
    } else {
      echo '<div class="alert alert-info">La eliminación del platillo ha sido cancelada.</div>';
    }
  }
  ?>

  <form method="post" onsubmit="return confirmarEliminacion();">
    <input type="hidden" name="confirmacion" value="yes">
    <button type="submit" class="btn btn-danger">Eliminar</button>
    <a href="index.php" class="btn btn-success">Regresar</a>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
