<!DOCTYPE html>
<html>

<head>
  <title>Lista de Platillos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
    }
  </style>
</head>

<body>

  <div class="container">
    <h1>Lista de Platillos</h1>

    <?php
    require_once("db.php");

    $sql = "SELECT * FROM platillos";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
      echo '<div> 
      <a href="add.php" class="btn btn-success mb-3">Agregar Platillo</a>
      <a href="pantallaplatillos.php" class="btn btn-primary mb-3">Ver Platillos</a>
      <a href="login.php" class="btn btn-success mb-3">Cerrar sesion</a>

      </div>';
      echo '<table class="table">';
      echo '<thead class="thead-dark">';
      echo '<tr>';
      echo '<th>ID</th>';
      echo '<th>Nombre</th>';
      echo '<th>Descripción</th>';
      echo '<th>Precio</th>';
      echo '<th>Imagen</th>';
      echo '<th>Acciones</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["id"] . '</td>';
        echo '<td>' . $row["nombre"] . '</td>';
        echo '<td>' . $row["descripcion"] . '</td>';
        echo '<td>$' . $row["precio"] . '</td>';
        echo '<td><img src="./imagenes/' . $row["imagen"] . '" width="100"></td>';
        echo '<td>';
        echo '<a href="edit.php?id=' . $row["id"] . '" class="btn btn-primary btn-sm">Editar</a>';
        echo ' <a href="delete.php?id=' . $row["id"] . '" class="btn btn-danger btn-sm">Eliminar</a>';
        echo '</td>';
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    } else {
      echo '<div> 
      <a href="add.php" class="btn btn-success mb-3">Agregar Platillo</a>
      <a href="pantallaplatillos.php" class="btn btn-primary mb-3">Ver Platillos</a>
      
      </div>';
      echo '<div class="alert alert-info">No hay platillos en la base de datos.</div>';
    }

    $conn->close();
    ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>