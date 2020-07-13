<?php
session_start();
include './conectar.php';

//Si no esta identificado y esta queriendo identificarse...
if (
    !(
        $_POST["contactoSeccion"] == "comentario" or
        $_POST["contactoSeccion"] == "sugerencia" or
        $_POST["contactoSeccion"] == "bug"
    )
) {
    die("Error interno del servidor");
}

if (!filter_var($_POST["contactoMail"], FILTER_VALIDATE_EMAIL) or $_POST["contactoMail"] == null) {
    die("El mail ingresado no es correcto");
}

if ($_POST["contactoMensaje"] == null) {
    die('Error interno del servidor');
}

$ahora = time();

$sql = "INSERT INTO contacto (mail, seccion, mensaje, fecha, estado, comentario) VALUES ('$_POST[contactoMail]', '$_POST[contactoSeccion]', '$_POST[contactoMensaje]', '$ahora', '0', ' ')";
if (!mysqli_query($sql, $con)) {
    die('error' . mysqli_error($con));
}

echo 'ok';
?>
