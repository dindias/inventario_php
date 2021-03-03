<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <table>
    <th></th>
    <th></th>
    <th></th>
  </table>
  <?php
  session_start();
  
  $serverName = "localhost";
  $userName = "root";
  $password = "";
  $dbName = "test";

  //Crear conexión
  $conn = new mysqli($serverName, $userName, $password, $dbName);
  //Comprobar conexión
  if (mysqli_connect_errno()) {
    echo "Failed to connect";
    exit();
  } else {
    echo "Connection success";
  }

  //Crear base de datos
  $sql = "CREATE DATABASE IF NOT EXISTS inventario";
  if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
    echo                '<form action="" method="post">' .
      'Nombre: <input type="text" name="nombre">' .
      '</form>' .
      '<form action="" method="post">' .
      'Tipo: <input type="text" name="tipo">' .
      '</form>' .
      '<form action="" method="post">' .
      'Cantidad: <input type="text" name="cantidad">' .
      '<input type="submit">' .
      '</form>';

      $_SESSION['nom'] = $_POST['nombre'];
      $_SESSION['tipus'] = $_POST['tipo'];
      $_SESSION['quant'] = $_POST['cantidad'];
  } else {
    echo "Error creating database: " . $conn->error;
  }

  //Crear tabla SQL
  $sql = "CREATE TABLE IF NOT EXISTS MyGuests (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  email VARCHAR(50),
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";

  //Insertar dentro de la tabla
  $sql ==  "INSERT INTO MyGuests (firstname, lastname, email)
          VALUES (";$_SESSION['nom'];", ";$_SESSION['tipus'];", ";$_SESSION['quant'];")";
  $stmt = mysqli_query($conn, $sql);


  //Seleccionar la información
  $sql = "SELECT id, firstname, lastname FROM MyGuests";
  $result = $conn->query($sql);
  $result = mysqli_query($conn, $sql);
  $lineas = mysqli_fetch_all($result);

  echo var_dump($lineas);
  echo mysqli_error($conn);

  //Imprimir la información
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td> id: " . $row["id"] . "</td><td> - Nombre: " . $row["firstname"] . "</td><td>" . $row["lastname"] . "<br></td><tr>";
    }
  } else {
    echo "0 results";
  }
  $conn->close();
  ?>
</body>

</html>