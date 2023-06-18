<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $passwordFile = $_POST["password"];

    // Validación en PHP
    if (empty($nombre) || empty($apellido1) || empty($apellido2) || empty($email) || empty($login) || empty($passwordFile)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El formato del correo electrónico no es válido.";
        exit;
    }

    if (strlen($passwordFile) < 4 || strlen($passwordFile) > 8) {
        echo "La contraseña debe tener entre 4 y 8 caracteres.";
        exit;
    }

    // Guardar en la base de datos (aquí deberás usar tus propias credenciales y lógica de base de datos)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "laboratorio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Verificar si el correo electrónico ya existe en la base de datos
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "El correo electrónico ya está registrado. Por favor, inténtalo de nuevo.";
    } else {
        $insertSql = "INSERT INTO usuario (nombre, apellido1, apellido2, email, login, password)
                  VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$passwordFile')";

        if ($conn->query($insertSql) === TRUE) {
            // Registro exitoso
            echo "Registro completado con éxito.";

            // Botón para consultar los registros
            echo "<button onclick=\"location.href='consulta.php'\">Consulta</button>";
        } else {
            echo "Error al insertar los datos: " . $conn->error;
        }
    }

    $conn->close();

}
?>
