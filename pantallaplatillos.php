<!DOCTYPE html>
<html>

<head>
  <title>Lista de Platillos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      margin-top: 50px;
    }

    .card {
      margin-bottom: 30px;
      border-radius: 10px;
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      background-color: #ffffff;
      transition: transform 0.2s;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card-img {
      border-radius: 10px 10px 0 0;
      max-height: 200px;
      object-fit: cover;
    }

    .card-body {
      padding: 20px;
    }

    .card-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .card-text {
      margin-bottom: 10px;
    }

    .card-price {
      font-size: 20px;
      font-weight: bold;
      color: #e74c3c;
      margin-bottom: 10px;
    }

    .card-stock {
      font-size: 16px;
      color: #888888;
      margin-bottom: 10px;
    }

    .centrar {
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="container">
    <h1 class="text-center">Menú de Platillos</h1>
    <div class="row">
      <?php
      require_once("db.php");

      $sql = "SELECT * FROM platillos WHERE habilitado = 1";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="col-md-4">';
          echo '<div class="card">';
          echo '<img src="imagenes/' . $row["imagen"] . '" class="card-img-top" alt="Platillo">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $row["nombre"] . '</h5>';
          echo '<p class="card-text">' . $row["descripcion"] . '</p>';
          echo '<p class="card-price">$' . $row["precio"] . '</p>';
          echo '<p class="card-stock">Stock: ' . $row["Stock"] . '</p>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
      } else {
        echo '<div class="alert alert-info">No hay platillos habilitados en la base de datos.</div>';
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
