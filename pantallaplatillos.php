<!DOCTYPE html>
<html>

<head>
  <title>Lista de Platillos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
    }

    .card {
      margin-bottom: 20px;
    }

    .card-body {
      padding: 20px;
    }

    .card-title {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .card-text {
      margin-bottom: 10px;
    }

    .card-img {
      max-height: 200px;
      object-fit: cover;
    }

    .centrar {
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="container">
    <h1>Lista de Platillos</h1>

    <div class="row">
      <?php
      require_once("db.php");

      $sql = "SELECT * FROM platillos";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="col-md-4 centrar">';
          echo '<div class="card">';
          echo '<img src="imagenes/' . $row["imagen"] . '" class="card-img-top" alt="Platillo">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $row["nombre"] . '</h5>';
          echo '<p class="card-text">' . $row["descripcion"] . '</p>';
          echo '<p class="card-text">$' . $row["precio"] . '</p>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
      } else {
        echo '<div class="alert alert-info">No hay platillos en la base de datos.</div>';
      }

      $conn->close();
      ?>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>