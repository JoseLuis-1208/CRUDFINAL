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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id = $_POST["id"];
      $cantidad = $_POST["cantidad"];

      // Obtener el stock actual del platillo
      $sql = "SELECT stock FROM platillos WHERE id='$id'";
      $result = $conn->query($sql);

      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stockActual = $row["stock"];

        // Verificar si la cantidad a vender es válida
        if ($cantidad > 0 && $cantidad <= $stockActual) {
          $nuevoStock = $stockActual - $cantidad;

          // Actualizar el stock del platillo en la base de datos
          $updateSql = "UPDATE platillos SET stock='$nuevoStock' WHERE id='$id'";
          if ($conn->query($updateSql) === TRUE) {
            echo '<div class="alert alert-success">Cantidad vendida actualizada correctamente.</div>';
          } else {
            echo '<div class="alert alert-danger">Error al actualizar la cantidad vendida: ' . $conn->error . '</div>';
          }
        } else {
          echo '<div class="alert alert-danger">Cantidad inválida.</div>';
        }
      } else {
        echo '<div class="alert alert-danger">Error: No se encontró el platillo.</div>';
      }
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] === "deshabilitar" && isset($_GET["id"])) {
      $id = $_GET["id"];

      $updateSql = "UPDATE platillos SET habilitado='0' WHERE id='$id'";
      if ($conn->query($updateSql) === TRUE) {
        echo '<div class="alert alert-success">Platillo deshabilitado correctamente.</div>';
      } else {
        echo '<div class="alert alert-danger">Error al deshabilitar el platillo: ' . $conn->error . '</div>';
      }
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] === "habilitar" && isset($_GET["id"])) {
      $id = $_GET["id"];

      $updateSql = "UPDATE platillos SET habilitado='1' WHERE id='$id'";
      if ($conn->query($updateSql) === TRUE) {
        echo '<div class="alert alert-success">Platillo habilitado correctamente.</div>';
      } else {
        echo '<div class="alert alert-danger">Error al habilitar el platillo: ' . $conn->error . '</div>';
      }
    }

    // Obtener la lista de platillos
    $sql = "SELECT * FROM platillos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo '<div> 
      <a href="add.php" class="btn btn-success mb-3">Agregar Platillo</a>
      <a href="pantallaplatillos.php" class="btn btn-primary mb-3">Ver Platillos</a>
      <a href="login.php" class="btn btn-success mb-3">Cerrar sesión</a>
      </div>';
      echo '<table class="table">';
      echo '<thead class="thead-dark">';
      echo '<tr>';
      echo '<th>ID</th>';
      echo '<th>Nombre</th>';
      echo '<th>Descripción</th>';
      echo '<th>Precio</th>';
      echo '<th>Imagen</th>';
      echo '<th>Stock</th>';
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
        echo '<td>' . $row["Stock"] . '</td>';
        echo '<td>';
        echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
        echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
        echo '<input type="number" name="cantidad" min="1" max="' . $row["Stock"] . '" required>';
        echo '<input type="submit" class="btn btn-success btn-sm" value="Vender">';
        echo '</form>';

        if ($row["habilitado"] == 1) {
          echo '<a href="?action=deshabilitar&id=' . $row["id"] . '" class="btn btn-warning btn-sm">Deshabilitar</a>';
        } else {
          echo '<a href="?action=habilitar&id=' . $row["id"] . '" class="btn btn-success btn-sm">Habilitar</a>';
        }

        echo ' <a href="edit.php?id=' . $row["id"] . '" class="btn btn-primary btn-sm">Editar</a>';
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
