<!DOCTYPE html>
<html>
<head>
  <title>Eliminar Platillo</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h1>Eliminar Platillo</h1>

  <?php
  require_once("db.php");

  $id = $_GET["id"];

  $sql = "DELETE FROM platillos WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
    echo '<div class="alert alert-success">Platillo eliminado correctamente.</div>';
  } else {
    echo '<div class="alert alert-danger">Error al eliminar el platillo: ' . $conn->error . '</div>';
  }

  $conn->close();
  ?>

  <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-primary mt-3">REGRESAR</a>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
