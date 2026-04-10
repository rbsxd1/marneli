<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $referencia = $_POST['referencia'];

    // Validar que solo sean números
    if (!ctype_digit($referencia)) {
        die("Error: La referencia debe contener solo números.");
    }
    $banco      = mysqli_real_escape_string($conexion, $_POST['banco_emisor']);
    $fecha      = $_POST['fecha_pago'];
    $monto      = $_POST['monto']; // Nuevo
    $emisor     = mysqli_real_escape_string($conexion, $_POST['emisor']); // Nuevo

    $sql = "INSERT INTO pagos (referencia, banco_emisor, monto, emisor, fecha_pago)
    VALUES ('$referencia', '$banco', '$monto', '$emisor', '$fecha')";

    if (mysqli_query($conexion, $sql)) {
        header("Location: index.php?status=success");
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
