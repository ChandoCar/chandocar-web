<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanear los datos
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido. Por favor, vuelve a intentarlo.";
        exit();
    }

    // Preparar el contenido a guardar
    $log = "Nombre: $name\n";
    $log .= "Email: $email\n";
    $log .= "Mensaje:\n$message\n";
    $log .= "--------------------------\n";

    // Guardar en un archivo local
    $file = 'mensajes.txt'; // Archivo donde se guardarán los datos
    if (file_put_contents($file, $log, FILE_APPEND)) {
        echo "Mensaje guardado correctamente en mensajes.txt";
    } else {
        echo "Hubo un error al guardar el mensaje.";
    }
} else {
    echo "Acceso denegado.";
}
?>