<?php
    // Configuración de la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "laboratorio";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consultar los registros de la tabla usuarios
    $sql = "SELECT * FROM usuario";
    $result = $conn->query($sql);

    // Mostrar la lista de registros
    if ($result->num_rows > 0) {
        echo "<h2>Lista de usuarios</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Email</th><th>Login</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["apellido1"] . "</td>";
            echo "<td>" . $row["apellido2"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["login"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros.";
    }

    // Cerrar la conexión
    $conn->close();
?>